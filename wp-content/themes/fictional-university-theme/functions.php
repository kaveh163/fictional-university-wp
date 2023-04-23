<?php
// Global function used in the theme templates
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
        <div class="page-banner__bg-image" style="background-image: url(<?php echo $args['photo'];?>)"></div>
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

    wp_localize_script('main-university-js', 'universityData', array(
        'root_url' => get_site_url()
    ));
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


function universityMapKey($api) {
    $api['key'] = 'AIzaSyCLzGnrEffuBDSDiuoA3lsAAOEVn8KVFFQ';
    return $api;
}
add_filter('acf/fields/google_map/api', 'universityMapKey');

    ?>