<?php
/**
 * Redirect frontend requests to REST API
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Headless_Theme
 */

require_once ABSPATH . 'wp-admin/includes/plugin.php';

// Redirect user to documentation URL if WP API Swagger UI plugin is active.
if ( is_plugin_active( 'wp-api-swaggerui/wp-api-swaggerui.php' ) ) {
	header( 'Location: /rest-api/docs' );
	exit;
}

// Redirect individual posts to the REST API endpoint.
if ( is_singular() ) {
	header(
		sprintf(
			'Location: /wp-json/wp/v2/%s/%s',
			get_post_type_object( get_post_type() )->rest_base,
			get_post()->ID
		)
	);
	exit;
}

header( 'Location: /wp-json/' );
exit;
