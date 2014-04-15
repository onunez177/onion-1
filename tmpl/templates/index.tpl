<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <!-- To use translations in HTML, referr to them as $lang array. The keys are
  the same as they are in translations file in i18n\ folder -->
  <title>{$lang['title']}</title>
  <meta name="description" content="Description of your site goes here">
  <meta name="keywords" content="keyword1, keyword2, keyword3">
  <!-- Use $smarty.const.WEBROOT to refer to a absolute path when including files
  This variable is set in app\Configs\paths.php -->
  <link href="{$smarty.const.WEBROOT}/lib/design/css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="container">
<div id="header">
<h1 id="logo-text">{$lang['title']}</h1>
</div>
<!-- This loop shows all messages that were set in view class. If this part is
omitted, no messages are shown whether or not they are set -->
{if $messages} 
	<div id="message" onClick="$(this).hide('slow')">
		{foreach from=$messages item=msg}
            <!-- remember to define message type styles in Your css! -->
            <div class="{$msg->getType()}">{$msg->getMessage()}</div>
		{/foreach}
	</div>
{/if}
<!-- HTML part for specific view is injected here -->
{$content}
</div>
</body>
</html>
