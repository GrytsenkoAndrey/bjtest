          <!-- шаблон для вывода клиентов после фильтра 
          <div class="row">-->
            <div class="col-xs-12">
                <ul class="page-products__list">
                {if count($rsUsers) > 0}
                  {foreach $rsUsers as $item}
                  <li class="product-item page-products__item">
                    <b class="product-item__name">{$item['name']}&nbsp;{$item['second_name']}</b>
                    <span class="product-item__field">{$item['phone']}</span>
                    <span class="product-item__field">{$item['reg_at']}</span>
                    <a href="/clients/edit/id/{$item['id']}" class="product-item__edit" aria-label="Редактировать"></a>
                  </li>

                 {/foreach}

                 {else}
                 <div class="alert alert-warning">В базе нет такого клиента</div>
                 {/if}
                </ul>
            </div><!--/.col-xs-12-->
         <!-- </div>/row-->