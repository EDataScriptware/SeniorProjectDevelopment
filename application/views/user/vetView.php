
<?php $allowed = array(0,1,2); ?>
<h1 style = 'text-align:center'> <b> <?php echo $veteran[0]->first_name ?> <?php echo $veteran[0]->last_name ?> </b> </h1>

<?php $medAccomidations = array("med_cane","med_walker","med_wheelchair","med_scooter",'med_transport_airport','med_transport_trip','med_stairs','med_stand_30min','med_walk_bus_steps','med_use_mobility'); ?>
<?php $medMedication = array('med_emphysema','med_falls','med_heart_disease','med_pacemaker','med_colostomy','med_cancer','med_dnr','med_hbp','med_joint_replacement','med_kidney', 'med_diabetes','med_seizures','med_urostomy','med_dimentia','med_nebulizer','med_oxygen','med_football','med_stroke','med_urinary','med_cpap') ?>


<div class = "buttonScrollView">
	<button id = "aboutBut" class = "scrollItem scrollActive" onClick ="showAbout()"> <i class="fa fa-user fa-3x"></i> <br> <b> About </b></button>
	<button id = "schBut" class = "scrollItem"  onClick ="showRes()"> <i class="fa fa-plane fa-3x"></i>  <br> <b>  Travel</b></button>
	<?php if (in_array($_SESSION["userPerm"], $allowed)) { ?><button id = "medBut" class = "scrollItem" onClick ="showMed()"> <i class="fa fa-medkit fa-3x"></i>  <br> <b> Medical </b></button><?php } ?>
	<button id = "hisBut" class = "scrollItem" onClick ="showAcc()"> <i class="fa fa-history fa-3x"></i>  <br> <b> History </b></button>

</div>

