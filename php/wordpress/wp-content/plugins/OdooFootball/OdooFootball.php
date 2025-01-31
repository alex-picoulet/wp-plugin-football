<?php
/**
* Plugin Name: OdooFootball
* Plugin URI:  https://www.football.fr
* Description: .
* Version:     1.0.0
* Author:      Alexandre PICOULET--SONDER
* Author URI:  https://www.iutbayonne.univ-pau.fr/
* Text Domain: OdooFootball
*/

// This function is executed when the plugin is activated
function odooFootballInstall()
{ 
    $check_page_exist = get_page_by_path('odoofootball', 'OBJECT', 'page');
    // Check if the page already exists
    if(empty($check_page_exist)) {
        $page_id = wp_insert_post(
            array(
            'post_author'    => 1,
            'post_title'     => 'Football',
            'post_name'      => 'odoofootball',
            'post_status'    => 'publish',
            'post_type'      => 'page',
            'post_content'   => '',
            'post_parent'    => ''
            )
        );
    }
    // Vérifier s'il y a eu une erreur
    if ( is_wp_error( $page_id ) ) {
        echo $page_id->get_error_message();
    }
}
register_activation_hook(__FILE__,'odooFootballInstall');



// This function is executed when the plugin is deactivated
function odooFootballUninstall() {
    $page = get_page_by_path('odoofootball');
    if (isset($page)) {
        wp_delete_post($page->ID, true);
    }
}
register_deactivation_hook( __FILE__, 'odooFootballUninstall' );



function add_plugins_scripts_football() {


    if (is_page('odoofootball') || is_admin()) {
        wp_enqueue_style( 'styleodoo', plugin_dir_url(__FILE__) . 'assets/css/odoostyle.css', array(), '1.1', 'all' );


        wp_enqueue_script( 'scriptodoo', plugin_dir_url(__FILE__) . 'assets/js/odooscript.js', array(), 1.1, true ); 
    }
}
add_action( 'wp_enqueue_scripts', 'add_plugins_scripts_football' );
add_action( 'admin_enqueue_scripts', 'add_plugins_scripts_football' );

add_action( 'plugins_loaded', 'loadOdooFootball' );


function loadOdooFootball() {
    require_once('back.php');
    require_once('front.php');
}
