<header class="title clearfix">
    <p class="fleft"></p>
    <a href="{$smarty.const.WEBROOT}/review/list" class="arrow more fright">List of all reviews</a> </header>

    <h1 style="text-transform: uppercase;">{$lang['newreview']}</h1>

<form method="POST" action="{$smarty.const.WEBROOT}/?action=reviewAdd" id="addReview">
	<table width="90%">
		<tr><th width="100px">{$lang['product']}</th><td>
		  <select name="productId">
		      {foreach from=$products item=product}
		      <option value="{$product->getId()}">{$product->getName()}</option>
		      {/foreach}
	      </select> <a href="{$smarty.const.WEBROOT}/product/add/" class="button">{$lang['notInList']}</a>
		</td></tr>
		<tr><th>{$lang['user']}</th><td><input type="text" name="user"/></td></tr>
		<tr><th>{$lang['color']}</th><td><textarea name="color" cols="50"></textarea></td></tr>
		<tr><th>{$lang['smell']}</th><td><textarea name="smell" cols="50"></textarea></td></tr>
		<tr><th>{$lang['taste']}</th><td><textarea name="taste" cols="50"></textarea></td></tr>
		<tr><th>{$lang['description']}</th><td><textarea name="description" cols="50"></textarea></td></tr>
		<tr><th>{$lang['rating']}</th><td><div id="rating"></div></td></tr>
		<tr><td colspan="2"><a href="{$smarty.const.WEBROOT}/product/add" class="button">{$lang['cancel']}</a>
		<a href="#" onclick="$('#addReview').submit()" class="button">{$lang['save']}</a></td></tr>
	</table>
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