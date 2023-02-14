<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en « wp-config.php » et remplir les
 * valeurs.
 *
 * Ce fichier contient les réglages de configuration suivants :
 *
 * Réglages MySQL
 * Préfixe de table
 * Clés secrètes
 * Langue utilisée
 * ABSPATH
 *
 * @link https://fr.wordpress.org/support/article/editing-wp-config-php/.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define( 'DB_NAME', 'database' );

/** Utilisateur de la base de données MySQL. */
define( 'DB_USER', 'user' );

/** Mot de passe de la base de données MySQL. */
define( 'DB_PASSWORD', 'password' );

/** Adresse de l’hébergement MySQL. */
define( 'DB_HOST', 'database' );

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/**
 * Type de collation de la base de données.
 * N’y touchez que si vous savez ce que vous faites.
 */
define( 'DB_COLLATE', '' );

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clés secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '4] 7VOLpIKD`tRolvxH6GIdnn8b+>4*S>)&xFY,xO.blu6*67ZvA!6>v8VAtf(ZU' );
define( 'SECURE_AUTH_KEY',  'gRv%jb|6 Cq_D6!DwI1YumI,ni~$H&k4J0*?2gcG:M}|zx;mBGT4NLd6$2-p2MO)' );
define( 'LOGGED_IN_KEY',    'io5<A5=h}wPJb!~yvGb&emSM9:[$LIC:Ca3D<KkB Eu!#*7dC@Z!x#[MsWsni!:Q' );
define( 'NONCE_KEY',        ':!4*1vbx8_RINn%x^1m-?8.pA;cB-H*_rujGf7$7P)R,C3c0oPS[]*7PC}H]X8^H' );
define( 'AUTH_SALT',        'i5rXdxjLNm5H8*R5S8. #{seUS,He~77HN$Wbq(dR@_v4n-1xzJ7<=q+Z|d^:#^i' );
define( 'SECURE_AUTH_SALT', '>Ua&;zl^cd4qsnfkGP+4)Lr&&8zCd~SnhTZ.L_8zc?;9on1b(DnzrBk (0v{Lmf5' );
define( 'LOGGED_IN_SALT',   '>cY$1[V>eamch*$I=V=FL1a:Ras80Kf%3Rd73qak?MT0M143dwkh#V1T~D)SpeO-' );
define( 'NONCE_SALT',       'i~O6&.coqv#oGX+}>e6uan=PIv]?po[C6F]4gk$^YeyL/~1bjYY7:Z}/.yCG~AaN' );
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix = 'wp_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortement recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://fr.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* C’est tout, ne touchez pas à ce qui suit ! Bonne publication. */

/** Chemin absolu vers le dossier de WordPress. */
if ( ! defined( 'ABSPATH' ) )
  define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once( ABSPATH . 'wp-settings.php' );
