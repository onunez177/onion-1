<header class="title clearfix">
	<p class="fleft"></p>
    <a href="{$smarty.const.WEBROOT}/product/add" class="arrow more fright">{$lang['newproduct']}</a>
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
    	<p><b>{$lang['manufactor']}</b> {$entity->getManufactor()}</p>
        <p><b>{$lang['alc']}</b> {$entity->getAlc()} %</p>
        <p><b>{$lang['origin']}</b> {$entity->getOrigin()}</p>
    </figcaption>
</figure>
{/foreach}
</section>
<section class="part clearfix">
<header class="title clearfix">
    <p class="fleft"></p>
    <a href="{$smarty.const.WEBROOT}/product/fresh" class="arrow more fright"></a> 
</header>

<h1 style="text-transform: uppercase;">{$lang['products']}</h1>
<table id="contentTable">
    {if $entities}
        <thead>
            <tr>
                <th width="20%">{$lang['name']}</th>
                <th width="20%">{$lang['manufactor']}</th>
                <th width="20%">{$lang['averageRating']}</th>
                <th width="20%">{$lang['subtype']}</th>
                <th width="20%">{$lang['alc']}</th>
            </tr>
        </thead>
        <tbody>
            {foreach from=$entities item=product}
                {* get the ID of specific relation as an element *}
                {assign var=subTypeId value=$product->getSubTypeId()}
                {* get the specific element, so translation can be fetched *}
                {assign var=subTypeName value=$subtypes[$subTypeId]->getName()}
                <tr onclick="document.location.href = '{$smarty.const.WEBROOT}/product/details/{$product->getId()}'">
                    <td>{$product->getName()}</td>
                    <td>{$product->getManufactor()}</td>
                    <td>{$ratings[$product->getId()]}</td>
                    <td>{$lang[$subTypeName]}</td>
                    <td>{$product->getAlc()|string_format:"%.1f"}</td>
                </tr>
            {/foreach}
        </tbody>
    {/if}
</table>
