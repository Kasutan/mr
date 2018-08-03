<?php
/**
 * Plugin Name: k-custom-block — Blocks personnalisés pour Gutenberg
 * Plugin URI: https://github.com/ahmadawais/create-guten-block/
 * Description: k-custom-block — is a Gutenberg plugin created via create-guten-block.
 * Author: mrahmadawais, maedahbatool, kasutan
 * Author URI: https://kasutan.pro/
 * Version: 1.0.0
 * License: GPL2+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 *
 * @package CGB
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Block Initializer.
 */
require_once plugin_dir_path( __FILE__ ) . 'src/init.php';
require_once plugin_dir_path( __FILE__ ) . 'src/faq/index.php';