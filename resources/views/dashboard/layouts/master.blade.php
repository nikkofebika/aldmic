<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ isset($page_title) ? $page_title : 'ALDMIC' }}</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{ asset('backend/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/bower_components/font-awesome/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/bower_components/Ionicons/css/ionicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/dist/css/AdminLTE.min.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/dist/css/skins/_all-skins.min.css') }}">
  @stack('styles')
  <style type="text/css">
    .d-inline {display: inline !important}.d-inline-block {display: inline-block !important}.d-block {display: block !important}
    .text-white {color: #fff !important;}
    .p-1{padding: 0.5rem}.p-2{padding: 0.75rem}.p-3{padding: 1rem}
  </style>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    @include('dashboard.layouts.header')
    @include('dashboard.layouts.sidebar')
    @yield('content')
    <footer class="main-footer">
      <strong>Copyright &copy; <?php echo date('Y') ?> <a href="https://adminlte.io">{{ isset($page_title) ? $page_title : 'ALDMIC' }}</a>.</strong> All rights
      reserved.
    </footer>
  </div>
  <script src="{{ asset('backend/bower_components/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('backend/bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
  <script>
    $.widget.bridge('uibutton', $.ui.button);
  </script>
  <script src="{{ asset('backend/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('backend/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
  <script src="{{ asset('backend/bower_components/fastclick/lib/fastclick.js') }}"></script>
  <script src="{{ asset('backend/dist/js/adminlte.min.js') }}"></script>
  <script type="text/javascript">
    $('form').submit(function(){
      $('#btn_submit').attr('disabled',true).text('Loading...');
    });
  </script>
  @stack('scripts')
</body>
</html>
