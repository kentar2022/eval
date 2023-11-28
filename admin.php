<?php

session_start();
$csrfToken = bin2hex(random_bytes(32));


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
  <link rel="icon" href="images/icon.ico">
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


<div class="registration-block block">
  <div>
    <h1>Changer l'horaire:</h1>
    <form action="save_schedule.php" method="POST">
      <label for="day" class="form-label">Jour de semaine:</label>
      <input type="text" name="day" id="day" class="form-control">
      <label for="time_intervals" class="form-label">Intervalles de temps:</label>
      <input type="text" name="time_intervals" id="time_intervals" class="form-control">
      <button type="submit" class="btn btn-primary btn_submit">Enregistrer</button>
    </form>  
  </div>
</div>


  <div class="registration-block block">
    <div class="col-md-12">
      <h1>Créer un compte d'employé</h1>
      <form action="reg_user.php" method="POST">
        <div class="mb-3">
          <label for="email" class="form-label">Email:</label>
          <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Mot de passe:</label>
          <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary btn_submit">Enregister les données</button>
      </form>
    </div>
  </div>


<script>
document.querySelector('.btn_submit').addEventListener('click', function() {

  let form = document.getElementById('car-form');
  let formData = new FormData(form);
  let xhr = new XMLHttpRequest();
  xhr.open('POST', 'add_car.php');
  xhr.send(formData);


  let images = document.getElementById('image').files;
  let imageFormData = new FormData();
  for (let i = 0; i < images.length; i++) {
    let imageName = images[i].name;
    let imageId = Math.floor(Math.random() * 1000000); 
    imageFormData.append('photos[]', images[i], imageName + '_' + imageId);
  }
  let imageXhr = new XMLHttpRequest();
  imageXhr.open('POST', 'upload_image.php');
  imageXhr.send(imageFormData);
});


  
  function getCsrfToken() {
      return fetch('csrf_token.php')
          .then(response => response.json())
          .then(data => data.csrf_token);
  }
  
  
  async function submitForm() {
      const csrfToken = await getCsrfToken();
      
     
      document.getElementById('csrfToken').value = csrfToken;
      
      
      const form = document.getElementById('myForm');
      fetch(form.action, {
          method: form.method,
          body: new FormData(form),
      });
}
 </script>
</body>
</html>

</script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>