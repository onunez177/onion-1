<!DOCTYPE html>
<html lang="en">
<head>
{assign var=key value='drinkType'|cat:$smarty.session.type}
<title>{$lang[$key]}{$lang['planet']}</title>
<meta charset="UTF-8">
<meta property="og:type" content="{$openGraph->getType()}"/>
<meta property="og:site_name" content="{$openGraph->getSiteName()}"/>
<meta property="fb:admins" content="100000128748523" />
{if $openGraph->getTitle() neq ""}
<meta property="og:title" content="{$openGraph->getTitle()}"/>
{/if}
{if $openGraph->getDescription() neq ""}
<meta property="og:description" content="{$openGraph->getDescription()}"/>
{/if}
{if $openGraph->getUrl() neq ""}
<meta property="og:url" content="{$openGraph->getUrl()}"/>
{/if}
{if $openGraph->getImage() neq ""}
<meta property="og:image:type" content="image/png" />
<meta property="og:image" content="{$openGraph->getImage()}"/>
{/if}

<link rel="stylesheet" href="{$smarty.const.WEBROOT}/lib/design/css/style.css">
<link rel="stylesheet" href="{$smarty.const.WEBROOT}/lib/design/css/token-input-facebook.css">
<!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
  <link href="{$smarty.const.WEBROOT}/lib/design/css/style.css" rel="stylesheet" type="text/css">
  <link href="{$smarty.const.WEBROOT}/lib/design/css/jquery.dataTables.css" rel="stylesheet" type="text/css">
  <link href="{$smarty.const.WEBROOT}/lib/design/css/jquery-ui-1.10.4.custom.css" rel="stylesheet" type="text/css">
  {if $smarty.session.type eq 1}
	<link rel="stylesheet" href="{$smarty.const.WEBROOT}/lib/design/css/beer.css">
  {else}
	<link rel="stylesheet" href="{$smarty.const.WEBROOT}/lib/design/css/wine.css">
  {/if}
  <link rel="stylesheet" href="{$smarty.const.WEBROOT}/lib/design/css/token-input-facebook.css">
  <script type="text/javascript">
    //make full server path available to javascript functions
    var prefix = '{$smarty.const.WEBROOT}';
  </script>
  
  <script src="{$smarty.const.WEBROOT}/lib/design/js/jquery-1.11.1.min.js"></script>
  <script src="{$smarty.const.WEBROOT}/lib/design/js/jquery-ui-1.10.4.custom.min.js"></script>
  <script src="{$smarty.const.WEBROOT}/lib/design/js/jquery.dataTables-1.10.2.min.js"></script>
  <script src="{$smarty.const.WEBROOT}/lib/design/js/yoxview-init.js"></script>
  <script src="{$smarty.const.WEBROOT}/lib/design/js/js.js"></script>
  <script src="{$smarty.const.WEBROOT}/lib/design/js/jquery.raty-2.5.2.min.js"></script>
  <!-- Country selector from https://github.com/JamieAppleseed/selectToAutocomplete -->
  <script src="{$smarty.const.WEBROOT}/lib/design/js/jquery.browser.js"></script>
  <script src="{$smarty.const.WEBROOT}/lib/design/js/jquery.tokeninput.js"></script>
  <script src="{$smarty.const.WEBROOT}/lib/design/js/jquery.select-to-autocomplete.js"></script>
  {include file="GATracker.tpl"}
  
</head>

<body>
  <!-- Include FB, because we all love FB -->
<div id="fb-root"></div>
<script>
    (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/et_EE/all.js#xfbml=1&appId=151992804893154";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
<header class="center clearfix"><a href="{$smarty.const.WEBROOT}/?action=setType&amp;type=1"><img src="{$smarty.const.WEBROOT}/lib/design/images/logo.jpg" alt="{$lang['drinkType1']}{$lang['planet']}" /></a><a href="{$smarty.const.WEBROOT}/?action=setType&amp;type=2"><img src="{$smarty.const.WEBROOT}/lib/design/images/logo2.jpg" alt="{$lang['drinkType2']}{$lang['planet']}" /></a>
  <div style="float:right"><a href="{$smarty.const.WEBROOT}/?L=et">est</a> | <a href="{$smarty.const.WEBROOT}/?L=en">eng</a></div>
  <nav class="fright">
    <ul>
      <li><a href="{$smarty.const.WEBROOT}/?action=setType&amp;type={$smarty.session.type}" {if $smarty.get.object eq ''}class="navactive"{/if}>{$lang['home']}</a></li>
      
    </ul>
    <ul>
      <li><a href="{$smarty.const.WEBROOT}/product/list/" {if $smarty.get.object eq 'product' && $smarty.get.method eq 'list'}class="navactive"{/if}>{$lang['products']}</a></li>
      <li><a href="{$smarty.const.WEBROOT}/product/add/" {if $smarty.get.object eq 'product' && $smarty.get.method eq 'add'}class="navactive"{/if}>{$lang['newproduct']}</a></li>
    </ul>
    <ul>
    <li><a href="{$smarty.const.WEBROOT}/review/list/" {if $smarty.get.object eq 'review' && $smarty.get.method eq 'list'}class="navactive"{/if}>{$lang['reviews']}</a></li>
    <li><a href="{$smarty.const.WEBROOT}/review/add/" {if $smarty.get.object eq 'review' && $smarty.get.method eq 'add'}class="navactive"{/if}>{$lang['newreview']}</a></li>
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
      <h5>{$lang['donate']}</h5>
      <div class="sepmini"></div>
      {$lang['donateDetails']}
      <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top" style="text-align:center">
        <input type="hidden" name="cmd" value="_s-xclick">
        <input type="hidden" name="hosted_button_id" value="5DNVC634SR3NJ">
        <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" name="submit" alt="PayPal - The safer, easier way to pay online!">
        <img alt="" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
      </form>
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
      <div class="fb-like" data-href="{$smarty.const.LIKEURL}" data-width="250" data-layout="standard" data-action="like" data-show-faces="false" data-share="true"></div>
    </article>
</footer>
<!--[if (gte IE 6)&(lte IE 8)]>
<script src="js/selectivizr.js"></script>
<![endif]-->
<div>{$lang['downloadDisclaimer']} <a href='http://all-free-download.com/free-website-templates/'>free website templates</a></div></body>
</html>