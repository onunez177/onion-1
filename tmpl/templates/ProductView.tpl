<h1 class="h-text-1" style="text-transform: uppercase;">{$lang['products']}</h1>
<h2 class="h-text-2">{$form.manufactor} {$form.name}</h2>
<div id="rating"></div>
<table>
	<tr><th>{$lang['type']}</th><td>{$form.typeId}</td></tr>
	<tr><th>{$lang['subtype']}</th><td>{$form.subTypeId}</td></tr>
	{if $form.year gt 0}
	   <tr><th>{$lang['year']}</th><td>{$form.year}</td></tr>
	{/if}
	<tr><th>{$lang['alc']}</th><td>{$form.alc} %</td></tr>
	<tr><th>{$lang['origin']}</th><td>{$form.origin}</td></tr>
	<tr colspan="2"><td><a href="{$smarty.const.WEBROOT}/review/add">{$lang['addReview']}</a></td></tr>
</table>
<script type="text/javascript">
var webroot = '{$smarty.const.WEBROOT}/lib/design/images/';
var score = '{$average|string_format:"%.1f"}';
{literal}
    $('#rating').raty({
      starOff : webroot + 'star-off.png',
      starOn  : webroot + 'star-on.png',
      starHalf : webroot + 'star-half.png',
      number : 10,
      readOnly: true, 
      score: score
    });
{/literal}
</script>

<p class="border-1">&nbsp;</p>
<h2 class="h-text-2">{$lang['productReviews']}</h2>
{if $reviews}
    <table id="contentTable">
        <thead>
            <tr>
                <th>{$lang['color']}</th>
                <th>{$lang['smell']}</th>
                <th>{$lang['taste']}</th>
                <th>{$lang['rating']}</th>
            </tr>
        </thead> 
        <tbody>
            {foreach from=$reviews item=review}
                <tr>
                    <td width="30%"><a href="{$smarty.const.WEBROOT}/review/details/{$review->getId()}">{$review->getColor()}</a></td>
                    <td width="30%">{$review->getSmell()}</td>
                    <td width="30%">{$review->getTaste()}</td>
                    <td width="10%">{$review->getRating()}</td>
                </tr>
            {/foreach}
        </tbody>
    </table>
{/if}