<?php
// Database connection
$servername = "localhost";
$username = "root"; // Change to your database username if needed
$password = "";     // Change to your database password if needed
$dbname = "word";   // Database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch contact info
$result = $conn->query("SELECT * FROM contact_info WHERE id = 1");
$contact_info = $result->fetch_assoc();

// If no contact info is found, initialize with empty values
if (!$contact_info) {
    $contact_info = [
        'email' => '',
        'phone' => '',
        'address' => ''
    ];
}

// Handle form submission for updating contact info
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    // Debugging: Output submitted data to ensure it's being received correctly
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";

    // Ensure the fields are not empty
    if (!empty($email) && !empty($phone) && !empty($address)) {
        // Update contact info
        $stmt = $conn->prepare("UPDATE contact_info SET email = ?, phone = ?, address = ? WHERE id = 1");
        if ($stmt === false) {
            // Output error if the prepare statement fails
            die("Error preparing the statement: " . $conn->error);
        }

        // Bind parameters and execute the query
        $stmt->bind_param("sss", $email, $phone, $address);
        $executeResult = $stmt->execute();

        if ($executeResult) {
            echo "Data updated successfully!";
        } else {
            // Output error if the execute statement fails
            die("Error executing the statement: " . $stmt->error);
        }

        $stmt->close();
        header("Location: ".$_SERVER['PHP_SELF']); // Redirect to prevent form resubmission
        exit;
    } else {
        echo "All fields are required!";
    }
}
?>
  


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IETI SAN PEDRO LAGUNA WEBSITE</title>
    <link rel="stylesheet" href="#">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=PT+Serif:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     
    <script>
        // Open the modal and display the clicked image
        function openModal(img) {
            var modal = document.getElementById("myModal");
            var modalImg = document.getElementById("img01");
            modal.style.display = "block";
            modalImg.src = img.src; // Get the source of the clicked image
        }
    
        // Close the modal
        function closeModal() {
            var modal = document.getElementById("myModal");
            modal.style.display = "none";
        }
    
        // Close the modal when clicking outside of the image
        window.onclick = function(event) {
            var modal = document.getElementById("myModal");
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        // Open login modal
        function openLoginModal() {
            document.getElementById("loginModal").style.display = "block";
        }

        // Close login modal
        function closeLoginModal() {
            document.getElementById("loginModal").style.display = "none";
        }
    </script>

</head>
<body>
    <section class="header">
        <nav>
          <a href="index.php"><img src="images/IETICollegeOfScienceAndTechnology.png"></a>
          <div class="nav-links" id="navLinks">
              <i class="fa fa-times" onclick="hideMenu()"></i>
              <ul>
                  <li><a href="index.php">HOME</a></li>
                  <li class="dropdown">
                      <a href="#" class="dropbtn">ABOUT</a>
                      <ul class="dropdown-content">
                          <li><a href="history.php">History</a></li>
                          <li><a href="cert.php">Certifications</a></li>
                          <li class="dropdown">
                              <a href="#">MORE INFO</a>
                              <ul class="dropdown-content">
                                  <li><a href="schoolact.php">School Activities</a></li>
                                  <li><a href="facility.php">School Facility</a></li>
                                  <li><a href="viewvid.php">Videos</a></li>
                              </ul>
                          </li>
                          <li><a href="admin.php">Login</a></li>
                      </ul>
                  </li>
                  <li><a href="announcement.php">ANNOUNCEMENTS</a></li>
                  <li><a href="regs.php">CONTACT US</a></li>
              </ul>

            </div>
            <i class="fa fa-bars" onclick="showMenu()"></i>
        </nav>
        <div class="text-box">
            <h2>WELCOME TO</h2>
            <h1>IETI COLLEGE OF SCIENCE & TECHNOLOGY, INC.</h1>
            <p><?= htmlspecialchars($contact_info['address']) ?><br>COLLEGE DEPARTMENT<br>"The School That Cares & Makes Your Dreams Come True"</p>
        </div>
    </section>

          <!-------------COURSES------------------>
          <section class="courses">
          <p>AIM HIGH WITH IETI</p>
          <div class="row">
              <div class="column">
                  <a href="bsit.php">
                      <img src="images/BSIT.jpg" style="width: 20%;" alt="BSIT">
                  </a>
                  <a href="bscpe.php">
                      <img src="images/BSCPE.jpg" style="width: 20%;" alt="BSCPE">
                  </a>
                  <a href="bsba.php">
                      <img src="images/BSBA.jpg" style="width: 20%;" alt="BSBA">
                  </a>
                  <a href="bsca.php">
                      <img src="images/BSCA.jpg" style="width: 20%;" alt="BSCA">
                  </a>
              </div>
          </div>
          <div class="row2">
              <div class="column2">
                  <a href="bsed.php">
                      <img src="images/BSED.jpg" style="width: 20%;" alt="BSED">
                  </a>
                  <a href="beed.php">
                      <img src="images/BEED.jpg" style="width: 20%;" alt="BEED">
                  </a>
                  <a href="bshrm.php">
                      <img src="images/BSHRM.jpg" style="width: 20%;" alt="BSHRM">
                  </a>
              </div>
          </div>
      </section>

 
    <section class="container">
        <!-- Video and Paragraph side by side -->
        <div class="video-section">
            <!-- Video on the left -->
            <div class="video">
                <video controls muted src="vid.mp4"></video>
            </div>
            <!-- Paragraph beside the video -->
            <div class="description">
                <p>
                    <strong>Watch this video to learn more about IETI College of Science and Technology.</strong><br>
                    Explore the campus, facilities, and student life in this informative video. Gain insights into the courses offered and why IETI is a great place for your education.
                </p>
            </div>
        </div>
   
    </section>
  <footer>
  <div class="footer-container">
  <div class="footer-container">
        <div class="footer-section">
            <h4>Contact Us</h4>
            <ul>
                <li>Email: <a href="mailto:<?= htmlspecialchars($contact_info['email']) ?>"><?= htmlspecialchars($contact_info['email']) ?></a></li>
                <li>Contact Num: <?= htmlspecialchars($contact_info['phone']) ?></a></li>
                <li>Address: <?= htmlspecialchars($contact_info['address']) ?></li>
            </ul>
        </div>
    </div>
    <div class="footer-section">
      <h4>FAQ</h4>
      <ul>
        <li><a href="testing7.php">Questions & Answers</a></li>

      </ul>
    </div>
  </div>
  <div class="footer-bottom">
    <p>&copy; 2024  IETI COLLEGE OF SCIENCE & TECHNOLOGY, INC. San Pedro Campus-COLLEGE DEPARTMENT</p>
  </div>
</footer>

<style>
  footer {
    background-color: #2c2c2c;
    color: #fff;
    padding: 40px 20px;
    font-family: Arial, sans-serif;
    text-align: center;
  }

  .footer-container {
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
    max-width: 1200px;
    margin: 0 auto;
  }

  .footer-section {
    flex: 1;
    margin: 10px 20px;
    min-width: 250px;
    text-align: left;
  }

  .footer-section h4 {
    font-size: 1.4em;
    margin-bottom: 15px;
    color: #f4a261;
    border-bottom: 2px solid #f4a261;
    padding-bottom: 5px;
  }

  .faq-link {
    color: #f4a261;
    text-decoration: none;
    font-size: 1.2em;
    transition: color 0.3s ease;
  }

  .faq-link:hover {
    color: #61dafb;
    text-decoration: underline;
  }

  .footer-section ul {
    list-style-type: none;
    padding: 0;
    margin: 0;
  }

  .footer-section ul li {
    margin: 10px 0;
  }

  .footer-section ul li a {
    color: #61dafb;
    text-decoration: none;
    font-size: 1em;
    transition: color 0.3s ease;
  }

  .footer-section ul li a:hover {
    color: #f4a261;
    text-decoration: underline;
  }

  .footer-bottom {
    margin-top: 30px;
    font-size: 0.9em;
    color: #aaa;
  }

  @media (max-width: 768px) {
    .footer-container {
      flex-direction: column;
    }
    .footer-section {
      text-align: center;
    }
  }
</style>







    <script>
    var navLinks = document.getElementById("navLinks");
var barsIcon = document.querySelector(".fa-bars");

function showMenu() {
    navLinks.style.right = "0"; // Show the menu
    barsIcon.style.display = "none"; // Hide the bars icon
    document.body.style.overflow = "hidden"; // Disable scrolling
}

function hideMenu() {
    navLinks.style.right = "-250px"; // Hide the menu by moving it off-screen
    barsIcon.style.display = "block"; // Show the bars icon
    document.body.style.overflow = "auto"; // Re-enable scrolling
}
    </script>

</body>
</html>


<style>
    * {
      margin: 0;
      padding: 0;
      font-family: "PT Serif", serif;
     
    }
    
    .header {
      min-height: 90vh;
      width: 100%;
      background-image: url(images/bg1.jpg);
      background-position: center;
      background-size: cover;
      position: relative;
    }
    
    nav {
      display: flex;
      padding: 2% 6%;
      justify-content: space-between;
      align-items: center;
    }
    
    nav img {
      width: 100px;
    }
    
    .nav-links {
      flex: 10;
      text-align: right;
    }
    
    .nav-links ul {
      list-style: none;
    }
    
    .nav-links ul li {
      display: inline-block;
      
      position: relative;
    }
    
    .nav-links ul li a {
      color: hsl(160, 86%, 5%);
      text-decoration: none;
      padding: 10px 12px;
      font-size: 18px;
    }
    
    .nav-links ul li::after {
      content: '';
      width: 0%;
      height: 2px;
      background: #0b925e;
      display: block;
      margin: auto;
      transition: 0.5s;
    }
    
    .nav-links ul li:hover::after {
      width: 100%;
    }
    ul li:hover > a {
        background-color: #ddd;
    }
    /* Dropdown Styles */
    .dropdown {
      position: relative;
    }
    
    .dropdown-content {
  display: none;
  position: absolute;
  background-color: #f0f1f0;
  min-width: 160px;
  z-index: 1;
  list-style: none;
  padding: 0;
  text-align: left;
  font-size: 5px;
  
}

 
    .dropdown-content li a {
      color: rgb(0, 0, 0);
      padding: 12px 16px;
      text-decoration: none;
      display: block;
    }
    
    .dropdown-content li a:hover {
      background-color: #ebdada;
    }
    
    .dropdown:hover > .dropdown-content {
        display: block;
    }

    .dropdown-content .dropdown {
        position: relative;
    }

    .dropdown-content .dropdown-content {
        left: 100%;
        top: 0;
    }
    .dropdown > a::after {
    content: " ⌄";
    font-size: 14px;
    color: #000;
    margin-left: 5px;
    transition: transform 0.3s;
}

.dropdown:hover > a::after {
    transform: rotate(180deg); /* Rotate symbol on hover for a dynamic effect */
}
    .text-box {
      width: 90%;
      color: #000000;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      text-align: center;
    }
    
    .text-box h1 {
      font-size: 57px;
    }
    
    .text-box p {
      margin: 10px 0 40px;
      font-size: 20px;
    }
    
    nav .fa {
      display: none;
    }
    
    @media(max-width: 700px) {
      .text-box h1 {
          font-size: 30px;
      }
    
      .nav-links ul li {
          display: block;
      }
    
      .nav-links {
          position: fixed;
          background: rgb(20, 204, 13);
          height: 100vh;
          width: 200px;
          top: 0;
          right: -200px;
          text-align: left;
          z-index: 2;
          transition: 1s;
      }
    
      nav .fa {
          display: block;
          color: hsl(157, 100%, 9%);
          margin: 10%;
          font-size: 17px;
          cursor: pointer;
      }
      .nav-links.show {
        right: 0;
        overflow: hidden; /* Prevent swipe when the menu is shown */
      }
      .nav-links ul {
          padding: 10px;
      }
    }
    
    /*-------COURSES-------------*/
    /* Style for the Courses Section */
    .courses {
      width: 100%;
      margin: auto;
      text-align: center;
      padding: 50px 0;
      background-color:rgb(255, 255, 255);
    }
    
    .courses h1 {
      font-size: 36px;
      font-weight: 700;
      color: rgb(0, 0, 0);
      margin-bottom: 20px;
    }
    
    .courses p {
      color: #000000;
      font-size: 24px;
      font-weight: 300;
      margin-bottom: 40px;
    }
    
    /* Row for course images */
    .row, .row2 {
      display: flex;
      justify-content: center;
      gap: 20px; /* Spacing between images */
      flex-wrap: wrap; /* Make the row wrap to multiple lines if needed */
      margin-bottom: 40px;
    }
    
    /* Style for individual images */
    .row img, .row2 img {
      width: 220px; /* Set a smaller width for the images */
      height: auto; /* Maintain the aspect ratio */
      border-radius: 20px; /* Add rounded corners for a cleaner look */
      transition: transform 0.3s ease; /* Add a smooth hover effect */
      box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1); /* Soft shadow for visual depth */
    }
    
    /* Hover effect for images */
    .row img:hover, .row2 img:hover {
      transform: scale(1.05); /* Slightly enlarge the image on hover */
    }
    
    
    
    /* Container styles */
    .container {
      display: flex;
      flex-direction: column;
      gap: 20px;
      padding: 40px;
      max-width: 1200px; /* Sets a maximum width for better layout */
      margin: auto; /* Center the container */
    }
    
    /* Video section styling */
    .video-section {
      display: flex;
      flex-direction: column; /* Stack elements vertically to match map layout */
      align-items: center; /* Center align for a better look */
      gap: 20px; /* Adjusted gap for better spacing */
      background-color: #ffffff; /* White background for contrast */
      padding: 20px;
      border-radius: 10px; /* Rounded corners */
      box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1); /* Soft shadow */
    }
    
    /* Video styling */
    .video video {
      width: 100%; /* Responsive width */
      max-width: 800px; /* Increased max width for consistency with the map */
      height: 450px; /* Fixed height for better alignment */
      border-radius: 10px; /* Match the rounded corners of the map */
      box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.2); /* Consistent shadow */
    }
    
    /* Description styling */
    .description {
      max-width: 500px; /* Match the width of the location description */
      text-align: center; /* Center text for a balanced appearance */
    }
    
    /* Paragraph styling */
    .description p {
      font-size: 18px; /* Keep the same font size for consistency */
      line-height: 1.6; /* Maintain readability */
      color: #333; /* Consistent color */
    }
    
    
    /* Map section styling */
    /* Map section styling */
    .map-section {
      display: flex;
      flex-direction: column; /* Stack elements vertically */
      align-items: center; /* Center align for a better look */
      gap: 20px; /* Adjusted gap for better spacing */
      background-color: #ffffff; /* White background for contrast */
      padding: 20px;
      border-radius: 10px; /* Rounded corners */
      box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
    }
    
    /* Location description styling */
    .location-description {
      max-width: 500px; /* Reduced width for better space management */
      text-align: center; /* Center text for a balanced appearance */
    }
    
    /* Location description paragraph styling */
    .location-description p {
      font-size: 18px; /* Reduced font size for compactness */
      color: #555;
    }
    
    /* Map iframe styling */
    .map iframe {
      width: 100%; /* Use full width of its parent */
      max-width: 800px; /* Increased max width for the iframe */
      height: 450px; /* Adjust height as needed */
      border-radius: 10px;
      box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.2);
    }
    
    
    
     /* Modal styles */
    .modal {
      display: none; /* Hidden by default */
      position: fixed; /* Stay in place */
      z-index: 1; /* Sit on top */
      left: 0;
      top: 0;
      width: 100%; /* Full width */
      height: 100%; /* Full height */
      overflow: auto; /* Enable scroll if needed */
      background-color: rgb(0, 0, 0); /* Fallback color */
      background-color: rgba(0, 0, 0, 0.9); /* Black w/ opacity */
      padding: 20px; /* Padding for mobile */
    }
    
    /* Modal content */
    .modal-content {
      margin: auto;
      display: block;
      max-width: 90%; /* Reduced width for better mobile view */
      height: auto; /* Auto height to maintain aspect ratio */
      max-height: 70%; /* Adjusted limit height to reduce size */
    }
    
    /* Close button */
    .close {
      position: absolute;
      top: 10px; /* Move closer to the top */
      right: 50px; /* Move closer to the left */
      color: white;
      font-size: 30px; /* Font size for desktop */
      font-weight: bold;
      cursor: pointer;
      z-index: 2; /* Ensure it's above the modal */
      border: 2px solid white; /* Added border for visibility */
      border-radius: 50%; /* Make it circular */
      padding: 5px; /* Added padding for touch targets */
    }
    
    /* Close button hover effect */
    .close:hover,
    .close:focus {
      color: #bbb;
      text-decoration: none;
      cursor: pointer;
    }
    
    /* Responsive styles */
    @media (max-width: 768px) {
      .close {
        font-size: 28px; /* Adjust close button size for mobile */
        padding: 8px; /* Increased padding for better touch response */
      }
      
      .modal-content {
        max-height: 60%; /* Reduce max height for mobile to keep image smaller */
        padding-top: 100px;
      }
    }
    
    
    
    
    
    </style>