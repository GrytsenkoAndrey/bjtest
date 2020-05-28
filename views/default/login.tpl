<div class="col-xs-12">
{$infoMsg}
    <form action="/user/" method="POST" class="uform"> 
        <select name="id" id="login" class="form-control input-lg">
            <option selected>Выберите пользователя</option>
            {foreach $rsUsers as $item}
            <option value="{$item['id']}">{$item['second_name']}&nbsp;{$item['name']}</option>
            {/foreach}
        </select>
        <br>
        <input class="form-control input-lg" id="pass" name="pass" type="password" placeholder="Пароль">
        <br>
        <button type="submit" class="btn btn-primary btn-lg btn-block" name="subm">Войти</button>
    </form><!--/end form-->
</div><!--/.col-xs-12-->