<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>{$lang['title']}</title>
  <meta name="description" content="Description of your site goes here">
  <meta name="keywords" content="keyword1, keyword2, keyword3">
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
<div id="container">
<div id="header">
<h1 id="logo-text">{$lang['title']}</h1>
</div>
<div id="nav">
<ul>
  <li><a href="{$smarty.const.WEBROOT}/">{$lang['home']}</a></li>
  <li><a href="{$smarty.const.WEBROOT}/review/list/">{$lang['reviews']}</a></li>
  <li><a href="{$smarty.const.WEBROOT}/product/list/">{$lang['products']}</a></li>
  <li><a href="{$smarty.const.WEBROOT}/review/add/">{$lang['newreview']}</a></li>
  <li style="border-right: medium none;"><a href="{$smarty.const.WEBROOT}/product/add/">{$lang['newproduct']}</a></li>
</ul>
</div>
<div id="site-content">
<!-- This loop shows all messages that were set in view class. If this part is
omitted, no messages are shown whether or not they are set -->
{if $messages} 
    <div id="message" onClick="$(this).hide('slow')">
        {foreach from=$messages item=msg}
            <div class="{$msg->getType()}">{$msg->getMessage()}</div>
        {/foreach}
    </div>
{/if}
<div id="col-left">
{$content}
</div>
<div id="col-right">
<div style="padding: 30px 10px 10px;">
<h2 class="h-text-2">{$lang['latestReviews']}</h2>
<h3 class="h-text-3">00.00.0000</h3>
<p class="text-2">Lorem Ipsum is simply dummy text of the printing and
typesetting industry. Lorem Ipsum has been .</p>
<h3 class="h-text-3">00.00.0000</h3>
<p class="text-2">Lorem Ipsum is simply dummy text of the printing and
typesetting industry. Lorem Ipsum has been .</p>
<h3 class="h-text-3">00.00.0000</h3>
<p class="text-2">Lorem Ipsum is simply dummy text of the printing and
typesetting industry. Lorem Ipsum has been .</p>
</div>
<div>&nbsp;</div>
<div style="padding: 5px 10px;">
<h2 class="h-text-2">{$lang['contactInfo']}</h2>
</div>
<div
 style="padding: 5px 10px 15px; background: rgb(216, 214, 215) none repeat scroll 0%; -moz-background-clip: initial; -moz-background-origin: initial; -moz-background-inline-policy: initial;">
<p class="text-2">{$lang['contactDetails']}</p>
</div>
</div>
</div>
<div id="footer">
<!--DO NOT Remove The Footer Links-->
<!--Designed by--><a href="http://www.htmltemplates.net">
<img src="images/footnote.gif" class="copyright" alt="html templates"></a>
<p>&copy; Copyright 2014. Designed by <a target="_blank"
 href="http://www.htmltemplates.net">htmltemplates.net</a>
<!--DO NOT Remove The Footer Links-->
</p>
<ul class="footer-nav">
  <li><a href="{$smarty.const.WEBROOT}/main/">{$lang['home']}</a></li>
  <li><a href="{$smarty.const.WEBROOT}/reviews/">{$lang['reviews']}</a></li>
  <li><a href="{$smarty.const.WEBROOT}/products/">{$lang['products']}</a></li>
  <li><a href="{$smarty.const.WEBROOT}/review/add/">{$lang['newreview']}</a></li>
  <li><a href="{$smarty.const.WEBROOT}/product/add/">{$lang['newproduct']}</a></li>
</ul>
</div>
</div>
</body>
</html>
