<?php
include 'db.php'; session_start();
if(!isset($_SESSION['user'])){ header("Location: index.php"); exit(); }
$id=intval($_GET['id']); $action=$_GET['action']=='Rejected'?'Rejected':'Approved';
$stmt=$conn->prepare("UPDATE requests SET status=? WHERE id=?"); $stmt->bind_param("si",$action,$id); $stmt->execute();
header("Location: task_inbox.php"); exit();
?>