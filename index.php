<?php
/**
 * Boğaziçi Teması - Index (Yedek Şablon)
 * 
 * Daha özelleşmiş bir şablon bulunmadığında devreye girer.
 */
get_header();
?>

<main class="page-content">
    <div class="content-container">

        <?php if (have_posts()) : ?>

            <?php while (have_posts()) : the_post(); ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                    <header class="entry-header">
                        <h1 class="entry-title"><?php the_title(); ?></h1>
                    </header>

                    <?php if (has_post_thumbnail()) : ?>
                        <figure class="entry-thumbnail">
                            <?php the_post_thumbnail('large'); ?>
                        </figure>
                    <?php endif; ?>

                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div>

                </article>

            <?php endwhile; ?>

            <?php
            // Sayfalama
            the_posts_pagination([
                'mid_size'  => 2,
                'prev_text' => bogazici_translate([
                    'tr' => '← Önceki',
                    'en' => '← Previous',
                    'it' => '← Precedente',
                ]),
                'next_text' => bogazici_translate([
                    'tr' => 'Sonraki →',
                    'en' => 'Next →',
                    'it' => 'Successivo →',
                ]),
            ]);
            ?>

        <?php else : ?>

            <p>
                <?php
                echo esc_html(bogazici_translate([
                    'tr' => 'Henüz içerik bulunmuyor.',
                    'en' => 'No content yet.',
                    'it' => 'Nessun contenuto ancora.',
                ]));
                ?>
            </p>

        <?php endif; ?>

    </div>
</main>

<?php get_footer(); ?>
