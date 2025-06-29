<?php
$host = "localhost";
$user = "root"; // your DB username
$pass = "";     // your DB password
$db = "emergency_db"; // your database name

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();
  $user = $result->fetch_assoc();

  if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
    header("Location: profile.php");
    exit();
  } else {
    $error = "Invalid email or password";
  }
}
?>


<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}

$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $full_name = $_POST['full_name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];
  $role = $_POST['role'];

  if (!empty($_POST['password'])) {
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $update = $conn->prepare("UPDATE users SET full_name=?, email=?, phone=?, address=?, role=?, password=? WHERE id=?");
    $update->bind_param("ssssssi", $full_name, $email, $phone, $address, $role, $password, $user_id);
  } else {
    $update = $conn->prepare("UPDATE users SET full_name=?, email=?, phone=?, address=?, role=? WHERE id=?");
    $update->bind_param("sssssi", $full_name, $email, $phone, $address, $role, $user_id);
  }

  $update->execute();
  header("Location: profile.php"); // refresh page
  exit();
}
?>

<!-- HTML Profile Form -->
<!DOCTYPE html>
<html>
<head>
  <title>My Profile</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-100 text-gray-800">

<section class="max-w-4xl mx-auto mt-10 bg-white p-8 rounded-xl shadow-lg">
  <h2 class="text-2xl font-bold mb-6">Update Profile</h2>
  <form method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">
    <div>
      <label class="block mb-1">Full Name</label>
      <input type="text" name="full_name" value="<?= htmlspecialchars($user['full_name']) ?>" class="w-full px-4 py-2 rounded border" required />
    </div>

    <div>
      <label class="block mb-1">Email</label>
      <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" class="w-full px-4 py-2 rounded border" required />
    </div>

    <div>
      <label class="block mb-1">Phone</label>
      <input type="text" name="phone" value="<?= htmlspecialchars($user['phone']) ?>" class="w-full px-4 py-2 rounded border" />
    </div>

    <div>
      <label class="block mb-1">Address</label>
      <input type="text" name="address" value="<?= htmlspecialchars($user['address']) ?>" class="w-full px-4 py-2 rounded border" />
    </div>

    <div>
      <label class="block mb-1">Role</label>
      <select name="role" class="w-full px-4 py-2 rounded border">
        <?php
          $roles = ['Citizen', 'Dispatcher', 'Medical Staff', 'Police Officer', 'Firefighter'];
          foreach ($roles as $role) {
            $selected = ($user['role'] == $role) ? 'selected' : '';
            echo "<option $selected>$role</option>";
          }
        ?>
      </select>
    </div>

    <div>
      <label class="block mb-1">Change Password</label>
      <input type="password" name="password" placeholder="New password" class="w-full px-4 py-2 rounded border" />
    </div>

    <div class="md:col-span-2 mt-4 flex justify-end">
      <button type="submit" class="bg-blue-600 hover:bg-red-700 text-white px-6 py-2 rounded-full font-bold">Save Changes</button>
    </div>
  </form>
</section>

</body>
</html>


<!-- HTML Login Form -->
<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-100 flex items-center justify-center min-h-screen">
  <form method="POST" class="bg-white p-6 rounded-lg shadow-md w-full max-w-md">
    <h2 class="text-xl font-bold mb-4">Login</h2>
    <?php if (isset($error)) echo "<p class='text-red-500 mb-4'>$error</p>"; ?>
    <input name="email" type="email" placeholder="Email" required class="w-full mb-4 px-3 py-2 border rounded" />
    <input name="password" type="password" placeholder="Password" required class="w-full mb-4 px-3 py-2 border rounded" />
    <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">Login</button>
  </form>
</body>
</html>
