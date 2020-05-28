<div class="col-xs-12">
    <ol class="breadcrumb">
        {if isset($rsBCrumb['m'])}
        <li><a href="/orders/index/y/{$rsBCrumb['y']}/">2020</a></li>
        <li><a href="/orders/index/y/{$rsBCrumb['y']}/m/{$rsBCrumb['m']}/">{$rsBCrumb['m']}</a></li>
            {if isset($rsBCrumb['w'])}
            <li><a href="/orders/index/y/{$rsBCrumb['y']}/m/{$rsBCrumb['m']}/w/{$rsBCrumb['w']}/">{$rsBCrumb['range']}</a></li>
                {if isset($rsBCrumb['d'])}
                <li class="active">{$rsBCrumb['d']}</li>
                {/if}
            {/if}
        {else}
            <li class="active">{$rsBCrumb['y']}</li>
        {/if}
    </ol>
</div>