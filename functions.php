<?php
/**
 * Boğaziçi Teması - Functions
 * 
 * Bu dosya temanın tüm temel fonksiyonlarını barındırır:
 * - Tema ayarları (menüler, post thumbnails, vs.)
 * - Asset yükleme (CSS, JS, fontlar)
 * - Çoklu dil desteği (TR/EN/IT)
 * - Hub'a dönüş şeridi
 * - Custom Post Type: Medya
 * 
 * Version: 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Direkt erişimi engelle
}

/* ============================================
   1. TEMEL TEMA AYARLARI
   ============================================ */
function bogazici_theme_setup() {
    // Sayfa başlığını WordPress'e bırak
    add_theme_support('title-tag');

    // Öne çıkan görsel desteği
    add_theme_support('post-thumbnails');

    // Özel logo desteği
    add_theme_support('custom-logo', [
        'height'      => 80,
        'width'       => 240,
        'flex-height' => true,
        'flex-width'  => true,
    ]);

    // HTML5 desteği
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ]);

    // Otomatik feed bağlantıları
    add_theme_support('automatic-feed-links');

    // Menü konumları
    register_nav_menus([
        'ana-menu' => __('Ana Menü', 'bogazici-tema'),
    ]);
}
add_action('after_setup_theme', 'bogazici_theme_setup');

/* ============================================
   2. SABİT DEĞERLER
   ============================================ */
if (!defined('BOGAZICI_HUB_URL')) {
    define('BOGAZICI_HUB_URL', 'https://www.sedat.bornova.li/');
}

/* ============================================
   3. ASSET YÜKLEME (CSS, JS, Fontlar)
   ============================================ */
function bogazici_enqueue_assets() {
    $version = wp_get_theme()->get('Version');

    // Google Fonts: Cardo (başlık) + Lato (gövde)
    wp_enqueue_style(
        'bogazici-google-fonts',
        'https://fonts.googleapis.com/css2?family=Cardo:ital,wght@0,400;0,700;1,400&family=Lato:wght@300;400;700&display=swap',
        [],
        null
    );

    // Ana stil dosyası
    wp_enqueue_style(
        'bogazici-main',
        get_stylesheet_uri(),
        [],
        $version
    );

    // JavaScript
    wp_enqueue_script(
        'bogazici-script',
        get_template_directory_uri() . '/theme.js',
        [],
        $version,
        true
    );
}
add_action('wp_enqueue_scripts', 'bogazici_enqueue_assets');

/* ============================================
   4. ÇOKLU DİL DESTEĞİ - TEMEL ALTYAPI
   ============================================ */

/**
 * Mevcut dilin slug'ını döndürür: 'tr', 'en' veya 'it'
 * Polylang veya WPML aktifse onları kullanır.
 */
function bogazici_get_current_lang_slug() {
    if (function_exists('pll_current_language')) {
        $lang = pll_current_language('slug');
        return $lang ?: 'tr';
    }

    if (defined('ICL_LANGUAGE_CODE')) {
        return ICL_LANGUAGE_CODE;
    }

    return 'tr';
}

/**
 * 3 dilde çevrilmiş metni döndürür.
 * 
 * Kullanım:
 *   echo bogazici_translate([
 *       'tr' => 'Yazar',
 *       'en' => 'Author',
 *       'it' => 'Autore',
 *   ]);
 */
function bogazici_translate(array $texts) {
    $slug = bogazici_get_current_lang_slug();

    if (isset($texts[$slug])) {
        return $texts[$slug];
    }

    if (isset($texts['tr'])) {
        return $texts['tr'];
    }

    return reset($texts);
}

/**
 * Hub URL'sini mevcut dile göre döndürür.
 */
function bogazici_get_hub_url() {
    $slug = bogazici_get_current_lang_slug();

    if ($slug === 'en') {
        return BOGAZICI_HUB_URL . 'en/';
    }

    if ($slug === 'it') {
        return BOGAZICI_HUB_URL . 'it/';
    }

    return BOGAZICI_HUB_URL;
}

/* ============================================
   5. HUB RETURN STRIP — Yazar Şeridi
   Header'da çağırılır. Tüm uydu sitelerin ortak elemanı.
   ============================================ */
