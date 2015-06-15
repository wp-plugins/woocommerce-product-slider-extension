 <?php
 add_filter('woocommerce_general_settings', 'pse_setting');

    function pse_setting($settings) {
        $updated_settings = array();



        foreach ($settings as $section) {



            // at the bottom of the General Options section

            if (isset($section['id']) && 'general_options' == $section['id'] &&
                    isset($section['type']) && 'sectionend' == $section['type']) {



                $updated_settings[] = array(
                    'name' => __('Product Slider', 'wc_product_slider'),
                    'desc_tip' => __('The Slider View of Product.', 'wc_product_slider'),
                    'id' => 'woocommerce_product_slider',
                    'type' => 'checkbox',
                    'css' => 'min-width:300px;',
                    'std' => '1', // WC < 2.0

                    'default' => '1', // WC >= 2.0
                );
            }



            $updated_settings[] = $section;
        }

        return $updated_settings;
    }