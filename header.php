<?php
/**
 * Boğaziçi Teması - Header
 * 
 * Sayfa başlığını, yazar şeridini ve site header'ını basar.
 * v1.1.0 — Site adı tema seviyesinde dile göre çevrilir.
 *          İngilizce subtitle kaldırıldı.
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
     YAZAR ŞERİDİ (Hub Return Strip)
     ============================================ -->
<?php bogazici_render_hub_strip(); ?>

<!-- ============================================
     SİTE HEADER — Kitap markalaması (3 dilde)
     ============================================ -->
<header id="site-header" class="site-header-inner">
    <div class="header-container">

        <div class="header-left">
            <a class="book-logo" href="<?php echo esc_url(home_url('/')); ?>">
                <?php echo esc_html(bogazici_get_book_title()); ?>
            </a>
        </div>

        <nav class="header-right" aria-label="<?php esc_attr_e('Ana Menü', 'bogazici-tema'); ?>">
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
</header>

<div id="page-wrapper">
