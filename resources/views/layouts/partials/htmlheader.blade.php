<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ config('app.name', 'HR101') }}-@yield('subtitle') </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset('css/all.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{asset('css/animations.css')}}">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/toastr.css')}}">
    <link rel="stylesheet" href="{{asset('css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('css/jquery.hortree.css')}}">
    <link rel="stylesheet" href="{{asset('css/jquery-explr-1.4.css')}}">
    <link rel="stylesheet" href="{{asset('css/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/jquery-ui.structure.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/jquery-ui.theme.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/animate.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/materialize.css')}}">
    <link rel="stylesheet" href="{{asset('css/izimodall.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/fullcalendar.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/chosen.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/highcharts.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/maincharts.css')}}">
    <link href='https://fullcalendar.io/releases/fullcalendar/3.9.0/fullcalendar.min.css' rel='stylesheet' />
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
<link href='https://fullcalendar.io/releases/fullcalendar/3.9.0/fullcalendar.print.min.css' rel='stylesheet' media='print' />
{{-- {!! Charts::styles() !!} --}}

    {{--<link rel="stylesheet" href="https://unpkg.com/vue-form-wizard/dist/vue-form-wizard.min.css">--}}

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <![endif]-->


    {{--<script>--}}
        {{--//See https://laracasts.com/discuss/channels/vue/use-trans-in-vuejs--}}
        {{--window.trans = @php--}}
            {{--// copy all translations from /resources/lang/CURRENT_LOCALE/* to global JS variable--}}
            {{--$lang_files = File::files(resource_path() . '/lang/' . App::getLocale());--}}
            {{--$trans = [];--}}
            {{--foreach ($lang_files as $f) {--}}
                {{--$filename = pathinfo($f)['filename'];--}}
                {{--$trans[$filename] = trans($filename);--}}
            {{--}--}}
            {{--$trans['adminlte_lang_message'] = trans('adminlte_lang::message');--}}
        {{--@endphp--}}
    {{--</script>--}}

    <script src="{{asset('js/toastr.min.js')}}"></script>
    {{--<script src="{{asset('js/organization-module/app.js')}}"></script>--}}
    <script src="{{asset('js/jquery.min.js')}}"></script>



</head>