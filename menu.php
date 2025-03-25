<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Menu</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/menuslider.css">
    <link rel="icon" href="images/icon-modified.png">

    <style>

       
        
        .filter-section {
            text-align: center;
            margin-bottom: 30px;
        }

        .filter-section button {
            padding: 10px 30px;
            margin: 5px;
            background-color: rgb(156, 118, 22);
            color: white;
            border: 1.5px solid rgb(156, 118, 22);
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-size: 12px;
            font-weight: bold;
        }

        .filter-section button:hover {
            opacity: 0.9;
        }

        #searchBar {
            padding: 10px;
            width: 300px;
            margin: 20px 10px 50px 900px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .menu-items {
            max-width: 900px;
            margin: 0 auto;
        }

        .menu-item {
            display: flex;
            align-items: center;
            background-color: white;
            width: 100%;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
            transition: box-shadow 0.3s ease;
            text-align: left;
            justify-content: space-between;
        }

        .menu-item img {
            width: 180px;
            height: 130px;
            object-fit: cover;
            border-radius: 10px;
            margin-right: 20px;
        }

        .menu-item .menu-details {
            flex: 1;
        }

        .menu-item h2 {
            margin: 0;
            font-size: 1.1rem;
            color: rgb(156, 118, 22);
            font-family: 'Open Sans', sans-serif;
        }

        .menu-cuisine{
            font-size: 0.7rem;
            margin-top: 2px;
            color: #6c757d;
        }

        .menu-description {
            color: #6c757d;
            font-size: 0.8rem;
            margin-top: 5px;
        }

        .menu-price {
            font-weight: bold;
            color: #333;
            font-size: 0.8rem;
            margin-top: 10px;
            color: #6c757d;
        }

    </style>
</head>
<body>

<!-- header section -->
<header class="header">
    <div class="container header-flex">
      <img src="images/tgcbk-removebg-preview.png" alt="The Gallery Cafe" class="logo">

      <nav>
        <ul class="mainmenu">
          <li><a  href="home.php">HOME</a></li>
          <li><a href="about.php">ABOUT</a></li>
          <li><a class="current" href="menu.php">MENU</a></li>
          <li><a href="promotions.php">PROMOTIONS</a></li>
          
          <li><a href="contact.php">CONTACT</a></li>
          <li><a href="reservation.php">RESERVATION</a></li>
          <li><a class="btn login" href="login.php">LOGIN</a></li>   
        </ul>
      </nav>
    </div>
  </header>

<!-- Menu Hero Section -->
<section class="menu-hero">
<div class="slider">

<div class="list">
        <div class="item active" >
            <img src="images/menuhero/5.png">
        </div>
        <div class="item">
            <img src="images/menuhero/4.png">
        </div>
        <div class="item">
            <img src="images/menuhero/2.png">
        </div>
        <div class="item">
            <img src="images/menuhero/1.png">
        </div>
        <div class="item">
            <img src="images/menuhero/3.png">
        </div>
    </div>
    <div  class="circle">
        Scroll down to explore our full menu - Scroll down to explore our full menu -
    </div>
    <div class="content">
        <div style="color: rgb(156, 118, 22); font-weight:bold;" >TGC</div>
        <div style="color: rgb(156, 118, 22);" >Our Menu</div>
    </div>
    <div class="arow">
        <button id="prev"><</button>
        <button id="next">></button>
    </div>
    </div> 
</section>

<!-- Filter Section -->
<section class="menu-section">
    <div class="filter-section">
        <input type="text" id="searchBar" onkeyup="searchMenu()" placeholder="Search for menu items...">
        <br>
        <button onclick="filterMenu('All')">ALL</button>
        <button onclick="filterMenu('Italian')">ITALIAN</button>
        <button onclick="filterMenu('Chinese')">CHINESE</button>
        <button onclick="filterMenu('Sri Lankan')">SRI LANKAN</button>
        <button onclick="filterMenu('Indian')">INDIAN</button>
        <button onclick="filterMenu('Beverage')">BEVERAGES</button>
        <button onclick="filterMenu('Special')">TODAY'S CHEF SPECIAL</button>
    </div>

    <!-- Menu Items Section -->
    <div class="menu-items" id="menuContainer">
        <?php
        // Database connection settings
        $conn = new mysqli("localhost", "root", "", "gallerycafe");

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Query to fetch menu items
        $sql = "SELECT name, cuisine_type, price, menudes, image_url FROM menu";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data for each menu item
            while ($row = $result->fetch_assoc()) {
                $name = $row["name"];
                $cuisine_type = $row["cuisine_type"];
                $price = $row["price"];
                $menudes = $row["menudes"];
                $image_url = $row["image_url"];
                ?>
                <div class="menu-item" data-cuisine="<?php echo $cuisine_type; ?>">
                    <img src="<?php echo $image_url; ?>" alt="<?php echo $name; ?>">
                    <div class="menu-details">
                        <h2><?php echo $name; ?></h2>
                        <p class="menu-cuisine"> <?php echo $cuisine_type; ?></p>
                        <p class="menu-description"> <?php echo $menudes; ?></p>
                        <p class="menu-price"><?php echo number_format($price, 2); ?></p>
                    </div>
                    
                </div>
                <?php
            }
        } else {
            echo "<p>No menu items found.</p>";
        }

        $conn->close();
        ?>
    </div>

    </section>


<script>



    // JavaScript to filter menu items by cuisine
    function filterMenu(cuisine) {
        const menuItems = document.querySelectorAll('.menu-item');
        menuItems.forEach(item => {
            if (cuisine === 'All' || item.getAttribute('data-cuisine') === cuisine) {
                item.style.display = 'flex';
            } else {
                item.style.display = 'none';
            }
        });
    }

    // JavaScript to search menu items
    function searchMenu() {
        const searchTerm = document.getElementById('searchBar').value.toLowerCase();
        const menuItems = document.querySelectorAll('.menu-item');

        menuItems.forEach(item => {
            const itemName = item.querySelector('h2').textContent.toLowerCase();
            if (itemName.includes(searchTerm)) {
                item.style.display = 'flex';
            } else {
                item.style.display = 'none';
            }
        });
    }

    // Initialize by showing all items
    filterMenu('All');
</script>

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
<script src="scripts/menu.js"></script>
</body>
</html>
