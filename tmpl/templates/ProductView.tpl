<header class="title clearfix">
	<p class="fleft">{$lang['products']}</p>
    <a href="{$smarty.const.WEBROOT}/product/list" class="arrow more fright">{$lang['allProducts']}</a>
</header>

<h1 style="text-transform: uppercase;">{$form.name}</h1>

<table cellspacing="15">
	<tr><td>
	<div class="yoxview" id="thumbnails">
	    <a href="{$smarty.const.WEBROOT}/uploads/{$encodedName}"><img src="{$smarty.const.WEBROOT}/uploads/thumb/{$encodedName}" width="75px" height="150px" alt="{$form.name}" title="{$form.name}" style="padding-right:10px"/></a>
	</div>
	</td><td>
	<div id="rating"></div>
	<table>
		<tr><th>{$lang['manufactor']}</th><td>{$form.manufactor}</td></tr>
		<tr><th>{$lang['type']}</th><td>{$form.typeId}</td></tr>
		<tr><th>{$lang['subtype']}</th><td>{$form.subTypeId}</td></tr>
		{if $form.year gt 0}
		   <tr><th>{$lang['year']}</th><td>{$form.year}</td></tr>
		{/if}
		{if $form.alc gt 0}
		<tr><th>{$lang['alc']}</th><td>{$form.alc|string_format:"%.1f"} %</td></tr>
		{/if}
		<tr><th>{$lang['origin']}</th><td>{$form.origin}</td></tr>
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
	</td>
	<td><a href="{$smarty.const.WEBROOT}/review/addUnder/{$form.id}" class="button">{$lang['addReview']}</a></td>
	</tr>
</table>
<br><br>
<header class="title clearfix">
	<p class="fleft">{$lang['productReviews']}</p>
    <a href="{$smarty.const.WEBROOT}/review/list" class="arrow more fright">{$lang['allReviews']}</a>
</header>
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
                <tr onclick="document.location.href = '{$smarty.const.WEBROOT}/review/details/{$review->getId()}'">
                    <td width="30%">{$review->getColor()}</td>
                    <td width="30%">{$review->getSmell()}</td>
                    <td width="30%">{$review->getTaste()}</td>
                    <td width="10%">{$review->getRating()}</td>
                </tr>
            {/foreach}
        </tbody>
    </table>
{/if}