<?php
if ( ! defined( 'ABSPATH' ) ) exit;


/***************************************************************
    Custom Taxonomy 
/***************************************************************/

//hook into the init action and call the function when it fires
add_action( 'init', 'create_docs_cat', 0 );
function create_docs_cat() {
	$labels = array(
		'name' => _x( 'Catégories de docs', 'taxonomy general name' ),
		'singular_name' => _x( 'Catégorie de docs', 'taxonomy singular name' ),
		'menu_name' => __( 'Catégories de docs' ),
	);

// Now register the non-hierarchical taxonomy like tag
  register_taxonomy('docs_cat','doc',array(
	'hierarchical' => true,
	'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
  ));
}
/***************************************************************
    Custom Post Type : doc
/***************************************************************/
function kdoc_cpt() {
	// Set UI labels for Custom Post Type
		$labels = array(
			'name'                => _x( 'Docs', 'Post Type General Name', 'doc' ),
			'singular_name'       => _x( 'Doc', 'Post Type Singular Name', 'doc' ),
			'menu_name'           => __( 'Docs', 'doc' ),
			'all_items'           => __( 'Tous les docs', 'doc' ),
			'view_item'           => __( 'Voir le doc', 'doc' ),
			'add_new_item'        => __( 'Ajouter un doc', 'doc' ),
			'add_new'             => __( 'Ajouter', 'doc' ),
		);
	// Set other options for Custom Post Type
	$args = array(
		'label'               => __( 'Docs', 'doc' ),
		'labels'              => $labels,
		// Features this CPT supports in Post Editor
		'supports'            => array( 'title', 'editor', 'thumbnail', 'revisions', 'excerpt','custom-fields'),
		// You can associate this CPT with a taxonomy or custom taxonomy. 
		'taxonomies'          => array('docs_cat'),
		/* A hierarchical CPT is like Pages and can have
		* Parent and child items. A non-hierarchical CPT
		* is like Posts.
		*/	
		'hierarchical'        => true,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'show_in_rest'   => true,
		'menu_position'       => 11,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
		'menu_icon'           => 'dashicons-media-text'
	);
		// Registering your Custom Post Type
		register_post_type( 'doc', $args );
	}
	/* Hook into the 'init' action so that the function
	* Containing our post type registration is not 
	* unnecessarily executed. 
	*/
add_action( 'init', 'kdoc_cpt', 0 );

/***************************************************************
    Construire un tableau avec tous les docs triés par catégories
/***************************************************************/

function k_docs_tableau() {
	$cats=get_terms('docs_cat');
	$tableau=array();
	foreach ($cats as $cat) :
		// setup the cateogory ID
		$cat_id= $cat->term_id;
		$args=array(
			'post_type' => 'doc',
			'tax_query' => array(
				array(
					'taxonomy' => 'docs_cat',
					'field'    => 'term_id',
					'terms'    => $cat_id,
				),
			),
			'fields' => 'ids',
		);
		$query = new WP_Query( $args ); 
		if ($query) :
			$tableau[$cat->name]=$query->posts;
		endif;
	endforeach;
	return $tableau;
}

/***************************************************************
    Afficher tous les docs triés par catégories
/***************************************************************/
function k_docs_affiche() {
	$tableau= k_docs_tableau();
	foreach($tableau as $cat => $ids) :
		echo '<strong><span class="dashicons dashicons-media-text"></span>'.$cat.'</strong><ul>';
		foreach($ids as $id) :
			echo '<li><a href="'.get_the_permalink($id).'">'.get_the_title($id).'</a></li>';
		endforeach;
		echo '</ul>';
	endforeach;
}