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
        wp_register_style('quizeditcss', plugin_dir_url(__FILE__) . 'build/index.css');
        // register a script
        wp_register_script('ournewblocktype', plugin_dir_url(__FILE__) . 'build/index.js', array('wp-blocks', 'wp-element', 'wp-editor'));
        register_block_type(
            'ourplugin/are-you-paying-attention',
            array(
                // editor_script: telling wordpress which javascript file to load for this block type
                'editor_script' => 'ournewblocktype',
                'editor_style' => 'quizeditcss',
                // function that is responsible to return html that will be seen on the front end of website
                'render_callback' => array($this, 'theHTML')
            )
        );
    }
    // First argument is block attributes
    function theHTML($attributes)
    {
        if (!is_admin()) {
            // for the frontend
            // wp-element: wordpress's version of React. (wp.element in browser console)
            wp_enqueue_script('attentionFrontend', plugin_dir_url(__FILE__) . "build/frontend.js", array("wp-element"));
            wp_enqueue_style('attentionFrontendStyles', plugin_dir_url(__FILE__) . "build/frontend.css");
        }
        // ob stands for output buffer. anything between ob_start() and ob_get_clean() will be returned
        // pre tag is used to parse the text as json from the page
        // display:none the element is not rendered but it is still in the dom
        ob_start(); ?>
        
        <div class="paying-attention-update-me"><pre style="display:none;"><?php echo wp_json_encode($attributes);?></pre></div>
        <?php return ob_get_clean();
    }
}
$areYouPayingAttention = new AreYouPayingAttention();