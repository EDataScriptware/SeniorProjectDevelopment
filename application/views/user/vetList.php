

<?php // echo json_encode($veteran)?>

<button id = "teamButton" class = "userViewButton" onClick ="showTeam()"> Team View</button>
<button id = "busButton" class = "userViewButton" onClick ="showBus()"> Bus view </button>

<div id = "teamView"> 



<?php if ($id != null) { ?>
<div class = "teamListView">


	<h3> <?php echo $team->color ?> Team View </h3>

<?php foreach ($veteran as $vet): ?>
	<a href="<?php echo base_url('vetView'. '/'. $vet->veteran_id) ?>" class="teamListElement"><?php echo $vet->first_name ?> <?php echo$vet->last_name?></a>
<?php endforeach ?>
<?php } else { ?>

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

</div>

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


	<script>
			function showTeam() {
		document.getElementById("teamView").style.display = "inline-block";
		document.getElementById("busView").style.display = "none";

	}

	function showBus() {
		document.getElementById("teamView").style.display = "none";
		document.getElementById("busView").style.display = "inline-block";

	}

	</script>