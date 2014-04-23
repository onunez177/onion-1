<h1 class="h-text-1" style="text-transform: uppercase;">{$lang['products']}</h1>
<table id="contentTable">
    {if $entities}
        <thead>
            <tr>
                <th>{$lang['name']}</th>
                <th>{$lang['manufactor']}</th>
                <th>{$lang['type']}</th>
                <th>{$lang['subtype']}</th>
                <th>{$lang['alc']}</th>
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