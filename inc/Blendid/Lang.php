<?php

namespace Blendid\Starter;

if ( !is_admin() )
  return;

if ( !is_super_admin() )
  return;

class Lang {

  function __construct() {
    add_action('wp_dashboard_setup', array($this, 'wp_dashboard_setup'));
    add_action('admin_enqueue_scripts', array($this, 'admin_enqueue_scripts'));
    add_action('wp_ajax_vl-generate-mo-file', array($this, 'generate_mo_file'));
  }
  
  function wp_dashboard_setup() {
    wp_add_dashboard_widget('blendid-lang', __('Generate .mo-file', 'blendid'), array($this, 'widget_html'));
  }
  
  function widget_html() {
    ?>
    <p>
      <button id="vl-generate-mo-file" class="button button-secondary"><?php _e('Generate .mo-file', 'blendid'); ?></button>
      <span class="spinner" style="float: none;"></span>
    </p>
    <div id="vl-generate-result"></div>
    
    <?php
  }
  
  function admin_enqueue_scripts($hook) {
    if ($hook !== "index.php")
      return;
    
    wp_register_script('vl', get_template_directory_uri() . '/inc/Blendid/Lang/lang.js', 'jquery', null, true);
    wp_enqueue_script('vl');
    
    wp_localize_script('vl', 'blendid', array('nonce' => wp_create_nonce('vl-generate-mo-file')));
  }
  
  function generate_mo_file() {
    check_ajax_referer('vl-generate-mo-file', 'nonce');
    
    require_once('Lang/php-mo.php');
    
    $out = array();
    $po_files = glob(get_template_directory() . '/lang/*.po');
    
    if (!empty($po_files)) {
      foreach ($po_files as $po_file) {
        $generate_res = @phpmo_convert($po_file);
        
        $mo_filename = str_replace('.po', '.mo', basename($po_file));
        
        $out[$mo_filename] = $generate_res;
        
        wp_send_json_success($out);
      }
    } else {
      $out = "No .po files found.";
    }
    
    wp_send_json_error($out);
  }
}
