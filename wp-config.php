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
define( 'DB_NAME', 'wordpress' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',         '[e!WTR~9~ia,~>s+Ax,vnO|$Yx_Lg`j:F[4;d#2ZW*HwW.5Q&(B9]mE+Q%*fc8=K' );
define( 'SECURE_AUTH_KEY',  'tsB!O#7 1mT~]1nnTj3ehhFUiE^pZlH!s10K6G`ahA:ia!%uKfT8s.:fGB@$@Ok(' );
define( 'LOGGED_IN_KEY',    '%:AxIr~edel359BLq=o60x/#ARU6`gzdFFu3V6e`MGQu03pucv7+f!bF2[|`BOKJ' );
define( 'NONCE_KEY',        'iGYPVn[:HYNP}TtV<0%>=jtEyc<:+(mzf5-5>r<;s(NmJ{t@H&wULDxBR%~O<wQ;' );
define( 'AUTH_SALT',        'PD,PcyZ,Q-7^(K-V-b8J`X[_~(r5{94#=WW;[=eK;C2f{3Hh$}%!`5lv1{o{(1-@' );
define( 'SECURE_AUTH_SALT', 'iqe`NijK3y}(zY;kI12+8<gOYHS(oxfP%|4`dD%aw5:n;X1]0(r4zoslb-*7`(I-' );
define( 'LOGGED_IN_SALT',   'jVCeZ-+v<MWo~:Hu;2c(%lV:U4fW2R(V,iN$-VkCqz(,;HI44Fz`Sc:E8d_sKH-=' );
define( 'NONCE_SALT',       'KfXqg/]TLur3oKbtTp3f4~K]JWs|J1Fo~jxJpv!:0Vy>m>F|p}0lYU,TO7n{X:xO' );

/**#@-*/

/**
 * WordPress database table prefix.
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
 * visit the documentation.
 *
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

