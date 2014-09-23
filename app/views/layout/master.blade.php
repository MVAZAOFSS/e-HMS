<?php NoCache::sendNoCacheHeaders() ; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>e-HMS</title>

 

    {{HTML::style('assets/css/main.css')}}
    {{HTML::style('assets/css/theme.css')}}
    {{HTML::style('assets/css/MoneAdmin.css')}}
    {{HTML::style('assets/plugins/Font-Awesome/css/font-awesome.css')}}

    <!-- Bootstrap core CSS -->
    {{HTML::style('/css/bootstrap.css')}}
    {{HTML::style('/css/bootstrap.css')}}
    {{HTML::style('/css/sb-admin.css')}}
    {{HTML::style('/css/pgis.css')}}
    {{HTML::style('/css/style.css')}}


    
    {{HTML::style('/css/jquery-ui-custom.css')}}
    
    {{HTML::script('/js/jquery-2.0.3.min.js')}}
    
    {{HTML::script('/js/bootstrap.min.js')}}
    
    {{HTML::script('/js/jquery-ui.min.js')}}
    
    {{ HTML::style("DataTables/media/css/jquery.dataTables.css") }}
    {{ HTML::style("DataTables/media/css/jquery.dataTables_themeroller.css") }}
    
    {{ HTML::style("DataTables/TableTools/css/TableTools.css") }}
    {{ HTML::style("DataTables/TableTools/css/TableTools_JUI.css") }}

    {{ HTML::script("DataTables/media/js/jquery.dataTables.js") }}
    {{ HTML::script("DataTables/TableTools/js/TableTools.min.js") }}

   {{ HTML::script("Highcharts/highcharts.js") }}
   {{ HTML::script("Highcharts/modules/exporting.js") }}
   {{-- HTML::script("Highcharts/themes/dark-unica.js") --}}
   {{ HTML::script("graphs/custom_chart.js") }}

   {{-- HTML::script("DataTables/TableTools/js/ZeroClipboard.js") --}}

    <script type="text/javascript">
      $(document).ready(function(){
        $('#popv').popover({});  
      });




    </script>
  </head>

  <body style="background-color: #f5f5f5">

  
    <div class="container">
      @yield('content')
    </div>  
      

<script type="text/javascript">

      var m  = 0;
var mx = 0;
function minSide(){
    $('#min').hide('normal', function(){
        $('#max').show();
    });
    if(m == 0){
        $('#side').animate({
            left: '-=230'
        }, 800, function() {
        // Animation complete.
           $('#page-wrapper').css({
                marginLeft: -370,
                width:   1300
           })
        }); 
    }

}

function maxSide(){

    $('#max').hide('normal', function(){
        $('#min').show();
    });
    $('#page-wrapper').css({
                marginLeft: -180,
                width:   1000
           })
     $('#side').animate({
        left: '+=230'
    }, 800, function() {
    // Animation complete.
          
  });
}

      $(document).ready(function(){
          $('.alert').fadeOut(100000);
      });
    </script>   
  </body>



</html>     
