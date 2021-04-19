

<?php // echo json_encode($veteran)?>
<div class="btn-group text-center">
<button  type="button" id = "teamButton" class="btn btn-primary" onClick ="showTeam()">Team</button>
<?php if ($id === null) { ?> <button  type="button" id = "busButton" class="btn btn-primary" onClick ="showBus()"> Bus </button> <?php } ?>
<button  type="button" id = "staffButton" class="btn btn-primary" onClick ="showStaff()"> Staff </button>
</div>
<div id = "teamView"> 



<?php if ($id != null) { ?>
	<script> $(document).ready( function () {  
    $('#teams').addClass('active');
} ); 
</script>
<div class = "teamListView">


	<h3> <?php echo $team->color ?> Team View </h3>

<?php foreach ($veteran as $vet): ?>
	<a href="<?php echo base_url('vetView'. '/'. $vet->veteran_id) ?>" class="teamListElement"><?php echo $vet->first_name ?> <?php echo$vet->last_name?></a>
<?php endforeach ?>
<?php } else { ?>

	<script> $(document).ready( function () {  
    $('#home').addClass('active');
} ); 
</script>

<?php foreach ($team as $tem): ?>

	<h3> <?php echo $tem->color ?> Team View </h3>

<?php foreach ($veteran as $vet): ?>
	<?php if ($vet->team_id === $tem->team_id) { ?>
	<a href="<?php echo base_url('vetView'. '/'. $vet->veteran_id) ?>" class="teamListElement"><?php echo $vet->first_name ?> <?php echo$vet->last_name?></a>
	<?php  }?>
<?php endforeach ?>

<?php endforeach ?>
	<?php } ?>
</div>

<?php if ($id === null) { ?>
<div id = "busView">
	<?php foreach ($bus as $b): ?>

<h3> <?php echo $b->name ?> View </h3>

<?php foreach ($veteran as $vet): ?>
<?php if ($vet->bus_id === $b->bus_id) { ?>
<a href="<?php echo base_url('vetView'. '/'. $vet->veteran_id) ?>" class="teamListElement"><?php echo $vet->first_name ?> <?php echo$vet->last_name?></a>
	<?php  }?>
	<?php endforeach ?>

	<?php endforeach ?>

	</div>
<?php } ?>

	<div style="display:none" id = "staffView">

	</div>


	<script>
			function showTeam() {
		document.getElementById("teamView").style.display = "inline-block";
		document.getElementById("busView").style.display = "none";
		document.getElementById("staffView").style.display = "none";

	}

	function showBus() {
		document.getElementById("teamView").style.display = "none";
		document.getElementById("busView").style.display = "inline-block";
		document.getElementById("staffView").style.display = "none";

	}

	function showStaff() {
		document.getElementById("teamView").style.display = "none";
		document.getElementById("busView").style.display = "none";
		document.getElementById("staffView").style.display = "inline-block";

	}

	</script>