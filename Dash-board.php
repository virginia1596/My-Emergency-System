<?php
$conn = new mysqli("localhost", "root", "", "emergency_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$conn = new mysqli("localhost", "root", "", "emergency_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $type = $_POST['type'];
    $location = $_POST['location'];
    $description = $_POST['description'];
    $status = 'Pending';
    $responder = 'Unassigned';

    $stmt = $conn->prepare("INSERT INTO dashboard_cases (type, location, description, status, responder) VALUES (?, ?, ?, ?, ?)");

    $stmt->bind_param("sssss", $type, $location, $description, $status, $responder);
    $stmt->execute();
    $stmt->close();

    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Emergency Dispatch Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


  <style>
    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background-color: #f9f9f9;
    }

    nav {
      background-color: black; 
      padding: 1rem 2rem;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    ul {
      list-style-type: none;
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      margin: 0;
      padding: 0;
    }

    li {
      margin: 0 15px;
    }

    a {
      text-decoration: none;
      color: white;
      font-weight: 600;
      transition: color 0.3s, background-color 0.3s;
      padding: 8px 12px;
      border-radius: 6px;
    }

    a:hover {
      background-color: white;
      color: #0d6efd;
    }

    /* Responsive for mobile */
    @media (max-width: 768px) {
      ul {
        flex-direction: column;
        align-items: center;
      }

      li {
        margin: 10px 0;
      }
    }
  </style>
</head>
<body>

<nav>
  <ul>
    <li><a href="Home.html">Home</a></li>
    <li><a href="register.html">Register</a></li>
    <li><a href="login.html">Login</a></li>
    <li><a href="Services.html">Services</a></li>
    <li><a href="Profile.html">My Profile</a></li>
    <li><a href="About.html">About Us</a></li>
    <li><a href="Contact.html">Contact Us</a></li>
    <li><a href="EmergencyTips.html">Emergency Tips</a></li>
    <li><a href="Dash-board.php">Dashboard</a></li>
  </ul>
</nav>

  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: lightblue;
    }
    .sidebar {
      height: 100vh;
      background-color: #1e293b;
      color: white;
      padding: 1rem;
    }
    .sidebar h4 {
      color: #38bdf8;
    }
    .nav-link {
      color: white;
      margin: 10px 0;
    }
    .nav-link:hover {
      background-color: #334155;
      border-radius: 8px;
      padding: 5px;
    }
    .card {
      border: none;
      border-radius: 1rem;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    }
    .table th {
      background-color: #0ea5e9;
      color: white;
    }
    .floating-btn {
      position: fixed;
      bottom: 30px;
      right: 30px;
      background-color: #0ea5e9;
      color: white;
      border: none;
      border-radius: 50%;
      width: 60px;
      height: 60px;
      font-size: 30px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    }
    #map {
      height: 300px;
      width: 100%;
      border-radius: 10px;
      margin-top: 20px;
    }
  </style>
