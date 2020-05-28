<?php
/*
* файл РНР но отдается серверу как CSS
* цвета для сайта
*/
header("Content-type: text/css");

$buttonLinkColor = '#14b535';
?>
/*  переменные */
:root {
  --button-link-clr: <?=$buttonLinkColor;?>; 
}
/* изменяем цвет по желанию */
.btn-primary, .list-group-item.active, .list-group-item.active:hover, .list-group-item.active:focus {
  background-color: var(--button-link-clr);
  border-color: var(--button-link-clr);
}
a, h1, h2, h3, h4, h5, h6, .nav-link.active:hover {
  color: var(--button-link-clr);
}
.btn-primary:hover, a.hover{
  background-color: #0b6f1fd6;
}