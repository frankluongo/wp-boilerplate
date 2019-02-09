<?php get_header(); ?>

	<main role="main">
    <?php include 'modules/_hero_single.php'; ?>

    <?php if (have_posts()): while (have_posts()) : the_post(); ?>
      <section class="layout--container">
        <div class="row">
          <?php the_content(); ?>
        </div>
      </section>

		<?php endwhile; endif; ?>

	</main>
<?php get_footer(); ?>
