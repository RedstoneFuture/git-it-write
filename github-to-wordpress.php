<?php
/*
Plugin Name: Github to WordPress
Plugin URI: https://www.aakashweb.com/
Description: A WordPress plugin to publish posts from Github
Author: Aakash Chakravarthy
Version: 1.0
*/

define( 'G2W_VERSION', '1.0' );
define( 'G2W_PATH', plugin_dir_path( __FILE__ ) ); // All have trailing slash
define( 'G2W_ADMIN_URL', trailingslashit( plugin_dir_url( __FILE__ ) . 'admin' ) );

final class Github_To_WordPress{

    public static function init(){
        
        self::includes();

    }

    public static function includes(){

        require __DIR__ . '/vendor/autoload.php';

        require_once( G2W_PATH . 'includes/utilities.php' );
        require_once( G2W_PATH . 'includes/repository.php' );
        require_once( G2W_PATH . 'includes/publisher.php' );
        require_once( G2W_PATH . 'includes/publish-handler.php' );
        require_once( G2W_PATH . 'includes/parsedown.php' );

        require_once( G2W_PATH . 'admin/admin.php' );

    }

    public static function default_config(){
        return array(
            'username' => '',
            'repository' => '',
            'folder' => '/',
            'post_type' => 'doc',
            'last_publish' => 0
        );
    }

    public static function all_repositories(){

        $repos_raw = get_option( 'g2w_repositories', array( array(), array('username' => 'vaakash'), array()) );
        $repos = array();
        $default_config = self::default_config();

        foreach( $repos_raw as $id => $config ){
            array_push( $repos, wp_parse_args( $config, $default_config ) );
        }

        return $repos;

    }

}

Github_To_WordPress::init();

?>