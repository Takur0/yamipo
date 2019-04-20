<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <title>
            @yield('title')
        </title>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
        <link rel="stylesheet" href="/css/styles.css">
    </head>
    <body>
    <header>
        <a href="/post/index"><img class="header-logo" src="/image/logo.gif"></a>

        @guest
        <a href="/login" class="sign-up">ログイン</a>
        @else
        <a href="/post/new" class="sign-up">ポストする</a>
        <a href="/user/myprofile/edit" class="sign-up"><span>@</span>{{Auth::user()->screen_name}}</a>
        @if(Auth::user()->profile_image_url == null)
        <a href=""><img class="my-image" src="/image/author-img.png"></a>
        @else
        <a href=""><img class="my-image" src="{{Auth::user()->profile_image_url}}"></a>
        @endif
        @endguest
        <a href="/whatisyamipo" class="sign-up">病みポ。is what</a>
    </header>


@yield('content')
            
    </body>
    <script type="text/javascript" src="/js/jquery-3.4.0.min.js"></script>
    <script type="text/javascript" src="/js/jquery.jrumble.1.3.min.js"></script>
    <script type="text/javascript">
    // javascript for changing font-size each letter
        $(".colorful").children().addBack().contents().each(function(){
            if (this.nodeType == 3) {
                var $this = $(this);
                $this.replaceWith($this.text().replace(/(\S)/g, "<span>$&</span>"));
            }
        });
    </script>
    <script type="text/javascript">
    // javascript for rumble effect

        $('.rumble')
        .children()
        .children()
        .jrumble({
            x: 3,
            y: 3,
            rotation: 4,
            speed: 100
        });

        $('.post').children().children().children().trigger('startRumble');

        // $('.post')
        // .hover(function(){
        //     $(this).children().children().children().trigger('startRumble');
        // }, function(){
        //     $(this).children().children().children().trigger('stopRumble');
        // });

    </script>

</html>
