<!DOCTYPE html>
<html lang="en">
<head>
<title>{$lang['title']}</title>
<meta charset="UTF-8">
<link rel="stylesheet" href="{$smarty.const.WEBROOT}/lib/design/css/style.css">
<!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
  <link href="{$smarty.const.WEBROOT}/lib/design/css/style.css" rel="stylesheet" type="text/css">
  <link href="{$smarty.const.WEBROOT}/lib/design/css/jquery.dataTables.css" rel="stylesheet" type="text/css">
  
  <script type="text/javascript">
    //make full server path available to javascript functions
    var prefix = '{$smarty.const.WEBROOT}';
  </script>
  
  <script src="{$smarty.const.WEBROOT}/lib/design/js/jquery-1.11.0.min.js"></script>
  <script src="{$smarty.const.WEBROOT}/lib/design/js/jquery.dataTables-1.9.4.js"></script>
  <script src="{$smarty.const.WEBROOT}/lib/design/js/yoxview-init.js"></script>
  <script src="{$smarty.const.WEBROOT}/lib/design/js/js.js"></script>
  <script src="{$smarty.const.WEBROOT}/lib/design/js/jquery.raty-2.5.2.min.js"></script>
</head>

<body>
<header class="center clearfix" id=""><img src="{$smarty.const.WEBROOT}/lib/design/images/logo.png" alt="{$lang['title']}" />
  <nav class="fright">
    <ul>
      <li><a href="{$smarty.const.WEBROOT}/" class="navactive">{$lang['home']}</a></li>
      <li><a href="{$smarty.const.WEBROOT}/review/list/">{$lang['reviews']}</a></li>
    </ul>
    <ul>
      <li><a href="{$smarty.const.WEBROOT}/product/fresh/">{$lang['products']}</a></li>
      <li><a href="{$smarty.const.WEBROOT}/review/add/">{$lang['newreview']}</a></li>
    </ul>
    <ul>
      <li><a href="{$smarty.const.WEBROOT}/product/add/">{$lang['newproduct']}</a></li>
      <li><a href="links.html">{$lang['links']}</a></li>
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
      <h5>About</h5>
      <div class="sepmini"></div>
      <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Morbi commodo, ipsum sed pharetra gravida, orci magna rhoncus neque, id pulvinar odio lorem non turpis. Nullam sit amet enim.</p>
    </article>
    <article class="column3 mright ">
      <h5>Help</h5>
      <div class="sepmini"></div>
      <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Morbi commodo, ipsum sed pharetra gravida, orci magna rhoncus neque, id pulvinar odio lorem non turpis. Nullam sit amet enim.</p>
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
<div align=center>This template  downloaded form <a href='http://all-free-download.com/free-website-templates/'>free website templates</a></div></body>
</html>