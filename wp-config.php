<?php
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
define('DB_NAME', 'maslansky');

/** MySQL database username */
define('DB_USER', 'admin');

/** MySQL database password */
define('DB_PASSWORD', 'password');

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
define('AUTH_KEY', '2eccd869e32226b4842e79e9055cb089663f721d9821480a42cf3d507a97d330');
define('SECURE_AUTH_KEY', '0f5d5589de64cb8ed4b32145e2bfd4f1e6ec98642354b9120eee540b282435d7');
define('LOGGED_IN_KEY', 'f2a461681c35f27b1d4cbfb59651632318d793761bec0af9a5c81636cc95e97f');
define('NONCE_KEY', 'f7cf9a3a6641c9d58d5a5be275d51b2de165523be50354556cb73d01c7492416');
define('AUTH_SALT', '18f4c2dfd28e6a8d9c4d21c8c467c35272196e79deeee8ed1c86ac224b58b4e3');
define('SECURE_AUTH_SALT', '1a843b6a3db1238d4ac78d89396a504e58ace95e6c109c1b35588fed386ca76c');
define('LOGGED_IN_SALT', '86ae5da31b942856749ecc749f003c712e9aeaa85796a7f231c2468c7e5deb14');
define('NONCE_SALT', 'a444f1c7645d0a4f79f51a8e2446ed089ddcd0074e3365553220e8a553feed0b');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = '_TAD_';

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


// Settings modified by hosting provider
define( 'WP_CRON_LOCK_TIMEOUT', 120   );
define( 'AUTOSAVE_INTERVAL',    300   );
define( 'WP_POST_REVISIONS',    5     );
define( 'EMPTY_TRASH_DAYS',     7     );
define( 'WP_AUTO_UPDATE_CORE',  true  );
/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
