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
 * - Site adı ve menü helper fonksiyonları
 * 
 * Version: 1.1.0
 */

if (!defined('ABSPATH')) {
    exit; // Direkt erişimi engelle
}

/* ============================================
   1. TEMEL TEMA AYARLARI
   ============================================ */
function bogazici_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', [
        'height'      => 80,
        'width'       => 240,
        'flex-height' => true,
        'flex-width'  => true,
    ]);
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ]);
    add_theme_support('automatic-feed-links');

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

    wp_enqueue_style(
        'bogazici-google-fonts',
        'https://fonts.googleapis.com/css2?family=Cardo:ital,wght@0,400;0,700;1,400&family=Lato:wght@300;400;700&display=swap',
        [],
        null
    );

    wp_enqueue_style(
        'bogazici-main',
        get_stylesheet_uri(),
        [],
        $version
    );

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

/**
 * Hub'daki "Tüm Kitaplar" sayfasının URL'sini döndürür.
 */
function bogazici_get_hub_books_url() {
    $slug = bogazici_get_current_lang_slug();

    if ($slug === 'en') {
        return BOGAZICI_HUB_URL . 'en/kitaplar/';
    }

    if ($slug === 'it') {
        return BOGAZICI_HUB_URL . 'it/kitaplar/';
    }

    return BOGAZICI_HUB_URL . 'kitaplar/';
}

/* ============================================
   5. SİTE ADI VE BAŞLIKLAR (3 DİLLİ)
   WordPress site title'ı yerine tema seviyesinde 
   düzgün dilli başlık yönetimi.
   ============================================ */

/**
 * Header'da gösterilecek site adı (kitap başlığı).
 * WordPress admin'deki Site Title'dan bağımsız.
 */
function bogazici_get_book_title() {
    return bogazici_translate([
        'tr' => 'Boğaziçi\'nin Tarih Atlası',
        'en' => 'The Bosphorus: An Illustrated Story',
        'it' => 'Il Bosforo: Una Storia Illustrata',
    ]);
}

/**
 * <title> tag'i için site adı (browser sekmesinde görünür)
 */
function bogazici_filter_document_title($title) {
    if (!is_array($title)) {
        return $title;
    }
    $title['site'] = bogazici_get_book_title();
    return $title;
}
add_filter('document_title_parts', 'bogazici_filter_document_title');

/* ============================================
   6. HUB RETURN STRIP — Yazar Şeridi
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
   7. CUSTOM POST TYPE: MEDYA
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
   8. MENÜ FALLBACK (Menü atanmamışsa)
   "Ana Sayfa" kaldırıldı (logo zaten oraya gidiyor).
   "Diğer Kitaplar" eklendi (hub'a yönlendiriyor).
   ============================================ */
function bogazici_default_menu_fallback() {
    $blog_label = bogazici_translate([
        'tr' => 'Blog',
        'en' => 'Blog',
        'it' => 'Blog',
    ]);

    $media_label = bogazici_translate([
        'tr' => 'Medyada',
        'en' => 'In the Media',
        'it' => 'Nei Media',
    ]);

    $other_books_label = bogazici_translate([
        'tr' => 'Diğer Kitaplar',
        'en' => 'Other Books',
        'it' => 'Altri Libri',
    ]);

    $blog_url = get_permalink(get_option('page_for_posts'));
    if (!$blog_url) {
        $blog_url = home_url('/blog/');
    }
    $media_url = get_post_type_archive_link('medya');

    echo '<ul class="main-navigation">';
    echo '<li><a href="' . esc_url($blog_url) . '">' . esc_html($blog_label) . '</a></li>';
    if ($media_url) {
        echo '<li><a href="' . esc_url($media_url) . '">' . esc_html($media_label) . '</a></li>';
    }
    echo '<li><a href="' . esc_url(bogazici_get_hub_books_url()) . '">' . esc_html($other_books_label) . '</a></li>';
    echo '</ul>';
}
