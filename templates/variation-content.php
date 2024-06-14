<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

if (isset($variation)) {
    $product = wc_get_product($variation['variation_id']);
?>
    <div class="single-product-content">
        <h1 class="product_title"><?php echo $product->get_name(); ?></h1>
        <div class="woocommerce-product-gallery">
            <?php echo $product->get_image(); ?>
        </div>
        <div class="woocommerce-product-details__short-description">
            <?php echo $product->get_short_description(); ?>
        </div>
        <div class="woocommerce-variation-price">
            <?php echo $product->get_price_html(); ?>
        </div>
        <!-- 其他你想展示的变体信息 -->
    </div>
<?php
}
