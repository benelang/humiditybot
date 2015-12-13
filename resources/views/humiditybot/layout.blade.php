<!DOCTYPE html>
<html>
    <head>
        <title>Humiditybot - obacht, der Schimmel!</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="https://fonts.googleapis.com/css?family=Lato:100,300,500,700" rel="stylesheet" type="text/css">
        {!! HTML::style('css/bootstrap.min.css') !!}
        {!! HTML::style('css/style.css') !!}
    </head>
    <body>

      <header class="document__header col-md-12">
          <div class="row">
            <nav class="document__header__navigation">
              <ul class="document__header__navigationlist nav nav-tabs">
                <li class="document__header__navigationlistitem" role="presentation">
                  <a class="document__header__navigationlink">Home</a>
                </li>
              </ul>
            </nav>
          </div>
      </header>


      <main class="document__main">
        <div class="row">
          <div class="col-md-12">
            @yield('document__main')
          </div>
        </div>
      </main>
    </body>
</html>
