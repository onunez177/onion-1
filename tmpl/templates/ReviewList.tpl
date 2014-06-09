<header class="title clearfix">
    <p class="fleft"></p>
    <a href="{$smarty.const.WEBROOT}/review/add/" class="arrow more fright">{$lang['newreview']}</a>
</header>

<h1 style="text-transform: uppercase;">{$lang['topFresh']}</h1>

{foreach from=$fresh item=entity}
{assign var=productId value=$entity->getProductId()}
<figure class="work" style="margin-right:20px">
    <div>   
        <a href="{$smarty.const.WEBROOT}/review/details/{$entity->getId()}">
            <img src="{$smarty.const.WEBROOT}/uploads/thumb/{$images[$entity->getProductId()]}" width="75px" height="150px" alt="{$products[$productId]}" title="{$products[$productId]}" />
        </a>
    </div>
    <figcaption> 
        <a href="{$smarty.const.WEBROOT}/review/details/{$entity->getId()}" class="arrow">{$products[$productId]}</a>
        <div id="rating_{$entity->getId()}"></div>
    </figcaption>
</figure>
<script type="text/javascript">
var webroot = '{$smarty.const.WEBROOT}/lib/design/images/';
var score = '{$entity->getRating()}';
var id = '{$entity->getId()}';
{literal}
    $('#rating_' + id).raty({
      starOff : webroot + 'star-off.png',
      starOn  : webroot + 'star-on.png',
      number : 10,
      readOnly: true, 
      score: score
    });
{/literal}
</script>
{/foreach}
</section>
<section class="part clearfix">
<header class="title clearfix">
    <p class="fleft"></p>
    <a href="#" class="arrow more fright"></a> 
</header>

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