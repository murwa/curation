<!--Created by PhpStorm.-->
<!--User: peter.wanjala-->
<!--Date: 3/30/2015-->
<!--Time: 3:08 PM-->


<!DOCTYPE html>
<!--[if gt IE 8]><!-->
<html class="no-js hgt100p"> <!--<![endif]-->
<head lang="en">
    @section('meta')
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="_token" content="{{ csrf_token() }}"/>
    @stop
    @yield('meta', '<meta charset="UTF-8">')
    <title>@yield('title', 'Welcome to Gigavia')</title>
    <link rel="stylesheet" type="text/css"
          href="{{ config('globals.cdn') }}componets/data_tables/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="{{ config('globals.cdn') }}componets/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css"
          href="{{ config('globals.cdn') }}componets/bootstrap/css/bootstrap-theme.css">
    <link rel="stylesheet" type="text/css" href="{{ config('globals.cdn') }}componets/fontawesome/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="{{ config('globals.cdn') }}componets/datepicker/css/datepicker.css">
    <link rel="stylesheet" type="text/css"
          href="{{ config('globals.cdn') }}componets/fullcalendar/dist/fullcalendar.min.css">
    <link rel="stylesheet" type="text/css" href="{{ config('globals.cdn') }}componets/jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" type="text/css"
          href="{{ config('globals.cdn') }}componets/time/jquery-ui-timepicker-addon.min.css">
    <link rel="stylesheet" type="text/css"
          href="{{ config('globals.cdn') }}componets/richeditor/bootstrap-wysihtml5.css"/>
    <link rel="stylesheet" type="text/css"
          href="{{ config('globals.cdn') }}componets/custom-scrollbar/jquery.mCustomScrollbar.css"/>
    <link rel="stylesheet" type="text/css" href="{{ config('globals.cdn') }}css/styles.css">
    <link rel="stylesheet" type="text/css" href="{{ config('globals.cdn') }}css/screen.css">

    <style>
        .ui-front {
            z-index: 2000;
        }
    </style>

</head>

<body class="hgt100p bgee">
<!--[if lt IE 11]>
<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
    your browser</a> to improve your experience.</p>
<![endif]-->
<div class="width-f pl">
    @include('layouts.curation.header')
    @yield('body')
</div>

<script type="text/javascript" src="{{ config('globals.cdn') }}js/jquery.js"></script>
<script type="text/javascript" src="{{ config('globals.cdn') }}componets/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="{{ config('globals.cdn') }}componets/bootstrap/js/bootstrap.js"></script>
<script type="text/javascript"
        src="{{ config('globals.cdn') }}componets/data_tables/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="{{ config('globals.cdn') }}componets/moment/min/moment.min.js"></script>
<script type="text/javascript" src="{{ config('globals.cdn') }}componets/livestamp/livestamp.min.js"></script>
<script type="text/javascript"
        src="{{ config('globals.cdn') }}componets/fullcalendar/dist/fullcalendar.min.js"></script>
<script type="text/javascript" src="{{ config('globals.cdn') }}componets/jquery-form/jquery-form.min.js"></script>
<script type="text/javascript"
        src="{{ config('globals.cdn') }}componets/jquery-ui/time/jquery-ui-timepicker-addon.min.js"></script>
<script type="text/javascript"
        src="{{ config('globals.cdn') }}componets/jquery-ui/time/jquery-ui-timepicker-addon-i18n.min.js"></script>
<script type="text/javascript"
        src="{{ config('globals.cdn') }}componets/jquery-ui/time/jquery-ui-sliderAccess.js"></script>
{{--<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jstimezonedetect/1.0.4/jstz.min.js"></script>--}}
<script type="text/javascript" src="{{ config('globals.cdn') }}componets/richeditor/wysihtml5-0.3.0.min.js"></script>
<script type="text/javascript" src="{{ config('globals.cdn') }}componets/richeditor/bootstrap-wysihtml5.js"></script>
<script type="text/javascript"
        src="{{ config('globals.cdn') }}componets/custom-scrollbar/js/minified/jquery.mCustomScrollbar.min.js"></script>
{{--<script type="text/javascript" src="{{ config('globals.cdn') }}js/position-sticky.js"></script>--}}
<script type="text/javascript" src="{{ config('globals.cdn') }}js/global.js"></script>

<script type="text/javascript">
    document.cdn = '{{ config('globals.img') }}';
</script>
</body>
</html>