<?php
include 'db.php'; session_start();
if(!isset($_SESSION['user'])){ header("Location: index.php"); exit(); }
$user=$_SESSION['user'];
$total=$conn->query("SELECT COUNT(*) c FROM requests")->fetch_assoc()['c'];
$pending=$conn->query("SELECT COUNT(*) c FROM requests WHERE status='Submitted'")->fetch_assoc()['c'];
$approved=$conn->query("SELECT COUNT(*) c FROM requests WHERE status='Approved'")->fetch_assoc()['c'];
$recent=$conn->query("SELECT * FROM requests ORDER BY id DESC LIMIT 5");
?>
<link rel="stylesheet" href="style.css">
<div class="topbar"><b>🎓 UI VENTURES</b><span><?php echo $user['name']; ?> • <?php echo ucfirst($user['role']); ?> &nbsp; <a href="logout.php">Logout</a></span></div>
<div class="container">
  <h2>Dashboard Overview</h2><p style="color:#666">Welcome back, <?php echo $user['name']; ?>. Here is what is happening today.</p>
  <div class="grid"><div class="stat"><small>TOTAL REQUESTS</small><h2><?php echo $total; ?></h2><span>All submissions</span></div><div class="stat" style="border-top-color:#E67E22"><small>PENDING APPROVAL</small><h2><?php echo $pending; ?></h2><span>Waiting for approver</span></div><div class="stat" style="border-top-color:#1E9E62"><small>APPROVED</small><h2><?php echo $approved; ?></h2><span>Ready 
    for processing</span></div></div>
  <div class="card"><h3>Quick Actions</h3>
    
  <?php if($user['role']=='staff'){ ?><a class="btn" href="submit_request.php">+ New Request</a> <a class="btn btn-light" href="my_requests.php">My Requests</a><?php } ?>
    <?php if($user['role']!='staff'){ ?><a class="btn btn-green" href="task_inbox.php">📥 Task Inbox (<?php echo $pending; ?>)</a> <a class="btn btn-light" href="my_requests.php">All Requests</a><?php } ?>
  </div>
  <div class="card"><h3>Recent Requests</h3><table><tr><th>ID</th><th>Title</th><th>Status</th><th>Date</th></tr>
   
  <?php while($r=$recent->fetch_assoc()){ echo "<tr><td>REQ-".str_pad($r['id'],3,'0',STR_PAD_LEFT)."</td><td>".htmlspecialchars($r['title'])."</td><td><span class='badge $r[status]'>$r[status]</span></td><td>$r[created_at]</td></tr>"; } 
  ?>

 </table></div>


 </div>