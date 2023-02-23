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
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'customtheme' );

/** Database username */
define( 'DB_USER', 'admin4' );

/** Database password */
define( 'DB_PASSWORD', 'admin' );

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
define( 'AUTH_KEY',         'Q&8&C}Utq}}9nWuC~hnkT1}%PU,8TwAi}Ay5,6HV(tEdvR%+#o7i4l3YYayxBPU?' );
define( 'SECURE_AUTH_KEY',  ',Wt|MT.%Ei*&Lum+rl>H+;*wPw$D}Uv)Wcsj+U]Y1=vYXsVv2U_mc0^}gIf}Oyo-' );
define( 'LOGGED_IN_KEY',    '}=)`E}6^`Q#WNpL{7-^-bDsQ{?S,]u;Z5x(z&Y&taOcUTZqk$i.xRWrPEH8^g1Qp' );
define( 'NONCE_KEY',        'hhLy}}tl9>N^[EML>oWFeH}=/[`r|n<dRW5U% ,V(t*0*y#lDlV(nk(f=bqB-a#q' );
define( 'AUTH_SALT',        '$uY)|1:Wb|OhFbRE!V?p%ceJGKVx~,ae#tZ(T4L6JQc>lo|b4 5;[pN }Iy6^1S_' );
define( 'SECURE_AUTH_SALT', 'fm-~.7>j<<XQ<})mL$5Vu})B(.=aNx6(o6)`wzgXdS,EV0+aD=yi8~>oxp3!)DhN' );
define( 'LOGGED_IN_SALT',   '6g8WfTjw0qg=?8KnZ|3^XDFbOOzl{JXP;;rw2?!VYo=6,3>gv5$7kW_))7OEDw)w' );
define( 'NONCE_SALT',       'yig]8k;EBzOc@jG*W3Ru/?&lN`{1I2Zt&e;=ewI[~.C*jM=e,Ok+!P4JUfVwI*w4' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'ct_';

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
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
