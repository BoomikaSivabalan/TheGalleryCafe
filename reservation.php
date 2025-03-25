<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
  // If not logged in, redirect to login page
  header("Location: index.php");
  exit();
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home Page</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">  

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="css/promotion.css">
  <link rel="stylesheet" href="css/reservation.css">
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link rel="icon" href="images/tgchead-removebg-preview.png">


</head>
<body>

  <!-- header section -->
  <header class="header">
    <div class="container header-flex">
      <img src="images/tgcbk-removebg-preview.png" alt="The Gallery Cafe" class="logo">

      <nav>
        <ul class="mainmenu">
          <li><a class="current" href="userhome.php">HOME</a></li>
          <li><a href="userabout.php">ABOUT</a></li>
          <li><a href="usermenu.php">MENU</a></li>
          <li><a href="userpromotions.php">PROMOTIONS</a></li>
          
          <li><a href="usercontact.php">CONTACT</a></li>
          <li><a class="current" href="reservation.php">RESERVATION</a></li>
          <li class="login" id="account-icon">
            <a href="user_account.php" >
              <i class="fas fa-user-circle"> </i> USER
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </header>

<!-- header-image -->
<section class="container-lg promotion-hero">
    <div class="promotion-header">
      <img src="images\reservation-header.png" alt="reservation">
    </div>
  </section>

<!-- reservation Description -->
 <section class="container-sm reservation-description">
  <div class="reservation-details">
    <h5>MAKE YOUR</h5>
    <h1>RESERVATION</h1>
    <p>At TGC, we are delighted to offer you a memorable dining experience. Whether you're planning a cozy dinner, a small get-together, or a special anniversary celebration, we've got you covered! <br><br>
  <p style="margin-bottom: 60px;"><strong>We look forward to serving you!</strong></p>
  </section>
    
    <!-- body_menu section -->
    <section class="body_menu">
      <div class="details_grid container-lg">
        <!-- item1 -->
         <div class="element-item" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="300">
          <img src="images/carparking.webp" alt="">
         </div>
         <!-- item2 -->
         <div style="margin-left: 50px;"  class="details_grid-content" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="300">
          <h3 class="details_grid-heading">
          Parking Availability
          </h3>
          <p class="details_grid-description">
          We have 10 parking slots available to ensure your convenience. You can enjoy your visit without worrying about where to park your vehicle.  
          </p>
        </div>
         <!-- item3 -->
         <div style="margin-left: 50px;" class="details_grid-content"  data-aos="fade-up" data-aos-duration="1500" data-aos-delay="300">
          <h3 class="details_grid-heading">
          Table Availability
          </h3>
          <p  class="details_grid-description">
          Choose from our beautiful dining spaces: <br>

          <strong>Indoor Tables</strong>: Enjoy a comfortable and intimate atmosphere for your meal <br>
          <strong>Rooftop Tables</strong>: Experience breathtaking views while dining under the stars  
          </p>
        
        </div>
        <!-- item4 -->
        <div class="element-item" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="300">
          <img src="images/tablereserve.jpg" alt="">
         </div> 

         <!-- item5 -->
         <div class="element-item" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="300">
          <img src="images/carparking.webp" alt="">
         </div>
         <!-- item6 -->
         <div style="margin-left: 50px;"  class="details_grid-content" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="300">
          <h3 class="details_grid-heading">
          Pre Order Cuisine
          </h3>
          <p class="details_grid-description">
          Take advantage of our pre-order cuisine option! Browse our menu and select your favorite dishes ahead of time to have them prepared just for you. This way, you can enjoy a seamless dining experience.  
          </p>
        </div>
      </div>
    </section>

  

 
 <?php


if (!isset($_SESSION['user_id'])) {
    // Redirect to login if not logged in
    header("Location: index.php");
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "gallerycafe");

