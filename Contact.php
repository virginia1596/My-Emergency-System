<?php
// Database configuration
$host = "localhost";
$dbname = "emergency_db";   // Replace with your actual DB name
$username = "root";         // Default for XAMPP
$password = "";             // Empty password for XAMPP by default

// Connect to MySQL
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get and sanitize user input
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $message = $conn->real_escape_string($_POST['message']);

    // Insert into database
    $sql = "INSERT INTO contact_messages (name, email, message) 
            VALUES ('$name', '$email', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('✅ Message sent successfully.'); window.location.href='Home.html';</script>";
  
    } else {
        echo "Error: " . $conn->error;
    }

    // Close connection
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact Us - Emergency Dispatch System</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="icon" href="favicon.png" />
  <style>
    /* Scrolling text animation */
    .scrolling-text {
      white-space: nowrap;
      overflow: hidden;
      font-size: 24px;
      font-weight: bold;
      color: black;
      padding: 12px;
      background-color: #ffffff;
      text-align: center;
      animation: scroll-left 15s linear infinite;
    }

    @keyframes scroll-left {
      0% { transform: translateX(100%); }
      100% { transform: translateX(-100%); }
    }

    /* Fade-in animations */
    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }

    .animate-fade-in { animation: fadeIn 1s ease-in-out forwards; }
    .animate-fade-in-down { animation: fadeIn 0.8s ease-in-out forwards; }
    .animate-fade-in-up { animation: fadeIn 1s ease-in-out forwards; transform: translateY(20px); }
  </style>
</head>
<body class="bg-blue-100 text-gray-900 font-sans">

  <!-- Scrolling Text -->
  <div class="scrolling-text">🚨 LUSAKA EMERGENCY DISPATCH SYSTEM 🚨</div>

  <!-- Header -->
  <header class="bg-gray-800 text-white sticky top-0 z-50 shadow-md">
    <div class="max-w-7xl mx-auto flex justify-between items-center px-6 py-4">
      <div class="logo">
        <img src="Pictures/pic 2.png" alt="Logo" class="w-16 h-16 rounded-full border-2 border-white"/>
      </div>
      <nav class="space-x-6 text-sm">
        <a href="Home.html" class="hover:text-yellow-400">Home</a>
        <a href="Register.html" class="hover:text-yellow-400">Register</a>
        <a href="Login.html" class="hover:text-yellow-400">Login</a>
        <a href="Services.html" class="hover:text-yellow-400">Services</a>
        <a href="Profile.html" class="hover:text-yellow-400">My Profile</a>
        <a href="About.html" class="hover:text-yellow-400">About Us</a>
        <a href="Contact.html" class="text-yellow-400 font-bold">Contact Us</a>
        <a href="EmergencyTips.html" class="hover:text-yellow-400">Emergency Tips</a>
        <a href="Dash-board.php" class="hover:text-yellow-400">Dashboard</a>
        <a href="Logout.html" class="hover:text-yellow-400">Logout</a>
      </nav>
    </div>
  </header>

  <!-- Hero Section -->
  <section class="py-12 text-center animate-fade-in">
    <h2 class="text-4xl font-bold text-red-700 mb-4 animate-bounce">Need Help? Reach Out Anytime</h2>
    <p class="text-lg text-gray-700 max-w-xl mx-auto">We're connected to emergency responders across Matero and Mandevu. Contact us or our partners directly during emergencies.</p>
  </section>

  <!-- Emergency Contacts -->
  <section class="py-12">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-8">

      <!-- Police -->
      <div class="bg-white rounded-xl shadow-lg p-6 border-t-4 border-blue-600 hover:scale-105 transition transform animate-fade-in-up">
        <h3 class="text-2xl font-bold text-blue-700 mb-4">👮 Police Stations</h3>
        <ul class="space-y-3 text-sm">
          <li><strong>Matero Police Station</strong><br>📞 <a href="tel:+260211243946" class="text-blue-600 hover:underline">+260 211 243 946</a></li>
          <li><strong>Muchinga Police Post</strong><br>📍 Mandevu Area</li>
          <li><strong>Barlastone Police Post</strong><br>📍 Barlastone Area</li>
          <li><strong>Emergency Line</strong>: <a href="tel:991" class="text-blue-600 hover:underline">991</a></li>
        </ul>
      </div>

      <!-- Fire -->
      <div class="bg-white rounded-xl shadow-lg p-6 border-t-4 border-yellow-500 hover:scale-105 transition transform animate-fade-in-up delay-150">
        <h3 class="text-2xl font-bold text-yellow-700 mb-4">🔥 Fire Stations</h3>
        <ul class="space-y-3 text-sm">
          <li><strong>Levy Junction Fire Station</strong><br>📞 <a href="tel:+260211220180" class="text-yellow-600 hover:underline">+260 211 220 180</a></li>
          <li><strong>Lusaka City Fire Brigade</strong><br>📞 <a href="tel:+260211253122" class="text-yellow-600 hover:underline">+260 211 253 122</a></li>
          <li><strong>Emergency Line</strong>: <a href="tel:993" class="text-yellow-600 hover:underline">993</a></li>
        </ul>
      </div>

      <!-- Medical -->
      <div class="bg-white rounded-xl shadow-lg p-6 border-t-4 border-green-600 hover:scale-105 transition transform animate-fade-in-up delay-300">
        <h3 class="text-2xl font-bold text-green-700 mb-4">🏥 Hospitals & Clinics</h3>
        <ul class="space-y-3 text-sm">
          <li><strong>Matero Level 1 Hospital</strong><br>📞 <a href="tel:+260211245010" class="text-green-600 hover:underline">+260 211 245 010</a></li>
          <li><strong>St. Clare Mission Hospital</strong><br>📍 Mandevu Area</li>
          <li><strong>Chipata Level 1 Hospital (MAX Clinic)</strong><br>📞 <a href="tel:+260977559066" class="text-green-600 hover:underline">+260 977 559 066</a></li>
          <li><strong>Emergency Line</strong>: <a href="tel:992" class="text-green-600 hover:underline">992</a></li>
        </ul>
      </div>

    </div>
  </section>

  <!-- Contact Form -->
  <section class="py-16">
    <div class="max-w-4xl mx-auto px-6 bg-white rounded-xl shadow-xl p-10 animate-fade-in-up">
      <h3 class="text-3xl font-bold text-red-700 mb-6 text-center">📬 Send Us a Message</h3>
      <form action="Contact.php" method="POST" class="space-y-6">
        <div>
          <label for="name" class="block font-semibold mb-1">Full Name</label>
          <input type="text" id="name" name="name" required class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 transition" />
        </div>
        <div>
          <label for="email" class="block font-semibold mb-1">Email Address</label>
          <input type="email" id="email" name="email" required class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 transition" />
        </div>
        <div>
          <label for="message" class="block font-semibold mb-1">Your Message</label>
          <textarea id="message" name="message" rows="5" required class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 transition"></textarea>
        </div>
        <div class="text-center">
          <button type="submit" class="bg-red-600 text-white px-8 py-3 rounded-full hover:bg-red-700 transition shadow-md">
            Send Message
          </button>
        </div>
      </form>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-gray-800 text-white text-center py-6 mt-12">
    <p class="mb-2"><a href="Logout.html" class="text-blue-400 hover:underline font-semibold">Logout</a></p>
    <p>&copy; 2025 Lusaka Emergency Dispatch System | Designed for Rapid Response</p>
  </footer>

</body>
</html>
