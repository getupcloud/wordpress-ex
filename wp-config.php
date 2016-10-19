<?php

/** Enable W3 Total Cache */
define('WP_CACHE', true);

/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', getenv("DATABASE_NAME"));

/** MySQL database username */
define('DB_USER', getenv("DATABASE_USER"));

/** MySQL database password */
define('DB_PASSWORD', getenv("DATABASE_PASSWORD"));

/** MySQL hostname */
define('DATABASE_SERVICE_NAME', strtoupper(preg_replace("/[^a-zA-Z0-9_]/", "_", getenv("DATABASE_SERVICE_NAME"))));
define('DB_HOST', getenv(DATABASE_SERVICE_NAME."_SERVICE_HOST"). ':' . getenv(DATABASE_SERVICE_NAME."_SERVICE_PORT"));

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
// This is where we define the OpenShift specific secure variable functions
require_once(getenv('HOME') . '/wp-includes/openshift.inc');

// Set the default keys to use
$_default_keys = array(
  'AUTH_KEY'          => 'GNUMqyq8Vy*mcwA5e_6^hNI4CrEK~$HU2CzGw65%C(l`;E|Dcu90!/hdVlm4E_bd',
  'SECURE_AUTH_KEY'   => '?EqRtd^`gG`Z|&x[ @ZR0udGQn~/]+%/fjsuPC?Np9B[Td7Cn6x^(b&CQ])--.fN',
  'LOGGED_IN_KEY'     => '-pa|qa7URoK 4mgViU%rNb3dg)4x?eV=yYf?uUhg/u8=B|Aj3wcA=PCW(.QxM#1O',
  'NONCE_KEY'         => '=vU!} E*#wSeq}iJC+N8HY3lXvg+xe.q-Ty|2lWPsETdPI&yGkZ2VXKnN?g)NTF%',
  'AUTH_SALT'         => ']!1Ue@m`%m#XD>o>%V0PNFS=r<fLj-|*+HB@8/Et>jATSL{{;sp,T1KVYQNzxWpr',
  'SECURE_AUTH_SALT'  => '4^|D+|kS!8H@Mf%vG#r)47Q|mA1-AG&:J}EWYIgx]7vu7Fk!+#-oL;=i$2y#]BPS',
  'LOGGED_IN_SALT'    => 'f,n}AR:%.|?{(zhoM9l,y`FP,:/:+dt*qsof(Nt4,Py$qXsSaY=?9b*,_3*C1/#@',
  'NONCE_SALT'        => 'X|1R9MPaCR2n7 +DWl*:UP5OR-1IG|Ws3* zYFm9?Xsbuwf#GfF]^br-t)98@8=8'
);

// This function gets called by openshift_secure and passes an array
function make_secure_key($args) {
  $hash = $args['hash'];
  $key  = $args['variable'];
  $original = $args['original'];

  $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
  $chars .= '!@#$%^&*()';
  $chars .= '-_ []{}<>~`+=,.;:/?|';

  // Convert the hash to an int to seed the RNG
  srand(hexdec(substr($hash,0,8)));
  // Create a random string the same length as the default
  $val = '';
  for($i = 1; $i <= strlen($original); $i++){
    $val .= substr( $chars, rand(0,strlen($chars))-1, 1);
  }
  // Reset the RNG
  srand();
  // Set the value
  return $val;
}

// Generate OpenShift secure keys (or return defaults if not on OpenShift)
$array = openshift_secure($_default_keys,'make_secure_key');

// Loop through returned values and define them
foreach ($array as $key => $value) {
  define($key,$value);
}

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
