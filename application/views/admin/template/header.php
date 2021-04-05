<?php
	session_start(); 

    if(isset($_SESSION["userPerm"]) && $_SESSION["userPerm"] == 2) {
      // display this page
    }
    else {
      redirect("");
    }

?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Honor Flight - Administration</title>

<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/css/bootstrap.css')?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/css/bootstrap-grid.css')?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/css/bootstrap-reboot.css')?>" />


<script src="<?php echo base_url('assets/internal/js/jquery-3.5.1.js')?>"> </script>
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.js')?>"> </script>
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.bundle.js')?>"> </script>

<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/internal/css/internal.css')?>" />
<script src="<?php echo base_url('assets/internal/js/internal.js')?>"> </script>

<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/DataTables/datatables.css')?>" />
<script src="<?php echo base_url('assets/DataTables/datatables.js')?>"> </script>

</head>
<body>

<div id="adminHeader" class="sidenav">
  <a href="<?php echo base_url('admin')?>">Home</a>
  <a href="<?php echo base_url('teams')?>">Teams</a>
  <a href="<?php echo base_url('documents')?>">Documents</a>
  <a href="<?php echo base_url('reservations')?>">Reservations</a>
  <a href="<?php echo base_url('users')?>">Users</a>
  <a href="<?php echo base_url('users')?>">Veterans</a>
  <a href="<?php echo base_url('user')?>">Personel View</a>
  <a id = "logout" href="<?php echo base_url('')?>">< Logout</a>
</div>

<div id = 'main'> 