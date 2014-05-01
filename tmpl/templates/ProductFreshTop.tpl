<header class="title clearfix">
	<p class="fleft"></p>
    <a href="{$smarty.const.WEBROOT}/product/list" class="arrow more fright">{$lang['allProducts']}</a>
</header>

<h1 style="text-transform: uppercase;">{$lang['topFresh']}</h1>

{foreach from=$fresh item=entity}
<figure class="work">
	<div> 	
		<a href="{$smarty.const.WEBROOT}/product/details/{$entity->getId()}">
      		<img src="{$smarty.const.WEBROOT}/uploads/thumb/{$images[$entity->getId()]}" width="75px" height="150px" alt="{$entity->getName()}" title="{$entity->getName()}" />
      	</a>
	</div>
    <figcaption> 
    	<a href="{$smarty.const.WEBROOT}/product/details/{$entity->getId()}" class="arrow">{$entity->getName()}</a>
        <p><b>{$lang['alc']}</b> {$entity->getAlc()} %</p>
        <p><b>{$lang['origin']}</b> {$entity->getOrigin()}</p>
    </figcaption>
</figure>
{/foreach}