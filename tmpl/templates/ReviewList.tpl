<h1 class="h-text-1" style="text-transform: uppercase;">{$lang['reviews']}</h1>
<table id="contentTable">
    {if $entities}
        <thead>
            <tr>
                <th>{$lang['product']}</th>
                <th>{$lang['user']}</th>
                <th>{$lang['rating']}</th>
            </tr>
        </thead>
        <tbody>
            {foreach from=$entities item=review}
                <tr>
                {assign var=productId value=$review->getProductId()}
                    <td><a href="{$smarty.const.WEBROOT}/review/details/{$review->getId()}">{$products[$productId]}</a></td>
                    <td>{$review->getUser()}</td>
                    <td>{$review->getRating()}</td>
                </tr>
            {/foreach}
        </tbody>
    {/if}
</table>