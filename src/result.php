<?php
session_start();
include "connection.php";
$theme = isset($_SESSION['theme']) ? $_SESSION['theme'] : 'light';

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
mysqli_set_charset($conn, "utf8mb4");

// Uploading image on form submit
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['profileImage']) && $_FILES['profileImage']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $uniqueName = uniqid() . '_' . basename($_FILES['profileImage']['name']);
    $uploadFile = $uploadDir . $uniqueName;

    if (move_uploaded_file($_FILES['profileImage']['tmp_name'], $uploadFile)) {
        $param = !empty($_SESSION['enrollment_id']) ? $_SESSION['enrollment_id'] : $_SESSION['email'];
        $query = "UPDATE users SET profile_image = ? WHERE " . (!empty($_SESSION['enrollment_id']) ? "enrollment_id = ?" : "email = ?");

        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $uploadFile, $param);

        if ($stmt->execute()) {
            $_SESSION['profile_image'] = $uploadFile;
            echo "<script>alert('Profile image updated successfully.'); window.location.href = 'profile1.php';</script>";
            exit;
        } else {
            echo "<script>alert('Database update failed.');</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('File upload failed.');</script>";
    }
}

// Fetch user info
$user = null;
$param = !empty($_SESSION['enrollment_id']) ? $_SESSION['enrollment_id'] : $_SESSION['email'];
$query = "SELECT fname, email, enrollment_id, profile_image, phone FROM users WHERE " . (!empty($_SESSION['enrollment_id']) ? "enrollment_id = ?" : "email = ?");

$stmt = $conn->prepare($query);
$stmt->bind_param("s", $param);

if ($stmt->execute()) {
    $result = $stmt->get_result();
    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['profile_image'] = $user['profile_image'];
    }
}
$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Result Page</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen ">
    <nav
        class="flex justify-between h-18 bg-white p-4 text-black shadow-lg text-center text-lg font-semibold fixed w-full top-0 z-10">
        <div class="flex items-center">
            <img class="rounded-full size-10" src="Logo.png" alt="Logo">
            <h1 class="pl-2">XamXpress</h1>
        </div>
        <ul class="flex justify-center items-center space-x-10">
            <li><a href="Sdashboard.php">Home</a></li>
            <li><a href="Test_Select.php">Mock Test</a></li>
            <li><a href="result.php">Results</a></li>
            <li><a href="contact1.php">Contact</a></li>
        </ul>
        <div class="relative flex items-center text-center">
        <img id="avatarButton" type="button" data-dropdown-toggle="userDropdown" data-dropdown-placement="bottom-start" class="w-10 h-10 rounded-full cursor-pointer mr-2" src="<?php echo isset($_SESSION['profile_image']) ? htmlspecialchars($_SESSION['profile_image'], ENT_QUOTES, 'UTF-8') : 'user-avtar-modified.png'; ?>" alt="User dropdown">

                <p id="userName" name="name"><?php echo isset($user) ? htmlspecialchars($user['fname'], ENT_QUOTES, 'UTF-8') : 'Guest'; ?></p>

            <div id="userDropdown"
                class="z-10 hidden absolute mr-10 right-0 bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700 dark:divide-gray-600" style="margin-top: 220px;">
                <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                <div id="userEmail" class="font-medium truncate" name="email">
                        <?php echo isset($user) ? htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8') : 'Not logged in'; ?>
                    </div>
                </div>
                <div class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="avatarButton">
                    <a href="profile1.php"
                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Profile</a>
                </div>
                <div class="py-1 flex justify-center items-center">
                    <a href="index.php"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Logout</a>
                    <img src="logout.png" alt="logout" class="w-6 h-6 ml-2">
                </div>
            </div>
        </div>

        <script>
            document.getElementById('avatarButton').addEventListener('click', function (event) {
                event.stopPropagation();
                var dropdown = document.getElementById('userDropdown');
                dropdown.classList.toggle('hidden');
            });

            document.addEventListener('click', function (event) {
                var dropdown = document.getElementById('userDropdown');
                if (!dropdown.classList.contains('hidden')) {
                    dropdown.classList.add('hidden');
                }
            });
            home = () => {
                window.location.href = "index.html";
            }
            contact = () => {
                window.location.href = "contact.html";
            }
        </script>
    </nav>

  <div class="bg-white rounded-2xl shadow-lg p-8 w-full max-w-md">
    <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Exam Result</h2>
    
    <div class="space-y-4 text-gray-700">
      <p><span class="font-semibold">Exam: </span> Physics</p>
      <p><span class="font-semibold">Enrollment ID:</span> STU20250415001</p>
    <div class="flex space-x-2">
      <p id="userName" name="name" class="font-semibold">Name: </p><span><?php echo isset($user) ? htmlspecialchars($user['fname'], ENT_QUOTES, 'UTF-8') : 'Guest'; ?></span>
    </div>
      <p>
        <span class="font-semibold">Status:</span> 
        <span class="text-green-600 font-bold">Pass</span>
        <!-- Use text-red-600 for Fail -->
      </p>
      <p><span class="font-semibold">Score:</span> 87%</p>
    </div>

    <div class="mt-6 bg-yellow-100 border-l-4 border-yellow-400 p-4 rounded-md">
      <p class="font-semibold text-yellow-800 mb-2">Needs Improvement In:</p>
      <ul class="list-disc list-inside text-sm text-yellow-900 space-y-1">
        <li>JEE_MAINS </li>
        <li>MAths</li>
        <li>Chemistry</li>
      </ul>
    </div>
  </div>

</body>
</html>
