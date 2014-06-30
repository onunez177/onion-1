<header class="title clearfix">
	<div class="fb-share-button" style="float:left" data-href="{$smarty.const.LIKEURL}/review/details/{$form.id}" data-type="button"></div>
    <a href="{$smarty.const.WEBROOT}/review/list" class="arrow more fright">{$lang['allReviews']}</a>
</header>
<div id="rating"></div>
<h1 style="text-transform: uppercase;">{$form.manufactor} <a href="{$smarty.const.WEBROOT}/product/details/{$form.productId}" style="white-space: nowrap;">{$form.name}</a></h1>

<section class="part clearfix">
<article class="column4in mright services">
	<h5>{$lang['color']}</h5>
	<div class="sepmini"></div>
	<p>{$form.color}</p>
</article>
<article class="column4in mright services">
	<h5>{$lang['smell']}</h5>
	<div class="sepmini"></div>
	<p>{$form.smell}</p>
</article>
<article class="column4in mright services">
	<h5>{$lang['taste']}</h5>
	<div class="sepmini"></div>
	<p>{$form.taste}</p>
</article>
</section>
<div class="yoxview" id="thumbnails" style="float:left;">
    <a href="{$smarty.const.WEBROOT}/uploads/{$encodedName}"><img src="{$smarty.const.WEBROOT}/uploads/thumb/{$encodedName}" width="75px" height="150px" alt="{$form.name}" title="{$form.name}" style="padding-right:10px"/></a>
</div>
<div style="float:left;width: 800px;padding-left: 10px;"><h5>{$lang['description']}</h3>
<p>
    {$form.description}
</p></div>

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