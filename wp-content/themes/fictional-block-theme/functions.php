<?php
// Global function used in the theme templates

require get_theme_file_path('/inc/like-route.php');
require get_theme_file_path('/inc/search-route.php');
function university_custom_rest()
{
    // first argument of the function below is the post type, 
    // second argument the added field name,
    // third argument the author of each blog post
    register_rest_field(
        'post',
        'authorName',
        array(
            'get_callback' => function () {
                return get_the_author();
            }
        )
    );
    register_rest_field(
        'note',
        'userNoteCount',
        array(
            'get_callback' => function () {
                return count_user_posts(get_current_user_id(), 'note');
            }
        )
    );
}
add_action('rest_api_init', 'university_custom_rest');
function pageBanner($args = NULL)
{
    if (!isset($args['title'])) {
        $args['title'] = get_the_title();
    }
    if (!isset($args['subtitle'])) {
        $args['subtitle'] = get_field('page_banner_subtitle');
    }
    if (!isset($args['photo'])) {
        // When using pageBanner for archive or blog page
        // if the first post of archive or blog templates has a custom field image, it would be used  as the banner for these templates
        // to avoid this we add two more conditions as below
        if (get_field('page_banner_background_image') and !is_archive() and !is_home()) {
            $args['photo'] = get_field('page_banner_background_image')['sizes']['pageBanner'];
        } else {
            $args['photo'] = get_theme_file_uri('/images/ocean.jpg');
        }
    }
    ?>
    <div class="page-banner">
        <div class="page-banner__bg-image" style="background-image: url(<?php echo $args['photo']; ?>)"></div>
        <div class="page-banner__content container container--narrow">
            <?php // print_r($pageBannerImage); ?>
            <h1 class="page-banner__title">
                <?php echo $args['title']; ?>
            </h1>
            <div class="page-banner__intro">
                <p>
                    <?php echo $args['subtitle']; ?>
                </p>
            </div>
        </div>
    </div>
<?php }
function university_files()
{

    // wordpress function points to the css file (style.css)
    // wp_enqueue_style('university_main_styles', get_stylesheet_uri());
    wp_enqueue_script('googleMap', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyCLzGnrEffuBDSDiuoA3lsAAOEVn8KVFFQ&callback=Function.prototype', NULL, '1.0', true);
    wp_enqueue_script('main-university-js', get_theme_file_uri('/build/index.js'), array('jquery'), '1.0', true);
    wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('university_main_styles', get_theme_file_uri('/build/style-index.css'));
    wp_enqueue_style('university_extra_styles', get_theme_file_uri('/build/index.css'));

    wp_localize_script(
        'main-university-js',
        'universityData',
        array(
            'root_url' => get_site_url(),
            //nonce :  Whenever we successfully log in into wordpress, wordpress creates a random generated number for the user session
            // The API uses nonces with the action set to wp_rest
            'nonce' => wp_create_nonce('wp_rest')
        )
    );
}
// university_files function runs at specific moments and that moment is specified by wp_enqueue_scripts.
// right before you output the code (syle, and script) inside Head tag in header file, call university_files.
add_action('wp_enqueue_scripts', 'university_files');

function university_features()
{
    // register_nav_menu('headerMenuLocation', 'Header Menu Location');
    // register_nav_menu('footerLocationOne', 'Footer Location One');
    // register_nav_menu('footerLocationTwo', 'Footer Location Two');
    add_theme_support('title-tag');

    // Function below add featured image (post-thumbnail) for default wordpress Posts and Pages
    add_theme_support('post-thumbnails');

    //The last argument is if you want to crop the image or not, by default it is false,
    // false constrains the image to the max width or height we defined.
    //If we want the image to exactly be the width and height below, the only way is to crop the image, so we should set the last argument to true.
    // True crops the image using centered position
    // We create custom images so that our data plan and bandwidth are not wasted. smaller image sizes are downloaded faster.
    add_image_size('professorLandscape', 400, 260, true);
    add_image_size('professorPortrait', 480, 650, true);
    add_image_size('pageBanner', 1500, 350, true);
    // to load the entire css we used for our theme into the editor(our banner block)
    // used when loading block from theme instead of plugin.
    add_theme_support('editor-styles');
    add_editor_style(array('https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i', 'build/style-index.css', 'build/index.css'));
}
add_action('after_setup_theme', 'university_features');

function university_adjust_queries($query)
{

    if (!is_admin() and is_post_type_archive('campus') and is_main_query()) {

        $query->set('posts_per_page', -1);
    }
    if (!is_admin() and is_post_type_archive('program') and is_main_query()) {
        $query->set('orderby', 'title');
        $query->set('order', 'ASC');
        $query->set('posts_per_page', -1);
    }

    if (!is_admin() and is_post_type_archive('event') and is_main_query()) {
        $today = date('Ymd');
        $query->set('meta_key', 'event_date');
        $query->set('orderby', 'meta_value_num');
        $query->set('order', 'ASC');
        $query->set(
            'meta_query',
            array(
                array(
                    'key' => 'event_date',
                    'compare' => '>=',
                    'value' => $today,
                    'type' => 'NUMERIC',
                )
            )
        );

    }
}
add_action('pre_get_posts', 'university_adjust_queries');


function universityMapKey($api)
{
    $api['key'] = 'AIzaSyCLzGnrEffuBDSDiuoA3lsAAOEVn8KVFFQ';
    return $api;
}
add_filter('acf/fields/google_map/api', 'universityMapKey');

// Redirect subscriber accounts out of admin and onto homepage
add_action('admin_init', 'redirectSubsToFrontend');

function redirectSubsToFrontend()
{
    $ourCurrentUser = wp_get_current_user();

    if (count($ourCurrentUser->roles) == 1 and $ourCurrentUser->roles[0] == 'subscriber') {
        wp_redirect(site_url('/'));
        exit;
    }
}
//wp_loaded fires when the plugins and theme have loaded.
add_action('wp_loaded', 'noSubsAdminBar');

function noSubsAdminBar()
{
    $ourCurrentUser = wp_get_current_user();

    if (count($ourCurrentUser->roles) == 1 and $ourCurrentUser->roles[0] == 'subscriber') {
        show_admin_bar(false);
    }
}
// Customize login screen
add_filter('login_headerurl', 'ourHeaderUrl');
function ourHeaderUrl()
{
    return esc_url(site_url('/'));
}
add_action('login_enqueue_scripts', 'ourLoginCSS');

// custom css for login page
function ourLoginCSS()
{
    wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('university_main_styles', get_theme_file_uri('/build/style-index.css'));
    wp_enqueue_style('university_extra_styles', get_theme_file_uri('/build/index.css'));

}
// login_headertitle deprecated. use login_headertext instead
add_filter('login_headertext', 'ourLoginTitle');
function ourLoginTitle()
{
    //if building a theme that might be used by many sites in that case fetch the official sitename from the databas
    return get_bloginfo('name');
}

// Force note posts to be private
//hook below (wp_insert_post_data) runs on creating and updating the post(note)
//when deleting a note post, wordpress makes the post_status equal to "trash"
//new posts for create don't have id.
//Third argument  of function below (10) is the priority. priority of which function should be executed first
//when there are multiple functions assigned to this hook. the lower the value, the function would execute earlier.
//Fourth argument of function below is the number of parameters passed to makeNotePrivate.
add_filter('wp_insert_post_data', 'makeNotePrivate', 10, 2);
//wordpress wp_insert_post_data passes two arguments to this function
function makeNotePrivate($data, $postarr)
{
    if ($data['post_type'] == "note") {
        if (count_user_posts(get_current_user_id(), 'note') > 4 and !$postarr['ID']) {
            // die to cancel the current request.
            die("You have reached your note limit.");
        }
        $data['post_content'] = sanitize_textarea_field($data['post_content']);
        $data['post_title'] = sanitize_text_field($data['post_title']);
    }
    //$data is all the data that is going to be sent to database.
    //post_status private makes user notes invisible in restapi.
    //post_status publish shows all user notes in restapi.
    if ($data['post_type'] == 'note' and $data['post_status'] != 'trash') {
        $data['post_status'] = "private";
    }

    return $data;
}

class JSXBlock
{
    function __construct($name, $renderCallback = null)
    {
        $this->name = $name;
        $this->renderCallback = $renderCallback;
        // registering our custom block type to use this banner.js asset in the editor
        add_action('init', [$this, 'onInit']);
    }
    // $content is for accessing nested block contents
    function ourRenderCallback($attributes, $content) {
        ob_start();
        require get_theme_file_path("/our-blocks/{$this->name}.php");
        return ob_get_clean();
    }
    function onInit()
    {
        // register javascript file
        // first argument: name of the javascript asset
        // wp_register_script($this->name, get_stylesheet_directory_uri() . "/build/{$this->name}.js", array('wp-blocks', 'wp-editor'));
        // register block type
        wp_register_script($this->name, get_stylesheet_directory_uri() . "/build/{$this->name}.js", array('wp-blocks', 'wp-editor'));
        $ourArgs = array(
            'editor_script' => $this->name
        );
        if($this->renderCallback) {
            $ourArgs['render_callback'] = [$this, 'ourRenderCallback'];
        }
        register_block_type(
            "ourblocktheme/{$this->name}", $ourArgs
            
        );
    }
}
// to avoid repeated code for registering our block type we use the class JSXBlock instead.
// true is for if we want a php render callback
new JSXBlock('banner', true);
new JSXBlock('genericheading');
new JSXBlock('genericbutton');










?>