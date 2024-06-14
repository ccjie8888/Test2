<?php
class Custom_Variation_URL_Title
{
    public function init()
    {
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
        add_action('wp_ajax_nopriv_load_variation_content', array($this, 'load_variation_content'));
        add_action('wp_ajax_load_variation_content', array($this, 'load_variation_content'));
    }

    public function enqueue_scripts()
    {
        if (is_product()) {
            wp_enqueue_script('custom-variation-url-title', CVUT_PLUGIN_URL . 'assets/js/custom-variation-url-title.js', array('jquery'), '1.0', true);
            wp_localize_script('custom-variation-url-title', 'cvut_data', array(
                'base_url' => get_permalink(),
                'ajax_url' => admin_url('admin-ajax.php')
            ));
            wp_enqueue_style('custom-variation-url-title', CVUT_PLUGIN_URL . 'assets/css/custom-variation-url-title.css');
        }
    }

    public function load_variation_content()
    {
        if (isset($_POST['product_id']) && isset($_POST['attribute_pa_color'])) {
            $product_id = intval($_POST['product_id']);
            $color = sanitize_text_field($_POST['attribute_pa_color']);

            // 获取产品
            $product = wc_get_product($product_id);
            if ($product && $product->is_type('variable')) {
                $available_variations = $product->get_available_variations();
                foreach ($available_variations as $variation_data) {
                    if (strtolower($variation_data['attributes']['attribute_pa_color']) == strtolower($color)) {
                        wc_get_template('variation-content.php', array('variation' => $variation_data), '', CVUT_PLUGIN_DIR . 'templates/');
                        wp_die();
                    }
                }
            }
        }
        wp_die('Variation not found', 'Variation not found', 404);
    }
}
