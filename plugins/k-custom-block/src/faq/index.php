<?php

function k_render_block_faq( $attributes ) {
	$ID=$attributes['fragId'];
	$frag = get_post($ID);
	$status=get_post_status($ID);
	if ($frag == null || $status != 'publish') : return '';
	else:
	ob_start();?>
		<div class="question">
			<h3 class="titre"><?php echo $frag->post_title; ?></h3>
		
			<div class="contenu">
				<?php echo $frag->post_content; ?>
			</div>
		</div>
	
	<?php 
	return ob_get_clean();
	endif;
}


function k_faq_init() {
	// Hook the post rendering to the block
	if ( function_exists( 'register_block_type' ) ) :
	// Hook a render function to the testimonial block
	register_block_type( 'cgb/block-faq', array(
		'render_callback' => 'k_render_block_faq',
	) );
	endif;
}
add_action( 'init', 'k_faq_init' );