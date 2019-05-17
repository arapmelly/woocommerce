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
define( 'DB_NAME', 'optimus_wordpress_db' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '!QAZ2wsx2019' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '((c`!8)P&?&0KG007K|ssTW<s6~sm-$fP_PzT:b4+H}+Kb+{d@AZy*E= @~ro|F)' );
define( 'SECURE_AUTH_KEY',  'Fee.9.q*?( je|nUZc-Fw/iFC yM!#Ow*V4:kjha!KOQ~NxU>z0u.G5N7@_-A;h(' );
define( 'LOGGED_IN_KEY',    ']Y@o87,w_7_g^{;ByPgE(+{L/DE3Y[Fj|!C16e=%~?Oa(1RV{~Yw.C~0e4*O83j;' );
define( 'NONCE_KEY',        '011mq0VRe3[[.Iw9;iX:rt+[R`AS~F1t~dXao)DB{y&Z3JA5LB(s%:E%.d|Y;M7O' );
define( 'AUTH_SALT',        '0=1]Rxhcv=L*%1+s%+s]_Yn<c%X8(n9ZYy~#VM2IWx5[O%/+=hsGN^v#|0-?JY|[' );
define( 'SECURE_AUTH_SALT', 'lf0rdw%e{<pq P3WSgZKZm[;wQ.N!ygHJF_szXGq2>HN5e(w~ZFR/7L+Pa{I^VG%' );
define( 'LOGGED_IN_SALT',   '>mQJGXYmoNJ<it$m>K%|1Aig+MKwp1+_~;2j>6>3N|f I!DwNpYJ]eIl?z![i$0S' );
define( 'NONCE_SALT',       'Kg*UTwYz~Rkqz?<L(!TSh8z?q`oL](%ZPClv5-(`aOtpQFl1%so&h+X6JZRCI#kT' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
define( 'WP_DEBUG', true );

define('FS_METHOD','direct');

define( 'WP_MEMORY_LIMIT', '256M' );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
