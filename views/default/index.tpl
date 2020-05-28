        
        <div class="row">
            <div class="col-xs-12">
            <form class="form-inline">
                <div class="form-group">
                <label for="user">Имя</label>
                <select name="user" class="form-control input-lg" id="user">
                    <option>Сортировать по</option>
                    <option value="ASC">Возрастанию</option>
                    <option value="DESC">Убыванию</option>
                </select>
                </div>
                <div class="form-group">
                <label for="email">Email</label>
                <select name="email" class="form-control input-lg" id="email">
                    <option >Сортировать по</option>
                    <option value="ASC">Возрастанию</option>
                    <option value="DESC">Убыванию</option>
                </select>
                </div>
                    <div class="form-group">
                        <label for="status">Статус</label>
                        <select name="status" class="form-control input-lg" id="status">
                            <option >Сортировать по</option>
                            <option value="ASC">Возрастанию</option>
                            <option value="DESC">Убыванию</option>
                        </select>
                <button type="submit" class="btn btn-primary btn-lg">Применить</button>
                </div>
            </form>
            </div> <!--/ .col-xs-12 -->
        </div> <!--/ end row FORM -->

        <div class="row">
            <div col="col-xs-12" style="padding:10px;">
            <p><a href="/task/add/" class="btn btn-success">Новая задача</a></p>
                </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-lg-12">

                <hr>
                {if count($rsTask) > 0}
                    {foreach $rsTask as $item}
                         <h2>{$item['username']} /E-mail: {$item['useremail']}/
                            <p class='lead'>{if $item['status'] == 1}Выполнено{else}Не выполнено{/if}
                         </h2>
                         <p>{$item['content']}</p>
                        {if isset($activeUser)}
                            <p><a href="/task/edit/id/{$item['id']}" title="Edit" class="btn btn-primary">Edit</a>
                            {if $item['edited'] == 1}
                                <small>| Отредактировано администратором</small>
                            {/if}
                            </p>
                        {/if}
                    {/foreach}
                {else}
                     <p>Пока нет ни одной задачи</p>
                {/if}
            </div> <!-- col-xs-12 col-sm-6 col-lg-4  -->
        </div>