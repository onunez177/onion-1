<header class="title clearfix">
    <p class="fleft">{$lang['reviews']}</p>
    <a href="{$smarty.const.WEBROOT}/review/add/" class="arrow more fright">{$lang['newreview']}</a></header>
	
	<h1 style="text-transform: uppercase;">{$lang['reviews']}</h1>
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
	                <tr onclick="document.location.href = '{$smarty.const.WEBROOT}/review/details/{$review->getId()}'">
	                {assign var=productId value=$review->getProductId()}
	                    <td>{$products[$productId]}</td>
	                    <td>{$review->getUser()}</td>
	                    <td>{$review->getRating()}</td>
	                </tr>
	            {/foreach}
	        </tbody>
	    {/if}
	</table>