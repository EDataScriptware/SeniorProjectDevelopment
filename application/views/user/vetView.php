<?php // echo json_encode($veteran)?>

<h2> <?php echo $veteran[0]->first_name ?> <?php echo $veteran[0]->middle_initial ?>  <?php echo $veteran[0]->last_name ?> </h2>


<div id = "buttonScrollView">
	<button id = "aboutButton" class = "userViewButton" onClick ="showAbout()"> About </button>
	<button id = "resButton" class = "userViewButton" onClick ="showRes()"> Reservations </button>
	<?php if ($_SESSION["userPerm"] = 2)  ?>	<button id = "medButton" class = "userViewButton" onClick ="showMed()"> Medical Info </button> <?php } ?>
	<?php if ($_SESSION["userPerm"] = 2)  ?>	<button id = "acomButton" class = "userViewButton" onClick ="showAcc()"> Accommodations </button> <?php } ?>

</div>


<div id = "about">
	<h3> About </h3>

	<p> DOB: <?php echo $veteran[0]->dob ?>  </p>

	<p> Address: <?php echo $veteran[0]->city ?> <?php echo $veteran[0]->state ?> <?php echo $veteran[0]->zip ?>  </p>

	<p> Day Phone: <?php echo $veteran[0]->day_phone ?>  </p>

	<p> Alt Phone: <?php echo $veteran[0]->cell_phone ?>  </p>

	<h3> Guardian </h3>
	<?php
	$this->db->select("*");
	$this->db->from('guardian');
	$this->db->where('guardian_id',$veteran[0]->guardian_id);

	$guardian = $this->db->get()->result();
	?>
	<p> Name: <?php echo $guardian[0]->first_name ?> <?php echo $guardian[0]->middle_initial ?>  <?php echo $guardian[0]->last_name ?> </p>

	<p> DOB: <?php echo $guardian[0]->dob ?>  </p>

	<p> Relationship: <?php echo $guardian[0]->vet_relationship ?> </p>

	<p> Address: <?php echo $guardian[0]->city ?> <?php echo $guardian[0]->state ?> <?php echo $guardian[0]->zip ?> </p>

	<p> Day Phone: <?php echo $guardian[0]->day_phone ?>  </p>

	<p> Alt Phone: <?php echo $guardian[0]->cell_phone ?>  </p>

	<h2>Veteran Object JSON</h3>
	<?php 
		echo json_encode($fields);
	?>

</div>

<div id = "reservations">
<h3> reservations</h3>

</div>

<div id = "medicalInfo">
<h3>Medical Information</h3>

	<p> DOB: <?php echo $guardian[0]->dob ?>  </p>

</div>

<div id = "accommodations">
<h3>Accommodations </h3>

</div>

<script>
	function showAbout() {
		document.getElementById("about").style.display = "inline-block";
		document.getElementById("reservations").style.display = "none";
		document.getElementById("medicalInfo").style.display = "none";
		document.getElementById("accommodations").style.display = "none";
	}

	function showRes() {
		document.getElementById("about").style.display = "none";
		document.getElementById("reservations").style.display = "inline-block";
		document.getElementById("medicalInfo").style.display = "none";
		document.getElementById("accommodations").style.display = "none";
	}

	function showMed() {
		document.getElementById("about").style.display = "none";
		document.getElementById("reservations").style.display = "none";
		document.getElementById("medicalInfo").style.display = "inline-block";
		document.getElementById("accommodations").style.display = "none";
	}

	function showAcc() {
		document.getElementById("about").style.display = "none";
		document.getElementById("reservations").style.display = "none";
		document.getElementById("medicalInfo").style.display = "none";
		document.getElementById("accommodations").style.display = "inline-block";
	}

</script>
