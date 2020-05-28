<body>
    <nav class="navbar navbar-fixed-top navbar-inverse">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">МЕНЮ</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/">Иголочка</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <!--<li><a href="/">Главная</a></li>
             <li><a href="/user/" title="Войти">Войти</a></li> -->
            <li><a href="/till/index/" title="Касса">Касса</a></li>
            <li><a href="/salary/edit/" title="Зарплата">Зарплата</a></li>
            <li><a href="/orders/" title="Заказы">Заказы</a></li>
            <li><a href="/clients/index/p/1/" title="Клиенты">Клиенты</a></li>
            <li><a href="/user/show/" title="Пользователи">Пользователи</a></li>
            <li><a href="/category/" title="Услуги">Услуги</a></li>
            <!-- <li><a href="/settings/" title="Настройки">Настройки</a></li> -->
            <li><a href="/setting/" title="Настройки">Настройки</a></li>
            <li><a href="/user/logout/">Выйти</a></li>
          </ul>
        </div><!-- /.nav-collapse -->
      </div><!-- /.container -->
    </nav><!-- /.navbar -->

     <div class="container">

      <div class="row row-offcanvas row-offcanvas-right">
          <div class="col-xs-12 col-sm-9">
              <p class="pull-right visible-xs">
              <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">МЕНЮ</button>
              </p>
              <div class="jumbotron">
                  <img src="/img/logo.jpeg" alt="Иголочка" class="pull-right img-circle">
                  <h1>Иголочка</h1>
                  <p>Текущая неделя <b>{$week}</b></p>
                  <!-- <p>Швейная мастерская</p> -->
                  {include file='activeUser.tpl'}
                  
              </div>
                <div class="row">
                {$infoMsg}