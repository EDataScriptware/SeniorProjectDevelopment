
<?php $allowed = array(0,1); ?>
<h1 style = 'text-align:center'> <b> <?php echo $veteran[0]->first_name ?> <?php echo $veteran[0]->last_name ?> </b> </h1>

<?php $medAccomidations = array("med_cane","med_walker","med_wheelchair","med_scooter",'med_transport_airport','med_transport_trip','med_stairs','med_stand_30min','med_walk_bus_steps','med_use_mobility'); ?>
<?php $medMedication = array('med_emphysema','med_falls','med_heart_disease','med_pacemaker','med_colostomy','med_cancer','med_dnr','med_hbp','med_joint_replacement','med_kidney', 'med_diabetes','med_seizures','med_urostomy','med_dimentia','med_nebulizer','med_oxygen','med_football','med_stroke','med_urinary','med_cpap') ?>

<?php $about = array('dob','gender','weight','city','state','zip','day_phone','cell_phone','email','shirt_size'); ?>
<?php $emergency = array ('emergency_name','emergency_relationship','emergency_address', 'emergency_day_phone', 'emergency_cell_phone') ?>
<?php $comments = array ('add_comments','admin_comments') ?>
<?php $alternative = array ('alt_name','alt_email','alt_phone','alt_relationship') ?>
<?php $mobility = array ("med_cane","med_walker","med_wheelchair","med_scooter",'med_transport_airport','med_transport_trip','med_stairs','med_stand_30min','med_walk_bus_steps','med_use_mobility') ?>
<?php $conditions = array ('med_emphysema','med_falls','med_heart_disease','med_pacemaker','med_colostomy','med_cancer','med_dnr','med_hbp','med_joint_replacement','med_kidney', 'med_diabetes','med_seizures','med_urostomy','med_dimentia','med_nebulizer','med_oxygen','med_football','med_stroke','med_urinary','med_cpap') ?>


<div class = "buttonScrollView">
	<button id = "aboutBut" class = "scrollItem scrollActive" onClick ="showAbout()"> <i class="fa fa-user fa-3x"></i> <br> <b> About </b></button>
	<button id = "schBut" class = "scrollItem"  onClick ="showRes()"> <i class="fa fa-calendar fa-3x"></i>  <br> <b>  Schedule </b></button>
	<?php if (in_array($_SESSION["userPerm"], $allowed)) { ?><button id = "medBut" class = "scrollItem" onClick ="showMed()"> <i class="fa fa-medkit fa-3x"></i>  <br> <b> Medical </b></button><?php } ?>
	<?php if (in_array($_SESSION["userPerm"], $allowed)) { ?><button id = "hisBut" class = "scrollItem" onClick ="showAcc()"> <i class="fa fa-history fa-3x"></i>  <br> <b> History </b></button> <?php } ?>

</div>

