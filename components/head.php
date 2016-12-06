<?php
/**
 * Meta output in the document head.
 *
 * @package abraham
 */

$p_color = get_theme_mod( 'primary_color', '' );
$hex = maybe_hash_hex_color( $p_color );
?>

<head <?php hybrid_attr( 'head' ); ?>>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="msapplication-TileColor" content="<?php echo $hex ?>">
<meta name="theme-color" content="<?php echo $hex ?>">

<?php wp_head(); ?>
</head>
