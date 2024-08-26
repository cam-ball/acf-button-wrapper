<?php
/**
 * ACF Button Wrapper
 *
 * @package           ACFButtonWrapper
 * @author            Cam Ball
 * @copyright         2024 Cam Ball
 * @license           GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       ACF Button Wrapper
 * Description:       Custom "buy button" used to access ACF-defined "amazon_link" fields
 * Version:           0.0.1
 * Author:            Cam Ball
 * Text Domain:       acf-button-wrapper
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */
 
 /*
  * Within a query loop, this works only in conjunction with an edited version
  * of Shortcode Extended
  * https://github.com/seemly/shortcode-extended
  *
  * The [buy_button] shortcode must be included in the list of allowed
  * shortcodes in order to be able to grab individual post IDs when used
  * within a query loop.
  */

 function create_acf_button($atts) {
   $default_attributes = array(
     'button_text' => 'Available Now',
   );
   $button_text = shortcode_atts($default_attributes, $atts)['button_text'];

   $amazon_url = do_shortcode('[acf field="amazon_link"]', get_the_ID());

   if(empty($amazon_url)) {
     $button_content = "<span class='wp-block-button__link wp-element-button'>". $button_text ."</span>";
   } else {
     $button_content = "<a class='wp-block-button__link wp-element-button' href='". $amazon_url . "'>". $button_text ."</a>";
   }

   $content = "<div class='shortcode-button wp-block-button'>\r\n";
   $content .= $button_content;
   $content .= "</div>";
	 
   return $content;
 }

add_shortcode('buy_button', 'create_acf_button');
