<header class="title clearfix">
    <p class="fleft"></p>
    <a href="{$smarty.const.WEBROOT}/review/list" class="arrow more fright">{$lang['allReviews']}</a> </header>

    <h1 style="text-transform: uppercase;">{$lang['newreview']}</h1>

<form method="POST" action="{$smarty.const.WEBROOT}/?action=reviewAdd" id="addReview">
	<ul class="contact_ie9">
		{if !isset($product)}
	    <li>
	        <label for="productId">{$lang['product']}</label>
	        <select name="productId" id="productId" class="button" style="width:200px">
			    {foreach from=$products item=product}
			        <option value="{$product->getId()}">{$product->getName()}</option>
			    {/foreach}
		    </select>
	    </li>
	    {else}
	    <li>
	        <label for="product">{$lang['product']}</label>
	        <input type="hidden" name="productId" readonly required class="required" value="{$product->getId()}">
	        <div name="product">{$product->getName()}</div>
	    </li>
	    {/if}
        <li>
            <label for="user">{$lang['user']}</label>
            <input type="text" name="user" required class="required" >
        </li>
        <li>
            <label for="color">{$lang['color']}</label>
            <textarea name="color" cols="40" rows="6" required class="required"></textarea>
        </li>
        <li>
            <label for="smell">{$lang['smell']}</label>
            <textarea name="smell" cols="40" rows="6" required class="required"></textarea>
        </li>
        <li>
            <label for="taste">{$lang['taste']}</label>
            <textarea name="taste" cols="40" rows="6" required class="required"></textarea>
        </li>
        <li>
            <label for="description">{$lang['description']}</label>
            <textarea name="description" cols="40" rows="6" required class="required"></textarea>
        </li>
        <li>
            <label for="rating">{$lang['rating']}</label>
            <div id="rating" name="rating"></div>
        </li>
    </ul>
		<a href="{$smarty.const.WEBROOT}/product/add" class="button">{$lang['cancel']}</a>
		<a href="#" onclick="$('#addReview').submit()" class="button">{$lang['save']}</a>
		
    <script type="text/javascript">
    var webroot = '{$smarty.const.WEBROOT}/lib/design/images/';
    {literal}
        $('#rating').raty({
          starOff : webroot + 'star-off.png',
          starOn  : webroot + 'star-on.png',
          number : 10,
          scoreName: 'rating'
        });
    {/literal}
    </script>
</form>
<p class="border-1">&nbsp;</p>
{include file='ReviewList.tpl'}