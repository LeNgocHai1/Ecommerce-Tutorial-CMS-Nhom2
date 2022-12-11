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
define( 'DB_NAME', 'nhom2' );

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
define( 'AUTH_KEY',         'fw|{101M,nwG4jn4*ZY8:ipE.VuViEmba$%Y^&Od~Fe %AX[ITOjH/D]634lG&sB' );
define( 'SECURE_AUTH_KEY',  '@BtrC%r:*a]O{OUUmc`2M;OL?c>/&@WP/Kq@)[(t&$r*NJJb}A>^1#a?p8jmKl^e' );
define( 'LOGGED_IN_KEY',    'q.MJ{,OYwSRIyr0~beOjRQR#@@Q5CJIa:1I2`Wk?~qZ,51*bUV4IdxFnLOU#q91u' );
define( 'NONCE_KEY',        '$B2]Qp.BWmf/%INbLx=Z,|!2`lW5?L}DCz<[qus U:(S$(@,A,Ff2:,)~M@SC,!(' );
define( 'AUTH_SALT',        'NO7CkOvmnQRR+o)Jrk0T3NVAN9m!++z(TFRpACM8^4N0sxB,}[]<Cy 5Rbqi2RgE' );
define( 'SECURE_AUTH_SALT', 'LzF{z(GyPj3t*+EjgU70@,lY-|tNPzTiuH`>h7a.fGTx#2nv:q9as%$6ZJw?nEX[' );
define( 'LOGGED_IN_SALT',   'UF?SVNDl~Oz6746(|V;X? _W4b!A(Aqa}04f)rI,GcyXwXCTfh[E%2$><otw435V' );
define( 'NONCE_SALT',       's|KXXes0r*1|&}LO;LbU`Q1PDHo27Yd*>+~eN?Mio.Xv|K2T8gR`:RJ[VY*ai~2,' );

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
