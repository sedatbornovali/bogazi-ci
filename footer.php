<?php
/**
 * Boğaziçi Teması - Footer
 * 
 * Hub'a dönüş butonu ve telif bilgisini basar.
 */

$hub_url = bogazici_get_hub_url();

$hub_button_label = bogazici_translate([
    'tr' => 'Yazarın Tüm Kitaplarını Keşfet',
    'en' => "Discover All of the Author's Books",
    'it' => "Scopri Tutti i Libri dell'Autore",
]);

$copyright_text = bogazici_translate([
    'tr' => 'Sedat Bornovalı · Tüm hakları saklıdır.',
    'en' => 'Sedat Bornovalı · All rights reserved.',
    'it' => 'Sedat Bornovalı · Tutti i diritti riservati.',
]);

$current_year = date('Y');
?>
</div><!-- #page-wrapper -->

<footer class="site-footer" role="contentinfo">

    <a href="<?php echo esc_url($hub_url); ?>" class="footer-hub-link">
        <?php echo esc_html($hub_button_label); ?>
    </a>

    <p class="footer-meta">
        © <?php echo esc_html($current_year); ?> · <?php echo esc_html($copyright_text); ?>
    </p>

</footer>

<?php wp_footer(); ?>
</body>
</html>
