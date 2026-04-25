<?php
/**
 * Boğaziçi Teması - Ana Sayfa (Akordeon Düzeni)
 * Version: 1.8.0
 * 
 * v1.8.0 — DİJİTAL cell artık yeni Kız Kulesi portre fotoğrafını kullanıyor
 *          (eskiden Yazar paneliyle aynı görsel duruyordu).
 *          Cell'e media-cell-digital modifier class eklendi ki CSS hedefleyebilsin.
 */
get_header();

$theme_uri = get_template_directory_uri();
$hub_url   = bogazici_get_hub_url();

/* PANEL ETİKETLERİ */
$author_label = bogazici_translate(['tr' => 'Yazar', 'en' => 'Author', 'it' => 'Autore']);
$book_label   = bogazici_translate(['tr' => 'Kitap', 'en' => 'The Book', 'it' => 'Il Libro']);
$blog_label   = bogazici_translate(['tr' => 'Blog', 'en' => 'Blog', 'it' => 'Blog']);
$media_label  = bogazici_translate(['tr' => 'Medyada', 'en' => 'In the Media', 'it' => 'Nei Media']);

/* MEDYA ALT-CELL ETİKETLERİ */
$cell_popular_cat    = bogazici_translate(['tr' => 'Popüler', 'en' => 'Popular', 'it' => 'Popolare']);
$cell_popular_title  = bogazici_translate(['tr' => 'Röportajlar', 'en' => 'Interviews', 'it' => 'Interviste']);
$cell_press_cat      = bogazici_translate(['tr' => 'Basın', 'en' => 'Press', 'it' => 'Stampa']);
$cell_press_title    = bogazici_translate(['tr' => 'Köşe Yazıları', 'en' => 'Op-Eds', 'it' => 'Editoriali']);
$cell_academic_cat   = bogazici_translate(['tr' => 'Akademik', 'en' => 'Academic', 'it' => 'Accademico']);
$cell_academic_title = bogazici_translate(['tr' => 'Makaleler & Yayınlar', 'en' => 'Articles & Publications', 'it' => 'Articoli e Pubblicazioni']);
$cell_digital_cat    = bogazici_translate(['tr' => 'Dijital', 'en' => 'Digital', 'it' => 'Digitale']);
$cell_digital_title  = bogazici_translate(['tr' => 'TV & Belgeseller', 'en' => 'TV & Documentaries', 'it' => 'TV & Documentari']);

/* PANEL GÖRSELLERİ */
$author_image = 'https://www.sedat.bornova.li/wp-content/uploads/2025/07/DSC09419-Osman-Palabiyik-Sedat-low-scaled.jpeg';
$book_image   = $theme_uri . '/images/kitap-kompozisyon.jpg';
$blog_image   = 'https://www.sedat.bornova.li/wp-content/uploads/2025/07/defter-kapaga-crop.jpg';

$cell_popular_image  = $theme_uri . '/images/esg-roportaj.jpg';
$cell_press_image    = 'https://bogazi.ci/wp-content/uploads/2018/09/Bo%C4%9Fazi%C3%A7i-Kitap-Kritik.jpg';
$cell_academic_image = $theme_uri . '/images/kitap-cicekli.jpg';

// YENİ! DİJİTAL cell için Kız Kulesi önünde Sedat Bey portresi
$cell_digital_image  = $theme_uri . '/images/kiz-kulesi-portre.jpg';

/* BAĞLANTILAR */
$book_url  = home_url('/kitap/');
$blog_url  = get_permalink(get_option('page_for_posts'));
if (!$blog_url) { $blog_url = home_url('/blog/'); }
$media_url = get_post_type_archive_link('medya');
if (!$media_url) { $media_url = home_url('/medya/'); }
?>

<div class="accordion-container">

    <!-- 1. PANEL: Yazar -->
    <a href="<?php echo esc_url($hub_url); ?>" 
       class="panel author-panel"
       style="background-image: url('<?php echo esc_url($author_image); ?>');">
        <div class="panel-overlay">
            <h2 class="section-title"><?php echo esc_html($author_label); ?></h2>
        </div>
    </a>

    <!-- 2. PANEL: Kitap (yalı kompozisyonu) -->
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

    <!-- 4. PANEL: Medyada (4 alt-cell ile) -->
    <section class="panel media-panel">

        <div class="media-grid">
            <a href="<?php echo esc_url($media_url); ?>" 
               class="media-cell media-cell-popular"
               style="background-image: url('<?php echo esc_url($cell_popular_image); ?>');">
                <div class="cell-overlay">
                    <span class="cell-cat"><?php echo esc_html($cell_popular_cat); ?></span>
                    <h4><?php echo esc_html($cell_popular_title); ?></h4>
                </div>
            </a>

            <a href="<?php echo esc_url($media_url); ?>" 
               class="media-cell media-cell-press"
               style="background-image: url('<?php echo esc_url($cell_press_image); ?>');">
                <div class="cell-overlay">
                    <span class="cell-cat"><?php echo esc_html($cell_press_cat); ?></span>
                    <h4><?php echo esc_html($cell_press_title); ?></h4>
                </div>
            </a>

            <a href="<?php echo esc_url($media_url); ?>" 
               class="media-cell media-cell-academic"
               style="background-image: url('<?php echo esc_url($cell_academic_image); ?>');">
                <div class="cell-overlay">
                    <span class="cell-cat"><?php echo esc_html($cell_academic_cat); ?></span>
                    <h4><?php echo esc_html($cell_academic_title); ?></h4>
                </div>
            </a>

            <!-- DİJİTAL: Kız Kulesi önünde Sedat Bornovalı (özel odaklama: media-cell-digital) -->
            <a href="<?php echo esc_url($media_url); ?>" 
               class="media-cell media-cell-digital"
               style="background-image: url('<?php echo esc_url($cell_digital_image); ?>');">
                <div class="cell-overlay">
                    <span class="cell-cat"><?php echo esc_html($cell_digital_cat); ?></span>
                    <h4><?php echo esc_html($cell_digital_title); ?></h4>
                </div>
            </a>
        </div>

        <div class="panel-overlay">
            <h2 class="section-title"><?php echo esc_html($media_label); ?></h2>
        </div>

    </section>

</div>

<?php get_footer(); ?>
