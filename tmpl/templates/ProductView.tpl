<header class="title clearfix">
	<div class="fb-share-button" style="float:left" data-href="{$smarty.const.LIKEURL}/product/details/{$form.id}" data-type="button"></div>
    <a href="{$smarty.const.WEBROOT}/product/list" class="arrow more fright">{$lang['allProducts']}</a>
</header>

<div class="myH1container">
    <div class="myH1">{$form.name}</div>
</div>
<div style="float:right">
    <a href="{$smarty.const.WEBROOT}/review/addUnder/{$form.id}" class="button">{$lang['addReview']}</a>
</div>

<table class="productDetailsTable">
	<tr><td>
	<div class="yoxview" id="thumbnails">
	    <a href="{$smarty.const.WEBROOT}/uploads/{$encodedName}"><img src="{$smarty.const.WEBROOT}/uploads/thumb/{$encodedName}" width="75" height="150" alt="{$form.name}" title="{$form.name}" style="padding-right:10px"/></a>
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
	<td>
	   <h2>{$lang['stores']}</h2>
	   <input type="text" id="stores" name="stores" />
	</td>
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
                <th class="reviewsCellWidth">{$lang['color']}</th>
                <th class="reviewsCellWidth">{$lang['smell']}</th>
                <th class="reviewsCellWidth">{$lang['taste']}</th>
                <th>{$lang['rating']}</th>
            </tr>
        </thead> 
        <tbody>
            {foreach from=$reviews item=review}
                <tr onclick="document.location.href = '{$smarty.const.WEBROOT}/review/details/{$review->getId()}'">
                    <td>{$review->getColor()}</td>
                    <td>{$review->getSmell()}</td>
                    <td>{$review->getTaste()}</td>
                    <td>{$review->getRating()}</td>
                </tr>
            {/foreach}
        </tbody>
    </table>
{/if}
<script>
    //read stores related with this product
    var prepopulate = eval('{$stores}');
    var productId = '{$form.id}';
</script>
{literal}
<script>
    //tokeninput for store listing
    $("#stores").tokenInput(prefix + '/ajax.php?op=getStores', {
        theme : "facebook",
        zindex : 999999,
        prePopulate : prepopulate,
        allowFreeTagging : true,
        onAdd: function(item) {
            $.ajax({
                type: "POST",
                url: prefix + '/ajax.php?op=addStore',
                data: { name: item.name, product: productId },
                success: function(data) {
                }
            }); 
        },
        onDelete: function(item) {
            $.ajax({
                type: "POST",
                url: prefix + '/ajax.php?op=deleteStore',
                data: { name: item.name, product: productId },
                success: function(data) {
                }
            }); 
        }
    });
</script>
{/literal}