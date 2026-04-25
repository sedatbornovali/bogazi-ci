<?php
/**
 * Boğaziçi Teması - Header
 * 
 * Sayfa başlığını, yazar şeridini ve site header'ını basar.
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
     Tüm sayfalarda en üstte görünür.
     Ekosistem hissini taşır.
     ============================================ -->
<?php bogazici_render_hub_strip(); ?>

<!-- ============================================
     SİTE HEADER — Kitap markalaması
     ============================================ -->
<header id="site-header" class="site-header-inner">
    <div class="header-container">

        <div class="header-left">
            <a class="book-logo" href="<?php echo esc_url(home_url('/')); ?>">
                <?php bloginfo('name'); ?>
                <?php
                $description = get_bloginfo('description');
                if ($description) :
                ?>
                    <span class="book-subtitle"><?php echo esc_html($description); ?></span>
                <?php endif; ?>
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
