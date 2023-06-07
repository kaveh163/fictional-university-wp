<?php

/*
 Plugin Name: Our Test Plugin
 Description: A truly amazing plugin.
 Version: 1.0
 Author: Kaveh
 Author URI: https://www.udemy.com/user/bradschiff/
 Text Domain: wcpdomain
 Domain Path: /languages
*/

// Uses wordpress generated form builder. wordpress will handle automatically nonce, security issues, the form submission.

// Plugin is for leveraging action and filter hooks
// that wordpress makes available to us.
// Plugin setting screen or admin screen:
// how to add a link in the admin settings screen to a new
// custom page we are creating

class WordCountAndTimePlugin
{
    function __construct()
    {
        // admin_menu: fires before the administration menu loads in the admin
        add_action('admin_menu', array($this, 'adminPage'));
        // admin_init: triggered before any other hook when a user accesses the admin area.
        // used for adding register_setting function
        add_action('admin_init', array($this, 'settings'));
        add_filter('the_content', array($this, 'ifWrap'));
        //below: init Fires on the initialization of WordPress
        add_action('init', array($this, 'languages'));
    }
    //For translation use the loco translation plugin
    // loco translate looks for the code with __();
    function languages()
    {   
        // load the translated files into languages folder
        // third argument: path to our languages folder
        load_plugin_textdomain('wcpdomain', false, dirname( plugin_basename( __FILE__ ) ) . '/languages');
    }
    function ifWrap($content)
    {
        if (is_main_query() and is_single() and (get_option('wcp_wordcount', '1') or get_option('wcp_charactercount', '1') or get_option('wcp_readtime', '1'))) {
            return $this->createHTML($content);
        }
        return $content;
    }
    function createHTML($content)
    {
        $html = '<h3>' . esc_html(get_option('wcp_headline', 'Post Statistics')) . '</h3><p>';
        // get word count once because both word count and read time will need it.
        if (get_option('wcp_wordcount', '1') or get_option('wcp_readtime', '1')) {
            $wordCount = str_word_count(strip_tags($content));
        }
        if (get_option('wcp_wordcount', '1')) {
            $html .= esc_html__('This post has', 'wcpdomain') . ' ' . $wordCount . ' ' . __('words', 'wcpdomain') . '.<br>';
        }
        if (get_option('wcp_charactercount', '1')) {
            $html .= 'This post has ' . strlen(strip_tags($content)) . ' characters.<br>';
        }
        // Average adult reads 200 or approximately 225 words per minute.
        if (get_option('wcp_readtime', '1')) {
            $html .= 'This post will take about ' . round($wordCount / 225) . ' minute(s) to read.<br>';
        }
        $html .= '</p>';
        if (get_option('wcp_location', '0') == '0') {
            return $html . $content;
        }
        return $content . $html;
    }
    function settings()
    {
        // execute 3
        //wcp: word count plugin
        // below: first argument: section name
        // second argument: title for the section (subtitle);
        // third argument: generic html content we want at top of section
        add_settings_section('wcp_first_section', null, null, 'word-count-settings-page');

        add_settings_field('wcp_location', 'Display Location', array($this, 'locationHTML'), 'word-count-settings-page', 'wcp_first_section');
        register_setting('wordcountplugin', 'wcp_location', array('sanitize_callback' => array($this, 'sanitizeLocation'), 'default' => '0'));

        add_settings_field('wcp_headline', 'Headline Text', array($this, 'headlineHTML'), 'word-count-settings-page', 'wcp_first_section');
        register_setting('wordcountplugin', 'wcp_headline', array('sanitize_callback' => 'sanitize_text_field', 'default' => 'Post Statistics'));

        add_settings_field('wcp_wordcount', 'Word count', array($this, 'checkboxHTML'), 'word-count-settings-page', 'wcp_first_section', array('theName' => 'wcp_wordcount'));
        register_setting('wordcountplugin', 'wcp_wordcount', array('sanitize_callback' => 'sanitize_text_field', 'default' => '1'));

        add_settings_field('wcp_charactercount', 'Character count', array($this, 'checkboxHTML'), 'word-count-settings-page', 'wcp_first_section', array('theName' => 'wcp_charactercount'));
        register_setting('wordcountplugin', 'wcp_charactercount', array('sanitize_callback' => 'sanitize_text_field', 'default' => '1'));

        // execute 2
        // below function: build out the html field for this form. fields will be output in table tag.
        // first argument: The name of the setting we want to add this to
        // second argument: name of the field to display, what people see in frontend
        // third argument: callback function to output the html
        // fourth argument: slug of the settings page
        // fifth argument: section that we want to add this field to.
        add_settings_field('wcp_readtime', 'Read Time', array($this, 'checkboxHTML'), 'word-count-settings-page', 'wcp_first_section', array('theName' => 'wcp_readtime'));
        // execute 1
        //First argument: the name of the group this setting belongs to
        //Second argument: the actual name for this setting
        //Third argument:array: 
        //sanitize_callback:how we are going to sanitize or validate the value
        //default: if no values exist in database, what would be the default
        register_setting('wordcountplugin', 'wcp_readtime', array('sanitize_callback' => 'sanitize_text_field', 'default' => '1'));
    }
    // Validation for wcp_location
    function sanitizeLocation($input)
    {
        if ($input != '0' and $input != '1') {
            add_settings_error('wcp_location', 'wcp_location_error', 'Display location must be either beginning or end.');
            return get_option('wcp_location');
        }
        return $input;
    }
    /*
    function readtimeHTML() {?>
        <input type="checkbox" name="wcp_readtime" value="1" <?php checked(get_option('wcp_readtime'), '1');?>>
    <?php }
    function charactercountHtmL() { ?>
        <input type="checkbox" name="wcp_charactercount" value="1" <?php checked(get_option('wcp_charactercount'), '1') ;?>>
    <?php }
    function wordcountHTML() {?>
        <input type="checkbox" name="wcp_wordcount" value="1" <?php checked(get_option('wcp_wordcount', '1'))?>>
    <?php }
    */

