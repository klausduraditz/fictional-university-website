<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'wyx1SC8HRG8PMjqODfzQtpOh+rj/Ns6dqCUfeH0w/7vfG3A65MUkBnnk5eiVpNyp/CRzpv1DxooDuGkSejO6UQ==');
define('SECURE_AUTH_KEY',  'i5yxiOjy+ryr3tR6T8EoP4Wbrj2I1zvDW2jD9rh1nogGgSgwoEtlFB5cPbD9CyZWY5mQYsKbpJBBK8rqqJe4XA==');
define('LOGGED_IN_KEY',    'fhHFZKp4eiYrRJORxgNWRP34hhGOqfqD2M8zjDW6oClHJlCp41asIwWE8CrorXhwFrRdUF3v4wTP/KEstA/vXQ==');
define('NONCE_KEY',        'ZmtT8VWNUflOwrOPrZ6k8yTedAJCMYspijBEgsdzfUo/MmHfCFwZyNa73OvL7n+zamBTU+EZExXReTZlLhdVcw==');
define('AUTH_SALT',        'N4jEUL90HIADWHeaHbv+4Qg/zaknnu+86uTuu+RyvEYt6TqDp7Mo370oDoa6Bvbp9VptVTlT+DdMW7CqHZvJhg==');
define('SECURE_AUTH_SALT', 'm+IJBPQxj94T+DWhfzE1EUolahpzhC9pQs+tlKrnXJG8ss0pqxsgiDq/2mjZ/rTEpYLaye9L/tdrhjxCAE+8xQ==');
define('LOGGED_IN_SALT',   'YJApQVy4RS9IVIj1O2ZGA2UdbhqHNZTLsE/Ue7dlIaQvEH9o7R96grI4gfweyf2JGXrv7i7PoQsfHR3zPI4x+g==');
define('NONCE_SALT',       '985JfpdqYaFDxJsrFckWCxU026OpBkgBU1ByflyxX+LWbhLQHfWeFSVULoZxRY6n3bOgx849CfKV2sxY9ShpnQ==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
