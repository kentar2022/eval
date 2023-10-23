<?php

session_start();


if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
  
    header('Location: login.php'); 
    exit();
}

$login = $_SESSION['login'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="avis.js"></script>
  

  
  <style>
  .custom-bg-gray {
    background-color: #434B4D !important;
  }
  .block {
    width: 400px;
    height: 800px;
    margin: 20px;
    padding: 20px;
    background-color: #F8F8FF;
  }
  .btn_submit{
    background-color: #C5001A;
    border: none;
    margin: 20px 0px 40px 0px;
  }
  .glav{
    display: flex;
    justify-content: space-evenly;
  }
  h1{
    color: #C5001A;
    font-size: 28px;
  }
  .comment__block{
  height: 600px;
  /*padding: 50px 0 50px 0;*/
  }
  .comments{
    display:flex;
    flex-wrap: wrap;
    width: 500px;
    justify-content: space-evenly;
    padding-bottom: 100px;
    flex-direction: column;
    padding: 10px;
  }

  .comment{
    border: 3px solid black;
    padding: 35px;
  }
  .comments div p{
    font-size: 18px;
  }

  .comments__wrapper{
    height: 200px !important;
  }
  .avis{
    margin-top: 80px;
    background-color: white;
    height: auto;
  }

  .avis hr{
    border: none;
    height: 4px;
    background-color: black;
  }

  .comment p{
    color: black;
  }
  </style>
</head>
<body class="custom-bg-gray">
 <div class="glav">
  <div class="block">
    <h1>Add Car</h1>
    <form id="car-form" method="POST" action="add_car.php" enctype="multipart/form-data">
      <div class="mb-3">
        <label for="brand" class="form-label">Marque</label>
        <input type="text" class="form-control" id="brand" name="brand" required>
      </div>
      <div class="mb-3">
        <label for="price" class="form-label">Prix:</label>
        <input type="text" class="form-control" id="price" name="price" required>
      </div>
      <div class="mb-3">
        <label for="mileage" class="form-label">Kilométrage</label>
        <input type="text" class="form-control" id="mileage" name="mileage" required>
      </div>
      <div class="mb-3">
        <label for="color" class="form-label">Couleur:</label>
        <input type="text" id="color" name="color" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="color_html" class="form-label">La couleur html en format HEX:</label>
        <input type="text" class="form-control" id="color_html" name="color_html" required>
      </div>
      <div class="mb-3">
        <label for="brand" class="form-label">L'année de mise en circulation:</label>
        <select type="text" class="form-control" id="releasedate" name="releaseDate">
          <option value="2000-01-01">2000</option>
          <option value="2001-01-01">2001</option>
          <option value="2002-01-01">2002</option>
          <option value="2003-01-01">2003</option>
          <option value="2004-01-01">2004</option>
          <option value="2005-01-01">2005</option>
          <option value="2006-01-01">2006</option>
          <option value="2007-01-01">2007</option>
          <option value="2008-01-01">2008</option>
          <option value="2009-01-01">2009</option>
          <option value="2010-01-01">2010</option>
          <option value="2011-01-01">2011</option>
          <option value="2012-01-01">2012</option>
          <option value="2013-01-01">2013</option>
          <option value="2014-01-01">2014</option>
          <option value="2015-01-01">2015</option>
          <option value="2016-01-01">2016</option>
        </select>
    </form>
    <div class="mb-3">
        <label for="image" class="form-label">Image:</label>
        <input type="file" class="form-control" id="image" name="image[]" accept="image/*" multiple required>      
    </div>
    <div class="mb-3">
        <label for="details" class="form-label">Détails:</label>
        <input type="text" id="details" name="details" class="form-control" required>
      </div>  
    <button type="button" class="btn btn-primary btn_submit">Envoyer l'image et poster l'annonce</button>
    </form>
  </div>
</div>

<section id="avis" class="avis">
        <div class="">
            <div class="avis_block">
              <h1>Les avis:</h1>
              <div id="comments" class="comments"></div>
            </div>
        </div>
    </div>
</section>






<script>

document.querySelector('.btn_submit').addEventListener('click', function() {
  
  var form = document.getElementById('car-form');
  var formData = new FormData(form);
  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'add_car.php');
  xhr.send(formData);

  
  var images = document.getElementById('image').files;
  var imageFormData = new FormData();
  for (var i = 0; i < images.length; i++) {
    var imageName = images[i].name;
    var imageId = Math.floor(Math.random() * 1000000); 
    imageFormData.append('photos[]', images[i], imageName + '_' + imageId);
  }
  var imageXhr = new XMLHttpRequest();
  imageXhr.open('POST', 'upload_image.php');
  imageXhr.send(imageFormData);
});
</script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
