jQuery(document).ready(function ($) {
    var baseUrl = cvut_data.base_url;
    var ajaxUrl = cvut_data.ajax_url;

    // 监听变体选择事件
    $('form.variations_form').on('change', 'select', function () {
        var selectedColor = $('select[name="attribute_pa_color"]').val();
        if (selectedColor) {
            var newUrl = baseUrl + '?attribute_pa_color=' + selectedColor.toLowerCase();
            var productId = $('input[name="product_id"]').val();

            // 更新URL
            window.history.replaceState(null, null, newUrl);

            // 使用AJAX加载变体内容
            $.ajax({
                url: ajaxUrl,
                type: 'POST',
                data: {
                    action: 'load_variation_content',
                    product_id: productId,
                    attribute_pa_color: selectedColor
                },
                success: function (response) {
                    // 更新页面内容
                    $('.single-product-content').html(response);

                    // 更新标题
                    var newTitle = $('.single-product-content .product_title').text();
                    $('title').text(newTitle);
                },
                error: function () {
                    console.log('Error loading variation content');
                }
            });
        }
    });
});