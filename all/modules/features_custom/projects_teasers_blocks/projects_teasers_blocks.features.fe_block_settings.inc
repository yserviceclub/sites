<?php
/**
 * @file
 * projects_teasers_blocks.features.fe_block_settings.inc
 */

/**
 * Implements hook_default_fe_block_settings().
 */
function projects_teasers_blocks_default_fe_block_settings() {
  $export = array();

  $export['version'] = '2.0';

  $export['views-projects_teasers-project_news'] = array(
    'cache' => -1,
    'custom' => 0,
    'delta' => 'projects_teasers-project_news',
    'module' => 'views',
    'node_types' => array(),
    'pages' => 'projects*',
    'roles' => array(),
    'themes' => array(
      'bootstrap' => array(
        'region' => '',
        'status' => 0,
        'theme' => 'bootstrap',
        'weight' => 0,
      ),
      'bootstrap_subtheme' => array(
        'region' => 'sidebar_first',
        'status' => 1,
        'theme' => 'bootstrap_subtheme',
        'weight' => -17,
      ),
      'seven' => array(
        'region' => '',
        'status' => 0,
        'theme' => 'seven',
        'weight' => 0,
      ),
    ),
    'title' => '<none>',
    'visibility' => 1,
  );

  return $export;
}
