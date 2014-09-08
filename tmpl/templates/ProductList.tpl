<section class="part clearfix">
<header class="title clearfix">
	<p class="fleft"></p>
    <a href="{$smarty.const.WEBROOT}/product/add" class="arrow more fright">{$lang['newproduct']}</a>
</header>

{include file="ProductFresh.tpl"}

<header class="title clearfix">
    <p class="fleft"></p>
    <a href="{$smarty.const.WEBROOT}/product/fresh" class="arrow more fright"></a> 
</header>

<h1 style="text-transform: uppercase;">{$lang['products']}</h1>
<table id="contentTable">
    {if $entities}
        <thead>
            <tr>
                <th class="listCellWidth">{$lang['name']}</th>
                <th class="listCellWidth">{$lang['manufactor']}</th>
                <th class="listCellWidth">{$lang['averageRating']}</th>
                <th class="listCellWidth">{$lang['subtype']}</th>
                <th class="listCellWidth">{$lang['alc']}</th>
            </tr>
        </thead>
        <tbody>
            {foreach from=$entities item=product}
                {* get the ID of specific relation as an element *}
                {assign var=subTypeId value=$product->getSubTypeId()}
                {* get the specific element, so translation can be fetched *}
                {assign var=subTypeName value=$subtypes[$subTypeId]->getName()}
                <tr>
                    <td><a href="{$smarty.const.WEBROOT}/product/details/{$product->getId()}">{$product->getName()}</a></td>
                    <td>{$product->getManufactor()}</td>
                    <td>{$ratings[$product->getId()]}</td>
                    <td>{$lang[$subTypeName]}</td>
                    <td>{$product->getAlc()|string_format:"%.1f"}</td>
                </tr>
            {/foreach}
        </tbody>
    {/if}
</table>
</section>