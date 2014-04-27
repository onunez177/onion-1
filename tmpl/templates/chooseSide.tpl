<!DOCTYPE html>
<html lang="en">
<head>
<title>{$lang['drinkType1']}{$lang['planet']}</title>
<meta charset="UTF-8">
<link rel="stylesheet" href="{$smarty.const.WEBROOT}/lib/design/css/beer.css">
<link rel="stylesheet" href="{$smarty.const.WEBROOT}/lib/design/css/style.css">
</head>

<body>
<header class="center clearfix" id=""><a href="{$smarty.const.WEBROOT}/?action=setType&type=1"><img src="{$smarty.const.WEBROOT}/lib/design/images/logo.jpg" alt="{$lang['drinkType1']}{$lang['planet']}" /></a><a href="{$smarty.const.WEBROOT}/?action=setType&type=2"><img src="{$smarty.const.WEBROOT}/lib/design/images/logo2.jpg" alt="{$lang['drinkType2']}{$lang['planet']}" /></a>
  <nav class="fright">
     
  </nav>
</header>
<div class="main center">
  <section class="part clearfix">
    <header class="title clearfix">
		<p class="fleft"></p>
	    <a href="{$smarty.const.WEBROOT}/" class="arrow more fright"></a>
	</header>

	<article id="navwelcome" class="detail" style="border: 0px;">
	<h2 style="text-align: center;text-transform: uppercase;">{$lang['choose']}</h2>
		<h1 style="text-align: center;"><a href="{$smarty.const.WEBROOT}/?action=setType&type=1"><span style="color:#555">Beer</span></a> / <a href="{$smarty.const.WEBROOT}/?action=setType&type=2">Wine</a></h1>
	</article>
  </section>
</div>
<footer class="center part clearfix">
</footer>
<!--[if (gte IE 6)&(lte IE 8)]>
<script src="js/selectivizr.js"></script>
<![endif]-->
<div align=center>{$lang['downloadDisclaimer']} <a href='http://all-free-download.com/free-website-templates/'>free website templates</a></div></body>
</html>
