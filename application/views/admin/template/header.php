<?php
    //CHecks to make sure if you're allowed on this side, otherwise you get kicked back to the login page
    if(isset($_SESSION["userPerm"]) && $_SESSION["userPerm"] == 0) {
      // display this page
    }
    else {
      redirect("");
    }

?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" content="width=device-width, initial-scale=1" name="viewport" >
	<title>Honor Flight - Administration</title>

    <link href="https://getbootstrap.com/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
<!-- Loads in bookstrap style sheets -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/css/bootstrap.css')?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/css/bootstrap-grid.css')?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/css/bootstrap-reboot.css')?>" />
<!-- Loads in Bootstrap and jquery JS  -->
<script src="<?php echo base_url('assets/internal/js/jquery-3.5.1.js')?>"> </script>
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.js')?>"> </script>
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.bundle.js')?>"> </script>

<!-- Internal JS and CSS, you can find them in the assets section to make specific edits -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/internal/css/internal.css')?>" />
<script src="<?php echo base_url('assets/internal/js/internal.js')?>"> </script>

<!-- Loads in Datatables CSS/Jquery  -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/DataTables/datatables.css')?>" />
<script src="<?php echo base_url('assets/DataTables/datatables.js')?>"> </script>

<!-- Navigation style  -->
<style>

        .container
        {
            background-color: #2e353d;
            width:100% !important;
            max-width: 100% !important;
        }

        body
        {
            background-color: whitesmoke;
        }

        table {
          background-color: white !important;
        }
        .odd {
        background-color:  rgba(0, 0, 0, 0.05) !important;
        --bs-table-accent-bg: none !important;
        }

        .table>:not(:last-child)>:last-child>* {
          border-bottom-color: none !important;
        }

       .nav-link
       {
          color: darkgoldenrod;
       }

    </style>


</head>
<body>
<!-- Navigation Div -->
<div class="container">
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
      <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
        <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
        <span class="fs-4"><img src="<?php echo base_url('assets/internal/img/logo.png')?>"></span>
      </a>
  
      <ul class="nav nav-pills">
        <li class="nav-item"><a href="<?php echo base_url('busbook')?>" id = "book" class="nav-link">Bus Book</a></li>
        <li class="nav-item"><a href="<?php echo base_url('teams')?>" id = "team" class="nav-link">Teams</a></li>
        <li class="nav-item"><a href="<?php echo base_url('documents')?>" id = "doc" class="nav-link">Documents</a></li>
        <li class="nav-item"><a href="<?php echo base_url('reservations')?>" id = "rez" class="nav-link">Reservations</a></li>
        <li class="nav-item"><a href="<?php echo base_url('users')?>" id = "use" class="nav-link">Users</a></li>
        <li class="nav-item"><a href="<?php echo base_url('veterans')?>" id = "vet" class="nav-link">Veterans</a></li>
        <li class="nav-item"><a href="<?php echo base_url('guardians')?>" id = "gau" class="nav-link">Guardians</a></li>
        <li class="nav-item"><a href="<?php echo base_url('user')?>" class="nav-link">User Portal</a></li>
        <li class="nav-item"><a href="<?php echo base_url('')?>" class="nav-link">Logout</a></li>
      </ul>
    </header>
  </div>

<!--Main container div  -->
  <div id = "main"> 

  <?php
		$this->db->select("*");
		$this->db->from('mission');
		$mission = $this->db->get()->result();
		?>

<!-- Associated functions and HTML for mission selection -->
<label for="mission_id"> Mission </label>

<select style='display:inline;' name="mission_id" id="mission_id" onchange='swap()'>
<?php foreach ($mission as $miss): ?>
        <option value="<?php echo $miss->mission_id ?>"><?php echo $miss->title ?></option>
        <?php endforeach ?>
</select>
<!-- Sets the current mission ID for the dropdown on launch and gives you the function to change what mission you currently want to look at/edit -->
<script>
  $( document ).ready(function() {
    document.getElementById("mission_id").value = <?php echo $_SESSION['mission']; ?>
});

function swap() {
  var id = document.getElementById("mission_id").value;
  $.post('Admin/changeMission', {id: id}, function (result) {
    location.reload();
                });
}

</script>