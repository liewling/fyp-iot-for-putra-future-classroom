<!Doctype html>
<html>

<head>
  @include('includes.head')
</head>

<body>
  @include('includes.header')
  @include('includes.sidebar')


  <div class="content-container">

    <div class="container-fluid" id="content">
      {{-- <div id="pageTitle">
        <div class="breadcrumb">
          <div class="item"><a href="/">Home / </a></div>
        </div>
      </div> --}}
      @yield('content')

    </div>
  </div>

</body>

<script>
  $(function(){
  var current_page_URL = location.href;
  $( "a" ).each(function() {
     if ($(this).attr("href") !== "#") {
       var target_URL = $(this).prop("href");
       if (target_URL == current_page_URL) {
          $('sidebar-navigation a').parents('li, ul').removeClass('active');
          $(this).parent('li').addClass('active');
          return false;
       }
     }
  });
});


</script>


</html>