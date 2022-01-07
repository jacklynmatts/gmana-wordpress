<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/page', 'header'); ?>
  <?php get_template_part('templates/content', 'page'); ?>

  <br/><br/>
	<div class="row">
		<div class="col-sm-4"> <?php dynamic_sidebar('home-bottom-left'); ?> </div>
		<div class="col-sm-4"> <?php dynamic_sidebar('home-bottom-middle'); ?> </div>
		<div class="col-sm-4"> <?php dynamic_sidebar('home-bottom-right'); ?> </div>
	</div>

<?php endwhile; ?>
