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
          <a class="navbar-brand" href="/task/main/">Tasks</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
              <li><a href="/task/main/page/1/" title="Main page">Главная</a></li>
              <li><a href="/task/add/" title="Касса">Новая задача</a></li>
              <li><a href="/user/main/" title="Login">Войти</a></li>
              <li><a href="/user/logout/" title="Logout">Выйти</a></li>
          </ul>
        </div><!-- /.nav-collapse -->
      </div><!-- /.container -->
    </nav><!-- /.navbar -->

     <div class="container">

      <div class="row row-offcanvas row-offcanvas-right">
          <div class="col-xs-12 col-sm-12">
              <p class="pull-right visible-xs">
              <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">МЕНЮ</button>
              </p>
              <div class="jumbotron">
                  <img src="{$templateWebPath}img/logo.png" alt="Иголочка" class="pull-right img-circle">
                  <h1>Tasks</h1>
                  {include file='activeUser.tpl'}
                  
              </div>
          </div>
      </div>
          <div class="row">
          {$infoMsg}
          </div>
