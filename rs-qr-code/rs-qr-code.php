<?php
/*
Plugin Name: RS QR Code
Plugin URI: https://wordpress.org
Description: This plugin adding a QR code to the blog post, so that you can scan and read the same blog on your mobile instantly! Kinda Apple Echosystem.😉
Version: 1.0.0
Author: Riadujjaman Shanto
Author URI: https://shanto.net
Requires at least: 5.2
Requires PHP: 7.2
Licence: GPL v2 or later
Licence URI: https://www.gnu.org/licenses/gpl-2.0.html
Update URI: https://shanto.net/pricing
Text Domain: rs-qr-code
Domain Path: /languages
*/

class Rs_qr_code
{
    function __construct()
    {
        add_filter("the_content", [$this, "generate_qr"]);
    }
    function generate_qr($content)
    {
        if (is_single()) {
            $post_link = get_permalink();
            $quick_chart = "https://quickchart.io/qr?&text=";
            $post_qr = $quick_chart . $post_link;
            $label = "Scan Me";
            $size = apply_filters("rs_qr_size", "150");
            $qr_html = "<div style='
                                    position: fixed;
                                    text-align: center;
                                    right: 20px;
                                    bottom: 20px;
                                    z-index: 999;
                                '>
                            <div style='margin-bottom:5px;'>" . esc_html($label) . "</div>
                            <img class='qr-code' src='" . esc_url($post_qr) . "' alt='QR Code' width='" . esc_attr($size) . "' height='" . esc_attr($size) . "'>           
                        </div>";
            return $content . $qr_html;
        }
        return $content;
    }
}
new Rs_qr_code();