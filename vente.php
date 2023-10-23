<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Vente d'automobiles reconditionnés</title>
  <link rel="stylesheet" href="styles/style_vente.css">
  <link rel="stylesheet" href="styles/style.css">
  <link rel="stylesheet" type="text/css" href="styles/header.css">
  <link rel="script" href="scripts/schedule.js">
  <link rel="icon" href="images/icon.ico">
</head>

<body>
<header>
    <div class="header_container">
    <img src="images/icon.png" class="icon">
    <h1 class="icon_text">Vincent Parrot</h1>
    </div>
    <nav class="navbar">
      <ul>
        <li><a href="#accueil">Accueil</a></li>
        <li><a href="#nos-services">Nos services</a></li>
        <li><a href="#a-propos">À propos de nous</a></li>
        <li><a href="#horaire">Horaire</a></li>
        <li><a href="voitures.html">Voitures d'occasion</a></li>
        <li>
          <button class="contact_button">
            <a href="#contact">Appelez nous</a>
          </button>
        </li>
      </ul>
    </nav>
</header>
<hr class="header_hr">
<div class="title">
  <h1>Catalogue</h1>
</div>


<section class="filter-container">
  <section class="filter-block">
    <form class="filter-form">
      <div class="filter-field">
        <label for="minPrice">Prix:</label>
        <input id="minPrice" name="minPrice">
      </div>

      <div class="filter-field">
        <label for="maxMileage">Kilométrage:</label>
        <input id="maxMileage" name="maxMileage">
      </div>

      <div class="filter-field">
        <label for="carBrand">Marque:</label>
        <input type="text" id="carBrand" name="carBrand">
      </div>

      <div class="filter-field">
        <label for="minYear">Année de début d'exploitation:</label>
        <input id="minYear" name="minYear">
      </div>

      <button type="button" onclick="filterAds()">Appliquer les filtres</button>
    </form>
  </section>
</section>





<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: text/html; charset=UTF-8');

$db_host = 'localhost';
$db_user = 'kentar';
$db_password = 'password';
$db_name = 'mydatabase';
$imageFolder = "./cars_images/";

$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

if ($conn->connect_error) {
  die("Database connection eror: " . $conn->connect_error);
}

$conn->set_charset("utf8");

$sql = "SELECT * FROM cars";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    echo "<div id='car-container' class='car-container' id='adsContainer'> "; 

    while ($row = $result->fetch_assoc()) {

      echo "<div class='carData ad' data-price='" . $row["price"] . "' data-mileage='" . $row["mileage"] . "' data-year='" . $row["release_date"] . "' data-brand='" . $row["brand"] . "'>"; 

        $imagePath = $imageFolder . $row["id"] . ".png";

        echo "<div class='carImage'>";
        echo "<img src='" . $imagePath . "' alt='Car Image' class='car_image'>";
        echo "</div>";

        echo "<div class='carText'>";
        echo "<h2><span class='carLabel'> <span style='color: " . $row["color_html"] . ";'>" . $row["brand"] . "</h2>";
        echo "<p><span class='carLabel'>Prix: </span>" . $row["price"]. "</p>";
        echo "<p><span class='carLabel'>Killometrage: </span>" . $row["mileage"]. "</p>";
        echo "<p><span class='carLabel'>Age
: </span>" . $row["release_date"]. "</p>";

        echo "<button class='details-button' data-id=' ". $row["id"] . "'>Details</button>";

        echo "</div>";

        echo "</div>";
    }
    echo "</div>"; 


} else {
    echo "No cars found.";
}

$conn->close();
?>


<div id="modal" class="modal">
  <div class="modal-content">
    <span class="close-button">×</span>
    <div id="details-content"></div>
    <section id="contact" class="contact">
      <div class="block__white">
        <div class="block_contact_h1">
          <h1>Contacter le vendeur</h1>
          <hr class="inscription_hr">
        </div>
        <div class="inscription_block">
          <div style="max-width: 870px; height: 450px; background-color: rgba(197, 0, 26, 0.7); padding: 10px;">
            <div style="display: flex; flex-wrap: wrap; justify-content: space-around; margin-bottom: 40px; margin-top: 30px;">
              <div style="width: 40%; margin-left: 40px;">
                <input type="text" placeholder="Entrez votre prénom . . ." style="width: 70%; height: 23px; margin-bottom: 10px; background-color: #D9D9D9; border: none;">
                <input type="text" placeholder="Entrez votre nom . . ." style="width: 70%; height: 23px; margin-bottom: 10px; background-color: #D9D9D9; border: none;">
              </div>
              <div style="width: 40%;">
                <input type="email" placeholder="Entrez votre email . . ." style="width: 70%; height: 23px; margin-bottom: 10px; background-color: #D9D9D9; border: none;">
                <input type="tel" placeholder="Entrez votre numéro . . ." style="width: 70%; height: 23px; margin-bottom: 10px; background-color: #D9D9D9; border: none;">
              </div>
            </div>
            <textarea placeholder="Message" style="width: 100%; height: 200px; margin-bottom: 10px; border: none;"></textarea>
            <button class="textarea_btn">Envoyer</button>
          </div>
        </div>
      </div><br>
    </section>
  </div>
</div>



<footer id="footer" class="footer">
  <div class="footer_block">
    <div id="schedule" class="schedule">
      <div class="footer_block_h1">
        <h1 class="section-heading">Horaires:</h1>

        <div class="schedule-form">
        </div>

      </div>
    </div>
    <div class="footer_contact_block">
        <h1>Adresse:</h1>
        <p>Rue de Paris 123, Toulouse</p>
        <p>+33123456789</p>
        <p>Vincent Parrot</p>
      </div>
      <div class="footer_contact_block">
        <h1>Services:</h1>
        <p>Réparation</p>
        <p>Peinture</p>
        <p>Vente de voitures d'occasion</p>
      </div>
      <div>
        <div id="google-map">
  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d24859.136176284722!2d-0.1278!3d51.5074!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zM1DCsDA0JzI4LjciTiAwwrAzMicxMS41Ilc!5e0!3m2!1sen!2sus!4v1624297462245!5m2!1sen!2sus" width="500" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
</div>
      </div>
    </div>
  </div>
  <p class="footer_droits">© 2023, Toulouse Tous droits réservés</p>
</footer> 

<script type="text/javascript" src="details.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
  $('.details-button').click(function() {
  let id = $(this).data('id');

   
    $.ajax({
      type: 'POST',
      url: 'get_details.php', 
      data: { id: id },
      success: function(response) {
        $('#details-content').html(response);
        $('#modal').show();
      },
      error: function() {
        alert('Erreur.');
      }
    });
  });

  $('.close-button').click(function() {
    $('#modal').hide();
  });
});
</script>

<script>
    $(document).ready(function() {
      loadSchedule();

      function loadSchedule() {
        $.ajax({
          type: 'GET',
          url: 'load_schedule.php',
          dataType: 'json',
          success: function(data) {
            let scheduleContainer = $('.schedule-form');
            scheduleContainer.empty();

            for (let i = 0; i < data.length; i++) {
              let entry = data[i];
              let day = entry.day;
              let timeIntervals = entry.time_intervals;

              let entryElement = '<div class="schedule-entry">' +
  '<p>' + day + ':' +' '  + timeIntervals + '</p>' +
  '</div>';

              scheduleContainer.append(entryElement);
            }
          },
          error: function() {
            $('.schedule-form').text('Error while waiting for schedule.');
          }
        });
      }
    });


</script>

<script src="filter.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>
</html>
