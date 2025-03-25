
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us Page</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">  

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="css/promotion.css">
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.css" rel="stylesheet">

  <link rel="icon" href="images/icon-modified.png">
</head>
<body>




 <!-- header section -->
 <header class="header">
  <div class="container header-flex">
    <img src="images/tgcbk-removebg-preview.png" alt="The Gallery Cafe" class="logo">

    <nav>
      <ul class="mainmenu">
        <li><a href="home.php">HOME</a></li>
        <li><a href="about.php">ABOUT</a></li>
        <li><a href="menu.php">MENU</a></li>
        <li><a class="current" href="promotions.php">PROMOTIONS</a></li>
        
        <li><a href="contact.php">CONTACT</a></li>
        <li><a href="reservation.php">RESERVATION</a></li>
        <li><a href="index.php" class="login btn">LOGIN</a></li>   
      </ul>
    </nav>
  </div>
</header>

  <!-- promotion-hero -->
  <section class="container-lg promotion-hero">
    <div class="promotion-header">
      <img src="images/promotion-hero.webp" alt="promotions">
      <p>HELLO PARTY PEOPLE!</p>
    </div>
  </section>

  <!-- promotion-news -->
  <section class="gallery" >
    <div class="container gallery-flex promotion-news" >
    <?php
// Database connection settings
$conn = new mysqli("localhost","root", "", "gallerycafe");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch promotion data
$sql = "SELECT heading, description, start_date, end_date, image_url FROM promotions";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data for each promotion
    while($row = $result->fetch_assoc()) {
        $heading = $row["heading"];
        $description = $row["description"];
        $start_date = date("F j, Y", strtotime($row["start_date"]));
        $end_date = date("F j, Y", strtotime($row["end_date"]));
        $image_url = $row["image_url"];
        ?>
        <div class="gallery-item">
            <img src="<?php echo $image_url; ?>" alt="<?php echo $heading; ?>">
            <h2><?php echo $heading; ?></h2>
            <p class="promotion-description">
                <?php echo nl2br($description); ?><br><br>
                <strong>Available: <?php echo $start_date; ?> - <?php echo $end_date; ?></strong><br><br>
                <a href="reservation.php" class="btn">RESERVE</a>
            </p>
        </div>
        <?php
    }
} else {
    echo "No promotions found.";
}

$conn->close();
?>
      
      <div class="gallery-item">
        <img src="images/promotion2.webp" alt="Sunday Asado">
        <h2>Sunday Asado</h2>
        <p class="promotion-description">Our Sunday Asado Series invites chefs and grill masters from all over the world.  <br><br> No-fuss, no-frills BBQing afternoon amongst friends and neighbors. <br><br> 
          <strong>Available: Every Sunday - 7pm to 11pm </strong><br><br>
          <a href="reservation.php" class="btn">RESERVE</a>
      </p>
      </div>
      <div class="gallery-item">
        <img src="images/promotion3.jpg" alt="Lunch Buffet">
        <h2>Lunch Buffet</h2>
        <p>Offering an exclusive 2-course lunch buffet for their guests, this TGC invites everyone to savor in a delicious buffet special. <br><br> Priced at a 4999 LKR per person, the buffet brings together quality, flavours and affordability. <br><br> 
          <strong>Available: Every Weekend - 12pm to 3pm</strong><br><br>
          <a href="reservation.php" class="btn">RESERVE</a>
      </p>
      </div>
    </div>
  </section>

  <!-- promotion gallery -->
  <section class="gallery promotion-gallery">
    <div class="container-lg gallery-flex">
      <div class="gallery-item" data-aos="zoom-in">
          <img src="images/pro-gallery1.jpg" alt="">
      </div>
      <div class="gallery-item" data-aos="zoom-in">
        <img src="images/pro-gallery2.webp" alt="">
      </div>
      <div class="gallery-item" data-aos="zoom-in">
        <img src="images/pro-gallery3.webp" alt="">
      </div>
      <div class="gallery-item" data-aos="zoom-in">
        <img src="images/pro-gallery4.jpg" alt="">
      </div>
      <div class="gallery-item" data-aos="zoom-in">
        <img src="images/pro-gallery5.jpg" alt="">
      </div>
      <div class="gallery-item" data-aos="zoom-in">
        <img src="images/pro-gallery6.webp" alt="">
      </div>
      <div class="gallery-item"data-aos="zoom-in">
        <img src="images/pro-gallery7.webp" alt="">
      </div>
      <div class="gallery-item" data-aos="zoom-in">
        <img src="images/pro-gallery8.jpg" alt="">
      </div>
      <div class="gallery-item" data-aos="zoom-in">
        <img src="images/pro-gallery9.webp" alt="">
      </div>
    </div>
  </section>

  <!-- footer -->
  <section class="footer">

  <div class="container footer-flex">
    <div>
      <div>
        <h4>SITEMAP</h4>
        <ul class="sitemap">
          <li><a href="about.php">About</a></li>
          <li><a href="menu.php">Menu</a></li>
          <li><a href="promotions.php">Promotions</a></li>
          <li><a href="promotions.php">Events</a></li>
          <li><a href="reservation.php" class="homebtn">Reservation</a></li>  
        </ul>
      </div>
      
      <div class="social">
        <h4>Follow Us</h4>
        <a href="#"><i class="fab fa-facebook fa-2x"></i></a>
        <a href="#"><i class="fab fa-twitter fa-2x"></i></a>
        <a href="#"><i class="fab fa-instagram fa-2x"></i></a>
        <a href="#"><i class="fab fa-pinterest fa-2x"></i></a>
        <a href="#"><i class="fab fa-tumblr fa-2x"></i></a>
      </div>  
    </div>
    
    <div>
      <div class="hours">
        <h4>Opening Hours</h4>
        <ul>
          <li>Tuesday to Sunday</li>
          <li>9am to 11pm</li> 
          <li>Lunch, Dinner & Brunch</li>
        </ul>
      </div>
      
      <div class="contactdet">
        <h4>Contact</h4>
        <ul>
          <li>+94 12 345 678</li>
          <li>contact@thegallerycafe.lk</li>
          <li>Upper Level, <br>
            Overseas Passenger Terminal, <br>
            Colombo 10</li>
        </ul>
      </div>
    </div>
    
    <div class="reserve">
      <h4>Reservations</h4>
      <a href="reservations.php" class="btn">MAKE A RESERVATION</a>
      
      <p>We acknowledge the Traditional Custodians of the land on which Gallery Café stands, the indigenous communities of Sri Lanka. We honor their deep connection and unique cultural and spiritual relationship to this land, its waters, and its people. We pay our deepest respects to their rich heritage and to the Elders, past, present, and future. <br></p>
    </div>
  </div> 
</section>


<script src="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>
</body>
</html>