function bogazici_render_hub_strip() {
    $author_label = bogazici_translate([
        'tr' => 'Yazar:',
        'en' => 'Author:',
        'it' => 'Autore:',
    ]);

    $hub_label = bogazici_translate([
        'tr' => 'Tüm Kitapları Görüntüle',
        'en' => 'View All Books',
        'it' => 'Visualizza Tutti i Libri',
    ]);

    $url = bogazici_get_hub_url();

    echo '<div class="hub-return-strip">';
    echo '<a href="' . esc_url($url) . '">';
    echo esc_html($author_label) . ' <strong>Sedat Bornovalı</strong> · ' . esc_html($hub_label);
    echo '<span class="hub-arrow" aria-hidden="true">→</span>';
    echo '</a>';
    echo '</div>';
}

/* ============================================
   6. CUSTOM POST TYPE: MEDYA
   sedat-tema'daki "medya" CPT'sinin aynısı.
   Boğaziçi hakkında çıkmış basın haberlerini, röportajları, eleştirileri burada toplayacağız.
   ============================================ */
function bogazici_register_cpt_medya() {
    $labels = [
        'name'                  => _x('Medya', 'Post type genel adı', 'bogazici-tema'),
        'singular_name'         => _x('Medya Yazısı', 'Post type tekil adı', 'bogazici-tema'),
        'menu_name'             => _x('Medya', 'Admin menüsü', 'bogazici-tema'),
        'name_admin_bar'        => _x('Medya Yazısı', 'Admin bar', 'bogazici-tema'),
        'add_new'               => __('Yeni Ekle', 'bogazici-tema'),
        'add_new_item'          => __('Yeni Medya Yazısı Ekle', 'bogazici-tema'),
        'new_item'              => __('Yeni Medya Yazısı', 'bogazici-tema'),
        'edit_item'             => __('Medya Yazısını Düzenle', 'bogazici-tema'),
        'view_item'             => __('Medya Yazısını Görüntüle', 'bogazici-tema'),
        'all_items'             => __('Tüm Medya Yazıları', 'bogazici-tema'),
        'search_items'          => __('Medya Yazılarında Ara', 'bogazici-tema'),
        'not_found'             => __('Hiç medya yazısı bulunamadı.', 'bogazici-tema'),
        'not_found_in_trash'    => __('Çöp kutusunda medya yazısı bulunamadı.', 'bogazici-tema'),
    ];

    $args = [
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => ['slug' => 'medya', 'with_front' => false],
        'capability_type'    => 'post',
        'has_archive'        => 'medya',
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-megaphone',
        'supports'           => ['title', 'editor', 'thumbnail', 'excerpt', 'revisions'],
    ];

    register_post_type('medya', $args);
}
add_action('init', 'bogazici_register_cpt_medya');

/* ============================================
   7. MENÜ FALLBACK (Menü atanmamışsa)
   ============================================ */
function bogazici_default_menu_fallback() {
    $home_label = bogazici_translate([
        'tr' => 'Ana Sayfa',
        'en' => 'Home',
        'it' => 'Home',
    ]);

    $book_label = bogazici_translate([
        'tr' => 'Kitap',
        'en' => 'The Book',
        'it' => 'Il Libro',
    ]);

    $blog_label = bogazici_translate([
        'tr' => 'Blog',
        'en' => 'Blog',
        'it' => 'Blog',
    ]);

    $media_label = bogazici_translate([
        'tr' => 'Medyada',
        'en' => 'Media',
        'it' => 'Media',
    ]);

    echo '<ul class="main-navigation">';
    echo '<li><a href="' . esc_url(home_url('/')) . '">' . esc_html($home_label) . '</a></li>';
    echo '<li><a href="' . esc_url(home_url('/kitap/')) . '">' . esc_html($book_label) . '</a></li>';
    echo '<li><a href="' . esc_url(home_url('/blog/')) . '">' . esc_html($blog_label) . '</a></li>';
    $media_link = get_post_type_archive_link('medya');
    if ($media_link) {
        echo '<li><a href="' . esc_url($media_link) . '">' . esc_html($media_label) . '</a></li>';
    }
    echo '</ul>';
}
