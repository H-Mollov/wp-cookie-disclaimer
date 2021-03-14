<?php
/**
 * @package HMollovPlugin
 */
/*
Plugin Name: H.Mollov Cookie Disclaimer Plugin
Plugin URI: <-- Put GitHub url here
Description: Cookie Disclaimer Test Plugin. Provides a consent form to the user, giving him all the information needed about the cookies that are about to be stored.
Version: 1.0.0
Author: Hasan Mollov - H.M.
Author URI: https://github.com/H-Mollov/
Text Domain: hmollov-cookie-disclaimer
*/

if (function_exists('showCookieDisclaimer')) {
    add_action('wp_body_open', 'showCookieDisclaimer');
    add_action('wp_enqueue_scripts', 'includeCookieDisclaimerStyles');
    add_action('wp_enqueue_scripts', 'includeCookieDisclaimerScripts');
}

function showCookieDisclaimer() {
    if(!defined($_COOKIE['acceptedTerms'])) {
?>
    <div class="cookie-disclaimer-wrapper">
        <p class="close-button"><span onclick="hideForm()">x</span></p>
        <p>We use cookies to give you the best online experience.</p>
        <p>By using our website, you agree to the privacy policy of UFX Europe (Reliantco Investments Ltd) regulated by the <a href="https://wordpress.org/about/privacy/" target="new_blank">Cyprus Securities Exchange</a> Commisions.</p>
        <button id="accept-cookies-btn" onclick="acceptTerms()">Accept and Close</button>
    </div>
<?php
   }
}

function includeCookieDisclaimerStyles() {
    wp_enqueue_style('style', plugin_dir_url(__FILE__).'/styles/style.css');
}

function includeCookieDisclaimerScripts() {
    wp_enqueue_script('core', plugin_dir_url(__FILE__).'/scripts/core.js');
}
?>