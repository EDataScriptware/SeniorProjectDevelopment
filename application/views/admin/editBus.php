<script> $(document).ready( function () {  
    $('#book').addClass('active');
} ); 

<?php foreach($bus_book_data as $bus) { ?>
    $('#bus').DataTable();
<?php } ?> 

</script>

<?php if(isset($bus_data) && isset($team_data)) {
    echo json_encode($bus_data) ;
    echo "<br/>";
    echo json_encode($team_data) ;
} ?>

<button type="button" class="btn btn-primary" onclick="">Create Team</button>

<?php if(isset($bus_data) && isset($team_data)) { ?>
    <hr/>
    <h2>Bus Name: <?php echo $bus_data->name; ?> | Bus ID: <?php echo $bus_data->bus_id; ?></h2>
    <h5>Bus Leader: <?php echo $bus_data->leader_first.' '.$bus_data->leader_last; ?> | Phone: <?php echo $bus_data->leader_phone; ?></h5>
    <h5>Saftey Leader: <?php echo $bus_data->hs_first.' '.$bus_data->hs_last; ?> | Phone: <?php echo $bus_data->hs_phone; ?></h5>
    <h5>Group Leader: <?php echo $bus_data->gl_first.' '.$bus_data->gl_last; ?> | Phone: <?php echo $bus_data->gl_phone; ?></h5>

    <table id="bus" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Team ID</th>
                <th>Misson ID</th>
                <th>Color</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($team_data as $team) { ?>
                <tr>
                    <td><?php echo $team->team_id ;?></td>
                    <td><?php echo $team->mission_id ;?></td>
                    <td><?php echo $team->color;?></td>
                    <td><button type="button" class="btn btn-primary" onclick="location.href='<?php echo base_url('Admin/editBus/'.$bus->bus_id); ?>'" >Edit</button></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } ?>