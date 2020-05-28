            
            <div class="col-xs-12">
                <form action="/task/edit/" method="POST" class="uform">
                 <h2>Редактироавание задачи</h2>
                    <div class="form-group">
                        <label for="content">Задача</label>
                        <textarea class="form-control input-lg" id="content" name="content">
                            {$rsTask['content']}
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="content">Статус</label>
                        <select name="status">
                            <option value="2" {if $rsTask['status'] == 2}selected{/if}>Не выполнено</option>
                            <option value="1" {if $rsTask['status'] == 1}selected{/if}>Выполнено</option>
                        </select>
                    </div>
                    <input type="number" hidden value="{$rsTask['id']}" name="id">
                    <input type="submit" class="btn btn-primary btn-lg btn-block" value="Edit">
                </form><!--/end form-->
            </div><!--/.col-xs-12-->