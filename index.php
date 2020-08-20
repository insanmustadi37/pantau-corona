<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <title>Pantau Penyebaran Corona Virus (Covid-19)</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  
</head>
  
<body>
  <div class="jumbotron jumbotron-fluid bg-danger text-white">
    <div class="container text-center">
      <h1 class="display-4">Corona Virus</h1>
      <p class="lead">
        <h2>
          Pantau Penyebaran Corona Virus Di dunia
          <br> Secara REAL-TIME
          <br>Mari Bersama Menjaga Kesehatan Dari Corona Virus (Covid-19)
        </h2>
      </p>
    </div>
  </div>

  <style type="text/css">
    .box{
      padding: 30px 40px;
      border-radius: 5px;
    }
  </style>
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <div class="bg-danger box text-white">
         <div class="row">
           <div class="col-md-6">
             <h5>Positif </h5>
             <h2 id="data-kasus">1234</h2>
             <h5>Orang</h5>
           </div>
           <div class="col-md-4">
             <img src="img/sad.svg" style="width: 100px;">
           </div>
         </div>
       </div>
     </div>

     <div class="col-md-4">
      <div class="bg-info box text-white">
       <div class="row">
         <div class="col-md-6">
           <h5>Meninggal </h5>
           <h2 id="data-mati">21</h2>
           <h5>Orang</h5>
         </div>
         <div class="col-md-4">
           <img src="img/cry.svg" style="width: 100px;">
         </div>
       </div>
     </div>
   </div>
   <div class="col-md-4">
    <div class="bg-success box text-white">
     <div class="row">
       <div class="col-md-6">
         <h5>Sembuh </h5>
         <h2 id="data-sembuh">1234</h2>
         <h5>Orang</h5>
       </div>
       <div class="col-md-4">
         <img src="img/happy.svg" style="width: 100px;">
       </div>
     </div>
   </div>
 </div>

 <div class="col-md-12 mt-3">
  <div class="bg-primary box text-white">
   <div class="row">
     <div class="col-md-3">
       <h2>Indonesia</h2>
       <h5 id="data-id">Positif : 12 Orang <br>Meninggal : 20 Orang <br> Sembuh: 120 Orang</h5>
     </div>
     <div class="col-md-4">
       <img src="img/Indonesia.svg" style="width: 150px;">
     </div>
   </div>
 </div>
</div>
</div>
<!-- akhir row -->
<div class="card mt-3">
  <div class="card-header bg-primary text-white">
   <b>Data Kasus Corona Virus Di Indonesia Berdasarkan Provinsi</b>
 </div>
 <div class="card-body">
  <table class="table table-bordered">
    <thead>
      <th>No</th>
      <th>Nama Provisinsi</th>
      <th>Positif</th>
      <th>Meninggal</th>
      <th>Sembuh</th>
    </thead>
    <tbody id="table-data">
      
    </tbody>
  </table>
</div>
</div>

</div>

<!--akhir cotainer-->

<footer class="bg-danger text-center text-white mt-3 bt-2 pb-2">
  Copyright By : Insan Muchtadi Syafiq
</footer>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
</body>
</html>

<script>
  $(document).ready(function(){
    semuaData();
    dataNegara();
    dataprovinsi();
  //refresh otomatis

  setInterval(function(){
    semuaData();
    dataNegara();
    dataprovinsi();
  }, 1000);

  function semuaData(){
    $.ajax({
      url :'https://coronavirus-19-api.herokuapp.com/all',
      success : function(data){
        try{
          var json = data;
          var kasus = data.cases;
          var meninggal = data.deaths;
          var sembuh = data.recovered;

          $('#data-kasus').html(kasus);
          $('#data-mati').html(meninggal);
          $('#data-sembuh').html(sembuh);

        }catch{
          alert('Errorr');
        }
      }
    });
  }

  function dataNegara(){
   $.ajax({
    url :'https://coronavirus-19-api.herokuapp.com/countries',
    success : function(data){
      try{
        var json = data;
        var html = [];

        if (json.length >0){
          var i;
          for(i=0; i < json.length; i++){
            var dataNegara = json[i];
            var namaNegara = dataNegara.country;

            if(namaNegara === 'Indonesia'){
              var kasus = dataNegara.cases;
              var mati = dataNegara.deaths;
              var sembuh = dataNegara.recovered;
              $('#data-id').html(
                'Positif : ' +kasus+'Orang <br> Meninggal : '+mati+'Orang<br>Sembuh: '+sembuh+'orang')
            }
          }
        }

      }catch{
        alert('Errorr');
      }
    }
  }); 
 }

 function dataprovinsi(){
  $.ajax({
    url :'api.php',
    type: 'GET',
    success : function(data){
      try{

        $('#table-data').html(data);

      }catch{
        alert('Errorr');
      }
    }
  }); 
}
});
</script>
