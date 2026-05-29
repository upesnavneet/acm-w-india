<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          '%llyDpS`uLBn1>>_>5m%T]1EWRX+NiHM3gy/qbLkd/2$b]xn6Ch7 Zz~/6~S<}=Q' );
define( 'SECURE_AUTH_KEY',   'ljirvm59b,,.3MZv,440L!E^caK0L}dO9[bQ|{3V/}eUIkZ+<j_B03-OHhr$Ij?}' );
define( 'LOGGED_IN_KEY',     'Ec,IjJTbqvlw=Lz`jJ+L:h?=ZKE~J]s3C1IthPy)S(ykV,Zs=qB6~F%IE]%dwEVn' );
define( 'NONCE_KEY',         ',%4y5[69%t%#IR)Mn$t,06N)>Oe zE6q_WHTe.biXt)DVlIeqj.1m`Jo35!s~f^/' );
define( 'AUTH_SALT',         'rt2QpCGlqiDqS2=Qvi:5/3a0& _AK>{Pswt,^;ZUjN*Y}o+~]JX}6hTeU5okW*N+' );
define( 'SECURE_AUTH_SALT',  'PMIO5 #Vkzf|ASu7KKk9`fNJoaoxoNobafW.4uU;Z()3Az[_V*p0ZlJRdI!9>5_;' );
define( 'LOGGED_IN_SALT',    '#/7q!AV$OIn5{YgB&>JyJ<0|~:~Ka{T]K&9(bQ~` J[A<I>)`XtDgsP~!`Brr*Nu' );
define( 'NONCE_SALT',        'r(->7+r;`s@%jI]:LZ8k>J(i.Y_5T=L !Z?PASa[&wI+io/{T^V<b6llxjLBHf@~' );
define( 'WP_CACHE_KEY_SALT', 'up1]l^oo1I,%J~+@N[S8DZ~d%`Lh@MY$1]auq:PiC&]pXf2|q9NYfdS?T&?@QdbX' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