</head>
<body>
<div class="container-fluid">
  <div class="row">
    <!-- Sidebar -->
    <div class="col-md-2 sidebar d-flex flex-column">
      <h4>Emergency Dispatch System</h4>
      <a href="Dash-board.php" class="nav-link">Dashboard</a>
      <a href="#" class="nav-link">New Cases</a>
      <a href="#" class="nav-link">Assigned Cases</a>
      <a href="#" class="nav-link">Resolved Cases</a>
      <a href="Logout.html" class="nav-link">Log Out</a>
      <hr />
      <p id="clock"></p>
    </div>

    <!-- Main Content -->
    <div class="col-md-10 p-4">
      <h2>Welcome, Officer/Responder</h2>

      <!-- Cards -->
      <div class="row g-4 mt-2">
        <div class="col-md-4">
          <div class="card text-white bg-primary p-3">
            <h5>Police Cases</h5>
            <p>Dynamic Count</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card text-white bg-danger p-3">
            <h5>Fire Cases</h5>
            <p>Dynamic Count</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card text-white bg-success p-3">
            <h5>Medical Cases</h5>
            <p>Dynamic Count</p>
          </div>
        </div>
      </div>

      <!-- Search + Table -->
      <div class="mt-5">
        <div class="d-flex justify-content-between align-items-center mb-2">
          <h4>Recent Emergency Reports</h4>
          <input type="text" id="searchInput" placeholder="Search..." class="form-control w-25" onkeyup="searchTable()">
        </div>
        <table class="table table-bordered table-hover mt-3" id="caseTable">
          <thead>
            <tr>
              <th>#</th>
              <th>Type</th>
              <th>Location</th>
              <th>Description</th>
              <th>Status</th>
              <th>Responder</th>
            </tr>
          </thead>
          <tbody>
            <?php
            
            $result = $conn->query("SELECT * FROM dashboard_cases ORDER BY id DESC");

            if ($result->num_rows > 0):
              while ($row = $result->fetch_assoc()):
            ?>
              <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['type'] ?></td>
                <td><?= $row['location'] ?></td>
                <td><?= $row['description'] ?></td>
                <td><span class="badge bg-<?=
                  $row['status'] === 'Completed' ? 'success' :
                  ($row['status'] === 'Active' ? 'warning' : 'danger')
                ?>"><?= $row['status'] ?></span></td>
                <td><?= $row['responder'] ?></td>
              </tr>
            <?php
              endwhile;
            else:
              echo '<tr><td colspan="6" class="text-center">No cases found.</td></tr>';
            endif;
            ?>
          </tbody>
        </table>
      </div>

      <!-- Analytics -->
      <div class="mt-5">
        <h4>Case Distribution</h4>
        <canvas id="caseChart" height="100"></canvas>
      </div>

      <!-- Map -->
      <div id="map"></div>
    </div>
  </div>
</div>

<!-- Floating Button -->
<button class="floating-btn" data-bs-toggle="modal" data-bs-target="#caseModal">+</button>

<!-- Modal -->
<div class="modal fade" id="caseModal" tabindex="-1" aria-labelledby="caseModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form class="modal-content" method="POST" action="submit_case.php">
      <div class="modal-header">
        <h5 class="modal-title">Report New Case</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input type="text" name="type" class="form-control mb-2" placeholder="Type (Police, Fire, Medical)" required>
        <input type="text" name="location" class="form-control mb-2" placeholder="Location" required>
        <textarea name="description" class="form-control mb-2" placeholder="Description" required></textarea>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Submit Case</button>
      </div>
    </form>
  </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  // Clock
  setInterval(() => {
    document.getElementById('clock').innerText = new Date().toLocaleTimeString();
  }, 1000);

  // Search
  function searchTable() {
    const input = document.getElementById("searchInput").value.toLowerCase();
    const rows = document.querySelectorAll("#caseTable tbody tr");
    rows.forEach(row => {
      row.style.display = row.innerText.toLowerCase().includes(input) ? "" : "none";
    });
  }

  // Chart
  const ctx = document.getElementById('caseChart').getContext('2d');
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Police', 'Fire', 'Medical'],
      datasets: [
        { label: 'Pending', data: [5, 2, 4], backgroundColor: '#facc15' },
        { label: 'Active', data: [3, 1, 2], backgroundColor: '#60a5fa' },
        { label: 'Completed', data: [10, 8, 12], backgroundColor: '#34d399' }
      ]
    },
    options: {
      responsive: true,
      plugins: { legend: { position: 'top' } },
      scales: { y: { beginAtZero: true } }
    }
  });

  // Google Map
  function initMap() {
    const center = { lat: -15.4167, lng: 28.2833 };
    const map = new google.maps.Map(document.getElementById("map"), {
      zoom: 12,
      center: center,
    });
    new google.maps.Marker({ position: center, map: map, title: "Emergency Center" });
  }
</script>
<script async defer
  src="https://maps.googleapis.com/maps/api/js?key=YOUR_GOOGLE_MAPS_API_KEY&callback=initMap">
</script>
</body>
</html>
