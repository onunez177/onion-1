<header class="title clearfix">
    <p class="fleft"></p>
    <a href="{$smarty.const.WEBROOT}/product/fresh" class="arrow more fright">Freshest top 4</a> </header>

    <h1 style="text-transform: uppercase;">{$lang['products']}</h1>
<table id="contentTable">
    {if $entities}
        <thead>
            <tr>
                <th width="20%">{$lang['name']}</th>
                <th width="20%">{$lang['manufactor']}</th>
                <th width="20%">{$lang['type']}</th>
                <th width="20%">{$lang['subtype']}</th>
                <th width="20%">{$lang['alc']}</th>
            </tr>
        </thead>
        <tbody>
            {foreach from=$entities item=product}
                {* get the ID of specific relation as an element *}
                {assign var=typeId value=$product->getTypeId()}
                {assign var=subTypeId value=$product->getSubTypeId()}
                
                {* get the specific element, so translation can be fetched *}
                {assign var=typeName value=$types[$typeId]->getName()}
                {assign var=subTypeName value=$subtypes[$subTypeId]->getName()}
                <tr>
                    <td><a href="{$smarty.const.WEBROOT}/product/details/{$product->getId()}">{$product->getName()}</a></td>
                    <td>{$product->getManufactor()}</td>
                    <td>{$lang[$typeName]}</td>
                    <td>{$lang[$subTypeName]}</td>
                    <td>{$product->getAlc()|string_format:"%.1f"}</td>
                </tr>
            {/foreach}
        </tbody>
    {/if}
</table>
