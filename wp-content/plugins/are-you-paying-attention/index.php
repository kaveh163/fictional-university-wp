<?php
/*
 Plugin Name: Are You Paying Attention Quiz
 Description: Give your readers a multiple choice question.
 Version: 1.0
 Author: Kaveh
 Author URI: https://www.udemy.com/user/bradschiff/
*/

// Prevents people from triggering our code by visiting the url for this php file
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class AreYouPayingAttention {
    function __construct() {
        // load javascript file when we are in the block editor screen
        add_action('enqueue_block_editor_assets', array($this, 'adminAssets'));
    }
    function adminAssets() {
        // add the wp-element dependency just to be sure 100% that it is loaded and exists before wordpress loads our file
        wp_enqueue_script('ournewblocktype', plugin_dir_url(__FILE__) . 'build/index.js', array('wp-blocks', 'wp-element'));
    }
}
$areYouPayingAttention = new AreYouPayingAttention();