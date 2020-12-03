<?php
/*
Template Name: template1
*/
?>

<?php get_header(); ?>

<div class="spacer"></div>

<div class="container">

	<div class="row">

		<div class="<?php if ( is_active_sidebar( 'rightbar' ) ) : ?>col-md-8<?php else : ?>col-md-12<?php endif; ?>">

			<div class="content">
			
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			
			     <h2 class="entry-title"><?php the_title(); ?></h2>
			    
			     <div class="entry">

				   <?php the_content(); ?>
				   <?php include(dirname(__FILE__) . '/src/DashboardDepartement/dashboard-department.php') ?>
				   <p>bien chargé</p>

			     </div>

			     
			 </div>
			
			 <?php endwhile;?>

			 <?php endif; ?>
			

			</div>

		</div>

		<?php get_sidebar(); ?>

	</div>

</div>

<?php get_footer(); ?>