<?php
/*
 Plugin Name: Our Word Filter Plugin
 Description: Replace a list of words.
 Version: 1.0
 Author: Kaveh
 Author URI: https://www.udemy.com/user/bradschiff/
*/
// prevent public user to directly access your .php files through URL in browser
// If this file is accessed directly in the URL, 
// do not load the rest of the file's content in the browser. 
//  If file is accessed within the WordPress Environment, continue to load the file's content.

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class OurWordFilterPlugin
{
    function __construct()
    {
        add_action('admin_menu', array($this, 'ourMenu'));
        add_action('admin_init', array($this, 'ourSettings'));
        if(get_option('plugin_words_to_filter')) add_filter('the_content', array($this, 'filterLogic'));
    }
    function ourSettings() {
        add_settings_section('replacement-text-section', null, null, 'word-filter-options');
        register_setting('replacementFields', 'replacementText');
        // the first argument below: the id attribute for the specific element
        // second argument is the label for the field
        add_settings_field('replacementText', 'Filtered Text', array($this, 'replacementFieldHTML'), 'word-filter-options', 'replacement-text-section');
    }
    function replacementFieldHTML() { ?>
        <input type="text" name="replacementText" value="<?php echo esc_attr(get_option('replacementText', '***'))?>">
        <p class="description"></p>Leave blank to simply remove the filtered words.</p>
    <?php }
    function filterLogic($content) {
        $badWords = explode(',', get_option('plugin_words_to_filter'));
        // trim: what to do to each item of array and return a new array
        // second argument: original array
        $badWordsTrimmed = array_map('trim', $badWords);
        // first argument: the array of words we want to replace
        // second argument: what we want to replace them with
        // third argument: the text we want to perform the replacement on
        return str_ireplace($badWordsTrimmed, esc_html(get_option('replacementText', '****')), $content);
    }
    // where are menu appears vertically. Example (top of the admin panel or bottom)
    function ourMenu()
    {
        // For the svg icon, copy the svg tag inside custom.svg as the argument of btoa() function in console.
        // this changes the binary code to ascii. 
        // Copy the result of btoa() function to the 6 argument of the function below after base64,
        // This way wordpress is able to change the fill color on svg to match the exact shade of grid that wordpress uses.
        // wodrpress gives us the blue hover color.

        // add_menu_page('Words To Filter', 'Word Filter', 'manage_options', 'ourwordfilter', array($this, 'wordFilterPage'), plugin_dir_url(__FILE__) . 'custom.svg', 100);
        $mainPageHook = add_menu_page('Words To Filter', 'Word Filter', 'manage_options', 'ourwordfilter', array($this, 'wordFilterPage'), 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHZpZXdCb3g9IjAgMCAyMCAyMCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZmlsbC1ydWxlPSJldmVub2RkIiBjbGlwLXJ1bGU9ImV2ZW5vZGQiIGQ9Ik0xMCAyMEMxNS41MjI5IDIwIDIwIDE1LjUyMjkgMjAgMTBDMjAgNC40NzcxNCAxNS41MjI5IDAgMTAgMEM0LjQ3NzE0IDAgMCA0LjQ3NzE0IDAgMTBDMCAxNS41MjI5IDQuNDc3MTQgMjAgMTAgMjBaTTExLjk5IDcuNDQ2NjZMMTAuMDc4MSAxLjU2MjVMOC4xNjYyNiA3LjQ0NjY2SDEuOTc5MjhMNi45ODQ2NSAxMS4wODMzTDUuMDcyNzUgMTYuOTY3NEwxMC4wNzgxIDEzLjMzMDhMMTUuMDgzNSAxNi45Njc0TDEzLjE3MTYgMTEuMDgzM0wxOC4xNzcgNy40NDY2NkgxMS45OVoiIGZpbGw9IiNGRkRGOEQiLz4KPC9zdmc+', 100);
        add_submenu_page('ourwordfilter','Words To Filter','Words List','manage_options','ourwordfilter',array($this, 'wordFilterPage'));
        add_submenu_page('ourwordfilter','Word Filter Options','Options','manage_options','word-filter-options',array($this, 'optionsSubPage'));
        add_action("load-{$mainPageHook}", array($this, 'mainPageAssets'));
    }
    function mainPageAssets() {
        wp_enqueue_style('filterAdminCss', plugin_dir_url(__FILE__) . 'styles.css');
    }

    function handleForm() {
       if(wp_verify_nonce($_POST['ourNonce'], 'saveFilterWords') AND current_user_can('manage_options')) {
         // save the data in the wordpress options table in database
        // first argument: the name of the option in database where we want to store the value
        // second argument: the value to be saved in database
        update_option('plugin_words_to_filter', sanitize_text_field($_POST['plugin_words_to_filter']));?>
        <!-- this is the class which wordpress offers to us, it will create a green success styling -->
        <div class="updated">
            <p>Your filtered words were saved.</p>
        </div>
       <?php } else { ?>
            <div class="error">
                <p>Sorry, you do not have permission to perform that action.</p>
            </div>
      <?php }
   }
     function wordFilterPage()
    { ?>
        <div class="wrap">
            <h1>Word Filter</h1>
            <?php if($_POST['justsubmitted'] == 'true') $this->handleForm();?>
            <form action="" method="post">
                <input type="hidden" name="justsubmitted" value="true">
                <!-- using nonce to prevent csrf attack -->
                <!-- The nonce field is used to validate that the contents of the form came from the location on the current site and not somewhere else. -->
                <?php wp_nonce_field('saveFilterWords', 'ourNonce');?>
                <label for="plugin_words_to_filter"><p>Enter a <strong>comma-seperated</strong> list of words to filter from your site's content.</p></label>
                <div class="word-filter__flex-container">
                    <textarea name="plugin_words_to_filter" id="plugin_words_to_filter" placeholder="bad, mean, awful, horrible"><?php echo esc_textarea(get_option('plugin_words_to_filter'))?></textarea>
                </div>
                <input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes">
            </form>
        </div>
    <?php }
    function optionsSubPage() { ?>
        <div class="wrap">
            <h1>Word Filter Options</h1>
            <!-- wordpress generated form thats outputs the fields -->
            <form action="options.php" method="POST">
                <?php 
                    // for the green success message we should call the function below
                    // since our plugin is not on the settings page in the wordpress settings menu
                    settings_errors();
                    settings_fields('replacementFields');
                    do_settings_sections('word-filter-options');
                    submit_button();
                ?>
            </form>
        </div>
    <?php }
}
$ourWordFilterPlugin = new OurWordFilterPlugin();