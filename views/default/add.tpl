            
            <div class="col-xs-12">
                <form action="/task/add/" method="POST" class="uform">
                 <h2>Добавление новой задачи</h2>
                    <div class="form-group">
                        <label for="username">Имя пользователя</label>
                        <input class="form-control input-lg" id="username" name="username" placeholder="Имя пользователя" type="text">
                    </div>
                    <div class="form-group">
                        <label for="useremail">E-mail пользователя</label>
                        <input class="form-control input-lg" id="useremail" name="useremail" placeholder="E-mail пользователя" type="text">
                    </div>
                    <div class="form-group">
                        <label for="content">Задача</label>
                        <textarea class="form-control input-lg" id="content" name="content"></textarea>
                    </div>

                    <input type="submit" class="btn btn-primary btn-lg btn-block" value="Add">
                </form><!--/end form-->
            </div><!--/.col-xs-12-->