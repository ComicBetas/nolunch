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

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'nolunch_wp-test');

/** MySQL database username */
define('DB_USER', 'nolunch');

/** MySQL database password */
define('DB_PASSWORD', '7KixQDhPrHPn5Dux');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'c8Q|,L5a!./d `Ps>8(Oen#S7tni4djDPUV|ON#.{x?o xc7pY>)d15:<M7jkY`@');
define('SECURE_AUTH_KEY',  'gehQuP+(_VeOWA4o4K8M|[Z_pECdy)84 ;J//SWrpYXYB)EF$xSSDS$h[F]4c5ro');
define('LOGGED_IN_KEY',    ']>!=cpI@T;:2F,l-@]6ehyBr_m]aUzXg|];WAv0),#2+1`#(J21hNNQ]75&h)39p');
define('NONCE_KEY',        'P{?6e)p#0cFd2Rh*G!,-4J>U/&~J*g^@./.q_W.1%2Kpo#3GhXzw`#5Mk~U|uM]s');
define('AUTH_SALT',        'kg4Rt<dM3Z,GP&4KH@u?+`Oop6PB9>.6|+^%$;UB:A[|Wn|M0s%?xJ%CG6=%qp{j');
define('SECURE_AUTH_SALT', 'sQJo,i?zOD+?ZhH}?1%m]O4ZHqg!IV/%DxdpE6;-T%Cl5J1ik&4C.JwWQe]9L.K.');
define('LOGGED_IN_SALT',   'TUQ=v0@65xR^vC2@$+BY@{2KY3WlJSx{>pkPN,IR_;/6yb^@>viS$lG,.p+K bkt');
define('NONCE_SALT',       '}KV1/Z;,[CDc5{!2&=-C{.qQ>LAbBh|c)Q1..oyg37^yZEzkS]d<&3r8GC -3</:');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_nolunch_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
