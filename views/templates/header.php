<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?=doctype('html5')?>
<html lang='en'>
	<head>
		<title><?php echo isset($title) ? $title : 'DoodleLike';?></title>
		<meta charset='UTF-8'>
		<meta name='viewport' content='width=device-width, initial-scale=1'>
		<?=link_tag('assets/images/logo.png', 'icon', 'image/png');?>
		<?=link_tag('assets/css/iut_tacit.css', 'stylesheet', 'text/css');?>
	</head>
	
	<body>
		<div align='center'>