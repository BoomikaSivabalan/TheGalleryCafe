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
  <link rel="stylesheet" href="css/heroanimation.css">
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link rel="icon" href="images/tgchead-removebg-preview.png">

  <style>
    #account-icon {
      font-size: 15px; 
      transition: transform 0.3s ease-in-out; 
    }

    #account-icon:hover {
      transform: scale(1.2); 
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
          <li><a class="current" href="userhome.php">HOME</a></li>
          <li><a href="userabout.php">ABOUT</a></li>
          <li><a href="usermenu.php">MENU</a></li>
          <li><a href="userpromotions.php">PROMOTIONS</a></li>
          <li><a href="usercontact.php">CONTACT</a></li>
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


  <!-- hero section -->
  <section class="hero container-lg">
    <div class="carousel">
      <!-- list item -->
      <div class="list">
          <div class="item">
              <img src="images/indian.jpg">
              <div class="content">
                  <div class="title">INDIAN CUSINE</div>
                  <div class="des">
                      Rich blend of spices and flavors, offering a diverse culinary experience that celebrates tradition and culture.
                  </div>
                  <div class="buttons">
                  <button onclick="location.href='menu.php'">VIEW MENU</button>    
                  </div>
              </div>
          </div>
          <div class="item">
              <img class="a" src="images/chinese.webp">
              <div class="content">
                  <div class="title">CHINESE CUSINE</div> 
                  <div class="des">
                    Harmonious balance of flavors and textures, offering a diverse range of dishes that reflect centuries of culinary tradition.
                  </div>
                  <div class="buttons">
                  <button onclick="location.href='menu.php'">VIEW MENU</button>
                      
                  </div>
              </div>
          </div>
          <div class="item">
              <img class="a" src="images/italian.webp">
              <div class="content">
                  <div class="title">ITALIAN CUSINE</div>
                  <div class="des">
                    Celebration of simple, fresh ingredients, featuring timeless dishes that embody warmth and tradition.
                  </div>
                  <div class="buttons">
                  <button onclick="location.href='menu.php'">VIEW MENU</button>
                      
                  </div>
              </div>
          </div>
          <div class="item">
              <img src="images/lankan.jpg">
              <div class="content">
                  <div class="title">LANKAN CUSINE</div>
                  <div class="des">
                    Vibrant mix of spices and flavors, offering dishes that are rich in tradition and bursting with local ingredients.
                  </div>
                  <div class="buttons">
                  <button onclick="location.href='menu.php'">VIEW MENU</button>
                     
                  </div>
              </div>
          </div>
      </div>
      <!-- list thumnail -->
      <div class="thumbnail">
          <div class="item">
              <img src="images/indian.jpg">
              <div class="content">
                  <div class="title">
                      INDIAN
                  </div>
              </div>
          </div>
          <div class="item">
              <img src="images/chinese.webp">
              <div class="content">
                  <div class="title">
                      CHINESE
                  </div>
              </div>
          </div>
          <div class="item">
              <img src="images/italian.webp">
              <div class="content">
                  <div class="title">
                      ITALIAN
                  </div>
              </div>
          </div>
          <div class="item">
              <img src="images/lankan.jpg">
              <div class="content">
                  <div class="title">
                      LANKAN
                  </div>
              </div>
          </div>
      </div>
      <!-- next prev -->

      <div class="arrows">
          <button id="prev"><</button>
          <button id="next">></button>
      </div>
  </div>
   </section>



   <!-- body_menu section -->
    <section class="body_menu">
      <div class="details_grid container-lg">
        <!-- item1 -->
         <div class="element-item" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="300">
          <img src="images/menu.avif" alt="">
         </div>
         <!-- item2 -->
         <div style="margin-left: 50px;"  class="details_grid-content" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="300">
          <h3 class="details_grid-heading">
            MENU
          </h3>
          <p class="details_grid-description">
            Our kitchen is rooted in an appreciation for exceptional homegrown ingredients, thoughtful-yet-simple preparations, and a passion for breathing new life into Old World recipes.  
          </p>
          <a href="menu.php" class="btn">VIEW MENU</a>
        </div>
         <!-- item3 -->
         <div style="margin-left: 50px;" class="details_grid-content"  data-aos="fade-up" data-aos-duration="1500" data-aos-delay="300">
          <h3 class="details_grid-heading">
            HAPPENINGS
          </h3>
          <p  class="details_grid-description">
            Stay tuned to our website and social media for the latest happenings and exclusive events at The OG, the heart of Denver's dynamic brunch and dining scene. Indulge in our themed brunches, relish our monthly specials, and join us in giving back to the community. There’s always something new and exciting to look forward to.  
          </p>
          <a href="promotions.php" class="btn">VIEW HAPPENINGS</a>
        </div>
        <!-- item4 -->
        <div class="element-item" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="300">
          <img src="images/happenings.avif" alt="">
         </div> 
      </div>
    </section>

    <!-- section-gallery -->
    <section class="gallery">
      <div class="container container-lg gallery-flex">
        <div class="gallery-item" data-aos="zoom-in">
          
            <img src="images/gallery1.webp" alt="">
        
        </div>
        <div class="gallery-item" data-aos="zoom-in" data-aos-delay="100">
          <img src="images/gallery2.webp" alt="portfolio2">
        </div>

        <div class="gallery-item" data-aos="zoom-in" data-aos-delay="200">
          
            <img src="images/gallery3.webp" alt="portfolio3">
          
        </div>
        
      </div>
    </section>

    
    <!-- intro section -->
    <section class="intro container">
          <div class="intro_content ">
              <h2>Open Tuesdays to Saturdays</h2>
              
              <p>Ready for a great meal? Reserve your table at The Gallery Cafe now! Whether you’re planning a cozy dinner or a special celebration, we’ve got the perfect spot for you.</p>

              <a href="reservations.html" class="btn">Make a TGC reservation</a>
            </div>
    </section>

   <!--footer image section  -->

   <div class="footer_image container-lg">
    <div class="footer_image-item">
      <img src="images/footer-image.webp" alt="">
    </div>
   </div>

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