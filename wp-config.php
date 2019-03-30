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
define( 'FS_METHOD', 'direct' );
define( 'DB_NAME', 'wordpress' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'Kuroyukihime3009' );

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
define( 'AUTH_KEY',         ':/%}~xMqeP`F%AT[8P4bnp-^aYHDMq`Q.t+TI :T%zTQe9,+SWT:Hd@cQO1G<cIl' );
define( 'SECURE_AUTH_KEY',  '*W} 5)c!c%[~y <US?)><2w*$<d>dA(?7vH$foGzWtV$ncig_p4,rQ?Gv&wqro5w' );
define( 'LOGGED_IN_KEY',    'WY ZhoNou:u,|ET(@)x`~PR;@Z1}Q?e>1@kOqeJ@(cze},o%8(^-r#11<S_s^)YK' );
define( 'NONCE_KEY',        'Kt@.`[kExaR-~en1bWsCK~`W>tpZq3.P}famt) Z[h8;!F)J,rN.[~~/!oel52ZN' );
define( 'AUTH_SALT',        '{n%-v?-BCA>u}+63A(MzfZt6EfPGZ{/DSKj5]<#ge)&kRec3% >GKeif!]P@eM=Y' );
define( 'SECURE_AUTH_SALT', 'yj4g$a9CE.^p/$mQpNwPQ_Ku|MT~}TUNeyjH`,RuqW=&j8. }<hF1WK#%xTpP%XN' );
define( 'LOGGED_IN_SALT',   'B^/>glAX0WqFVr;JwA2GxJl5*=G*wf7rSB:cL)W:K).f]k1Y8v(wRb#6~eJ[^^s9' );
define( 'NONCE_SALT',       '=-fj`S$cF59d70d$XDCT!?&/Y/iuiAh#p$Wia!CxDm:sdSZI2*9D-a)>&8f8v#+i' );

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
