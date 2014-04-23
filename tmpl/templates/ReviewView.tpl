<h1 class="h-text-1" style="text-transform: uppercase;">{$lang['reviews']}</h1>
<h2 class="h-text-2"><a href="{$smarty.const.WEBROOT}/product/details/{$form.productId}">{$form.product}</a> - {$form.user}</h2> 
<div id="rating"></div>
<p class="border-1">&nbsp;</p>
<table style="width:100%">
	<tr>
	   <th width="30%">{$lang['color']}</th>
	   <th width="30%">{$lang['smell']}</th>
	   <th width="30%">{$lang['taste']}</th>
    </tr>
	<tr>
	   <td>{$form.color}</td>
	   <td>{$form.smell}</td>
	   <td>{$form.taste}</td>
    </tr>
</table>
<p class="border-1">&nbsp;</p>
<h3 class="h-text-2">{$lang['description']}</h3>
<p class="text-1">
    {$form.description}
</p>
<script type="text/javascript">
var webroot = '{$smarty.const.WEBROOT}/lib/design/images/';
var score = '{$form.rating}';
{literal}
    $('#rating').raty({
      starOff : webroot + 'star-off.png',
      starOn  : webroot + 'star-on.png',
      number : 10,
      readOnly: true, 
      score: score
    });
{/literal}
</script>