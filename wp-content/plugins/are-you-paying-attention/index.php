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

        // first argument points to the directory containing the block.json file
        register_block_type(
            __DIR__,
            array(
                // function that is responsible to return html that will be seen on the front end of website
                'render_callback' => array($this, 'theHTML')
            )
        );
    }
    // First argument is block attributes
    function theHTML($attributes)
    {
       
        // ob stands for output buffer. anything between ob_start() and ob_get_clean() will be returned
        // pre tag is used to parse the text as json from the page
        // display:none the element is not rendered but it is still in the dom
        ob_start(); ?>

        <div class="paying-attention-update-me">
            <pre style="display:none;"><?php echo wp_json_encode($attributes); ?></pre>
        </div>
        <?php return ob_get_clean();
    }
}
$areYouPayingAttention = new AreYouPayingAttention();