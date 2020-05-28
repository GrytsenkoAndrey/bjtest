            
            <div class="col-xs-12">
                <form action="/user/add/" method="POST" class="uform">
                 <h2>Добавление нового пользователя</h2>
                    <input class="form-control input-lg" id="second_name" name="second_name" required placeholder="Фамилия" type="text">
                    <br>
                    <input class="form-control input-lg" id="name" name="name" required placeholder="Имя" type="text">
                    <br>
                    <input class="form-control input-lg" id="login" name="login" required placeholder="Почта" type="email">
                    <br>
                    <div class="alert alert-danger" id="info" hidden="">Пароли отличаются!</div>
                    <input class="form-control input-lg" id="pass" name="pass1" type="password" required placeholder="Пароль" onChange="javascript:comparePass();">
                    <br>
                    <input class="form-control input-lg" id="pass2" name="pass2" type="password" required placeholder="Повторите пароль" onChange="javascript:comparePass();">
                    <br>
                    <button type="submit" class="btn btn-primary btn-lg btn-block" name="addsubm">Добавить</button>
                </form><!--/end form-->
            </div><!--/.col-xs-12-->