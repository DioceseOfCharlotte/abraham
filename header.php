<?php
/**
 * Main template file.
 *
 * @package abraham
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head <?php hybrid_attr('head'); ?>>
<meta http-equiv="x-ua-compatible" content="ie=edge">
<?php wp_head(); ?>
</head>

<body <?php hybrid_attr('body'); ?>>

<?php
tha_body_top();
