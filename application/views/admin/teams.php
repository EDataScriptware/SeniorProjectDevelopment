<?php foreach ($team as $tem): ?>

    <?php
	$this->db->select("*");
	$this->db->from('bus');
	$this->db->where('bus_id',$tem->bus_id);

	$bus = $this->db->get()->result();
	?>

<h3> <?php echo $tem->color ?> Team - <?php $bus[0]->name?>  </h3>

<script>
    $(document).ready( function () {
    $('#<?php echo $tem->color ?>Vet').DataTable();
    $('#<?php echo $tem->color ?>User').DataTable();
} );
    </script>
<h2> Staff </h2>

<div class = "scrunch"> 
<table id="<?php echo $tem->color ?>User"  class="table table-striped table-bordered">
    <thead>
        <tr>
            <th></th>
            <th>Veteran Contact Info</th>
            <th>Guardian</th>
            <th>Guardian Contact Info</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($user as $use): ?>
        <?php if ($use->bus_id == $bus[0]->bus_id) { ?>
    
        <tr>
            <td> <?php echo $vet->first_name ?> <?php echo$vet->last_name?></td>
            <td> <?php echo 'Day Phone: '.$vet->day_phone ?> <br> <?php echo 'Cell Phone: '.$vet->cell_phone?> </td>
            <td> <?php if ($guardian != null) { echo $guardian[0]->first_name." ".$guardian[0]->last_name; } else {echo "None";}?></td>
            <td> <?php if ($guardian != null) { echo'Day Phone: '.$guardian[0]->day_phone.'<br> Cell Phone: '.$guardian[0]->cell_phone; } else {echo "None";}?> </td>
            <td> <button type="button" class="btn btn-primary" onclick = "moveBlock(<?php echo $vet->veteran_id ?>)"  > MOVE </button> <button type="button" class="btn btn-primary" onclick = "moveBlock(<?php echo $vet->veteran_id ?>)"  > REMOVE </button> </td>

        </tr>
        <?php } ?>
        <?php endforeach ?>
    </tbody>
</table>
</div>


<h2> Veterans </h2>
<div class = "scrunch"> 
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
            <td> <button type="button" class="btn btn-primary" onclick = "moveBlock(<?php echo $vet->veteran_id ?>)"  > MOVE </button> <button type="button" class="btn btn-primary" onclick = "moveBlock(<?php echo $vet->veteran_id ?>)"  > REMOVE </button> </td>

        </tr>
        <?php endforeach ?>
    </tbody>
</table>
</div>

<button type="button" class="btn btn-primary" onclick = "addVetBlock()"  > Add New Vet </button>
<button type="button" class="btn btn-primary" onclick = "addUserBlock()"  > Add New User </button>
<hr>

<?php endforeach ?>


<script> 
function addVetBlock() {

}

function addUserBlock() {

}

function moveBlock() {
    
}

function removeBlock() {
    
}

</script>