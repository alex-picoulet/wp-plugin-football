<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'mydatabase' );

/** Database username */
define( 'DB_USER', 'myuser' );

/** Database password */
define( 'DB_PASSWORD', 'mypassword' );

/** Database hostname */
define( 'DB_HOST', 'mysql' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         'tARzCY!iw3DDD5?JOAM4Uu%N[N$@n{W-fT[8Ywe(-EHZ)tz#gz[Ie76L5IWS-I_h' );
define( 'SECURE_AUTH_KEY',  '`wb[3Y/JJ /Wt$3v*#/P65a%5#^{OYmO%`eGJ%motm:+[ec~U[vm3.r-w*Xk4^)<' );
define( 'LOGGED_IN_KEY',    '4?oX=ZUplJ~Dii_XqOU58t{xh1V3p:If27:@=|zW#kb<j|yJ]A/3~2d+)_:hiamv' );
define( 'NONCE_KEY',        'wJp;r/A&$EX1a@Bsl`PfZ_fP.|Z3{]W &|y+*Ee*Q/2aN qwku+K:wa!aFQ6YZ-]' );
define( 'AUTH_SALT',        '|ROhT4Wn^Mj?uiMc+-~K38Q^{Q&sDHb{SSDc$D-(Cg,Ah1Mu7rN/oTkYI0rT3,H8' );
define( 'SECURE_AUTH_SALT', 'G-0a^GQ&.${!:h1^wFyELP~jBHJ,%CIMuM}7/GCS.9{+9oA}k:e%bx9%K*K5^r T' );
define( 'LOGGED_IN_SALT',   'mWcT*&3J,La?M1ViS5Wwmy$>mL`qTJ!#;|7Zx)[D$}n:ZmDB~@%}#EuVnpZe_IKT' );
define( 'NONCE_SALT',       '{cGQvi.a.|0i$@m:.QaMc?jJaK-yA{zy=3GX`XwdUfw{WQo|jYT=F}7u6-Qi;aAf' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * visit the documentation.
 *
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );
define('FS_METHOD','direct');

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