<div id = "about">
<h2> <b> About </b> <?php if ($_SESSION["userPerm"] === '0') { ?>	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong"> EDIT </button>  <?php } ?>  </h2>

	<p> <b> DOB: </b> <?php echo $veteran[0]->dob ?>  </p>

	<p> <b> Gender: </b> <?php echo $veteran[0]->gender ?>  </p>

	<p> <b> Address: </b> <?php echo $veteran[0]->city ?> <?php echo $veteran[0]->state ?> <?php echo $veteran[0]->zip ?>  </p>

	<p> <b> Day Phone: </b> <?php echo $veteran[0]->day_phone ?>  </p>

	<p> <b> Cell Phone: </b> <?php echo $veteran[0]->cell_phone ?>  </p>

	<p> <b> Email: </b> <?php echo $veteran[0]->email ?>  </p>

	<p> <b> Shirt: </b> <?php echo $veteran[0]->shirt_size ?>  </p>

	<hr>

	<h2> <b> Guardian </b> </h2>
	<?php
	$this->db->select("*");
	$this->db->from('guardian');
	$this->db->where('guardian_id',$veteran[0]->guardian_id);

	$guardian = $this->db->get()->result();
	?>
	<p> <b> Name: </b> <?php echo $guardian[0]->first_name ?> <?php echo $guardian[0]->last_name ?> </p>

	<p> <b> DOB: </b> <?php echo $guardian[0]->dob ?>  </p>

	<p> <b> Relationship: </b> <?php echo $guardian[0]->vet_relationship ?> </p>

	<p> <b> Address: </b> <?php echo $guardian[0]->city ?> <?php echo $guardian[0]->state ?> <?php echo $guardian[0]->zip ?> </p>

	<p> <b> Day Phone: </b> <?php echo $guardian[0]->day_phone ?>  </p>

	<p> <b> Cell Phone: </b> <?php echo $guardian[0]->cell_phone ?>  </p>

	<hr>

	<h2> <b> Emergency Contact </b> </h2>

	<p> <b> Name: </b> <?php echo $veteran[0]->emergency_name ?>  </p>

	<p> <b> Relationship: </b> <?php echo $veteran[0]->emergency_relationship ?> </p>

	<p> <b> Address: </b> <?php echo $veteran[0]->emergency_address ?>  </p>

	<p> <b> Day Phone: </b> <?php echo $veteran[0]->emergency_day_phone ?>  </p>

	<p> <b> Cell Phone: </b> <?php echo $veteran[0]->emergency_cell_phone ?>  </p>

	<hr>

	<h2> <b> Comments </b> </h2>
	
	<p> <b> Comments:  </b>  <?php echo $veteran[0]->add_comments?> </p>
	<p> <b> Admin Comments:  </b> <?php echo $veteran[0]->admin_comments?>  </p>

	<hr> 

	<h2> <b> Alt Info </b> </h2>

	<p> <b> Alt Name: </b> <?php echo $veteran[0]->alt_name ?>  </p>

	<p> <b> Alt Relationship: </b> <?php echo $veteran[0]->alt_email ?> </p>

	<p> <b> Alt Phone: </b> <?php echo $veteran[0]->alt_phone ?>  </p>

	<p> <b> Alt Email: </b> <?php echo $veteran[0]->alt_relationship ?>  </p>

</div>

<div id = "reservations">


<?php if ($hotel != null) { ?>
<h2> <b> Hotel Info <?php if ($_SESSION["userPerm"] === '0') { ?>	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal"> EDIT </button>  <?php } ?>  </b> </h2>
<p> <b> Name: </b> <?php echo $hotel[0]->name ?>  </p>
<p> <b> Room No: </b> <?php echo $hotel[0]->room ?>  </p>
<p> <b> Check In: </b> <?php echo $hotel[0]->check_in ?>  </p>
<p> <b> Check Out: </b> <?php echo $hotel[0]->check_out ?>  </p>

<?php } ?>
<?php if ($flight != null) { ?>
<h2> <b> Flight Info </b> </h2>
<p> <b> Airline </b> <?php echo $flight[0]->airline ?>  </p>
<p> <b> Flight No: </b> <?php echo $flight[0]->flight_number ?>  </p>
<p> <b> Departure Date/Time: </b> <?php echo $flight[0]->departure ?>  </p>
<p> <b> Departure Location: </b> <?php echo $flight[0]->departure_location ?>  </p>
<p> <b> Arrival Date/Time: </b> <?php echo $flight[0]->arrival ?>  </p>
<p> <b> Arrival Location: </b> <?php echo $flight[0]->arrival_location ?>  </p>


<?php } ?>
</div>

<div id = "medicalInfo">
<h2> <b> Basic Information </b> <?php if ($_SESSION["userPerm"] === '0') { ?>	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong"> EDIT </button>  <?php } ?>  </h2>

	<?php if ($veteran[0]->med_code != "") { ?>
	<p> <b> Med Code: </b> <div id = 'med<?php echo $veteran[0]->med_code ?>' class = 'medCircle' > </div> <?php echo $veteran[0]->med_code ?> </p>
		<?php  } else { ?>
	<p> <b> Med Code: </b> None </p>
	<?php } ?>

	<?php if ($veteran[0]->diet_restrictions != "") { ?>
	<p> <b> Diet Restrictions: </b> <?php echo $veteran[0]->diet_restrictions ?> </p>
		<?php  } else { ?>
	<p> <b> Diet Restrictions: </b> None </p>
	<?php } ?>

	<hr>

	<h2> <b> Medication </b> </h2>

	<?php if ($veteran[0]->med_list != '') {
			echo '<h4> <b> Medication List </b> </h4>';
			echo $veteran[0]->med_list;
		} ?>

		<?php if ($veteran[0]->med_when_use != '') {
			echo '<h4> <b> When to use Medication </b> </h4>';
			echo $veteran[0]->med_when_use;
		} ?>

	<?php if ($veteran[0]->med_flow_rate != '') {
			echo '<h4> <b> Flow Rate </b> </h4>';
			echo $veteran[0]->med_flow_rate;
		} ?>

		<?php if ($veteran[0]->med_others != '') {
			echo '<h4> <b> Other Conditions </b> </h4>';
			echo $veteran[0]->med_others;
		} ?>

	<hr>

		<h2> <b> Mobility </b> </h2>

		<?php foreach ($medAccomidations as $accomidations): ?>
		<?php if ($veteran[0]->$accomidations == 1) {
			if ($accomidations === "med_walk_bus_steps") {
				echo "Bus Steps: Yes";
			}
			else {
				echo "<b>". str_replace('_', ' ',ucfirst(substr($accomidations,4)))." </b>: Yes";
			}
			echo '<br>';
		}
		?>
	<?php endforeach ?>

	<?php if ($veteran[0]->med_chair_loc != '') {
				echo " <b> Medical Chair Location: </b>".$veteran[0]->med_chair_loc;
			echo '<br>';
		}
		?>

	<hr>

	<h2> <b> Conditions </b> </h2>

	<?php foreach ($medMedication as $medication): ?>
		<?php if ($veteran[0]->$medication == 1) {
			echo "<b>".  str_replace('_', ' ',ucfirst(substr($medication,4)))." </b>: Yes";
			echo '<br>';
		} ?>

	<?php endforeach ?>

</div>

<div id = "accommodations">
<h2> <b> History </b> <?php if ($_SESSION["userPerm"] === '0') { ?>	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong"> EDIT </button>  <?php } ?> </h2>
	
<h2> <b> Veteran History </b> </h2>

	<p> <b> Service Branch: </b> <?php echo $veteran[0]->service_branch ?>  </p>

	<p> <b> Rank : </b> <?php echo $veteran[0]->service_rank ?> </p>
	<?php $getter = ""; ?>
	<p> <b> War(s) Served: </b> <?php if($veteran[0]->service_ww2 == 1) { $getter .='World War 2,'; } ?> <?php if($veteran[0]->service_korea == 1) { $getter .='Korean War,'; } ?> <?php if($veteran[0]->service_cold_war == 1) { $getter .='Cold War,'; } ?> <?php if($veteran[0]->service_vietnam == 1) { $getter .='Vietnam,'; } ?>
                <?php echo substr($getter, 0, -1); ?></p>

	<p> <b> Job: </b> <?php echo $veteran[0]->service_activity?>  </p>

	<hr>

	<h2> <b> Infomation History </b> </h2>

<p> <b> Last Updated: </b> <?php echo $veteran[0]->admin_comments ?>  </p>




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
		<textarea id="add_comments" name="add_comments"><?php echo $veteran[0]->add_comments; ?></textarea>

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

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModal" aria-hidden="true">
  <div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Edit Hotel Info</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form id ="editHotel" method='POST' action='<?php echo base_url('User/updateHotelInfo/'.$veteran[0]->veteran_id); ?>' >

        <label for="name">Hotel Name:</label>
 
            <input type="text" id="name" name="name" required size="10"> <br>

        <label for="veteran_id">Veteran:</label>

            <input type="text" list='veterans' id="veteran_id" name="veteran_id" required size="10"> <br>

        <label for="room">Room:</label>

            <input type="text" id="room" name="room" required size="10"> <br>

        <label for="check_in">Check-In Time:</label>

            <input type="datetime-local" id="check_in" name="check_in">  <br>

        <label for="check_out">Check-Out Time:</label>

            <input type="datetime-local" id="check_out" name="check_out">  <br>
          
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id='editHotelBut' form ="editHotel">Edit Hotel Entry</button>
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
