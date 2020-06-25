<?php
/**
 *  Handle admin notices displays in the WP Rocket plugin
 *
 * @package    spiralWebDb\rocketHelper\Admin
 * @since      1.0.0
 * @author     Robert A. Gadon
 * @link       http://spiralwebdb.com
 * @license    GNU General Public License 2.0+
 */

namespace spiralWebDb\rocketHelper\Admin;

add_action( 'in_admin_header', __NAMESPACE__ . '\unregister_htaccess_permissions_notice' );
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

