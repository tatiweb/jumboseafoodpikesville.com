<?php
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache


define('WP_HOME','http://localhost:8888/jumboseafoodpikesville.com');
define('WP_SITEURL','http://localhost:8888/jumboseafoodpikesville.com');

/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'jumbo');

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
define('AUTH_KEY',         '*;%]_}5BABO6)3hi{TejJ8RF)+ Fz-cCI2W])_-mLOvJ MU)Ub(p9|bKU,>YI4-q');
define('SECURE_AUTH_KEY',  'Qd8=c_9vbI6Cg(zq;xUSbyO=bQWzO:kV)m%FKM0%S5PvzX^|CT+r5)CPWZI8PsWB');
define('LOGGED_IN_KEY',    'V>Ge-P3>{#jA9knNU$3&N:_FJG^Btp.D.yA]wmZeE5hBZUVfJ+8P/xJXa+j+Kih`');
define('NONCE_KEY',        '$*E)9cecbzM5yY]]J~v1AC^15SfjGK B^51FZ1d@[}}s *-I-d*57]d)NQ|M5>[m');
define('AUTH_SALT',        '|9!6hiQ5|:fyj|HP3t-~mSvr874nWhsFJo/o}WDI]T^*)_h010i-Ou-T?xm3_!wW');
define('SECURE_AUTH_SALT', '3VHPO7P4puiAnQN=q)?=W=+<UE[[&)tpO_*=S9/Y9sY+f0Xm78uQn;z /+*o~+kr');
define('LOGGED_IN_SALT',   '>D>wvEA>fbAsKTo}(7^,Hk/ON0(pU+1 ujBZ++h-$43$yEc9Ur]:8TC9? o.&+s[');
define('NONCE_SALT',       '(#R{+{^qqKLu&D)&|T2NU1IbM-|Ix,=7Vs^dCMASk-6v4? }*f?m!t!wS>X[*ih9');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'js_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

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