    // reusable checkbox function
    function checkboxHTML($args)
    { ?>
        <input type="checkbox" name="<?php echo $args['theName'] ?>" value="1" <?php checked(get_option($args['theName']), '1') ?>>
        <?php }
    function headlineHTML()
    { ?>
        <input type="text" name="wcp_headline" value="<?php echo esc_attr(get_option('wcp_headline')); ?>">
    <?php }
    function locationHTML()
    { ?>
        <!-- name should match the setting we have just registered -->
        <select name="wcp_location">
            <!-- selected function outputs select attribute for the html -->
            <option value="0" <?php selected(get_option('wcp_location'), '0'); ?>>Beginning of post</option>
            <option value="1" <?php selected(get_option('wcp_location'), '1'); ?>>End of post</option>
        </select>
    <?php }
    function adminPage()
    {
        // Add a link in our settings menu in admin
        // first argument: title of the page we want to create (used in the actual tab in the browser)
        // second argument: the text or title of the page that will be used in the settings menu
        // Third argument: what capability does the user need to have in order to see this page
        // manage_options: Only if the user (Admin) has permissions to change options in wordpress should they be able to see this page
        // Fouth argument: The slug for this page. Should be unique.
        // Fifth argument: Function to Output Html content to the new page
        add_options_page('Word Count Settings', __('Word Count', 'wcpdomain'), 'manage_options', 'word-count-settings-page', array($this, 'ourHTML'));

    }
    function ourHTML()
    { ?>
        <!-- no css for wrap, wordpress will take care of it -->
        <div class="wrap">
            <h1>Word Count Settings</h1>
            <form action="options.php" method="POST">
                <?php
                // below: output the hidden html for us. the nonce value, action value. handles the security and permission aspects for us
                settings_fields('wordcountplugin');
                // wordpress will look for any sections that have been registered with the slug for setting page.
                // automatically loops through the fields and sections that have been registered
                do_settings_sections('word-count-settings-page');
                // wordpress button
                submit_button();
                ?>
            </form>
        </div>
    <?php }
}
$wordCountAndTimePlugin = new WordCountAndTimePlugin();