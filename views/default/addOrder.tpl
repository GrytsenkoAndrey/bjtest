            
            <form action="/orders/add/" method="POST">
                 <h2>Новый заказ</h2>
                    <div class="col-xs-12 col-md-4 form-group">
                    <input class="form-control input-lg" id="phone" name="phone" required placeholder="Телефон" type="tel" onchange="javascript:checkClient();">
                    </div>

                    <div class="col-xs-12 col-md-4 form-group">
                    <input class="form-control input-lg" id="client_name" name="client_name" type="text" required placeholder="Имя клиента" value="">
                    </div>

                    <div class="col-xs-12 col-md-4 form-group">
                    <input class="form-control input-lg" id="client_sname" name="client_sname" type="text" required placeholder="Фамилия клиента" value="">
                    </div>
                    
                    <div class="col-xs-12 col-md-4 form-group">
                    <label for="order_to">Дата выдачи</label>
                    <p id='order_to_fault' class="text-danger" hidden>Вы выбрали понедельник!</p>
                    <input class="form-control input-lg" id="order_to" name="order_to" required type="date" onchange="javascript:checkDayWeek();">
                    </div>
                    
                    <div class="col-xs-12 col-md-4 form-group">
                    <label for="time_to">Время выдачи</label>
                    <input class="form-control input-lg" id="time_to" name="time_to" required type="time">
                    </div>
                    
                    <div class="form-group" id="service">
                    <div class="col-xs-8 col-md-9 serviceName">
                    <label for="service1">Услуги</label>
                    <select class="form-control input-lg" name="service1" id="service1" required placeholder="Выберите услугу">
                    <option></option>
                    {foreach $rsList as $item}
                        <optgroup label="{$item['title']}">
                    {if isset($item['child'])}
                        {foreach $item['child'] as $itemChild}
                        <option value="{$itemChild['id']}">{$itemChild['title']}</option>
                        {/foreach}
                    {/if}
                    {/foreach}
                    </select>
                    </div>
                    <div class="col-xs-4 col-md-3 servicePrice">
                    <label for="price1">Цена</label>
                    <input type="text" class="form-control input-lg" id="price1" name="price1" required  placeholder="Цена" onchange="javascript:totalPrice();"> 
                    <hr>
                    <a href="#" title="Удалить" class="btn btn-danger" onclick="javascript:removeService(); return false;">Удалить</a>
                    <a href="#" title="Добавить" class="btn btn-primary" onclick="javascript:addService(); return false;">Добавить</a>
                    </div>

                    </div> <!--/ .form-group #service-->
                    
                    <div class="form-group">
                     <div class="col-xs-8 col-md-9">
                     <label for="furnit">Фурнитура</label>
                     <input type="text" class="form-control input-lg" name="furniture" id="furnit" placeholder="Фурнитура" onchange="javascript:enFurPrice();">
                     </div> <!--/ .col-xs-8 col-md-9 -->
                     <div class="col-xs-4 col-md-3">
                     <label for="furprice">Цена</label>
                     <input disabled="disabled" type="text" class="form-control input-lg" id="furprice" name="furprice" placeholder="Цена"  onchange="javascript:totalPrice();"> 
                     </div> <!--/ .col-xs-4 col-md-3 -->
                     <div class="col-xs-12">
                     <div class="checkbox">
                     <label>
                     <input type="checkbox" id="furpay" name="furpay" disabled>Фурнитура оплачена при заказе
                     </label>
                     </div> <!--/ .checkbox -->
                     </div> <!--/ .col-xs-12 -->
                    </div> <!--/ .form-group -->

                    <div class="form-group">
                    <div class="col-xs-12 col-md-4 form-group">
                    <label for="deposit">Залог</label>
                    <input type="text" class="form-control input-lg" id="deposit" name="deposit" placeholder="Залог" onchange="javascript:totalPrice();">
                    </div> <!--/ .col-xs-12 col-md-4 form-group -->

                    <div class="col-xs-12 col-md-5">
                    <div class="checkbox">
                    <label>
                    <input type="checkbox" id="pay" name="pay" onclick="javascript:disDeposit();">Заказ оплачен при оформлении
                    </label>
                    </div> <!--/ .checkbox -->
                    </div> <!--/ .col-xs-12 col-md-4 form-group -->

                    <div class="col-xs-12 col-md-3 form-group">
                    <label for="deposit">Итого</label>
                    <input class="form-control input-lg" id="price" name="price" required type="text" placeholder="Общая сумма">
                    </div> <!--/ .col-xs-12 col-md-4 form-group -->
                    
                    </div> <!--/ .form-group -->
                  
                    <div class="col-xs-12 form-group">
                    <label for="comments"></label>
                    <textarea class="form-control input-lg" id="comments" name="comments" placeholder="Комментарии"></textarea>
                    </div> <!--/ .col-xs-12 form-group -->

                    <div class="col-xs-12 form-group">
                    <input id="user_id" name="user_id" value="{$user_id}" hidden>
                    <button type="submit" class="btn btn-primary btn-lg btn-block" name="addsubm">Добавить</button>
                    </div> <!--/ .col-xs-12 form-group -->
                </form><!--/end form-->

                <!-- модальное окно для выбора дня выдачи! -->
                <div class="modal fade" id="order_to_modal">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4>Внимание!</h4>
                    </div>
                    <div class="modal-body">
                        <p class="text-danger">Вы выбрали понедельник в качестве дня выдачи заказа! Нельзя выбрать выходной день!</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    </div>
                </div> <!--/ .modal-content -->
                </div> <!--/ .modal-dialog -->
                </div> <!--/ .modal fade -->