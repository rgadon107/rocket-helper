<?php
/**
 * WP Rocket Helper Plugin
 *
 * @package     spiralWebDb\rocketHelper
 * @author      Robert A Gadon
 * @license     GPL-2.0+
 *
 * @wordpress-plugin
 * Plugin Name:     WP Rocket Helper Plugin
 * Plugin URI:      https://github.com/rgadon107/rocket-helper
 * Description:     A helper plugin to remove 2 hooks in the WP Rocket plugin.
 * Version:         1.0.0
 * Requires WP:     5.0
 * Requires PHP:    5.6
 * Author:          Robert A Gadon
 * Author URI:      https://spiralWebDb.com
 * Text Domain:     rocket-helper
 * License:         GPL-2.0+
 * License URI:     http://www.gnu.org/licenses/gpl-2.0.txt
 */

namespace spiralWebDb\rocketHelper;

add_action( 'admin_init', __NAMESPACE__ . '\unregister_htaccess_permissions_notice' );
/**
 * Unregister the htaccess permissions admin notice in the WP Rocket plugin.
 *
 * @since 1.0.0
 *
 * @return void
 */
function unregister_htaccess_permissions_notice() {
	remove_action( 'admin_notices', 'rocket_warning_htaccess_permissions' );
}

/**
 * Remove function rocket_warning_advanced_cache_permissions() from the 'admin_notices' hook.
 *
 * @since 1.0.0
 *
 * @return void
 */
add_action( 'admin_init', function() {
	$container  = apply_filters( 'rocket_container', null );
	$subscriber = $container->get( 'admin_cache_subscriber' );

	remove_action( 'admin_notices', [ $subscriber, 'rocket_warning_advanced_cache_permissions'] );
	}
);

