            
            <div class="col-xs-12">
                <form action="/category/addcat/" method="POST" class="uform">
                 <h2>Добавление новой задачи</h2>
                    <div class="form-group">
                        <label for="username">Имя пользователя</label>
                        <input class="form-control input-lg" id="username" name="username" placeholder="Имя пользователя" type="text">
                    </div>
                    <div class="form-group">
                        <label for="useremail">E-mail пользователя</label>
                        <input class="form-control input-lg" id="useremail" name="useremail" placeholder="E-mail пользователя" type="email">
                    </div>
                    <div class="form-group">
                        <label for="content">Задача</label>
                        <textarea class="form-control input-lg" id="content" name="content">Введите задачу</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg btn-block" name="addsubm">Добавить</button>
                </form><!--/end form-->
            </div><!--/.col-xs-12-->