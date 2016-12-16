<html>
<head>
  <title>
    REST API tutorial
  </title>

  <meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css" />

  <script type="text/javascript" src="js/jQuery_3_1_1.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>


</head>

<script>
$(document).ready(function(){

  $.ajax({
    url: 'https://www.keithandthegirl.com/api/v2/shows/series-overview/',
    type: "POST",
    dataType: 'json',
    success: function(response){
      $.each(response, function(key, value){
        var htmlResponse = "";
        htmlResponse += "<div class='card card-inverse card-danger text-xs-center'><div class='card-block'><img style='width: 100px; height:100px' src='"+value.CoverImageUrl+"' alt='Image not found'><h4 class='card-title'>"+value.Name+"</h4>";
        htmlResponse += "<p class='card-text'>"+value.Description+"</p><a href='#' id='"+value.ShowNameId+"' class='btn btn-success series'>List Shows</a></div>";
        $('#listSeries').append(htmlResponse);
      });

        $("a").click(function(){
          var showID = $(this).attr('id');
          $('#listFiles').empty();
          $.ajax({
            url: 'https://www.keithandthegirl.com/api/v2/shows/list/?shownameid='+showID,
            dataType: 'json',
            type: 'POST',
            success: function(response){
              $.each(response, function(key, value){
                var htmlResponse = "";
                htmlResponse += "<div><span class='h6'>"+value.Title+"</span><img style='float:left;width:50px;height:50px; margin-right:10px;' alt='Image not found' src='"+value.VideoThumbnailUrl+"'/>"
                htmlResponse += "<p>"+value.PostedDate+"</p></div>";
                $('#listFiles').append(htmlResponse);
              });
            }
          });
        });
    },
    error:function(jqXHR, textStatus, errorThrown) {
                console.log(errorThrown);
    }
  });

});
</script>
<body>
<div class="container">
<div class="row">
  <div class="col-md-9">
    <div class="card">

    <div class="card-block">
    <h4 class="card-title">List Of Series from Keith and The Girl Comedy Talk Show</h4>
    <div  class="card-body" id="listSeries">

    </div>

    </div>

    </div>
</div>
<div class="col-md-3">
  <div class="card">

  <div class="card-block">
  <h4 class="card-title">List Of Shows</h4>
  <div  class="card-body" id="listFiles">

  </div>

  </div>

  </div>
  </div>
</div>

</div>

</body>
</html>
