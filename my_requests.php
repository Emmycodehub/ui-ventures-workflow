<?php
include 'db.php'; session_start();
if(!isset($_SESSION['user'])){ header("Location: index.php"); exit(); }
$user=$_SESSION['user'];
if($user['role']=='staff'){ $stmt=$conn->prepare("SELECT * FROM requests WHERE user_id=? ORDER BY id DESC"); $stmt->bind_param("i",$user['id']); $stmt->execute(); $res=$stmt->get_result(); }
else { $res=$conn->query("SELECT * FROM requests ORDER BY id DESC"); }
?>
<link rel="stylesheet" href="style.css">
<div class="topbar"><b>🎓 UI VENTURES</b><a href="dashboard.php">← Dashboard</a></div>
<div class="container"><div class="card"><h2><?php echo $user['role']=='staff' ? 'My Requests' : 'All Requests'; ?></h2>
<?php if(isset($_GET['success'])) echo "<p style='background:#D9F5E5;padding:12px;border-radius:8px'>✅ Request submitted successfully!</p>"; ?>
<table><tr><th>ID</th><th>Title</th><th>Description</th><th>Status</th><th>Date</th></tr>
<?php while($r=$res->fetch_assoc()){ echo "<tr><td>REQ-".str_pad($r['id'],3,'0',STR_PAD_LEFT)."</td><td><b>".htmlspecialchars($r['title'])."</b></td><td>".htmlspecialchars(substr($r['description'],0,80))."</td><td><span class='badge $r[status]'>$r[status]</span></td><td>$r[created_at]</td></tr>"; } ?>
</table></div></div>