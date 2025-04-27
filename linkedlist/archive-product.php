<?php
defined('ABSPATH') || exit;

get_header('shop'); ?>

<div class="shop-page-wrapper">

    <!-- Display Categories -->
    <div class="categories-section">
        <h2>All Categories</h2>
        <ul class="categories-grid">
            <?php
            $categories = get_terms('product_cat', array(
                'hide_empty' => true,
            ));
            foreach ($categories as $category) {
                $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
                $image_url = wp_get_attachment_url($thumbnail_id);
                ?>
                <li>
                    <a href="#category-<?php echo esc_attr($category->slug); ?>">
                        <div class="category-image">
                            <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($category->name); ?>">
                        </div>
                        <div class="category-name"><?php echo esc_html($category->name); ?></div>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </div>

    <!-- Display Products by Category -->
    <div class="products-section">
        <?php
        foreach ($categories as $category) {
            ?>
            <div id="category-<?php echo esc_attr($category->slug); ?>" class="category-products">
                <h3><?php echo esc_html($category->name); ?></h3>
                <ul class="products-grid">
                    <?php
                    $query = new WP_Query(array(
                        'post_type' => 'product',
                        'posts_per_page' => -1,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'product_cat',
                                'field' => 'slug',
                                'terms' => $category->slug,
                            ),
                        ),
                    ));

                    if ($query->have_posts()) {
                        while ($query->have_posts()) {
                            $query->the_post();
                            wc_get_template_part('content', 'product'); // Default WooCommerce product template
                        }
                    }
                    wp_reset_postdata();
                    ?>
                </ul>
            </div>
        <?php } ?>
    </div>

</div>

<?php
get_footer('shop');
