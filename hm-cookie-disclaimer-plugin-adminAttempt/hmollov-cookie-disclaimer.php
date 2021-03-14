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
    add_action('init', 'showCookieDisclaimer');
    add_action('wp_enqueue_scripts', 'includeCookieDisclaimerStyles');
    add_action('wp_enqueue_scripts', 'includeCookieDisclaimerScripts');
    add_action('admin_menu', 'addAdminMenuSettings');
    add_action('admin_menu', 'addAdminMenuSettingsStyle');
}

class CookieDisclaimer {
    public $statement = 'We use cookies to give you the best online experience.';
    public $ownerhsip = 'By using our website, you agree to the privacy policy of UFX Europe (Reliantco Investments Ltd) regulated by the <a href="https://wordpress.org/about/privacy/" target="new_blank">Cyprus Securities Exchange</a> Commisions.';
    public $btn = 'Accept and Close';
    public $baseColor = '#f7c413';

    public function set_statement($statement) {
        $this->statement = $statement;
    }

    public function set_ownerhsip($ownerhsip) {
        $this->ownerhsip = $ownerhsip;
    }

    public function set_btn($btn) {
        $this->btn = $btn;
    }

    public function set_baseColor($baseColor) {
        $this->baseColor = $baseColor;
    }

    function get_statement() {
        return $this->statement;
    }

    function get_ownerhsip() {
        return $this->ownerhsip;
    }

    function get_btn() {
        return $this->btn;
    }

    function get_baseColor() {
        return $this->baseColor;
    }
}

$cookieDesclaimer = new CookieDisclaimer();

function getCookieDisclaimerData($data) {
    return $data;
}

function showCookieDisclaimer() {
    if(!defined($_COOKIE['acceptedTerms'])) {
global $cookieDesclaimer;
?>
        <div class="cookie-disclaimer-wrapper">
            <p class="close-button"><span onclick="hideForm()">x</span></p>
            <p><?php echo $cookieDesclaimer->get_statement(); ?></p>
            <p><?php echo $cookieDesclaimer->get_ownerhsip(); ?></p>
            <button id="accept-cookies-btn" onclick="acceptTerms()"><?php echo $cookieDesclaimer->get_btn(); ?></button>
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

function addAdminMenuSettings() {
    add_options_page( 'Cookie Disclaimer Options', 'Cookie Disclaimer', 'manage_options', 'cookie-disclaimer-options', 'adminMenuSettingsOptions' );
}

function addAdminMenuSettingsStyle() {
    wp_enqueue_style('style', plugin_dir_url(__FILE__).'/styles/settings-style.css');
}

function adminMenuSettingsOptions() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
global $cookieDesclaimer;
?>
	<div class="wrap">
	    <form id="cookie-disclaimer-options" method="POST">
            <label for="cookieStatement">Cookie Statement:</label>
            <textarea name="cookieStatement" id="cookieStatement" cols="30" rows="5"><?php echo $cookieDesclaimer->get_statement(); ?></textarea>
            <label for="siteOwnership">Site Ownership:</label>
            <textarea name="siteOwnership" id="siteOwnership" cols="30" rows="5"><?php echo $cookieDesclaimer->get_ownerhsip(); ?></textarea>
            <label for="acceptButton">Accept Button:</label>
            <input type="text" id="acceptButton" name="acceptButton" value="<?php echo $cookieDesclaimer->get_btn(); ?>">
            <label for="baseColor">Base Color:</label>
            <input type="text" id="baseColor" name="baseColor" value="<?php echo $cookieDesclaimer->get_baseColor()?>">
            <input type="submit" id="cd-submit-btn" name="cd-submit-btn" value="Apply Changes">
        </form>
    </div>
<?php

//Function to actually do the changes ...
}
?>