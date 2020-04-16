<?php
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

 define('WP_HOME','https://www.canyoudrinktapwaterin.com');
 define('WP_SITEURL','https://www.canyoudrinktapwaterin.com');

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('WP_CACHE', true);
define( 'WPCACHEHOME', '/home/tapwater/canyoudrinktapwaterin.com/wp-content/plugins/wp-super-cache/' );
define('DB_NAME', 'canyoudrinktapwaterin_co');

/** MySQL database username */
define('DB_USER', 'canyoudrinktapwa');

/** MySQL database password */
define('DB_PASSWORD', 'Y!Dh9AG?');

/** MySQL hostname */
define('DB_HOST', 'mysql.canyoudrinktapwaterin.com');

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
define('AUTH_KEY',         'TQT$x_OM@&KU`roJt~TJE1zTD2joC*ytCNrIQbY^48VdX$iq0mxQfRz~_2f$Vk`p');
define('SECURE_AUTH_KEY',  'Ei^2G/fCj&eyp0*Er9ht9(kIKTc6RZDmYDKG$nh`QXj@/#YM@RKmqJ7Fs`Meoehf');
define('LOGGED_IN_KEY',    '4HwA^6XxW7EEp&U3m+dhTY(CMbq7_uesq"lJOO8EK3/Mgn$oqP/aa?|Ru!pe2n32');
define('NONCE_KEY',        '`ESaj7"9RP%Uwa4hXVL_ozJZs%iVwxy;SFqY^2u9C*Tug01Xgk#L2)5aCJ/BEIWB');
define('AUTH_SALT',        'WFZY9p%q25LvY`/ELgnpTV?mdZvnwN#dHekVBt/3gTjZ%0?DGlsYP~2`TvK4pCmv');
define('SECURE_AUTH_SALT', 'l?BThZ%bk~~7/`Fcu+HfqV%W)aNYDsoZ^jN2$!C~JOcEZyjXhzz%_r@qAteWE~&h');
define('LOGGED_IN_SALT',   'tCD`9!*9mA4W|Ymp"|g#yQYk1JF?Y|eC3!%F"@m(BxtS!kB6S2Tfay6m/W75$+M6');
define('NONCE_SALT',       'YYLKUDDh;H/%3)cw`r#08l#B;ys_TJ?&*j#/7%NlGl+29N!QdC13MI+HG(is*mXS');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_i8ksm2_';

/**
 * Limits total Post Revisions saved per Post/Page.
 * Change or comment this line out if you would like to increase or remove the limit.
 */
define('WP_POST_REVISIONS',  10);

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

/**
 * Removing this could cause issues with your experience in the DreamHost panel
 */

if (preg_match("/^(.*)\.dream\.website$/", $_SERVER['HTTP_HOST'])) {
        $proto = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http";
        define('WP_SITEURL', $proto . '://' . $_SERVER['HTTP_HOST']);
        define('WP_HOME',    $proto . '://' . $_SERVER['HTTP_HOST']);
}

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');





