<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/***************************************************************
     Adds a shortcode with arguments and a Query
***************************************************************/
//Utilisation : [frag tag='samedi']
function affiche_fragments($atts) {
	$a = shortcode_atts( array(
	   'tag' => 'venir',
   ), $atts );
   
   $args = array(
	   'post_type' => 'fragment',
	   'posts_per_page'=> -1,
	   'tag'=>$a['tag'],
	   'order' => 'ASC',
	   'orderby' => 'date',
   );
   
   
   $fragments = new WP_Query( $args );
   
   if( $fragments->have_posts() ):
	ob_start();?>
		<div class="fragments flex">
		<?php
	   	while ( $fragments->have_posts() ) : $fragments->the_post();?>
		   <div class="col">
		   	<h3 class="titre"><?php the_title(); ?></h3>
			<div class="contenu"><?php the_content(); ?></div>
			</div>
		<?php
	   endwhile; ?>
	   </div>
	   <?php
   endif;
   wp_reset_postdata();
   return ob_get_clean();
}
add_shortcode( 'frag', 'affiche_fragments' );

//Utilisation : [f id='1']
function affiche_details($atts) {
	$ID=$atts['n'];
	$frag = get_post($ID);
	$status=get_post_status($ID);
	if ($frag == null || $status != 'publish') : return '';
	else:
	ob_start();?>
	<details>
		<summary>
			<h3 class="titre"><?php echo $frag->post_title; ?></h3>
			<p class="extrait"><?php echo $frag->post_excerpt; ?></p>
		</summary>
		<div class="contenu">
			<?php echo $frag->post_content; ?>
		</div>
	</details>
	<?php 
	return ob_get_clean();
	endif;
}
add_shortcode( 'f', 'affiche_details' );