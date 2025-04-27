<?php
/* Template Name: Shop New Page */

get_header(); ?>


<style>
    .columns-3 {
    grid-template-columns: repeat(3, minmax(0, 1fr));
}

ul.products {
    margin: 0 0 1em;
    padding: 0;
    list-style: none outside;
    clear: both;
}

ul.products {
    display: grid;
    column-gap: 20px;
}

.categories-list {
    text-align: center;
    margin-bottom: 30px;
}

.categories-list h2 {
    font-size: 2em;
    margin-bottom: 20px;
}

.categories-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    list-style: none;
    padding: 0;
    margin: 0;
}

.categories-grid li {
    text-align: center;
    background: #f9f9f9;
    border: 1px solid #ddd;
    border-radius: 10px;
    overflow: hidden;
    transition: transform 0.3s, box-shadow 0.3s;
}

.categories-grid li:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

.categories-grid a {
    text-decoration: none;
    color: inherit;
    display: block;
    padding: 15px;
}

.category-image img {
    width: 100%;
    height: auto;
    max-width: 150px;
    margin: 0 auto;
    display: block;
}

.category-name {
    margin-top: 10px;
    font-size: 1.1em;
    font-weight: bold;
}

</style>

<div class="categories-products-page woocomerce">
    <!-- Show All Categories -->
    <div class="categories-list">
    <h2>Categories</h2>
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
                <a href="#<?php echo esc_attr($category->slug); ?>">
                    <div class="category-image">
                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($category->name); ?>">
                    </div>
                    <div class="category-name"><?php echo esc_html($category->name); ?></div>
                </a>
            </li>
            <?php
        }
        ?>
    </ul>
</div>


    <!-- Show Products by Category -->
    <div class="category-products">
        <?php
        foreach ($categories as $category) {
            ?>
            <div id="<?php echo esc_attr($category->slug); ?>" class="category-section">
                <h3><?php echo esc_html($category->name); ?></h3>
                <ul class="products columns-3">
                    <?php
                    $products = new WP_Query(array(
                        'post_type' => 'product',
                        'posts_per_page' => -1,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'product_cat',
                                'field'    => 'slug',
                                'terms'    => $category->slug,
                            ),
                        ),
                    ));

                    if ($products->have_posts()) {
                        while ($products->have_posts()) {
                            $products->the_post();
                            wc_get_template_part('content', 'product');
                        }
                    } else {
                        echo '<p>No products found in this category.</p>';
                    }

                    wp_reset_postdata();
                    ?>
                </ul>
            </div>
            <?php
        }
        ?>
    </div>
</div>

<?php get_footer(); ?>
