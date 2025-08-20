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
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', "upyog" );

/** Database username */
define( 'DB_USER', "XXXXX" );

/** Database password */
define( 'DB_PASSWORD', "XXXXXXXXXXX" );

/** Database hostname */
define( 'DB_HOST', "localhost" );

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
define( 'AUTH_KEY',         'K+0F/T=~mYKDJ+=UJ_Qu{6:x#fe@P<Xd9m^4Xs6g?,-2&nYt8f}X[8k|V|.1vnHj' );
define( 'SECURE_AUTH_KEY',  'w=[^BMI@[mJ=~9R;02@ZsACo1@h2`5$7V`L#yJKlq$i=hYVsX$=Gtqm&M&V1)Vc(' );
define( 'LOGGED_IN_KEY',    '<Gz-,*qX2a[UKTFIe${lgfa_x}2cBnf<w.oTathURLK4S,O>KS}Qdrs!vmUj*^f+' );
define( 'NONCE_KEY',        'qrQdVVz,e_(rT$|HqCmqj6=YD0hhgp_IkPE9ZG|w=>Oaa]oL6*_m4i}}rnWW{`b$' );
define( 'AUTH_SALT',        'DKvOo;T,Su&oGTn=kCXd(!U03(I6GB2X8?zMAhdg8^sEveei#h~[U%:4BX+{)>dP' );
define( 'SECURE_AUTH_SALT', ')GWm9=HwC($=Wtp2l$#=yP?9gD0I+`o#qg #e2;~>b&OF(_=jMJX(!9JQRn1%(.t' );
define( 'LOGGED_IN_SALT',   '|*5qD&RXi<d&qwi.k3{_quM%__X.LD||PEs?YjT2-#nh_o2qZoB#[<-c=ZVnfrcc' );
define( 'NONCE_SALT',       'j2Hp+WTxm$svnEub-Utcc]_@(P/bCS[`*5dJf>Kw$AyNh.]INVIps6i06*,4$q*%' );

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



define( 'DUPLICATOR_AUTH_KEY', 'UdZm`9jqfJx%,rmn<nm!w|qt$Qa&6#-:skEUPlSed0X`)clyqD:+rSTB1+usss&o' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname(__FILE__) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
