<?php
/*
  Plugin Name: Products Slider Extension
  Description: This plugin adds the ultimate product slider to your Shop page.
  Version:
  Author: infoway
  Author URI: http://www.infoway.us
 */
?>
<?php
add_action('plugins_loaded', 'pse_callback');

function pse_callback() {

    define('PSE_FILE_PATH', dirname(__FILE__));
    define('PSE_FOLDER', dirname(plugin_basename(__FILE__)));
    define('PSE_URL', untrailingslashit(plugins_url('/', __FILE__)));
    define('PSE_NAME', plugin_basename(__FILE__));
    define('PSE_IMAGES_URL', PSE_URL . '/assets/images');
    define('PSE_JS_URL', PSE_URL . '/assets/js');
    define('PSE_CSS_URL', PSE_URL . '/assets/css');

    include ('admin/product-slider.php');

    function pse_enqueue() {

        wp_enqueue_script('pse-jcarousel-min', PSE_JS_URL . '/jquery.jcarousel.min.js');
        wp_enqueue_script('pse-responsive-js', PSE_JS_URL . '/jcarousel.responsive.js');
        wp_enqueue_style('pse-responsive-css', PSE_CSS_URL . '/jcarousel.responsive.css');
        if (get_option('woocommerce_product_slider') == 'yes'):
            wp_enqueue_style('pse-custom-css', PSE_CSS_URL . '/custom.css');
        endif;
    }

    add_action('wp_enqueue_scripts', 'pse_enqueue');

    add_action('woocommerce_after_shop_loop', 'pse_carousel_func', 11);

    function pse_carousel_func() {
        global $product;
        global $woocommerce;
        if (get_option('woocommerce_product_slider') == 'yes') {
            ?>

            <div class="jcarousel-wrapper woo-product-slider">
                <div class="jcarousel">
                    <ul>
                        <?php while (have_posts()) : the_post(); ?>
                            <li>
                                <a href="<?php echo get_permalink(); ?>"> 
                                    <div class="woo-product-image">
                                        <table width="100%" border="0" cellpading="0" cellspacing="0">
                                            <tr>
                                                <td align="center" valign="middle">
                                                    <?php the_post_thumbnail(); ?>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <h3> <?php the_title(); ?></h3>
                                    <?php do_action('woocommerce_after_shop_loop_item_title'); ?>
                                </a>
                                <?php do_action('woocommerce_after_shop_loop_item'); ?>

                            </li>
                        <?php endwhile; // end of the loop. ?>
                    </ul>

                </div>

                <a href="#" class="jcarousel-control-prev">&lsaquo;</a>
                <a href="#" class="jcarousel-control-next">&rsaquo;</a>

                <p class="jcarousel-pagination"></p>
            </div>

            <?php
        }
    }

}
?>