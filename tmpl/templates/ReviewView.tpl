<header class="title clearfix">
	<div class="fb-share-button" style="float:left" data-href="{$smarty.const.LIKEURL}/review/details/{$form.id}" data-type="button"></div>
    <a href="{$smarty.const.WEBROOT}/review/list" class="arrow more fright">{$lang['allReviews']}</a>
</header>
<div id="rating"></div>

<div class="myH1container">
    <div class="myH1">{$form.manufactor} <a href="{$smarty.const.WEBROOT}/product/details/{$form.productId}" style="white-space: nowrap;">{$form.name}</a></div>
</div>
<div style="float:right">
    <a href="{$smarty.const.WEBROOT}/review/addUnder/{$form.productId}" class="button">{$lang['addReview']}</a>
</div>

<section class="part clearfix" style="clear:both">
<article class="column4in mright services">
	<h5>{$lang['color']}</h5>
	<div class="sepmini"></div>
	<div><p>{$form.color}</p></div>
</article>
<article class="column4in mright services">
	<h5>{$lang['smell']}</h5>
	<div class="sepmini"></div>
	<div><p>{$form.smell}</p></div>
</article>
<article class="column4in mright services">
	<h5>{$lang['taste']}</h5>
	<div class="sepmini"></div>
	<div><p>{$form.taste}</p></div>
</article>
</section>
<section class="part clearfix" style="clear:both">
<div class="yoxview" id="thumbnails" style="float:left;">
    <a href="{$smarty.const.WEBROOT}/uploads/{$encodedName}"><img src="{$smarty.const.WEBROOT}/uploads/thumb/{$encodedName}" width="75" height="150" alt="{$form.name}" title="{$form.name}" style="padding-right:10px"/></a>
</div>
<div class="descriptionSection">
    <h5>{$lang['description']}</h5>
    <div class="sepmini"></div>
    <p>{$form.description}</p>
</div>
</section>

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