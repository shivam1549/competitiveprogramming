
// Custom code

// 
function enqueue_custom_scripts() {
    // Register and enqueue the script (replace 'your-script-handle' with your script handle)
    wp_enqueue_script( 'your-script-handle', get_template_directory_uri() . '/js/your-script.js', array('jquery'), null, true );

    // Localize the script to pass the AJAX URL to the script
    wp_localize_script( 'your-script-handle', 'ajaxurl', admin_url('admin-ajax.php') );
}

add_action( 'wp_enqueue_scripts', 'enqueue_custom_scripts' );

add_action( 'woocommerce_after_shop_loop_item', 'display_variations_in_shop', 15 );

function display_variations_in_shop() {
    global $product;

    // Only for variable products
    if ( $product->is_type( 'variable' ) ) {
        echo '<form class="variations_form cart" method="post" enctype="multipart/form-data" action="' . esc_url( wc_get_cart_url() ) . '">';

        // Output variations dropdown
        $attributes = $product->get_variation_attributes();
        foreach ( $attributes as $attribute_name => $options ) {
            echo '<p class="form-row">';
            echo '<label for="' . esc_attr( $attribute_name ) . '">' . wc_attribute_label( $attribute_name ) . '</label>';
          wc_dropdown_variation_attribute_options(array(
    'options'   => $options,
    'attribute' => 'attribute_' . wc_attribute_taxonomy_slug($attribute_name),
    'product'   => $product,
    'selected'  => '', // Ensure default value
));
            echo '</p>';
        }

        // Hidden input for product ID
        echo '<input type="hidden" name="add-to-cart" value="' . $product->get_id() . '">';
   echo '<input type="hidden" name="product_id" value="' . $product->get_id() . '">';
        // Hidden input for variation ID (this will be dynamically set by JavaScript)
        echo '<input type="hidden" name="variation_id" class="variation_id" value="">';

        // Quantity field
        echo '<p class="form-row">';
        echo '<label for="quantity">' . esc_html__( 'Quantity', 'woocommerce' ) . '</label>';
        echo '<input type="number" name="quantity" value="1" >';
        echo '</p>';

        // Add to Cart button
        echo '<button type="submit" class="button add_to_cart_button">' . esc_html__( 'Add to Cart', 'woocommerce' ) . '</button>';

        echo '</form>';
    }
}


function enqueue_variation_scripts() {
    if ( is_shop() || is_product_category() || is_product_tag() ) {
        wp_enqueue_script( 'wc-add-to-cart-variation' );
    }
}
add_action( 'wp_enqueue_scripts', 'enqueue_variation_scripts' );

add_action( 'wp_footer', 'add_dynamic_swatch_js', 100 );

function add_dynamic_swatch_js() { ?>
   <script>
jQuery(function ($) {
    // Listen for clicks on swatches
    $('.cfvsw-swatches-option').on('click', function () {
        var selectedValue = $(this).data('slug'); // Get the value from the data-slug attribute

        // Find the closest form and dynamically locate the associated select element
        var $form = $(this).closest('.variations_form');
        var $select = $form.find('select[data-attribute_name]'); // Find the select with data-attribute_name

        // Check if a select element exists
        if ($select.length) {
            // Update the correct select element based on the clicked swatch
            var attributeName = $select.data('attribute_name'); // Dynamically get the attribute name
            var $targetSelect = $form.find(`select[name="${attributeName}"]`);

            if ($targetSelect.length) {
                // Update the select element value and trigger change event
                $targetSelect.val(selectedValue).trigger('change');

                // Mark the clicked swatch as active
                $(this).addClass('selected').siblings().removeClass('selected');

                // Dynamically update the variation_id via AJAX
                updateVariationId($form);
            }
        }
    });

    // Reset active class when variations are reset
    $('.variations_form').on('reset_data', function () {
        $('.cfvsw-swatches-option').removeClass('selected');
        $(this).find('.variation_id').val(''); // Clear variation_id
    });

    // Function to update the variation_id via AJAX
    function updateVariationId($form) {
        var attributes = {};

        // Collect selected attributes
        $form.find('select[data-attribute_name]').each(function () {
            var attributeName = $(this).data('attribute_name');
            var attributeValue = $(this).val();
            if (attributeValue) {
                attributes[attributeName] = attributeValue;
            }
        });

        var product_id = $form.find('input[name="add-to-cart"]').val(); // Get product ID

        // AJAX request to get the variation ID
        $.ajax({
            url: ajaxurl, // WordPress AJAX URL
            method: 'POST',
            data: {
                action: 'get_product_variation', // Custom action defined in PHP
                product_id: product_id,
                attributes: attributes
            },
            success: function(response) {
                if (response.success) {
                    // Update the variation_id field with the fetched variation ID
                    $form.find('.variation_id').val(response.data.variation_id);
                } else {
                    $form.find('.variation_id').val(''); // Clear if no match
                }
            },
            error: function() {
                $form.find('.variation_id').val(''); // Clear in case of error
            }
        });
    }
});
</script>

<?php }

// Add AJAX handler to fetch variations
add_action( 'wp_ajax_get_product_variation', 'get_product_variation' );
add_action( 'wp_ajax_nopriv_get_product_variation', 'get_product_variation' );
function get_product_variation() {
    if ( ! isset( $_POST['product_id'] ) || ! isset( $_POST['attributes'] ) ) {
        wp_send_json_error(array('message' => 'Missing required data.'));
    }

    $product_id = absint($_POST['product_id']);
    $attributes = array_map('sanitize_text_field', $_POST['attributes']);

    $product = wc_get_product($product_id);
    if ( ! $product || ! $product->is_type('variable') ) {
        wp_send_json_error(array('message' => 'Invalid product.'));
    }

    $available_variations = $product->get_available_variations();

    foreach ( $available_variations as $variation ) {
        $match = true;
        foreach ( $attributes as $name => $value ) {
            $attr_key = 'attribute_' . wc_attribute_taxonomy_slug($name);
            if ( isset($variation['attributes'][$attr_key]) && $variation['attributes'][$attr_key] !== $value ) {
                $match = false;
                break;
            }
        }

        if ( $match ) {
            wp_send_json_success(array('variation_id' => $variation['variation_id']));
        }
    }

    wp_send_json_error(array('message' => 'No matching variation.'));
}

wp_localize_script('your-script-handle', 'ajaxurl', admin_url('admin-ajax.php'));
