<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="{$lang}" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="{$lang}" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="{$lang}" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="{$lang}" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="{$lang}" class="no-js"> <!--<![endif]-->
<head>
	<link rel="stylesheet" type="text/css" href="resource/css/login/main.css?v={$REV}">
	<link rel="shortcut icon" href="./favicon.ico" type="image/x-icon">
	<title>{block name="title"} - 2Moons{/block}</title>

    <base href="{$basePath}">

	<meta name="generator" content="2Moons {$VERSION}">
	<!-- 
		This website is powered by 2Moons {$VERSION}
		2Moons is a free space browsergame initially created by Jan Kröpke and licensed under GNU/GPL.
		2Moons is copyright 2009-2014 of Jan Kröpke. Extensions are copyright of their respective owners.
		Information and contribution at http://2moons.cc/
	-->
	<meta name="keywords" content="Weltraum Browsergame, XNova, 2Moons, Space, Private, Server, Speed">
	<meta name="description" content="2Moons Browsergame powerd by http://2moons.cc/"> <!-- Noob Check :) -->
	<!--[if lt IE 9]>
	<script src="resource/js/base/html5.js"></script>
	<![endif]-->
	<script src="resource/lib/jquery/jquery-1.10.2.min.js?v={$REV}"></script>
	<script src="resource/lib/jquery/jquery-migrate-1.2.1.min.js?v={$REV}"></script>
	<script src="resource/js/base/jquery.cookie.js?v={$REV}"></script>
	<script src="resource/js/login/main.js"></script>
	<script>{if isset($code)}var loginError = {$code|json};{/if}</script>
	{block name="script"}{/block}	
</head>
<body id="{$smarty.get.page|htmlspecialchars|default:'intro'}" class="{$bodyclass}">
	<div id="page">