<?php

include 'db.php';
session_start();
if(!isset($_SESSION['user'])){ header("Location: index.php"); exit(); }
$user = $_SESSION['user'];

if(isset($_POST['submit'])){
  $title = $_POST['title'];
  $desc = $_POST['description'];
  $email = $user['email'];

  $conn->query("INSERT INTO requests (title, description, initiator_email) VALUES ('$title','$desc','$email')");
  $req_id = $conn->insert_id;

  // Automatically create task for approver
  $conn->query("INSERT INTO tasks (request_id, assigned_to) VALUES ('$req_id','approver@ui.edu.ng')");

  echo "Request submitted! Your ID na REQ-00".$req_id;
}
?>
<h2>Submit New Request</h2>
<form method="POST">
  <input type="text" name="title" placeholder="Request Title e.g Procurement Request" required><br><br>
  <textarea name="description" placeholder="Describe the request" required></textarea><br><br>
  <button name="submit">Submit Request</button>
</form>
<br><a href="dashboard.php">Back to Dashboard</a>