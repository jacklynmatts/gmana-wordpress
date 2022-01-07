<?php 	
	$events = tribe_get_events( [ 'posts_per_page' => 5, 'featured' => true ] );
	if (is_front_page() && count($events)) : ?>
	
<div id="sliderIntro">
	<h4>Upcoming Events</h4>
</div>

<div id="carouselHomeEvents" class="carousel slide" data-ride="carousel">
	<ol class="carousel-indicators">
		<?php foreach ($events as $i=>$event): ?>
			<li data-target="#carouselHomeEvents" data-slide-to="<?=$i?>" <?=($i==0)?'class="active"':''?>></li>
		<?php endforeach; ?>
	</ol>
	<div class="carousel-inner">
		<?php 
			global $post;
			foreach ($events as $i => $event): 
			setup_postdata($event);
		?>
		<div class="carousel-item <?=($i==0)?'active':''?>" style="background-image: url('<?=tribe_event_featured_image($event, 'full', false, false)?>');">
			
			<div class="carousel-caption">
				<a href="<?=tribe_get_event_link($event);?>"><h3><?=$event->post_title?></h3></a>
				<p class="d-none d-md-block"><?=$event->post_excerpt?></p>
				<p class=small><em><?=tribe_get_start_date( $event );?></em></p>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
	<a class="carousel-control-prev" href="#carouselHomeEvents" role="button" data-slide="prev">
		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
		<span class="sr-only">Previous</span>
	</a>
	<a class="carousel-control-next" href="#carouselHomeEvents" role="button" data-slide="next">
		<span class="carousel-control-next-icon" aria-hidden="true"></span>
		<span class="sr-only">Next</span>
	</a>
</div>

<?php else: ?>

<header class="banner">
	<h1 class=text-center>Green Mountain Area Narcotics Anonymous</h1>
</header>

<?php endif; ?>

<nav class="navbar navbar-expand-lg sticky-top navbar-dark bg-primary">
	<a class="navbar-brand" href="<?= esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	
	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<?php
		if (has_nav_menu('primary_navigation')) :
			wp_nav_menu([
				'theme_location'	=> 'primary_navigation',
				'depth'				=> 2,
				'menu_class' 		=> 'navbar-nav mr-auto',
				'container' 		=> false,
				'walker'			=> new WP_Bootstrap_Navwalker()				
			]);
		endif;
		?>
	</div>
</nav>