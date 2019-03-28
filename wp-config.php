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
define( 'DB_NAME', 'crmplugin' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'Vou3h%D4o^@Urk!c7F,u]wOru1k%d5~~*C@Oxuxt4unk%-S])VH]!!-&t9J{j>RA' );
define( 'SECURE_AUTH_KEY',  ']]y+4e^Dpjx4Vv{Aeh(;*+Y(mGd=;O<)^]FD+ydMpr%ynpT?vEpg3G}D$,wXMNl:' );
define( 'LOGGED_IN_KEY',    ':d+!23OP4`vw}jr0Lr#w,MVd$G_s8j_j?rxLV5N{(7!Ty?~j4-LH2ZMxN+~F/f]O' );
define( 'NONCE_KEY',        'rCNYhw4:PrX,RQx&%$l:>s2AB/<Jjh?Tk#dfXhfO}77:RB=|4_aAuJA9`V[oVHmJ' );
define( 'AUTH_SALT',        'EEd>rp=)O+n5S|R1t=exczp%`7H{n@O/l83oGsNs=v~J<_-:bH<,+dW3#->Oj?wx' );
define( 'SECURE_AUTH_SALT', 'Eld/Xr@96#V{]R/85)z>U8`@]e^}fmO,lF,JY|~R<Je2,|;Vl2j{~L-W;FY&]]ag' );
define( 'LOGGED_IN_SALT',   '8)tg<n. VQpw*W.s1/s<dDL=@/&3#QuK@L#0}lqeGP~^NQXO0MS^=,.Ma^`*jKt4' );
define( 'NONCE_SALT',       '@`Vi1;po,D-AtGde6`>3HIZ=wk-WZ9pS&W&JT8QNYBT2}k+)S-!hmi>V]T::pi0x' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
