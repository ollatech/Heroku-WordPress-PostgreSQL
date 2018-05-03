<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
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
define('DB_NAME', 'stencil');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         'w5^[ AeGew^pRe&];+zstP+5ZC|mTdfnXQ ZHTuCoX*gH!Cn@grxqM6z0FmuZ!4^');
define('SECURE_AUTH_KEY',  'dZ,JEjnbT /-p)1PUc<<-Sm)pPZBnAw_H}Ng-rO&t%]bU:k=4xJEUS+fPfN|9KJT');
define('LOGGED_IN_KEY',    ' PTEv@QIH}V4k|RAb8k.mzcGr)82SNw*,2[^hkKpYq@b$K[u2%KHdR_.cW_H-z!l');
define('NONCE_KEY',        'N-5t@$d}liZ,v_%Vo>SDw^GH#i|IxN]0jH4Pr2LpYj- MR&6v$~$,xcp_7][GX#G');
define('AUTH_SALT',        'B`J+/d0QxS8Y15N8^1a0S2(`n)mw|GvS+eC-xhQ+$dM%,zX`:PVyM/e.A{MOgw`1');
define('SECURE_AUTH_SALT', ':k+=x+3([sobm,|+Gu(+3A=J+YC:2V$`+lGaI0%}*M&z+M)J;J%SreIYbuHmzE&=');
define('LOGGED_IN_SALT',   '/,<<8u[Sqa`>+om^lG^S2>$Popb`!>]:7Cq?0BX.Gf+Ciek]FB#13oroq~BL58*q');
define('NONCE_SALT',       'U`6(Cse}(b0_6y+4EWxs/DvJHk$o6;& x;T)>DE@yB6l77O7w:urD1c-vRZ<<G4K');

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
define('WP_DEBUG', true);
define( 'WP_DEBUG_LOG', true );
define( 'WP_DEBUG_DISPLAY',true );

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
