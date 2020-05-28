            
            <div class="col-xs-12">
                <form action="/category/editcat/" method="POST" class="uform">
                 <h2>Редактирование раздела</h2>
                    <div class="form-group">
                    <input class="form-control input-lg" id="title" name="title" required placeholder="Название категории" type="text" value="{$rsCat['title']}">
                    </div>
                    <input type="text" id="id" name="id" hidden value="{$rsCat['id']}">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" name="addsubm">Добавить</button>
                </form><!--/end form-->
            </div><!--/.col-xs-12-->