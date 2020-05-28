<nav aria-label="Page navigation">
  <ul class="pagination">
    <li>
      <a href="{$first}" aria-label="Первая">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
    {for $i=1 to count($rsPagination)-1 step 1}
        <li {$rsPagination[$i]['active']} ><a href="{$rsPagination[$i]['link']}">{$rsPagination[$i]['page']}</a></li>
    {/for}
    <li>
      <a href="{$last}" aria-label="Последняя">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>