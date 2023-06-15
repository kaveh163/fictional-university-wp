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

class AreYouPayingAttention
{
    function __construct()
    {
        // register block type with php
        add_action('init', array($this, 'adminAssets'));
    }
    function adminAssets()
    {
        // register a script
        wp_register_script('ournewblocktype', plugin_dir_url(__FILE__) . 'build/index.js', array('wp-blocks', 'wp-element'));
        register_block_type(
            'ourplugin/are-you-paying-attention',
            array(
                // editor_script: telling wordpress which javascript file to load for this block type
                'editor_script' => 'ournewblocktype',
                // function that is responsible to return html that will be seen on the front end of website
                'render_callback' => array($this, 'theHTML')
            )
        );
    }
    // First argument is block attributes
    function theHTML($attributes)
    {
        // ob stands for output buffer. anything between ob_start() and ob_get_clean() will be returned
        ob_start();?>
        <h3>Today the sky is <?php echo esc_html($attributes['skyColor']);?> and the grass is <?php echo esc_html($attributes['grassColor']);?></h3>
        <?php return ob_get_clean();
    }
}
$areYouPayingAttention = new AreYouPayingAttention();