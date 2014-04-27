<header class="title clearfix">
	<p class="fleft">{$lang['home']}</p>
    <a href="{$smarty.const.WEBROOT}/" class="arrow more fright"></a>
</header>
{assign var=key value='drinkType'|cat:$smarty.session.type}
<h1 style="text-transform: uppercase;">{$lang['welcomeTo']} {$lang[$key]}<span class="markedWord">{$lang['planet']}</h1>

<article id="navwelcome" class="detail">
	<h2>{$lang['aboutSite']}</h2>
	{$lang['introtext']}
</article>