<?php
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache


define('WP_ENVIRONMENT', 'dev');

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
define('DB_NAME', 'wpstatus_db');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         'dPH)&l{]5-pimper>LlinMFWX~5H+rOQo 0]:~2K)0DY&P._aKAkfV7rPtIP]TwC');
define('SECURE_AUTH_KEY',  'e=!-I)CNJCKKk2QKYx+6_1tazBfW>Hd5K,.?XiAPZ<@js.vy^0s>jmh[]B2ATc~-');
define('LOGGED_IN_KEY',    ']Y>g]-N6BO5gvP0DK+& 1Kap+82Ob-uAnE2o?%1x+6gkc}8E<gg9T$aU$RkN#>AX');
define('NONCE_KEY',        'r#HwT}Lf)#r>zFI)^_mXNWLWx,#U^W~D@]&S[=o8379{WT=96|:$-k~1FE0+jZy/');
define('AUTH_SALT',        '+JsUx/z1=$GT}!T^B~xJ*^+Ryh3yBN}HXl^4rmdl4s{t@>Oc>A0=z+ZzjjJ.9L):');
define('SECURE_AUTH_SALT', '2i6F|5wfka,XZXO=D5U}N7iB}w(#-7V~>t5 RNSHYi%8HJFpICZm;D(z*<c]U:M<');
define('LOGGED_IN_SALT',   '^N=z01Rfp4{r`4UMZ7R/xu3+f0;.l~tdxy(_auyf6bDk,S|x7F*Gtg &VJXrtJ3W');
define('NONCE_SALT',       'q)G7.Ih91qGBX]-V=y*3JU=vyweWuj{q$);b1dC`]> S^x%{vFwLpPpm&<4##r@J');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
