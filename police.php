<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// DB connection
$conn = new mysqli("localhost", "root", "", "emergency_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['full_name'] ?? '';
    $phone = $_POST['phone_number'] ?? '';
    $emergencyType = $_POST['emergency_type'] ?? '';
    $location = $_POST['location'] ?? '';
    $details = $_POST['additional_details'] ?? '';
    $uploadPath = "";

    // Upload file
    if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
        $uploadDir = "uploads/";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $uploadPath = $uploadDir . basename($_FILES["file"]["name"]);
        move_uploaded_file($_FILES["file"]["tmp_name"], $uploadPath);
    }

    // Insert into police_requests
    $sql1 = "INSERT INTO police_requests (full_name, phone_number, emergency_type, location, additional_details, file_path)
             VALUES (?, ?, ?, ?, ?, ?)";
    $stmt1 = $conn->prepare($sql1);

    // Insert into cases
    $sql2 = "INSERT INTO dashboard_cases (type, location, description, status, responder)
             VALUES (?, ?, ?, 'Pending', 'Unassigned')";
    $stmt2 = $conn->prepare($sql2);

    if ($stmt1 && $stmt2) {
        $stmt1->bind_param("ssssss", $name, $phone, $emergencyType, $location, $details, $uploadPath);

        $type = "Police";
        $description = "Name: $name | Phone: $phone | Emergency: $emergencyType | Details: $details";
        $stmt2->bind_param("sss", $type, $location, $description);

        if ($stmt1->execute() && $stmt2->execute()) {
            echo "<script>alert('✅ Police emergency request submitted and added to dashboard!'); window.location.href='Police.html';</script>";
            exit;
        } else {
            echo "❌ Error inserting: " . $stmt1->error . " / " . $stmt2->error;
        }
        $stmt1->close();
        $stmt2->close();
    } else {
        echo "❌ SQL prepare failed: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Police Emergency Request</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      padding: 20px;
      background: lightblue;
    }
    h1 {
      text-align: center;
      color: black;
    }
    form {
      background: #fff;
      padding: 20px;
      border-radius: 8px;
      max-width: 500px;
      margin: auto;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    label {
      display: block;
      margin-top: 15px;
      font-weight: bold;
    }
    input, select, textarea {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    button {
      margin-top: 20px;
      background: #007bff;
      color: #fff;
      padding: 12px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
    }
    button:hover {
      background: #0056b3;
    }
  </style>
</head>
<body>

  <header>
    <h1><marquee direction="left">LUSAKA EMERGENCY DISPATCH SYSTEM</marquee></h1>
  </header>

  <h1>🚓 Request Police Assistance</h1>
  <form action="police.php" method="POST" enctype="multipart/form-data">
    <label for="full_name">Full Name</label>
    <input type="text" id="full_name" name="full_name" required>

    <label for="phone_number">Phone Number</label>
    <input type="tel" id="phone_number" name="phone_number" required>

    <label for="emergency_type">Type of Emergency</label>
    <select id="emergency_type" name="emergency_type" required>
      <option>Theft</option>
      <option>Assault</option>
      <option>Domestic Violence</option>
      <option>Suspicious Activity</option>
      <option>Other</option>
    </select>

    <label for="location">Your Location</label>
    <input type="text" id="location" name="location" required>

    <label for="additional_details">Additional Details</label>
    <textarea id="details" name="additional_details" rows="4" placeholder="Provide more context..."></textarea>

    <label for="file">Upload Photo/Video (optional)</label>
    <input type="file" id="file" name="file" accept="image/*,video/*">

    <button type="submit">Submit Request</button>
  </form>

  <br><br>
  <div style="text-align:center;">
    <a href="Services.html"><button>⬅ Previous</button></a>
    <a href="Services.html"><button>➡ Forward</button></a>
  </div>

  <footer style="text-align:center; margin-top:40px;">
    <li><a href="Logout.html" class="hover:underline font-semibold text-blue-600 transition">Logout</a></li>
    <h4>&copy; 2025 Lusaka Emergency Dispatch System | Designed for rapid response</h4>
  </footer>

</body>
</html>
