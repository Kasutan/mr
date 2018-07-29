<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/***************************************************************
    Custom Post Type : faq
/***************************************************************/
function kfaq_cpt() {
	// Set UI labels for Custom Post Type
		$labels = array(
			'name'                => _x( 'Questions Fréquentes', 'Post Type General Name', 'faq' ),
			'singular_name'       => _x( 'Question', 'Post Type Singular Name', 'faq' ),
			'menu_name'           => __( 'FAQ', 'faq' ),
			'all_items'           => __( 'Toutes les questions', 'faq' ),
			'view_item'           => __( 'Voir la question', 'faq' ),
			'add_new_item'        => __( 'Ajouter une question', 'faq' ),
			'add_new'             => __( 'Ajouter', 'faq' ),
			'menu_name'           => 'FAQ'						
		);
	// Set other options for Custom Post Type
	$args = array(
		'label'               => __( 'Questions Fréquentes', 'faq' ),
		'labels'              => $labels,
		// Features this CPT supports in Post Editor
		'supports'            => array( 'title', 'editor', 'thumbnail', 'revisions', 'excerpt','custom-fields'),
		// You can associate this CPT with a taxonomy or custom taxonomy. 
		//'taxonomies'          => array('post_tag'),
		/* A hierarchical CPT is like Pages and can have
		* Parent and child items. A non-hierarchical CPT
		* is like Posts.
		*/	
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'show_in_rest'   => true,
		'menu_position'       => 10,
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
		'menu_icon'           => 'dashicons-editor-help'
	);
		// Registering your Custom Post Type
		register_post_type( 'faq', $args );
	}
	/* Hook into the 'init' action so that the function
	* Containing our post type registration is not 
	* unnecessarily executed. 
	*/
add_action( 'init', 'kfaq_cpt', 0 );
