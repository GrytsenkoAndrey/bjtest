<nav aria-label="Page navigation">
  <ul class="pagination">
      {if count($rsPag) > 1}
    {for $i=1 to count($rsPag) step 1}
        <li {$rsPag[$i]['active']} ><a href="{$rsPag[$i]['url']}">{$i}</a></li>
    {/for}
      {/if}
  </ul>
</nav>