<header class="title clearfix">
    <p class="fleft"></p>
    <a href="{$smarty.const.WEBROOT}/review/list" class="arrow more fright">{$lang['allReviews']}</a> </header>

    <h1 style="text-transform: uppercase;">{$lang['newreview']}</h1>

<form method="POST" action="{$smarty.const.WEBROOT}/?action=reviewAdd" id="addReview">
	<ul class="contact_ie9">
		{if !isset($product)}
	    <li>
	    	<div class="ui-widget">
		        <label for="productId">{$lang['product']}</label>
		        <select name="productId" id="productId" class="button" style="width:200px">
		        	<option value="">Select one...</option>
				    {foreach from=$products item=product}
				        <option value="{$product->getId()}">{$product->getManufactor()} {$product->getName()}</option>
				    {/foreach}
			    </select>
		    </div>
	    </li>
	    {else}
	    <li>
	        <label for="product">{$lang['product']}</label>
	        <input type="hidden" name="productId" id="product" readonly required class="required" value="{$product->getId()}">
	        <div name="product">{$product->getName()}</div>
	    </li>
	    {/if}
        <li>
            <label for="user">{$lang['user']}</label>
            <input type="text" name="user" id="user" required class="required" >
        </li>
        <li>
            <label for="color" onclick="$('#c_inp').toggle();$('#c_cb_inp').toggle()">{$lang['color']}</label>
            <div id="c_inp">
            <textarea name="color" cols="40" rows="6" id="color" required class="required"></textarea>
            </div>
            <div id="c_cb_inp" style="display:none">
            {foreach from=$appearanceHW item=word}
             <input type="checkbox" name="color_cb[]" value="{$lang[$word]}"><b>{$lang[$word]}</b><br>
            {/foreach}
            </div>
        </li>
        <li>
            <label for="smell" onclick="$('#s_inp').toggle();$('#s_cb_inp').toggle()">{$lang['smell']}</label>
            <div id="s_inp">
            <textarea name="smell" cols="40" rows="6" id="smell" required class="required"></textarea>
            </div>
            <div id="s_cb_inp" style="display:none">
             {foreach from=$aromaHW item=word}
             <input type="checkbox" name="smell_cb[]" value="{$lang[$word]}"><b>{$lang[$word]}</b><br>
            {/foreach}
            </div>
        </li>
        <li>
            <label for="taste" onclick="$('#t_inp').toggle();$('#t_cb_inp').toggle()">{$lang['taste']}</label>
            <div id="t_inp">
            <textarea name="taste" cols="40" rows="6" id="taste" required class="required"></textarea>
            </div>
            <div id="t_cb_inp" style="display:none">
             {foreach from=$tasteHW item=word}
             <input type="checkbox" name="taste_cb[]" value="{$lang[$word]}"><b>{$lang[$word]}</b><br>
            {/foreach}
            </div>
        </li>
        <li>
            <label for="description">{$lang['description']}</label>
            <textarea name="description" cols="40" rows="6" id="description" required class="required"></textarea>
        </li>
        <li>
            <label>{$lang['rating']}</label>
            <div id="rating"></div>
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
          hints: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
          scoreName: 'rating'
        });
    {/literal}
    </script>
</form>
<p class="border-1">&nbsp;</p>
{include file='ReviewList.tpl'}