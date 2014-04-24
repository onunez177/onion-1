<header class="title clearfix">
    <p class="fleft"></p>
    <a href="{$smarty.const.WEBROOT}/product/list" class="arrow more fright">List of all products</a> </header>

    <h1 style="text-transform: uppercase;">{$lang['newproduct']}</h1>

<form method="POST" action="{$smarty.const.WEBROOT}/?action=productAdd" enctype="multipart/form-data" id="addProduct">
	<table>
		<tr><th>{$lang['type']}</th><td>
		  <select name="typeId" onchange="updateSubTypes(this)" id="types">
		      {foreach from=$types item=type}
		      <option value="{$type->getId()}">{$lang[$type->getName()]}</option>
		      {/foreach}
	      </select>
		</td></tr>
		<tr><th>{$lang['subtype']}</th><td>
		  <select name="subTypeId" id="subtypes">
    		  {foreach from=$typeSubtypes item=subtype}
		      <option value="{$subtype->getId()}">{$lang[$subtype->getName()]}</option>
		      {/foreach}
		  </select>
		</td></tr>
		<tr><th>{$lang['manufactor']}</th><td><input name="manufactor" type="text"/></td></tr>
		<tr><th>{$lang['name']}</th><td><input name="name" type="text"/></td></tr>
		<tr><th>{$lang['year']}</th><td><input name="year" type="text"/></td></tr>
		<tr><th>{$lang['alc']}</th><td><input name="alc" type="text"/></td></tr>
		<tr><th>{$lang['origin']}</th><td><input name="origin" type="text"/></td></tr>
		<tr><th>{$lang['picture']}</th><td><input type="file" accept="image/png" id="picture" name="picture"/></td></tr>
		<tr><td colspan="2"><a href="{$smarty.const.WEBROOT}/product/add" class="button">{$lang['cancel']}</a>
		<a href="#" onclick="$('#addProduct').submit()" class="button">{$lang['save']}</a></td></tr>
	</table>

</form>
<p class="border-1">&nbsp;</p>
{include file='ProductList.tpl'}