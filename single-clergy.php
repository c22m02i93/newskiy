<?php
/**
 * The template for displaying a single clergy post.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bootscore
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();
?>

  <div id="content" class="site-content <?= apply_filters('bootscore/class/container', 'container', 'single'); ?> <?= apply_filters('bootscore/class/content/spacer', 'pt-4 pb-5', 'single'); ?>">
    <div id="primary" class="content-area">

      <?php do_action('bootscore_after_primary_open', 'single'); ?>

      <?php the_breadcrumb(); ?>

      <div class="row">
        <div class="<?= apply_filters('bootscore/class/main/col', 'col'); ?>">
          <main id="main" class="site-main">
            <?php if (have_posts()) : ?>
              <?php while (have_posts()) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('clergy-single'); ?>>
                  <header class="entry-header">
                    <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                  </header>

                  <div class="entry-content">
                    <?php if (has_post_thumbnail()) : ?>
                      <div class="clergy-single__image-wrap">
                        <?php the_post_thumbnail('large', ['class' => 'clergy-single__image']); ?>
                      </div>
                    <?php endif; ?>
                    <?php the_content(); ?>
                  </div>
                </article>
              <?php endwhile; ?>
            <?php endif; ?>
          </main>
        </div>
        <?php get_sidebar(); ?>
      </div>
    </div>
  </div>

<?php
get_footer();
