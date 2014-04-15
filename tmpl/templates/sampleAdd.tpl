<form method="POST" action="{$smarty.const.WEBROOT}/?action=samplePost">
    <input type="hidden" name="id" value="{$form.id}"/>
    <table>
        <tr><th>NAME</th><td><input type="text" name="name" value="{$form.name}"/></td></tr>
        <tr colspan="2"><td><input type="submit" value="submit"/></td></tr>
    </table>
</form>