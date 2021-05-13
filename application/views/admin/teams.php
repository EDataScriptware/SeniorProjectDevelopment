<?php 
//This makes absolutely sure if there are any uncatagorised Veterans or Users, so that the tables are only displayed if neccessary
$unUserCheck = false;
$unVetCheck = false;
?>
<div class = "scrunch"> 
<!-- Iterates through each bus and pulls any relevant users and teams that are associated with it -->
<?php foreach ($bus as $bub): ?>

    <script>
    $(document).ready( function () {
    //programmtically activates each individual user bus table
    $('#<?php echo $bub->bus_id ?>User').DataTable();
} );
    </script>
<script> $(document).ready( function () {  $('#team').addClass('active');} ); </script>

<h2><?php echo $bub->name?> </h2>

  <br>  
<!-- As an example this might be the Bus 1 Staff table -->
<h3> <?php echo $bub->name?> Staff </h3>


<table id="<?php echo $bub->bus_id ?>User"  class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>Role</th>
            <th>Contact Info</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($user as $use): ?>
        <?php if ($use->bus_id == $bub->bus_id) { ?>
    
        <tr>
            <td> <?php echo $use->first_name ?> <?php echo $use->last_name?></td>
            <td> <?php echo $use->user_type?></td>
            <td> <?php echo'Day Phone: '.$use->day_phone.'<br> Cell Phone: '.$use->cell_phone;?> </td>
            <td> <button type="button" class="btn btn-primary" onclick = "moveBlock(<?php echo $use->iduser ?>,'staff')"  > MOVE </button> <button type="button" class="btn btn-danger" onclick = "removeBlock(<?php echo $use->iduser ?>,'staff')"  > REMOVE </button> </td>
        </tr>
        <?php } else if ($use->bus_id == null){$unUserCheck = true;} ?>
        <?php endforeach ?>
    </tbody>
</table>
<!-- Gets all teams relevant to a specific bus and displays each one out as a seperate table (ex: Team Blue Veterans) -->
<?php foreach ($team as $tem): ?>
    <?php if ($tem->bus_id == $bub->bus_id) { ?>

        <script>
    //Programmatically activates each table
    $(document).ready( function () {
    $('#<?php echo $tem->color ?>Vet').DataTable();
    } );
    </script>

<br>  
<h3> Team <?php echo $tem->color ?> Veterans <button type="button" class="btn btn-primary" onclick = "moveTeam(<?php echo $tem->team_id ?>)"  > MOVE </button> </h3>
<table id="<?php echo $tem->color ?>Vet"  class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Veteran</th>
            <th>Veteran Contact Info</th>
            <th>Guardian</th>
            <th>Guardian Contact Info</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($veteran as $vet): ?>
        <?php if ($vet->team_id == $tem->team_id) { ?>

    <?php
    //Inline PHP gets relevant guardian info
	$this->db->select("*");
	$this->db->from('guardian');
	$this->db->where('guardian_id',$vet->guardian_id);

	$guardian = $this->db->get()->result();
	?>
    
        <tr>
            <td> <?php echo $vet->first_name ?> <?php echo$vet->last_name?></td>
            <td> <?php echo 'Day Phone: '.$vet->day_phone ?> <br> <?php echo 'Cell Phone: '.$vet->cell_phone?> </td>
            <td> <?php if ($guardian != null) { echo $guardian[0]->first_name." ".$guardian[0]->last_name; } else {echo "None";}?></td>
            <td> <?php if ($guardian != null) { echo'Day Phone: '.$guardian[0]->day_phone.'<br> Cell Phone: '.$guardian[0]->cell_phone; } else {echo "None";}?> </td>
            <td> <button type="button" class="btn btn-primary" onclick = "moveBlock(<?php echo $vet->veteran_id ?>,'veteran')"  > MOVE </button> <button type="button" class="btn btn-danger" onclick = "removeBlock(<?php echo $vet->veteran_id ?>,'veteran')"  > REMOVE </button> </td>
        </tr>
        <?php } else if ($vet->team_id == null){$unVetCheck = true;} ?>
        <?php endforeach ?>
    </tbody>
</table>

<?php } ?>
<?php endforeach ?>
<hr>

<?php endforeach ?>

<script>
    $(document).ready( function () {
     $('#unVet').DataTable();
    $('#unUser').DataTable();
} );
    </script>
