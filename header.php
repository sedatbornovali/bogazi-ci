<?php
/**
 * Boğaziçi Teması - Header
 * Version: 1.3.0
 * 
 * Değişiklik: Üstteki "Yazar Şeridi" kaldırıldı.
 * Sebep: Menüde zaten "Sedat Hakkında" ve "Diğer Kitaplar" var; tekrar oluyordu.
 * 
 * Header artık fixed konumda, panellerin üzerine bindiriliyor (Ayasofya tarzı).
 * 
 * 3 kolonlu yapı:
 *   Sol: kitap adı + dil değiştirici
 *   Orta: sosyal medya ikonları
 *   Sağ: ana menü
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- ============================================
     SİTE HEADER — Transparan, panellerin üstünde
     ============================================ -->
<header id="site-header" class="site-header-inner">
    <div class="header-container">

        <!-- Sol Grup: Kitap Adı + Dil Değiştirici -->
        <div class="header-group-left">
            <a class="book-logo" href="<?php echo esc_url(home_url('/')); ?>">
                <?php echo esc_html(bogazici_get_book_title()); ?>
            </a>
            <?php bogazici_render_lang_switcher(); ?>
        </div>

        <!-- Orta Grup: Sosyal Medya İkonları -->
        <div class="header-group-center">
            <?php bogazici_render_social_icons(); ?>
        </div>

        <!-- Sağ Grup: Ana Menü -->
        <div class="header-group-right">
            <nav class="main-nav" aria-label="<?php esc_attr_e('Ana Menü', 'bogazici-tema'); ?>">
                <?php
                wp_nav_menu([
                    'theme_location' => 'ana-menu',
                    'menu_class'     => 'main-navigation',
                    'container'      => false,
                    'fallback_cb'    => 'bogazici_default_menu_fallback',
                ]);
                ?>
            </nav>
        </div>

    </div>
</header>

<div id="page-wrapper">
