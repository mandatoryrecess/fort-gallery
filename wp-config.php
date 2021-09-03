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
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'fortgallery' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
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
define( 'AUTH_KEY',         '$1n^2PeT][3aYVJ,4 yDw)A=G=#;V 10A5DZHoB<)B=@v%MSa^;,Kug}BWfz!CX@' );
define( 'SECURE_AUTH_KEY',  'E14NjK=3]]21^j8~,=/K2r_o(QSz?%a?xT} oFQx7%z7TI%crCA>~%w;I)%um60H' );
define( 'LOGGED_IN_KEY',    ' UZIkbU1u_1`JlV~om>4r2=$msh<O?$_Av7i;^u%pRF 6` X.Ix_z|lp{ia)-L[X' );
define( 'NONCE_KEY',        'T?N:Mk]*Bj,m0OBW$U69qDY[Vmeb`,oPIDaDlFs7V;Uv0catE1zNU S3>tIsI74*' );
define( 'AUTH_SALT',        '~@(#E|3n@KA*EWFcF-T]?#<Y=NScfVb[s)KazNY-!JhXc,{YO/Ei;A?*@_nL}mGt' );
define( 'SECURE_AUTH_SALT', '#^.E4Ag[DS*t)NeHq[y~LB.a#e3Ke4Ix<0Onq;6MYvaYBE%OA2*[?Kxn*^$TLOMe' );
define( 'LOGGED_IN_SALT',   '6dE_:oZPzp1Z^@t44;YIRdRNh<XYi.S:8EM].M>zX`~v$wp]/ZW.Db&zT@VIbA#?' );
define( 'NONCE_SALT',       '27i7`^2H;=]8JsE|@/xCM]N4sjNm`M <q4n[|cV$(zjYA/@=1Nx9k[o$~k>+Xgwi' );

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
