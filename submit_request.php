<?php
include 'db.php';
session_start();
if(!isset($_SESSION['user'])){ header("Location: index.php"); exit(); }

if(isset($_POST['submit'])){
  $title = $_POST['title'];
  $desc = $_POST['description'];
  $uid = $_SESSION['user']['id'];
  $stmt = $conn->prepare("INSERT INTO requests (user_id, title, description, status) VALUES (?, ?, ?, 'Submitted')");
  $stmt->bind_param("iss", $uid, $title, $desc);
  if($stmt->execute()){
    header("Location: my_requests.php?success=1"); exit();
  } else {
    echo "Error: " . $conn->error;
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="style.css">
  <title>New Request - UI Ventures</title>
</head>
<body>
<div class="topbar"><b>🎓 UI VENTURES</b><a href="dashboard.php">← Dashboard</a></div>
<div class="container">
  <div class="card">
    <h2>Submit New Request</h2>
    <p style="color:#666">Fill the form below. It will go straight to the Approver's inbox.</p>
    <form method="POST">
      <label>Request Title</label>
      <input name="title" placeholder="e.g. Purchase of Printer for Admin Office" required>
      <label>Details / Justification</label>
      <textarea name="description" rows="5" placeholder="Explain why you need it, quantity, estimated cost..." required></textarea>
      <button name="submit" type="submit" style="width:100%">Submit Request →</button>
    </form>
  </div>
</div>
</body>
</html>