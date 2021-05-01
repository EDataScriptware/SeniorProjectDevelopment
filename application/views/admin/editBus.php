<script> $(document).ready( function () {  
    $('#book').addClass('active');
} ); 


$('#bus').DataTable();
</script>


<?php if(isset($bus_data) && isset($team_data)) { ?>
    <h2>Bus Name: <?php echo $bus_data->name; ?> | Bus ID: <?php echo $bus_data->bus_id; ?></h2>
    <h5>Bus Leader: <?php echo $bus_data->leader_first.' '.$bus_data->leader_last; ?> | Phone: <?php echo $bus_data->leader_phone; ?></h5>
    <h5>Saftey Leader: <?php echo $bus_data->hs_first.' '.$bus_data->hs_last; ?> | Phone: <?php echo $bus_data->hs_phone; ?></h5>
    <h5>Group Leader: <?php echo $bus_data->gl_first.' '.$bus_data->gl_last; ?> | Phone: <?php echo $bus_data->gl_phone; ?></h5>
    <br/>
    <br/>

    <table id="bus" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Color</th>
                <th>Team Leader</th>
                <th>Saftey Leader</th>
                <th>Team ID</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($team_data as $team) { ?>
                <tr>
                    <td><?php echo $team->color;?></td>
                    <td><?php echo $team->leader;?></td>
                    <td><?php echo $team->safety;?></td>
                    <td><?php echo $team->team_id ;?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } ?>
