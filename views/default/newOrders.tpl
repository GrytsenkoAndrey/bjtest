{include file='breadcrumb.tpl'}

          <div class="row">
            <div class="col-xs-2 col-xs-offset-9">
               <a class="btn btn-primary btn-lg pull-right" href="/orders/add/">Новый заказ</a>
            </div>
          </div>

<div class="row">
 <div class="col-xs-12">
                <ul class="page-order__list">
                {if count($rsOrders) > 0}
                {foreach $rsOrders as $item}
                    <li class="order-item page-order__item"> <!-- заказ -->
                        <div class="order-item__wrapper">  <!-- краткий вид -->
                          <div class="order-item__group order-item__group--id">
                            <span class="order-item__title">Номер заказа</span>
                            <span class="order-item__info order-item__info--id">{$item['id']}</span>
                          </div>
                          <div class="order-item__group">
                             <span class="order-item__title">Номер телефона</span>
                             <span class="order-item__info">+{$item['phone']}</span>
                           </div>
                          <div class="order-item__group" id="price">
                            <span class="order-item__title">Сумма заказа</span>
                            {$item['price']} грн.
                          </div>
                          <button class="order-item__toggle"></button>
                        </div> <!--/ конец краткого вида -->

                        <div class="order-item__wrapper"> <!-- полная информация -->
                           <div class="order-item__group order-item__group--margin">
                             <span class="order-item__title">Заказчик</span>
                             <span class="order-item__info">{$item['name']}&nbsp;{$item['second_name']}</span>
                           </div>
                           
                           <div class="order-item__group">
                             <span class="order-item__title">Услуга</span>
                             <span class="order-item__info">{$item['service']}</span>
                           </div>
                           <div class="order-item__group">
                             <span class="order-item__title">Дата выдачи</span>
                             <span class="order-item__info" id="order_to">{$item['order_to']|truncate:16:"":true}</span>
                           </div>
                           {if {$item['furniture']} }
                           <div class="order-item__group">
                               <span class="order-item__title">Фурнитура</span>
                               <span class="order-item__info">{$item['furniture']} - {$item['furprice']} грн.</span>
                           </div>
                           {/if}
                           <div class="order-item__group order-item__group--status">
                             <span class="order-item__title">Статус заказа</span>
                             {if {$item['status']} }
                             <span class="order-item__info order-item__info--yes">Выполнено</span>
                             {else}
                             <span class="order-item__info order-item__info--no">Не выполнено</span>
                             {/if}
                             <button class="order-item__btn" id="b{$item['id']}" onclick="javascript:updateOrder( '{$item['id']}', {$item['status']} );">Изменить</button>     
                           </div>
                           <div class="order-item__group order-item__group--pay">
                             <span class="order-item__title">Оплата</span>
                             {if {$item['payed']} }
                             <span class="order-item__info order-item__info--yes">Оплачен</span>
                             {else}
                             <span class="order-item__info order-item__info--no">Не оплачен</span>
                             <button class="order-item__btnpay" id="bp{$item['id']}" onclick="javascript:updateTill('{$item['order_to']}', '{$item['price']}', {$item['id']} );">Изменить</button>
                             {/if}
                           </div>
                          </div>
                          <div class="order-item__wrapper">
                           <div class="order-item__group">
                             <span class="order-item__title">Оформил</span>
                             <span class="order-item__info">{$item['usecond_name']}&nbsp;{$item['uname']} /{$item['create_at']}/</span>
                           </div>
                          </div>
                          <div class="order-item__wrapper">
                           <div class="order-item__group">
                             <span class="order-item__title">Комментарий к заказу</span>
                             <span class="order-item__info">{$item['comments']}</span>
                           </div>
                          </div><!--/ конец полной информации -->

                    </li> <!--/ конец заказа -->
                    {/foreach}
                    {else}
                    <p>Пока нет ни одного заказа</p>
                    {/if}
                </ul>

            </div><!--/.col-xs-10 col-xs-offset-1-->
    </div> <!--/ end row -->