<!-- Uncatigorized staff view, if their on the mission but they don't have an assigned team or bus  -->
<?php if ($unUserCheck == true || $unVetCheck == true) { ?> 
<h2> Uncatagorized Members</h2>

<br>

<?php if ($unUserCheck == true) { ?> 
<h3> Staff</h3>


<table id="unUser"  class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>Role</th>
            <th>Contact Info</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($user as $use): ?>
        <?php if ($use->bus_id == null && $use->user_permissions != '0') { ?>
    
        <tr>
            <td> <?php echo $use->first_name ?> <?php echo $use->last_name?></td>
            <td> <?php echo $use->user_type?></td>
            <td> <?php echo'Day Phone: '.$use->day_phone.'<br> Cell Phone: '.$use->cell_phone;?> </td>
            <td> <button type="button" class="btn btn-primary" onclick = "moveBlock(<?php echo $use->iduser ?>,'staff')"  > MOVE </button> </td>
        </tr>
        <?php } ?>
        <?php endforeach ?>
    </tbody>
</table>

<?php } ?>

<?php if ($unVetCheck == true) { ?> 
<h3> Veterans</h3>

<table id="unVet"  class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Veteran</th>
            <th>Veteran Contact Info</th>
            <th>Guardian</th>
            <th>Guardian Contact Info</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($veteran as $vet): ?>
        <?php if ($vet->team_id == null) { ?>

    <?php
	$this->db->select("*");
	$this->db->from('guardian');
	$this->db->where('guardian_id',$vet->guardian_id);

	$guardian = $this->db->get()->result();
	?>
        <tr>
            <td> <?php echo $vet->first_name ?> <?php echo$vet->last_name?></td>
            <td> <?php echo 'Day Phone: '.$vet->day_phone ?> <br> <?php echo 'Cell Phone: '.$vet->cell_phone?> </td>
            <td> <?php if ($guardian != null) { echo $guardian[0]->first_name." ".$guardian[0]->last_name; } else {echo "None";}?></td>
            <td> <?php if ($guardian != null) { echo'Day Phone: '.$guardian[0]->day_phone.'<br> Cell Phone: '.$guardian[0]->cell_phone; } else {echo "None";}?> </td>
            <td> <button type="button" class="btn btn-primary" onclick = "moveBlock(<?php echo $vet->veteran_id ?>,'veteran')"  > MOVE </button> </td>
        </tr>
        <?php }?>
        <?php endforeach ?>
    </tbody>
</table>
<?php } ?>
<?php } ?>
        

</div>

<!-- Move popups -->

<!-- Moving Individual User -->
<div class="modal fade " tabindex="-1" id="moveUser" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Move a User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form id = 'veteranMoving' style = 'display:none' method ="POST" action='<?php echo base_url('Admin/moveUser/')?> '> 
           <p> Which team do you want to move the veteran too? </p>

            <select name="team_id" id="team_id">
        <?php foreach ($team as $tem): ?>
        <option value="<?php echo $tem->team_id ?>"><?php echo $tem->color ?></option>
        <?php endforeach ?>
        </select>


        </form>


        <form id = 'userMoving' style = 'display:none' method ="POST" action='<?php echo base_url('Admin/moveVeteran/')?> '> 
        <p>     Where do you want to move this staff member? </p>

            <select name="bus_id" id="bus_id">
         <?php foreach ($bus as $bub): ?>
        <option value="<?php echo $bub->bus_id ?>"><?php echo $bub->name ?></option>
        <?php endforeach ?>
        </select>


        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" style='display:none' id ="userBut"  form='userMoving' class="btn btn-primary">Save changes</button>
        <button type="submit" style='display:none' id ="vetBut"  form='veteranMoving' class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<!-- Moving Teams -->
<div class="modal fade " tabindex="-1" id="moveTeam" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Move a Team</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form id = "movingTeam" method ="POST" action='' >

      <p> Where do you want to move the team to? </p>

      <select name="bus_id" id="bus_id">
      <?php foreach ($bus as $bub): ?>
        <option value="<?php echo $bub->bus_id ?>"><?php echo $bub->name ?></option>
        <?php endforeach ?>
        </select>


        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" form="movingTeams">Confirm changes</button>
      </div>
    </div>
  </div>
</div>

<script> 


//Moving functions

//lets you move a team to a different bus
function moveTeam($id) {
document.getElementById("movingTeam").action = "Admin/moveTeam/"+$id
$('#moveTeam').modal('show');
}

//rigs the team modal to either move a veteran or staff member depending on which button pressed
function moveBlock($id, $type) {
 
if ($type === "veteran") {
    document.getElementById("veteranMoving").action = "Admin/moveVeteran/"+$id;

    document.getElementById("veteranMoving").style.display = "block";
    document.getElementById("vetBut").style.display = "block";

    document.getElementById("userMoving").style.display = "none";
    document.getElementById("userBut").style.display = "none";
}

else {
    document.getElementById("userMoving").action = "Admin/moveUser/"+$id;

    document.getElementById("veteranMoving").style.display = "none";
    document.getElementById("vetBut").style.display = "none";

    document.getElementById("userMoving").style.display = "block";
    document.getElementById("userBut").style.display = "block";

}
$('#moveUser').modal('show');
}

//Allows you to remove a specified user OR Veteran, and will return them to the uncatagorized section
function removeBlock($id, $type) {

    if (confirm("Are you sure you want to remove this " + $type + " from the mission? "  )) {
        $.post('Admin/removeType', {id: $id, type: $type}, function () {
        location.reload();

    });
    } else {}
}

</script>