if ($conn === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Define maximum capacities for each table type
$tableCapacities = [
    'rooftop' => 6,  // Maximum 6 guests for rooftop
    'indoor' => 4     // Maximum 4 guests for indoor
];

// Fetch menu items
$sql = "SELECT name, price FROM menu";
$result = $conn->query($sql);
$menuItems = [];

if ($result->num_rows > 0) {
    // Store fetched menu items in an array
    while ($row = $result->fetch_assoc()) {
        $menuItems[] = $row;
    }
}

$conn->close();
?>

<!-- reservation form -->
<section class="container-sm">
    <div class="reservation-form" data-aos="zoom-in">
        <form action="submit_reservation.php" method="POST">
            <div class="form-group">
                <label class="visually-hidden" for="name">Name:</label>
                <input placeholder="Full Name" type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label class="visually-hidden" for="email">Email:</label>
                <input type="email" id="email" name="email" required value="<?php echo $_SESSION['user_email']; ?>">
            </div>
            <div class="form-group">
                <label class="visually-hidden" for="phone">Phone:</label>
                <input placeholder="Contact Number" type="tel" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <label class="visually-hidden" for="date">Date:</label>
                <input type="date" id="date" name="date" required>
            </div>
            <div class="form-group">
                <label class="visually-hidden" for="time">Time:</label>
                <input type="time" id="time" name="time" min="09:00" max="21:00" required>
            </div>
            <div class="form-group">
                <label class="visually-hidden" for="guests">Number of Guests:</label>
                <input placeholder="Number of Guests" type="number" id="guests" name="guests" min="1" max="10" required>
            </div>
            <div class="form-group">
                <label for="tabletype">Where you want to book the table:</label>
                <select style="width: 450px;" id="tabletype" name="tabletype" required>
                    <option value="rooftop">Rooftop</option>
                    <option value="Indoor">Indoor</option>
                </select>
            </div>
            <!-- Parking -->
            <div class="form-group">
                <label for="parking">Do you need parking?</label>
                <select style="width: 530px;" id="parking" name="parking" onchange="toggleParkingDetails()">
                    <option value="no">No I dont</option>
                    <option value="yes">Yes I need</option>
                </select>
            </div>

            <!-- Hidden Parking Details -->
            <div class="hidden" id="parking-details" style="display: none;">
                <div class="form-group">
                    <label for="vehicle-type">Vehicle Type:</label>
                    <select id="vehicle-type" name="vehicle_type">
                        <option value="car">Car</option>
                        <option value="bike">Bike</option>
                        <option value="van">Van</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="vehicle-number">Vehicle Number:</label>
                    <input type="text" id="vehicle-number" name="vehicle_number">
                </div>
            </div>

            <!-- Cuisine -->
            <div class="form-group">
                <label for="cuisine">Pre-order Cuisine:</label>
                <select style="width: 550px;" id="cuisine" name="cuisine" onchange="toggleCuisineDetails()">
                    <option value="none">No</option>
                    <option value="yes">Yes</option>
                </select>
            </div>

            <!-- Hidden Cuisine Details -->
            <div class="hidden" id="cuisine-details" style="display: none;">
                <div class="form-group">
                    <label>Menu Items to Prepare:</label>
                    <textarea id="menu-items" name="menu_items" readonly ></textarea>
                </div>
                <div class="form-group">
                    <span id="total-price">Total Price: Rs. 0.00</span>
                </div>

                <div class="form-group">
                    <label for="menu-item-list">Available Menu Items:</label>
                    <div id="menu-item-list">
                        <?php foreach ($menuItems as $item): ?>
                            <div class="menu-item">
                                <span><?php echo $item['name']; ?> - Rs. <?php echo number_format($item['price'], 2); ?></span>
                                <button type="button" onclick="addToTextarea('<?php echo $item['name']; ?>', <?php echo $item['price']; ?>)">Add</button>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="requests">Special Requests (optional):</label>
                <textarea id="requests" name="requests"></textarea>
            </div>

            <button type="submit" class="btn">Submit Reservation</button>
        </form>
    </div>
</section>

<script>
    function toggleParkingDetails() {
        const parking = document.getElementById('parking').value;
        const parkingDetails = document.getElementById('parking-details');
        parkingDetails.style.display = parking === 'yes' ? 'block' : 'none';
    }

    function toggleCuisineDetails() {
        const cuisine = document.getElementById('cuisine').value;
        const cuisineDetails = document.getElementById('cuisine-details');
        cuisineDetails.style.display = cuisine === 'yes' ? 'block' : 'none';
    }

    let totalPrice = 0; // Initialize total price

    function addToTextarea(name, price) {
        const menuItemsTextarea = document.getElementById('menu-items');
        totalPrice += price; // Add the price of the new item to the total
        menuItemsTextarea.value += `${name} - Rs. ${price.toFixed(2)}\n`;
        updateTotalPrice();
    }

    function updateTotalPrice() {
        const totalPriceDisplay = document.getElementById('total-price');
        totalPriceDisplay.textContent = `Total Price: Rs. ${totalPrice.toFixed(2)}`;
    }
</script>

                         

<!-- promotion gallery -->
<section class="gallery promotion-gallery">
    <div class="container-lg gallery-flex">
      <div class="gallery-item" data-aos="zoom-in">
          <img src="images/reservation6.jpg" alt="">
      </div>
      <div class="gallery-item" data-aos="zoom-in">
        <img src="images/reservation4.jpg" alt="">
      </div>
      <div class="gallery-item" data-aos="zoom-in">
        <img src="images/reservation3.jpg" alt="">
      </div>
      <div class="gallery-item" data-aos="zoom-in">
        <img src="images/reservation2.jpg" alt="">
      </div>
      <div class="gallery-item" data-aos="zoom-in">
        <img src="images/reservation5.jpg" alt="">
      </div>
      <div class="gallery-item" data-aos="zoom-in">
        <img src="images/reservation1.jpg" alt="">
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
    <a href="reservations.html" class="btn">MAKE A RESERVATION</a>
    
    <p>We acknowledge the Traditional Custodians of the land on which Gallery Café stands, the indigenous communities of Sri Lanka. We honor their deep connection and unique cultural and spiritual relationship to this land, its waters, and its people. We pay our deepest respects to their rich heritage and to the Elders, past, present, and future. <br></p>
  </div>
</div> 
</section>


<script src="scripts/hero.js"></script>
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.js"></script>
<script>
AOS.init();
</script>

</body>
</html>


