<?php
// functions.php 文件可以包含其他辅助函数

// 示例：获取产品变体的颜色选项
function cvut_get_variation_colors($product_id)
{
    $product = wc_get_product($product_id);
    if ($product && $product->is_type('variable')) {
        $variations = $product->get_available_variations();
        $colors = array();
        foreach ($variations as $variation) {
            if (isset($variation['attributes']['attribute_pa_color'])) {
                $colors[] = $variation['attributes']['attribute_pa_color'];
            }
        }
        return array_unique($colors);
    }
    return array();
}
