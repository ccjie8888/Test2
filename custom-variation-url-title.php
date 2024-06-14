<?php
/*
Plugin Name: Custom Variation URL and Title
Description: Modify product URL and title based on color variant.
Version: 1.0
Author: Your Name
*/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// 定义插件路径
define('CVUT_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('CVUT_PLUGIN_URL', plugin_dir_url(__FILE__));

// 包含必要的文件
require_once CVUT_PLUGIN_DIR . 'includes/class-custom-variation-url-title.php';
require_once CVUT_PLUGIN_DIR . 'includes/functions.php';

// 初始化插件
function cvut_init()
{
    $cvut = new Custom_Variation_URL_Title();
    $cvut->init();
}

add_action('plugins_loaded', 'cvut_init');
