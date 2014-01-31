{block name="title" prepend}Somethink Cool{/block}
{block name="content"}
<table>
    <tr>
        <th>Blah</th>
    </tr>
    <tr>
        <td class="left">
            <h2>{$LNG.step4_head}</h2>
            <p>{$LNG.step4_desc}</p>
            <form action="install/index.php?page=account&amp;mode=create" method="post">
            <input type="hidden" name="post" value="1">
            <table class="req">
                <tr>
                    <td class="transparent left"><p><label for="username">{$LNG.step4_admin_name}</label></p><p class="desc">{$LNG.step4_admin_name_desc}</p></td>
                    <td class="transparent"><input type="text" id="username" name="username" value="" size="30"></td>
                </tr>
                <tr>
                    <td class="transparent left"><p><label for="password">{$LNG.step4_admin_pass}</label></p><p class="desc">{$LNG.step4_admin_pass_desc}</p></td>
                    <td class="transparent"><input type="password" id="password" name="password" value="" size="30"></td>
                </tr>
                <tr>
                    <td class="transparent left"><p><label for="email">{$LNG.step4_admin_mail}</label></p></td>
                    <td class="transparent"><input type="text" id="email" name="email" value="" size="30"></td>
                </tr>
                <tr class="noborder">
                    <td colspan="2" class="transparent"><input type="submit" name="next" value="{$LNG.continue}"></td>
                </tr>
            </table>
            </form>
        </td>
    </tr>
</table>
{/block}