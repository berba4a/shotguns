<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<script>
		var WWW = '{$smarty.const.WWW}';
		var DOMAIN = '{$smarty.const.DOMAIN}';
	</script>
	<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
	<title>Hunt Site</title>
	<link href="{$smarty.const.WWW}templates/css/main.css" rel="stylesheet" type="text/css" media="all" />
	<script type="text/javascript" src="{$smarty.const.WWW}templates/javascript/jquery-1.4.4.min.js"></script>
	<script type="text/javascript" src="{$smarty.const.WWW}templates/javascript/main.js"></script>
	<link rel="stylesheet" href="{$smarty.const.WWW}templates/css/lightbox.css" type="text/css" media="screen" />
</head>
<body>
<div class="mainHead">
	<div class="logo"><img src="{$smarty.const.WWW}templates/images/testLogo.jpg" width="238" height="90"/>
	</div>
	<a href="http://tera-imoti.com" target="_blank"><div class="banner1">
		  <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="728" height="90" align="middle">
			<param name="movie" value="l{$smarty.const.WWW}templates/swf/flashvortex _horiz.swf">
			<param name="quality" value="high">
			<embed src="l{$smarty.const.WWW}templates/swf/flashvortex _horiz.swf" width="728" height="90" align="middle" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash"></embed>
		  </object>
 
  </div> </a>
	<div style="clear:both;margin-top:-10px;margin-bottom:-10px;">&nbsp;</div>
--{$controller}/{$action}--	
	<ul class="mainMenu">
		<a href="{$smarty.const.WWW}{$controller}/index"><li {if ($controller != 'dealers') && ($controller != 'contracts') && (($action == '') || ($action == 'index'))}class="mainMenuSelectedIthem"{/if}>начало</li></a>
		<a href="{$smarty.const.WWW}{$controller}/ur_add"><li {if ($controller != 'dealers') && ($controller != 'contracts') && ($action == 'ur_add')}class="mainMenuSelectedIthem"{/if}>публикуване</li></a>
		<a href="{$smarty.const.WWW}{$controller}/search"><li {if ($controller != 'dealers') && ($controller != 'contracts') && ($action == 'search')}class="mainMenuSelectedIthem"{/if}>подробно търсене</li></a>
		<a href="{$smarty.const.WWW}dealers"><li {if $controller == 'dealers'}class="mainMenuSelectedIthem"{/if}>дилъри</li></a>
		<a href="#"><li {if $controller == 'forum'}class="mainMenuSelectedIthem"{/if}>Форум</li></a>
		<a href="{$smarty.const.WWW}contacts"><li {if $controller == 'contacts' && (action == '' || $action == 'index')}class="mainMenuSelectedIthem"{/if}>контакти</li></a>
		<a href="{$smarty.const.WWW}contacts/suggestion"><li {if (($controller == 'contacts') && ($action == 'suggestion'))}class="mainMenuSelectedIthem"{/if}>предложения</li></a>
	</ul>
	
	<br>
	<div class="ithemsBand">
	<ul>
			<a href="{$smarty.const.WWW}shotgun/{$action}"> <li {if $controller == 'shotgun'}class="mainMenuSelectedIthem"{/if}> Пушки </li></a>
			<a href="{$smarty.const.WWW}pistol/{$action}"> <li {if $controller == 'pistol'}class="mainMenuSelectedIthem"{/if}> Пистолети </li></a>
			<a href="{$smarty.const.WWW}"><li> Патрони </li></a>
			<a href="{$smarty.const.WWW}"><li> Оптики </li></a>
			<a href="{$smarty.const.WWW}"><li> Екипировка </li></a>
			<a href="{$smarty.const.WWW}"><li> Аксесоари </li></a>
			<a href="{$smarty.const.WWW}"><li> Ловни кучета </li></a>

			<a href="#"><li style="-moz-border-radius-topright: 5px;
-webkit-top-right-radius: 5px;
-o-border-top-right-radius: 5px;
-khtml-border-top-right-radius: 5px;
border-top-right-radius: 5px;"> Офроуд автомобили </li></a>
		</ul>
	</div>
	<div style="clear:both;">&nbsp;</div>