<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'bradrib_donate');

/** MySQL database username */
define('DB_USER', 'bradrib_ramon');

/** MySQL database password */
define('DB_PASSWORD', 'g5LQI3m0qmrR');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         '[KrIR>:;2m67/k7n gB6^k2CAj;7*&*Bp|-#`p1<E_edEj0kE`X8xuI7nH~~[m?3');
define('SECURE_AUTH_KEY',  '813OZe?JPNxA<<zo(%MxUAY)43Xz@[~z]w`s3~kySXaW!ukiOy@w+Q#T60#]9u #');
define('LOGGED_IN_KEY',    'W_s$UaE!0J;zf7qkmLuFt[ &y]D]`Hq,82%PH#pnCrn$gd_,yg,V,uWoBd0GBB^N');
define('NONCE_KEY',        'YlH}s;+,=NUBe0/Kmzt(}Cqo=T4BQ`Sc4C*V-Fh2D7Mg,me(3^f8VLN|xxuDa*s-');
define('AUTH_SALT',        'QtzUL`nFizUl-V q(vb@3ws>@VnLt1V;(BcY,tI rYLdjY=(d*2VO(Q:CsWN)FF=');
define('SECURE_AUTH_SALT', '@!OQy5Ke2k}T*XVPD%7_b4YBD{JiQcm<TXhO26mZMvg|G32UaP^Rt%e($ &2 QR6');
define('LOGGED_IN_SALT',   'WZ<[K*_cQ&yoZYrAX*1t%J:WJ]l;ATcjZEQGU{+ZFv=X}>>l=ls1p$<XH3D$!nPy');
define('NONCE_SALT',       '@;:y%xa[P!p0s)UO0s>I:`OUOYQ:cHdOK<M^e$I<65A06^wG8&OxAG#vER@#B5_j');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
