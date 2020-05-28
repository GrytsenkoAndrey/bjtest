            
            <div class="col-xs-12">
                <form action="/user/edit/" method="POST" class="uform">
                 <h2>Редактировать профиль</h2>
                    <input class="form-control input-lg" id="second_name" name="second_name" required value="{$data['second_name']}" type="text">
                    <br>
                    <input class="form-control input-lg" id="name" name="name" required value="{$data['name']}" type="text">
                    <br>
                    <input class="form-control input-lg" id="login" name="login" value="{$data['login']}" type="email">
                    <br>
                    <div class="alert alert-danger" id="info" hidden="">Пароли отличаются!</div>
                    <input class="form-control input-lg" id="pass" name="pass1" type="password" required placeholder="Пароль" onChange="javascript:comparePass();">
                    <br>
                    <input class="form-control input-lg" id="pass2" name="pass2" type="password" required placeholder="Повторите пароль" onChange="javascript:comparePass();">
                    <br>
                    <input type="text" id="id" name="id" hidden="hidden" value="{$data['id']}">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" name="editsubm">Изменить</button>
                </form><!--/end form-->
            </div><!--/.col-xs-12-->