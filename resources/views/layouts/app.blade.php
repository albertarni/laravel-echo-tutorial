<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Styles -->
        <link href="css/app.css" rel="stylesheet">
        <link href="css/bootstrap-notifications.css" rel="stylesheet">
        <link href="css/animate.css" rel="stylesheet">

        <!-- Scripts -->
        <script>
            window.Laravel = <?php
echo json_encode([
    'csrfToken' => csrf_token(),
]);
?>
        </script>
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-default navbar-static-top">
                <div class="container">
                    <div class="navbar-header">

                        <!-- Collapsed Hamburger -->
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                            <span class="sr-only">Toggle Navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                        <!-- Branding Image -->
                        <a class="navbar-brand" href="{{ url('/') }}">
                            {{ config('app.name', 'Laravel') }}
                        </a>
                    </div>

                    <div class="collapse navbar-collapse" id="app-navbar-collapse">
                        <!-- Left Side Of Navbar -->
                        <ul class="nav navbar-nav">
                            &nbsp;
                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="nav navbar-nav navbar-right">
                            <!-- Authentication Links -->
                            @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Login</a></li>
                            <li><a href="{{ url('/register') }}">Register</a></li>
                            @else

                            <li class="dropdown dropdown-notifications">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <transition
                                        enter-active-class="animated tada"
                                        leave-active-class="animated tada">
                                        <i v-show="showNotifiction" class="glyphicon glyphicon-bell notification-icon"><span class="badge">@{{ animatedNumber }}</span></i>
                                    </transition>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-left">
                                    <li class="notification active">
                                        <div class="media">
                                            <div class="media-left media-middle">
                                                <div class="media-object">
                                                    <img class="img-circle" style="width: 32px; height: 32px;" src="">
                                                </div>
                                            </div>
                                            <div class="media-body">
                                                <strong class="notification-title"><a href="#">Nikola Tesla</a> resolved <a href="#">T-14 - Awesome stuff</a></strong>

                                                <p class="notification-desc">Resolution: Fixed, Work log: 4h</p>

                                                <div class="notification-meta">
                                                    <small class="timestamp">27. 10. 2015, 08:00</small>
                                                </div>

                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li> 
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="position:relative; padding-left:50px;">
                                    <img src="/uploads/avatars/{{ Auth::user()->avatar }}" style="width:32px; height:32px; position:absolute; top:10px; left:10px; border-radius:50%">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>


                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ url('/profile') }}"><i class="fa fa-btn fa-user"></i>Profile</a></li>
                                    <li>
                                        <a href="{{ url('/logout') }}"
                                           onclick="event.preventDefault();
                                                   document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </nav>

            @yield('content')
        </div>

        <!-- Scripts -->

        <script src="/js/app.js"></script>
        <script src="/js/bootstrap-notify.js"></script>
        <script src="/js/Tween.js"></script>

        <script type="text/javascript">
                                               var app = new Vue({
                                                   el: '#app',
                                                   data: {
                                                       showNotifiction: true,
                                                       number: 0,
                                                       animatedNumber: 0,

                                                   },
                                                   methods: {
                                                       toggleNotification: function () {
                                                           this.showNotifiction = false;
                                                           setTimeout(function () {
                                                               app.showNotifiction = true;
                                                           }, 500);
                                                       }
                                                   },
                                                   watch: {
                                                       number: function (newValue, oldValue) {
                                                           var vm = this
                                                           function animate(time) {
                                                               requestAnimationFrame(animate)
                                                               TWEEN.update(time)
                                                           }
                                                           new TWEEN.Tween({tweeningNumber: oldValue})
                                                                   .easing(TWEEN.Easing.Quadratic.Out)
                                                                   .to({tweeningNumber: newValue}, 500)
                                                                   .onUpdate(function () {
                                                                       vm.animatedNumber = this.tweeningNumber.toFixed(0)
                                                                   })
                                                                   .start()
                                                           animate()
                                                       }
                                                   },
                                                   mounted: function () {
//                                                       this.$http.get('/').then(resp = > {
//
//                                                       });
                                                   }
                                               });</script>

    </body>
</html>
