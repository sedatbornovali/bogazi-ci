<?php
/**
 * Boğaziçi Teması - Ana Sayfa (Akordeon Düzeni)
 * 
 * 4 panel: Yazar | Kitap | Blog | Medya
 * Ayasofya temasından esinlenilmiştir; aynı görsel dil.
 * 
 * v1.1.0 — Kitap görseli URL'si Türkçe karakter için encode edildi.
 *          Panel başlıkları artık tek satır, tutarlı.
 */
get_header();

$theme_uri = get_template_directory_uri();
$hub_url   = bogazici_get_hub_url();

/* ============================================
   ETİKETLER (3 dilde)
   Tüm panellerde tek başlık - tutarlı görünüm.
   ============================================ */
$author_label = bogazici_translate([
    'tr' => 'Yazar',
    'en' => 'Author',
    'it' => 'Autore',
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
    'en' => 'In the Media',
    'it' => 'Nei Media',
]);

/* ============================================
   PANEL GÖRSELLERİ
   Bu URL'leri ileride kendi medya kütüphanenizden gelen 
   görsellerle değiştireceğiz. Şimdilik mevcut hub görselleri.
   
   NOT: Türkçe karakter içeren dosya adları URL encode edilmiştir.
   ============================================ */
$author_image = 'https://www.sedat.bornova.li/wp-content/uploads/2025/07/DSC09419-Osman-Palabiyik-Sedat-low-scaled.jpeg';

// "ön" karakteri ö = %C3%B6 olarak encode edildi
$book_image   = 'https://www.sedat.bornova.li/wp-content/uploads/2025/07/bogazicinin-tarih-atlasi-%C3%B6n-kapak-crop.jpg';

$blog_image   = 'https://www.sedat.bornova.li/wp-content/uploads/2025/07/defter-kapaga-crop.jpg';
$media_image  = 'https://bogazi.ci/wp-content/uploads/2018/09/Bo%C4%9Fazi%C3%A7i-Kitap-Kritik.jpg';

/* ============================================
   BAĞLANTILAR
   ============================================ */
$book_url  = home_url('/kitap/');
$blog_url  = get_permalink(get_option('page_for_posts'));
if (!$blog_url) {
    $blog_url = home_url('/blog/');
}
$media_url = get_post_type_archive_link('medya');
if (!$media_url) {
    $media_url = home_url('/medya/');
}
?>

<div class="accordion-container">

    <!-- 1. PANEL: Yazar (Hub'a yönlendiren) -->
    <a href="<?php echo esc_url($hub_url); ?>" 
       class="panel author-panel"
       style="background-image: url('<?php echo esc_url($author_image); ?>');">
        <div class="panel-overlay">
            <h2 class="section-title"><?php echo esc_html($author_label); ?></h2>
        </div>
    </a>

    <!-- 2. PANEL: Kitap -->
    <a href="<?php echo esc_url($book_url); ?>" 
       class="panel book-panel"
       style="background-image: url('<?php echo esc_url($book_image); ?>');">
        <div class="panel-overlay">
            <h2 class="section-title"><?php echo esc_html($book_label); ?></h2>
        </div>
    </a>

    <!-- 3. PANEL: Blog -->
    <a href="<?php echo esc_url($blog_url); ?>" 
       class="panel blog-panel"
       style="background-image: url('<?php echo esc_url($blog_image); ?>');">
        <div class="panel-overlay">
            <h2 class="section-title"><?php echo esc_html($blog_label); ?></h2>
        </div>
    </a>

    <!-- 4. PANEL: Medyada -->
    <a href="<?php echo esc_url($media_url); ?>" 
       class="panel media-panel"
       style="background-image: url('<?php echo esc_url($media_image); ?>');">
        <div class="panel-overlay">
            <h2 class="section-title"><?php echo esc_html($media_label); ?></h2>
        </div>
    </a>

</div>

<?php get_footer(); ?>
