<?php
/**
 * The template for displaying clergy archive pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bootscore
 * @version 6.3.0
 */

// Exit if accessed directly
defined('ABSPATH') || exit;

get_header();
?>

  <div id="content" class="site-content <?= apply_filters('bootscore/class/container', 'container', 'archive'); ?> <?= apply_filters('bootscore/class/content/spacer', 'pt-4 pb-5', 'archive'); ?>">
    <div id="primary" class="content-area">

      <?php do_action('bootscore_after_primary_open', 'archive'); ?>

      <div class="row">
        <div class="<?= apply_filters('bootscore/class/main/col', 'col'); ?>">

          <main id="main" class="site-main">

            <div class="entry-header">
              <?php do_action('bootscore_before_title', 'archive'); ?>
              <?php the_archive_title('<h1 class="entry-title ' . apply_filters('bootscore/class/entry/title', '', 'archive') . '">', '</h1>'); ?>
              <?php do_action('bootscore_after_title', 'archive'); ?>
            </div>

            <?php
            $clergy_query = new WP_Query([
                'post_type'      => 'clergy',
                'posts_per_page' => -1,
                'orderby'        => 'meta_value_num',
                'meta_key'       => 'clergy_number',
                'order'          => 'ASC',
            ]);
            ?>

            <?php if ($clergy_query->have_posts()) : ?>
              <div class="row row-cols-1 row-cols-md-3 g-4 mt-2">
                <?php while ($clergy_query->have_posts()) : $clergy_query->the_post(); ?>
                  <?php
                  $description = get_post_meta(get_the_ID(), 'clergy_description', true);
                  ?>
                  <div class="col">
                    <article id="post-<?php the_ID(); ?>" <?php post_class('card h-100 clergy-card'); ?>>
                      <?php if (has_post_thumbnail()) : ?>
                        <a href="<?php the_permalink(); ?>" class="clergy-card__image-link">
                          <?php the_post_thumbnail('medium', ['class' => 'card-img-top']); ?>
                        </a>
                      <?php endif; ?>
                      <div class="card-body">
                        <h2 class="card-title h5">
                          <a class="text-body text-decoration-none" href="<?php the_permalink(); ?>">
                            <?php the_title(); ?>
                          </a>
                        </h2>
                        <?php if (!empty($description)) : ?>
                          <p class="card-text"><?php echo wp_kses_post($description); ?></p>
                        <?php endif; ?>
                      </div>
                    </article>
                  </div>
                <?php endwhile; ?>
              </div>
            <?php else : ?>
              <p><?php esc_html_e('Записи не найдены.', 'bootscore'); ?></p>
            <?php endif; ?>
            <?php wp_reset_postdata(); ?>

          </main>

        </div>
        <?php get_sidebar(); ?>
      </div>

    </div>
  </div>

<?php
get_footer();
