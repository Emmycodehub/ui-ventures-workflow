<?php
include 'db.php'; session_start();
if(!isset($_SESSION['user'])){ header("Location: index.php"); exit(); }
$res=$conn->query("SELECT * FROM requests WHERE status='Submitted' ORDER BY id DESC");
?>
<link rel="stylesheet" href="style.css">
<div class="topbar"><b>🎓 UI VENTURES - Task Inbox</b><a href="dashboard.php">← Dashboard</a></div>
<div class="container"><div class="card"><h2>Pending Approvals</h2><p style="color:#666">Review and take action on requests awaiting approval.</p>
<table><tr><th>ID</th><th>Title</th><th>Description</th><th>Action</th></tr>
<?php while($r=$res->fetch_assoc()){ echo "<tr><td>REQ-".str_pad($r['id'],3,'0',STR_PAD_LEFT)."</td><td><b>".htmlspecialchars($r['title'])."</b></td><td>".htmlspecialchars($r['description'])."</td><td><a class='btn btn-green' href='approve.php?id=$r[id]&action=Approved'>Approve</a> <a class='btn btn-red' href='approve.php?id=$r[id]&action=Rejected'>Reject</a></td></tr>"; }
if($res->num_rows==0) echo "<tr><td colspan='4'>No pending requests. All clear! 🎉</td></tr>"; ?>
</table></div></div>