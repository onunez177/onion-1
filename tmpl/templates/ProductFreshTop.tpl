<header class="title clearfix">
	<p class="fleft"></p>
    <a href="{$smarty.const.WEBROOT}/product/list" class="arrow more fright">List of all products</a>
</header>

<h1 style="text-transform: uppercase;">Freshest top 4</h1>

{foreach from=$fresh item=entity}
<figure class="work"> 	
	<div class="yoxview">
    	<a href="{$smarty.const.WEBROOT}/uploads/{$images[$entity->getId()]}">
      		<img src="{$smarty.const.WEBROOT}/uploads/thumb/{$images[$entity->getId()]}" width="75px" height="150px" alt="{$entity->getName()}" title="{$entity->getName()}" />
      	</a>
	</div>
    <figcaption> 
    	<a href="{$smarty.const.WEBROOT}/product/details/{$entity->getId()}" class="arrow">{$entity->getManufactor()} {$entity->getName()}</a>
        <p>Lorem ipsum dolor set amet Lorem ipsum dolor set amet Lorem ipsum dolor set amet</p>
    </figcaption>
</figure>
{/foreach}