<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">  

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link rel="stylesheet" href="css/styles.css">

  <link rel="stylesheet" href="css/about.css">
  <link rel="stylesheet" href="css/contact.css">

  <link rel="icon" href="images/icon-modified.png">
</head>
<body>
 <!-- header section -->
 <header class="header">
  <div class="container header-flex">
    <img src="images/tgcbk-removebg-preview.png" alt="The Gallery Cafe" class="logo">

    <nav>
      <ul class="mainmenu">
        <li><a href="userhome.php">HOME</a></li>
        <li><a href="userabout.php">ABOUT</a></li>
        <li><a href="usermenu.php">MENU</a></li>
        <li><a href="userpromotions.php">PROMOTIONS</a></li>
        
        <li><a class="current" href="usercontact.php">CONTACT</a></li>
        <li><a href="reservation.php">RESERVATION</a></li>
        <li class="login" id="account-icon">
            <a href="user_account.php" class="current">
              <i class="fas fa-user-circle"> </i> USER
            </a>
          </li>  
      </ul>
    </nav>
  </div>
</header>

<!-- contact image section -->
  <section class="container-lg contact-image">
    <div>
      <img src="images/contact-image.jpg" alt="">
    </div>
  </section>

  <!-- contact description -->
  <section class="contact_des container-sm">
    <h2 style="
      color: rgb(156, 118, 22);
      font-size: 50PX;">CONTACT US</h2>
    <p>Use the form below to send us a message, and we’ll get back to you as soon as possible.</p>
    <p>For assistance with an existing reservation, email us at <span class="mailaddress">reservations@gallerycafe.com</span> and a member of our staff will help you with your request. </p>
    <p>We would love to host your wedding, birthday celebration, family gathering or other special event in our beautiful space. For parties of 10 guests or more, please email <span class="mailaddress">events@gallerycafe.com</span></p>
    <p>For general inquiries, file the form below or you can also reach us by phone at <strong>+94 1234 5678</strong> <br>     
      <strong>Looking forward to hearing from you!</strong></p>
  </section>

  <!-- contact us form -->
  <section class="contact">
    <div class="container container-sm">
    <form method="post" action="contact.php">
      <div class="form-group">
        <label for="first-name" class="visually-hidden">Name</label>
        <input type="text" id="name" name="name" placeholder="Name">
      </div>
  
    <div class="form-group">
      <label for="email" class="visually-hidden">Email</label>
      <input type="email" id="email" name="email" placeholder="Email">
    </div>

    <div class="form-group">
      <label for="number" class="visually-hidden">Phone Number</label>
      <input type="int" id="number" name="number" placeholder="Phone Number">
    </div>

    <div class="form-group">
      <label for="message" class="visually-hidden">Your Message</label>
      <textarea id="message" name="message" placeholder="Your Message"></textarea>
    </div>

    <div class="form-group">
      <button class="btn" type="submit">SUBMIT</button>
    </div>

    </form>
    </div>
  </section>

  <?php

// Create a connection to the database
$conn = new mysqli("localhost","root", "", "gallerycafe");

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Check if the form data is being sent
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Get the form data from the request
  $name = $_POST['name'];
  $email = $_POST['email'];
  $number = $_POST['number'];
  $message = $_POST['message'];

  // Check if the form data is not empty
  if (!empty($name) && !empty($email) && !empty($number) && !empty($message)) {
    // Insert the data into the database
    $sql = "INSERT INTO contacts (name, email, phone_number, message) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $email, $number, $message);
    if ($stmt->execute()) {
      echo "Data inserted successfully";
    } else {
      echo "Error inserting data: " . $conn->error;
    }
  } else {
    echo "Please fill in all the fields";
  }
}

// Close the connection
$conn->close();
?>

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


<script src="scripts/contactform.js"></script>
</body>
</html>