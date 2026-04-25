/**
 * Boğaziçi Teması - JavaScript
 * Version: 1.0.0
 * 
 * Şu an çok minimal: ileride mobil menü, modal vb. eklendikçe büyüyecek.
 */

(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {

        // ============================================
        // MOBİL MENÜ TOGGLE (gelecek özellik için hazır)
        // ============================================
        var menuToggle = document.getElementById('mobile-menu-toggle');
        var navMenu    = document.getElementById('main-navigation');

        if (menuToggle && navMenu) {
            menuToggle.addEventListener('click', function () {
                var isActive = menuToggle.classList.toggle('active');
                navMenu.classList.toggle('active');
                menuToggle.setAttribute('aria-expanded', isActive);
            });

            // ESC tuşu ile kapat
            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape' && navMenu.classList.contains('active')) {
                    menuToggle.classList.remove('active');
                    navMenu.classList.remove('active');
                    menuToggle.setAttribute('aria-expanded', 'false');
                }
            });
        }

    });

})();
