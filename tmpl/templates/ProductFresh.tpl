<section class="part clearfix">
<div class="myH1container">
    <div class="myH1">{$lang['topFresh']}</div>
</div>
<div class="headerButtonContainer">
    <a href="{$smarty.const.WEBROOT}/product/add/" class="button">{$lang['newproduct']}</a>
</div>

{foreach from=$fresh item=entity}
<figure class="work">
    <div>   
        <a href="{$smarty.const.WEBROOT}/product/details/{$entity->getId()}">
            <img src="{$smarty.const.WEBROOT}/uploads/thumb/{$images[$entity->getId()]}" width="75" height="150" alt="{$entity->getName()}" title="{$entity->getName()}" />
        </a>
    </div>
    <figcaption> 
        <a href="{$smarty.const.WEBROOT}/product/details/{$entity->getId()}" class="arrow">{$entity->getName()}</a>
        <p><b>{$lang['manufactor']}</b> {$entity->getManufactor()}</p>
        <p><b>{$lang['alc']}</b> {$entity->getAlc()} %</p>
        <p><b>{$lang['origin']}</b> {$entity->getOrigin()}</p>
    </figcaption>
</figure>
{/foreach}
</section>