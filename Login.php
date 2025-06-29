<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "emergency_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  $inputPassword = $_POST['password'];

  $sql = "SELECT * FROM register WHERE username = '$username'";
  $result = $conn->query($sql);

  if ($result && $result->num_rows === 1) {
    $row = $result->fetch_assoc();

    if (password_verify($inputPassword, $row['password'])) {
      $_SESSION['username'] = $row['username'];
      $_SESSION['role'] = $row['role'];
      echo "<script>alert('✅ Login successful.'); window.location.href='Home.html';</script>";
    } else {
      $error = "❌ Incorrect password!";
    }
  } else {
    $error = "❌ Username not found!";
  }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login | Lusaka Emergency Dispatch</title>
  <style>
    * {
      box-sizing: border-box;
      font-family: 'Segoe UI', sans-serif;
      margin: 0;
      padding: 0;
    }

    body {
      background: linear-gradient(to right, #b3d9ff, #e6f2ff);
      height: 100vh;
      display: flex;
      flex-direction: column;
      animation: fadeInBody 1.5s ease-in;
    }

    @keyframes fadeInBody {
      from { opacity: 0; }
      to { opacity: 1; }
    }

    .scrolling-text {
      white-space: nowrap;
      overflow: hidden;
      animation: scroll-left 15s linear infinite;
      font-size: 24px;
      font-weight: bold;
      color: black;
      padding: 10px;
      text-align: center;
      background-color: #fff;
    }

    @keyframes scroll-left {
      0% { transform: translateX(100%); }
      100% { transform: translateX(-100%); }
    }

    nav {
      background-color: black;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 10px 20px;
      flex-wrap: wrap;
    }

    .logo img {
      width: 60px;
      height: 60px;
      border-radius: 50%;
      animation: float 3s ease-in-out infinite;
      object-fit: cover;
    }

    @keyframes float {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-7px); }
    }

    .nav-links {
      display: flex;
      flex-wrap: wrap;
      gap: 15px;
    }

    .nav-links a {
      color: white;
      text-decoration: none;
      font-weight: bold;
      font-size: 16px;
      transition: color 0.3s ease;
    }

    .nav-links a:hover {
      color: #ffcc00;
    }

    .login-wrapper {
      flex-grow: 1;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .login-container {
      background-color: white;
      border-radius: 20px;
      padding: 40px 30px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.1);
      max-width: 400px;
      width: 100%;
      animation: fadeInUp 1.2s ease-in;
    }

    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(40px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .login-container h2 {
      text-align: center;
      color: #005a9c;
      margin-bottom: 25px;
    }

    .input-group {
      position: relative;
      margin-bottom: 20px;
    }

    .input-group input {
      width: 100%;
      padding: 14px 12px;
      border: 3px solid #ccc;
      border-radius: 10px;
      background: transparent;
      font-size: 16px;
      transition: 0.3s;
    }

    .input-group label {
      position: absolute;
      top: 12px;
      left: 14px;
      color: #999;
      font-size: 16px;
      pointer-events: none;
      transition: 0.3s;
      background-color: white;
      padding: 0 5px;
    }

    .input-group input:focus,
    .input-group input:valid {
      border-color: #3399ff;
    }

    .input-group input:focus + label,
    .input-group input:valid + label {
      top: -8px;
      left: 10px;
      font-size: 12px;
      color: #005a9c;
    }

    .login-container button {
      width: 100%;
      padding: 12px;
      border: none;
      border-radius: 10px;
      background-color: #005a9c;
      color: white;
      font-size: 16px;
      font-weight: bold;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    .login-container button:hover {
      background-color: #0073e6;
    }

    .error-message {
      color: red;
      text-align: center;
      margin-top: 10px;
    }

    footer {
      background: #20232a;
      color: white;
      text-align: center;
      padding: 15px;
    }

    footer a {
      color: white;
      text-decoration: underline;
    }
  </style>
</head>

<body>
  <!-- Scrolling Text -->
  <div class="scrolling-text">
    🚨 LUSAKA EMERGENCY DISPATCH SYSTEM 🚨
  </div>

  <!-- Navigation Bar with Logo -->
  <nav>
    <div class="logo">
      <img src="Pictures/pic 2.png" alt="Emergency Dispatch Logo">
    </div>
    <div class="nav-links">
      <a href="Home.html">Home</a>
      <a href="Register.html">Register</a>
      <a href="Login.php">Login</a>
      <a href="Services.html">Services</a>
      <a href="Profile.html">My Profile</a>
      <a href="About.html">About Us</a>
      <a href="Contact.html">Contact Us</a>
      <a href="EmergencyTips.html">Emergency Tips</a>
      <a href="Dash-board.php">Dashboard</a>
    </div>
  </nav>

  <!-- Login Form -->
  <div class="login-wrapper">
    <div class="login-container">
      <h2>Login to Dispatch System</h2>
      <form method="POST" action="login.php">
        <div class="input-group">
          <input type="text" id="username" name="username" required />
          <label for="username">Username</label>
        </div>

        <div class="input-group">
          <input type="password" id="password" name="password" required />
          <label for="password">Password</label>
        </div>

        <button type="submit">Login</button>

        <?php if (!empty($error)): ?>
          <p class="error-message"><?php echo $error; ?></p>
        <?php endif; ?>
      </form>
    </div>
  </div>

  <!-- Footer -->
  <footer>
    <a href="Logout.html">Logout</a>
    <p>&copy; 2025 Lusaka Emergency Dispatch System | Designed for rapid response</p>
  </footer>
</body>
</html>

      
      
      
    
     

    
      

    
    
    
        