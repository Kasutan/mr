<?php
/**
 * Archive.php
 * controls styling for categories, tags etc
 */

get_header(); ?>
<section class="doc-search">
	<h1>
		<?php echo __('Documentation de l\'extension','themedd'); ?>
		<?php get_search_form( true ); ?>
	</h1>
</section>
<div class="content-wrapper<?php echo themedd_wrapper_classes(); ?>">
	<div id="primary" class="content-area<?php echo themedd_primary_classes(); ?>">
		<main id="main" class="site-main grille" role="main">
			<?php
				if (function_exists('k_docs_tableau')) {
					$tableau= k_docs_tableau();
					foreach($tableau as $cat => $ids) :
						echo '<div><h2><span class="dashicons dashicons-media-text"></span>'.$cat.'</h2><ul>';
						foreach($ids as $id) :
							echo '<li><a href="'.get_the_permalink($id).'">'.get_the_title($id).'</a></li>';
						endforeach;
						echo '</ul></div>';
					endforeach;
				}				
			?>
			<section class="doc-faq">
			<?php 
				$faq=get_post(1445);
				if( $faq && 'publish'==$faq->post_status) {
					echo sprintf('<h2><span class="dashicons dashicons-media-text"></span>%s</h2>', $faq->post_title);
					echo sprintf('<div>%s</div>', $faq->post_content);
				}
			?>
			</section>
			<section class="support-contact-form">
			<?php if(class_exists('Caldera_Forms')) {
				echo Caldera_Forms::render_form( 'CF5b88127bca073' );
			}
			//TODO : tester la langue et afficher un formulaire différent si besoin
			?>
			</section>
		</main>
	</div>


</div>

<?php
get_footer();