<div id = "about">
<h2> <b> About </b> <?php if ($_SESSION["userPerm"] === '0') { ?>	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong"> EDIT </button>  <?php } ?>  </h2>

	<p> <b> DOB: </b> </p>

	<p style="float: right; margin-right: 100px;" > <?php echo $veteran[0]->dob ?>   </p>

	<br>

	<p> <b> Address: </b> <?php echo $veteran[0]->city ?> <?php echo $veteran[0]->state ?> <?php echo $veteran[0]->zip ?>  </p>


<p> Day Phone: <?php echo $veteran[0]->day_phone ?>  </p>

	<p> Alt Phone: <?php echo $veteran[0]->cell_phone ?>  </p>

	<h3> Guardian </h3>
	<?php
	$this->db->select("*");
	$this->db->from('guardian');
	$this->db->where('guardian_id',$veteran[0]->guardian_id);

	$guardian = $this->db->get()->result();
	?>
	<p> Name: <?php echo $guardian[0]->first_name ?> <?php echo $guardian[0]->last_name ?> </p>

	<p> DOB: <?php echo $guardian[0]->dob ?>  </p>

	<p> Relationship: <?php echo $guardian[0]->vet_relationship ?> </p>

	<p> Address: <?php echo $guardian[0]->city ?> <?php echo $guardian[0]->state ?> <?php echo $guardian[0]->zip ?> </p>

	<p> Day Phone: <?php echo $guardian[0]->day_phone ?>  </p>

	<p> Alt Phone: <?php echo $guardian[0]->cell_phone ?>  </p>

	
	<?php if ($veteran[0]->add_comments != "") { ?>
	<h3> Additional Information: </h3>
	<p> <?php echo $veteran[0]->add_comments?> </p>
	<?php } ?>

</div>

<div id = "reservations">
<h2> Schedule <?php if ($_SESSION["userPerm"] === '0') { ?>	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong"> EDIT </button>  <?php } ?>  </h2>

</div>

<div id = "medicalInfo">
<h2> Medical Info <?php if ($_SESSION["userPerm"] === '0') { ?>	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong"> EDIT </button>  <?php } ?>  </h2>

	<p> DOB: <?php echo $veteran[0]->dob ?>  </p>

	<?php if ($veteran[0]->med_code != "") { ?>
	<h3> Med Code: <div id = 'med<?php echo $veteran[0]->med_code ?>' class = 'medCircle' > </div> <?php echo $veteran[0]->med_code ?>
		<?php  }?>
	<h4> Conditions </h4>	

	<?php foreach ($medMedication as $medication): ?>
		<?php if ($veteran[0]->$medication == 1) {
			echo str_replace('_', ' ',ucfirst(substr($medication,4)));
			echo '<br>';
		} ?>

	<?php endforeach ?>

	<?php if ($veteran[0]->med_list != '') {
			echo '<h4> Medication List </h4>';
			echo $veteran[0]->med_list;
		} ?>

		<?php if ($veteran[0]->med_when_use != '') {
			echo '<h4> When to use Medication </h4>';
			echo $veteran[0]->med_when_use;
		} ?>

<?php if ($veteran[0]->med_flow_rate != '') {
			echo '<h4> Flow Rate </h4>';
			echo $veteran[0]->med_flow_rate;
		} ?>

		<?php if ($veteran[0]->med_others != '') {
			echo '<h4> Other Conditions </h4>';
			echo $veteran[0]->med_others;
		} ?>
</div>

<div id = "accommodations">
<h2>History <?php if ($_SESSION["userPerm"] === '0') { ?>	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong"> EDIT </button>  <?php } ?> </h2>
<?php foreach ($medAccomidations as $accomidations): ?>
		<?php if ($veteran[0]->$accomidations == 1) {
			if ($accomidations === "med_walk_bus_steps") {
				echo "Needs help with walking up/down bus steps";
			}
			else {
				echo str_replace('_', ' ',ucfirst(substr($accomidations,4)));
			}
			echo '<br>';
		}
		?>
	<?php endforeach ?>

	<?php if ($veteran[0]->med_chair_loc != '') {
				echo "Medical Chair Location: ".$veteran[0]->med_chair_loc;
			echo '<br>';
		}
		?>


</div>

<!-- Modal -->
<div class="modal fade " id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modify Veteran Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <form  id = "update" method ="POST" action='<?php echo base_url('User/updateInfo/'.$veteran[0]->veteran_id); ?>'>

	
	  <h3> About </h3>

		<p> <b> Address: </b></p>
		<p>  <label for="city"> City: </label> <input type="text" id="city" name="city" class = "infoInput" value = "<?php echo $veteran[0]->city ?>" > </p>
		<p>  <label for="state">  State: </label> <input type="text" id="state" name="state" class = "infoInput" value ='<?php echo $veteran[0]->state ?>'> </p>
		<p>  <label for="zip"> Zip: </label> <input type="text" id="zip" name="zip" class = "infoInput" value = '<?php echo $veteran[0]->zip ?>'> </p>
		
		<p> <b> Contact: </b></p>
		<p> <label for="dPhone"> Day Phone: </label> <input type="text" id="day_phone" name="day_phone" class = "infoInput" value = "<?php echo $veteran[0]->day_phone ?>" >   </p>

		<p> <label for="aPhone"> Alt Phone: </label> <input type="text" id="cell_phone" name="cell_phone" class = "infoInput" value = "<?php echo $veteran[0]->cell_phone ?>" >   </p>

		<p> <b> Additional Information: </b></p>
		<textarea id="add_comments" name="add_comments" rows="4" cols="50"><?php echo $veteran[0]->add_comments; ?></textarea>

		<h3>Medical Information</h3>

	<?php if ($veteran[0]->med_code != "") { ?>
	<h3> Med Code: <div id = 'med<?php echo $veteran[0]->med_code ?>' class = 'medCircle' > </div> <?php echo $veteran[0]->med_code ?>
		<?php  }?>
	<h4> Conditions </h4>	

	<?php foreach ($medMedication as $medication): ?>
		<?php if ($veteran[0]->$medication == 1) {
			echo str_replace('_', ' ',ucfirst(substr($medication,4))).": <input type='checkbox' id='$medication' class='checker' name='$medication' checked='checked' value='1'>";
			echo '<br>';
		} else {
			echo str_replace('_', ' ',ucfirst(substr($medication,4))).": <input type='checkbox' id='$medication' class='checker' name='$medication'  value='1'>";
			echo '<br>';

		} ?>

	<?php endforeach ?>

	<h4> Medication List: </h4>
	<textarea id="med_list" name="med_list" ><?php echo $veteran[0]->med_list; ?></textarea> 

	<h4> When to use Medication: </h4>
	<textarea id="med_when_use" name="med_when_use" ><?php echo $veteran[0]->med_when_use; ?></textarea>

	<h4> Flow Rate: </h4>
	<textarea id="med_flow_rate" name="med_flow_rate" ><?php echo $veteran[0]->med_flow_rate; ?></textarea>

	<h4> Other Conditions: </h4>
	<textarea id="med_others" name="med_others" ><?php echo $veteran[0]->med_others; ?></textarea>

	<h3>Accommodations </h3>
	<?php foreach ($medAccomidations as $accomidations): ?>
		<?php if ($veteran[0]->$accomidations == 1) {
				echo str_replace('_', ' ',ucfirst(substr($accomidations,4))).": <input type='checkbox' id='$accomidations' class='checker' name='$accomidations' checked='checked' value='1'>"   ;
				echo '<br>';
		}else {
			echo str_replace('_', ' ',ucfirst(substr($accomidations,4))).": <input type='checkbox' id='$accomidations' class='checker' name='$accomidations'  value='1'>"   ;
			echo '<br>';
		}?>
	<?php endforeach ?>

	<h4> Medical Chair Location: </h4>
	<textarea id="med_chair_loc" name="med_chair_loc" ><?php echo $veteran[0]->med_chair_loc; ?></textarea>


	</form>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" form="update">Save changes</button>
      </div>

    </div>
  </div>
</div>

<script>

$(document).ready(function() {

	  // on form submit
        $("#update").on('submit', function() {
            // to each unchecked checkbox
            $(this).find('input[type=checkbox]:not(:checked)').prop('checked', true).val(0);
        })	
 
    });


	function showAbout() {
		document.getElementById("about").style.display = "inline-block";
		document.getElementById("reservations").style.display = "none";
		document.getElementById("medicalInfo").style.display = "none";
		document.getElementById("accommodations").style.display = "none";

		$("#aboutBut").removeClass("scrollActive");
		$("#schBut").removeClass("scrollActive");
		$("#medBut").removeClass("scrollActive");
		$("#hisBut").removeClass("scrollActive");

		$("#aboutBut").addClass("scrollActive");

	}

	function showRes() {
		document.getElementById("about").style.display = "none";
		document.getElementById("reservations").style.display = "inline-block";
		document.getElementById("medicalInfo").style.display = "none";
		document.getElementById("accommodations").style.display = "none";

		$("#aboutBut").removeClass("scrollActive");
		$("#schBut").removeClass("scrollActive");
		$("#medBut").removeClass("scrollActive");
		$("#hisBut").removeClass("scrollActive");

		$("#schBut").addClass("scrollActive");

	}

	function showMed() {
		document.getElementById("about").style.display = "none";
		document.getElementById("reservations").style.display = "none";
		document.getElementById("medicalInfo").style.display = "inline-block";
		document.getElementById("accommodations").style.display = "none";

		$("#aboutBut").removeClass("scrollActive");
		$("#schBut").removeClass("scrollActive");
		$("#medBut").removeClass("scrollActive");
		$("#hisBut").removeClass("scrollActive");

		$("#medBut").addClass("scrollActive");

	}

	function showAcc() {
		document.getElementById("about").style.display = "none";
		document.getElementById("reservations").style.display = "none";
		document.getElementById("medicalInfo").style.display = "none";
		document.getElementById("accommodations").style.display = "inline-block";

		$("#aboutBut").removeClass("scrollActive");
		$("#schBut").removeClass("scrollActive");
		$("#medBut").removeClass("scrollActive");
		$("#hisBut").removeClass("scrollActive");

		$("#hisBut").addClass("scrollActive");

	}

</script>
