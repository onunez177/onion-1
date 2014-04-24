<header class="title clearfix">
	<p class="fleft">{$lang['reviews']}</p>
    <a href="{$smarty.const.WEBROOT}/review/list" class="arrow more fright">List of all reviews</a>
</header>
<div id="rating"></div>
<h1 style="text-transform: uppercase;">{$form.product}</h1>

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
<h5>{$lang['description']}</h3>
<p>
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