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
define( 'DB_NAME', 'food' );

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
define( 'AUTH_KEY',         'ym#_+{y:&cUvY1_kDR>0|h7SP#<-.j.=M/|/dps]{pBT^F-,$dA,n%BI3z@})z1f' );
define( 'SECURE_AUTH_KEY',  'Ot$^9!,qhZ?q`Y(R&$BBBtG?gdapb*7vyRxLF8uK$R-t,k9y^cni00=3HIDc9XuX' );
define( 'LOGGED_IN_KEY',    'yM#u:0%Z.G9wBl75]LDaS_&gR&AE%_qxQwr$+);K7$6t<?U5D9ddW9{TVE3&6fo5' );
define( 'NONCE_KEY',        'M0ewtjdvXUW4SdE&L7>h~Mp*o&re<={iN:(I`Yh}|qhNC8#V$wWx%$X,w#t=Y|Mp' );
define( 'AUTH_SALT',        'H)7]#Q/JK]TIomf&g yhV1@NGI`~rEm<RF`S%a.Khuwl]Ecs8|f/8n{}cAm?SDLw' );
define( 'SECURE_AUTH_SALT', 'k3iotTFPT/V3lEuV>[Af_EQbypk,6<9&GE^HZRHi7yNnROL9%]&3aZOBH+>G-ZJe' );
define( 'LOGGED_IN_SALT',   '4)?f&nFPDcDxVeM%k:[.ia0T*+gFfD0Ap+?vX8%GauJVJPkUAkb]bnlU^,g$};@*' );
define( 'NONCE_SALT',       'y!iw/I.{M}x_w+uG`;rEj_XevNiB%`_`KkcC$!X`XGzF3joe[wf44`Vh%=gjkQO;' );

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
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
