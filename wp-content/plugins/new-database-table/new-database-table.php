<?php

/*
  Plugin Name: Pet Adoption (New DB Table)
  Version: 1.0
  Author: Brad
  Author URI: https://www.udemy.com/user/bradschiff/
*/

if (!defined('ABSPATH'))
  exit; // Exit if accessed directly
require_once plugin_dir_path(__FILE__) . 'inc/generatePet.php';

class PetAdoptionTablePlugin
{
  function __construct()
  {
    // for database prefix and character set
    global $wpdb;
    $this->charset = $wpdb->get_charset_collate();
    $this->tablename = $wpdb->prefix . "pets";
    // name of the plugin folder and its file is appended to activate
    // activate hook runs once when the plugin is activated
    // used for example: how many columns there should be
    // what the name of each column is
    // what type of data it stores
    add_action('activate_new-database-table/new-database-table.php', array($this, 'onActivate'));
    // the function below runs any time we load or refresh the admin side of wordpress

    // add_action('admin_head', array($this, 'populateFast'));
    // wordpress runs this hook below when the user is logged in.
    add_action('admin_post_createpet', array($this, 'createPet'));
    add_action('admin_post_nopriv_createpet', array($this, 'createPet'));
    add_action('admin_post_deletepet', array($this, 'deletePet'));
    add_action('admin_post_nopriv_deletepet', array($this, 'deletePet'));

    add_action('wp_enqueue_scripts', array($this, 'loadAssets'));
    add_filter('template_include', array($this, 'loadTemplate'), 99);
  }
  function deletePet()
  {
    // admin user can insert pet
    if (current_user_can('administrator')) {
      $id = sanitize_text_field($_POST['idtodelete']);
      global $wpdb;
      $wpdb->delete($this->tablename, array('id' => $id));
      wp_safe_redirect(site_url('/pet-adoption'));
    } else {
      wp_safe_redirect(site_url());
    }
    exit;
  }
  function createPet()
  {
    // admin user can insert pet
    if (current_user_can('administrator')) {
      $pet = generatePet();
      $pet['petname'] = sanitize_text_field($_POST['incomingpetname']);
      global $wpdb;
      $wpdb->insert($this->tablename, $pet);
      wp_safe_redirect(site_url('/pet-adoption'));
    } else {
      wp_safe_redirect(site_url());
    }
    exit;
  }
  function onActivate()
  {
    // to use the dbDelta function we need to require wordpress system file below
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta("CREATE TABLE $this->tablename (
      id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
      birthyear smallint(5) NOT NULL DEFAULT 0,
      petweight smallint(5) NOT NULL DEFAULT 0,
      favfood varchar(60) NOT NULL DEFAULT '',
      favhobby varchar(60) NOT NULL DEFAULT '',
      favcolor varchar(60) NOT NULL DEFAULT '',
      petname varchar(60) NOT NULL DEFAULT '',
      species varchar(60) NOT NULL DEFAULT '',
      PRIMARY KEY  (id)


    ) $this->charset;");
  }
  // For Adding Initial Data with admin refresh
  function onAdminRefresh()
  {
    global $wpdb;
    $wpdb->insert($this->tablename, generatePet());

  }

  function loadAssets()
  {
    if (is_page('pet-adoption')) {
      wp_enqueue_style('petadoptioncss', plugin_dir_url(__FILE__) . 'pet-adoption.css');
    }
  }

  function loadTemplate($template)
  {
    if (is_page('pet-adoption')) {
      return plugin_dir_path(__FILE__) . 'inc/template-pets.php';
    }
    return $template;
  }

  function populateFast()
  {
    $query = "INSERT INTO $this->tablename (`species`, `birthyear`, `petweight`, `favfood`, `favhobby`, `favcolor`, `petname`) VALUES ";
    $numberofpets = 10000;
    for ($i = 0; $i < $numberofpets; $i++) {
      $pet = generatePet();
      $query .= "('{$pet['species']}', {$pet['birthyear']}, {$pet['petweight']}, '{$pet['favfood']}', '{$pet['favhobby']}', '{$pet['favcolor']}', '{$pet['petname']}')";
      if ($i != $numberofpets - 1) {
        $query .= ", ";
      }
    }
    /*
    Never use query directly like this without using $wpdb->prepare in the
    real world. I'm only using it this way here because the values I'm 
    inserting are coming fromy my innocent pet generator function so I
    know they are not malicious, and I simply want this example script
    to execute as quickly as possible and not use too much memory.
    */
    global $wpdb;
    // The query method allows you to execute any SQL query on the WordPress database.
    $wpdb->query($query);
  }

}

$petAdoptionTablePlugin = new PetAdoptionTablePlugin();