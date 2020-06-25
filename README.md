# 'Rocket-Helper' Plugin

A WordPress helper plugin intended to target and remove 2 admin notices that display when either the `.htaccess` or `advanced-cache.php` files are not writable.

## Targeting the admin notices

There is one procedural function and one class method each that manage the respective admin notices.

- function `rocket_warning_htaccess_permissions()` in `/wp-rocket/inc/admin/ui/notices.php` on line 377.
- function `WP_Rocket\Engine\Cache\AdvancedCache::notice_permissions()` in `/wp-rocket/inc/Engine/Cache/AdvancedCache.php` on line 84.

## Removing `function rocket_warning_htaccess_permissions()`

The function `rocket_warning_htaccess_permissions()` was relatively easy to disable. It’s registered to the action event `admin_notices`. The event is located in the file `/wp-admin/admin-header.php` on line #281. Examining the file, I found the action event `in_admin_header`, which fires immediately before `do_action( ‘admin_notices )`. I then registered a custom callback to `in_admin_header` in which `rocket_warning_htaccess_permissions()` was removed. See `/rocket-helper/src/admin/admin-notices.php` to inspect the code.

I validated the removal of `rocket_warning_htaccess_permissions()` by calling the global variable `$wp_filter` inside the custom callback and inspecting `$wp_filter[‘admin_notices’]` before and after the function was removed. The call to `$wp_filter` was removed prior to committing the plugin code to Git.

## Inability to instantiate new object and target `WP_Rocket\Engine\Cache\AdvancedCache::notice_permissions()`.

I’m not able to successfully instantiate a new object of class `WP_Rocket\Engine\Cache\AdvancedCache( $template_path, $filesystem )`. The class method that I want to remove is `WP_Rocket\Engine\Cache\AdvancedCache::notice_permissions()`. In WP Rocket version 3.6, the procedural function `rocket_warning_advanced_cache_permissions()` which manages admin notices when the `advanced-cache.php` file in not writable was deprecated. The function was added as a method to the class `WP_Rocket\Engine\Cache\AdvancedCache`.

The target method is not registered to any event (action or filter) within the class. There is no filter (e.g. `apply_filters( ‘event_name’, $object )` within the class that allows access to the object and method.

Without access to both the object and method, I can’t remove the method given my current skill level and knowledge of PHP and WordPress.
