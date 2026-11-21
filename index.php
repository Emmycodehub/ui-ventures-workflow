<?php
include 'db.php'; session_start();
if(isset($_POST['login'])){
  $email=$_POST['email']; $pass=$_POST['password'];
  $stmt=$conn->prepare("SELECT * FROM users WHERE email=? AND password=?");
  $stmt->bind_param("ss",$email,$pass); $stmt->execute(); $res=$stmt->get_result();
  if($res->num_rows>0){ $_SESSION['user']=$res->fetch_assoc(); header("Location: dashboard.php"); exit(); }
  else $error="Invalid email or password. Try demo accounts below.";
}
?>
<!DOCTYPE html><html><head><meta name="viewport" content="width=device-width,initial-scale=1"><link rel="stylesheet" href="style.css"><title>UI Ventures | Login</title></head><body>
<div class="login-wrap">
  <div class="login-left"><p style="letter-spacing:2px;font-weight:700;color:#F5B041">UNIVERSITY OF IBADAN</p><h1>UI Ventures<br>Workflow System</h1><p>Digitizing approvals, requests and task tracking for staff, approvers and admin — fast, transparent and paperless.</p><p>✔ Submit Requests &nbsp; ✔ Approve in One Click &nbsp; ✔ Track Status Live</p></div>
  <div class="login-right"><div class="login-form">
    <h2>Welcome Back</h2><p style="color:#666">Login to continue to your dashboard</p>
    <?php if(isset($error)) echo "<p style='color:red;background:#FDE3E3;padding:10px;border-radius:8px'>$error</p>"; ?>
    <form method="POST"><label>Email</label><input type="email" name="email" placeholder="e.g staff@ui.edu.ng" required><label>Password</label><input type="password" name="password" placeholder="••••••" required><button name="login" style="width:100%">Login to Dashboard →</button></form>
    <div style="background:#EEF2F7;padding:12px;border-radius:10px;margin-top:16px;font-size:13px;line-height:1.8"><b>Demo Accounts:</b><br>Admin: admin@ui.edu.ng / 1234<br>Staff: staff@ui.edu.ng / 1234<br>Approver: approver@ui.edu.ng / 1234</div>
  </div></div>
</div></body></html>