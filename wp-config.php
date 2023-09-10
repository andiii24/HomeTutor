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
define( 'DB_NAME', 'home_tutor' );

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
define( 'AUTH_KEY',         '=lU@Rlfq?6 ;;0w4DAfnjxgN&leYZ=lG@85-)3$cIgS NOl^!Yb(K1[U~G[Te2:Q' );
define( 'SECURE_AUTH_KEY',  'nn>jis(:|C#KQQd[|]70b;;z0?3nbu9HmanqJM_)))O/V*`p s*n-2AG6dwzDA{-' );
define( 'LOGGED_IN_KEY',    'jhh[YU`2>+7YqrUj?1C;k^3K_B6Po]Nj3B:eQHTM/~@88{TNUfQE?=24#S|$Y$c2' );
define( 'NONCE_KEY',        '0Y.$y8?A!}^hF;$`}rk.b`0c)AE*g>S.hP[aa<+yjq<;d,1NQvdys]E,E43udlwX' );
define( 'AUTH_SALT',        'ks2Ca?w{v3<tiPU.Ql_mNwu?.,sWEP:QUQj3Vu!8o#<4ZpO`xl5<ez<rLf@--kPl' );
define( 'SECURE_AUTH_SALT', '$pwfL2pBr1Dv96uf-?|V#-/;Ww[ma BX8<]2NqjmdA^j>2f&=E_&)8xyu-!;z:uu' );
define( 'LOGGED_IN_SALT',   '<b3f|`|t6Lv)PVl&{13Qek^vtX<A-p$69Lu6NL=,$mZfv))If5|lLqusYD__qtxW' );
define( 'NONCE_SALT',       '3$K|=zX)@j(}vvl*pMG6kO>A<~ZeiU~P2r!}y<]3WD:F<b2C$F;]>?JR^V|!a!P.' );

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



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
