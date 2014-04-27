<!DOCTYPE html>
<html lang="en">
<head>
{assign var=key value='drinkType'|cat:$smarty.session.type}
<title>{$lang[$key]}{$lang['planet']}</title>
<meta charset="UTF-8">
<link rel="stylesheet" href="{$smarty.const.WEBROOT}/lib/design/css/style.css">
<!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
  <link href="{$smarty.const.WEBROOT}/lib/design/css/style.css" rel="stylesheet" type="text/css">
  <link href="{$smarty.const.WEBROOT}/lib/design/css/jquery.dataTables.css" rel="stylesheet" type="text/css">
  <link href="{$smarty.const.WEBROOT}/lib/design/css/jquery-ui-1.10.4.custom.css" rel="stylesheet" type="text/css">
  {if $smarty.session.type eq 1}
	<link rel="stylesheet" href="{$smarty.const.WEBROOT}/lib/design/css/beer.css">
  {else}
	<link rel="stylesheet" href="{$smarty.const.WEBROOT}/lib/design/css/wine.css">
  {/if}
  <script type="text/javascript">
    //make full server path available to javascript functions
    var prefix = '{$smarty.const.WEBROOT}';
  </script>
  
  <script src="{$smarty.const.WEBROOT}/lib/design/js/jquery-1.11.0.min.js"></script>
  <script src="{$smarty.const.WEBROOT}/lib/design/js/jquery-ui-1.10.4.custom.min.js"></script>
  <script src="{$smarty.const.WEBROOT}/lib/design/js/jquery.dataTables-1.9.4.js"></script>
  <script src="{$smarty.const.WEBROOT}/lib/design/js/yoxview-init.js"></script>
  <script src="{$smarty.const.WEBROOT}/lib/design/js/js.js"></script>
  <script src="{$smarty.const.WEBROOT}/lib/design/js/jquery.raty-2.5.2.min.js"></script>
  <!-- Country selector from https://github.com/JamieAppleseed/selectToAutocomplete -->
  <script src="{$smarty.const.WEBROOT}/lib/design/js/jquery.browser.js"></script>
  <script src="{$smarty.const.WEBROOT}/lib/design/js/jquery.select-to-autocomplete.js"></script>
</head>

<body>
<header class="center clearfix" id=""><a href="{$smarty.const.WEBROOT}/?action=setType&type=1"><img src="{$smarty.const.WEBROOT}/lib/design/images/logo.jpg" alt="{$lang['drinkType1']}{$lang['planet']}" /></a><a href="{$smarty.const.WEBROOT}/?action=setType&type=2"><img src="{$smarty.const.WEBROOT}/lib/design/images/logo2.jpg" alt="{$lang['drinkType2']}{$lang['planet']}" /></a>
  <nav class="fright">
    <ul>
      <li><a href="{$smarty.const.WEBROOT}/?action=setType&type={$smarty.session.type}" {if $smarty.get.object eq ''}class="navactive"{/if}>{$lang['home']}</a></li>
      <li><a href="{$smarty.const.WEBROOT}/review/list/" {if $smarty.get.object eq 'review' && $smarty.get.method eq 'list'}class="navactive"{/if}>{$lang['reviews']}</a></li>
    </ul>
    <ul>
      <li><a href="{$smarty.const.WEBROOT}/product/fresh/" {if $smarty.get.object eq 'product' && $smarty.get.method eq 'fresh'}class="navactive"{/if}>{$lang['products']}</a></li>
      <li><a href="{$smarty.const.WEBROOT}/review/add/" {if $smarty.get.object eq 'review' && $smarty.get.method eq 'add'}class="navactive"{/if}>{$lang['newreview']}</a></li>
    </ul>
    <ul>
      <li><a href="{$smarty.const.WEBROOT}/product/add/" {if $smarty.get.object eq 'product' && $smarty.get.method eq 'add'}class="navactive"{/if}>{$lang['newproduct']}</a></li>
      <!-- <li><a href="links.html" {if $smarty.get.object eq 'links'}class="navactive"{/if}>{$lang['links']}</a></li> -->
    </ul>
  </nav>
</header>
<div class="main center">
  <section class="part clearfix">
	  <!-- This loop shows all messages that were set in view class. If this part is
	omitted, no messages are shown whether or not they are set -->
	{if $messages} 
	    <div id="message" onClick="$(this).hide('slow')">
	        {foreach from=$messages item=msg}
	            <div class="{$msg->getType()}">{$msg->getMessage()}</div>
	        {/foreach}
	    </div>
	{/if}
    {$content}
  </section>
</div>
<footer class="center part clearfix">
  <article class="column3 mright ">
      <h5>{$lang['aboutus']}</h5>
      <div class="sepmini"></div>
      {$lang['aboutusDetails']}
    </article>
    <article class="column3 mright ">
      <h5>{$lang['help']}</h5>
      <div class="sepmini"></div>
      {$lang['helpDetails']}
    </article>
    <article class="column3 ">
      <h5>{$lang['contactInfo']}</h5>
      <div class="sepmini"></div>
      <p>{$lang['contactDetails']}</p>
    </article>
</footer>
<!--[if (gte IE 6)&(lte IE 8)]>
<script src="js/selectivizr.js"></script>
<![endif]-->
<div align=center>{$lang['downloadDisclaimer']} <a href='http://all-free-download.com/free-website-templates/'>free website templates</a></div></body>
</html>
