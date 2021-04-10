<?php 
$unUserCheck = false;
$unVetCheck = false;

?>
<div class = "scrunch"> 
<?php foreach ($bus as $bub): ?>

    <script>
    $(document).ready( function () {
    // $('#<?php // echo $tem->color ?>Vet').DataTable();
    $('#<?php echo $bub->bus_id ?>User').DataTable();
} );
    </script>
<script> $(document).ready( function () {  $('#team').addClass('active');} ); </script>

<h2><?php echo $bub->name?> </h2>

  <br>  
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
        <?php if ($use->bus_id == $bus[0]->bus_id) { ?>
    
        <tr>
            <td> <?php echo $use->first_name ?> <?php echo $use->last_name?></td>
            <td> <?php echo $use->user_type?></td>
            <td> <?php echo'Day Phone: '.$use->day_phone.'<br> Cell Phone: '.$use->cell_phone;?> </td>
            <td> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#moveUser" onclick = "moveBlock(<?php echo $use->iduser ?>,'staff')"  > MOVE </button> <button type="button" class="btn btn-primary" onclick = "removeBlock(<?php echo $use->iduser ?>,'staff')"  > REMOVE </button> </td>
        </tr>
        <?php } else if ($use->bus_id == null){$unUserCheck = true;} ?>
        <?php endforeach ?>
    </tbody>
</table>

<?php foreach ($team as $tem): ?>
    <?php if ($tem->bus_id == $bub->bus_id) { ?>

        <script>
    $(document).ready( function () {
    $('#<?php echo $tem->color ?>Vet').DataTable();
    } );
    </script>

<br>  
<h3> Team <?php echo $tem->color ?> Veterans <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#moveUser" onclick = "moveBlock(<?php echo $use->iduser ?>,'staff')"  > MOVE </button> </h3>
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
            <td> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#moveUser" onclick = "moveBlock(<?php echo $vet->veteran_id ?>,'veteran')"  > MOVE </button> <button type="button" class="btn btn-primary" onclick = "removeBlock(<?php echo $vet->veteran_id ?>,'veteran')"  > REMOVE </button> </td>
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


<button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#addBus" > Add Bus </button>
<button type="button" class="btn btn-primary" onclick = "removeBus()" data-toggle="modal" data-target="#removeBus"  > Remove Bus </button>

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
        <?php if ($use->bus_id == null) { ?>
    
        <tr>
            <td> <?php echo $use->first_name ?> <?php echo $use->last_name?></td>
            <td> <?php echo $use->user_type?></td>
            <td> <?php echo'Day Phone: '.$use->day_phone.'<br> Cell Phone: '.$use->cell_phone;?> </td>
            <td> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#moveUser" onclick = "moveBlock(<?php echo $use->iduser ?>,'staff')"  > MOVE </button> </td>
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
            <td> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#moveUser" onclick = "moveBlock(<?php echo $vet->veteran_id ?>,'veteran')"  > MOVE </button> </td>
        </tr>
        <?php }?>
        <?php endforeach ?>
    </tbody>
</table>
<?php } ?>
<?php } ?>
        

</div>

<!-- Moving Individual User -->
<div class="modal fade " tabindex="-1" id="moveUser" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Move a Veteran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">



      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- Adding Bus -->
<div class="modal fade " tabindex="-1" id="addBus" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Remove a Bus</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">



      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick = "addBus()" >Confirm changes</button>
      </div>
    </div>
  </div>
</div>

<!-- Removing Bus -->
<div class="modal fade " tabindex="-1" id="removeBus" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Remove a Bus</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form id = "busOut">

      <p> Select a Bus you'd like to remove: </p>

      <select name="bus_id" id="bus_id">
      <?php foreach ($bus as $bub): ?>
        <option value="<?php echo $bub->bus_id ?>"><?php echo $bub->name ?></option>
        <?php endforeach ?>
        </select>

        <p> Know this can't be undone. </p>

      </form>

      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" form="busOut">Confirm changes</button>
      </div>
    </div>
  </div>
</div>
<!-- Moving Teams -->
<div class="modal fade " tabindex="-1" id="moveTeam" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Remove a Bus</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <p> Where do you want to move the team to? </p>

        <select name="bus_id" id="bus_id">
        <?php foreach ($bus as $bub): ?>
        <option value="<?php echo $bub->bus_id ?>"><?php echo $bub->name ?></option>
        <?php endforeach ?>
        </select>

      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" form="busOut">Confirm changes</button>
      </div>
    </div>
  </div>
</div>

<script> 
var $holdBusID = null;
var $holdTeamID = null;
var $holdUID = null;
var $holdType = '';


function addBus() {
    $('#addBus').modal('show');
}

function removeBus($id) {
$holdBusID = $id;
$('#removeBus').modal('show');
}


function moveTeam($id) {
$holdTeamID = $id;
$('#moveTeam').modal('show');
}


function moveBlock($id, $type) {
$holdUID = $id;
$holdType = $type;
$('#moveUser').modal('show');
}

function removeBlock($id, $type) {

    if (confirm("Are you sure you want to remove this " + $type + " from the mission? You can undo this."  )) {
        $.post('Admin/removeType', {id: $id, type: $type}, function () {
        location.reload();

    });
    } else {
    
    }


    
}

</script>