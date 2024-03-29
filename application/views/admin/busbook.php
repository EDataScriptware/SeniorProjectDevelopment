<script> 
$(document).ready( function () {  
    $('#bookNav').addClass('active');
} ); 

<?php foreach($bus_book_data as $bus) { ?>
    $('#<?php echo $bus->bus_book_id; ?>book').DataTable();
<?php } ?> 

</script>

<h1>Bus Book Management</h1>
<hr/>
<p>
  Setting a mission as the "current mission" will display it to staff on the "user portal".  
  If no mission is set as "current", no mission will be displayed to staff.  
  Unsetting the "current mission" will not remove any of the mission's data.  
  Only one mission can be set as the "current mission".
</p>
<hr/>

<?php if(isset($bus_book_data)) {
    foreach($bus_book_data as $mission) { ?>
      <div style="display: inline-flex;">
        <h2><?php echo $mission->title; ?> | &#9;</h2>
        <?php if($mission->show_on_front != 1) { ?>
        <button type="button" class="btn btn-primary" onclick="location.href='<?php echo base_url('Admin/setMission/'.$mission->mission_id); ?>'">Set As "Current Mission"</button>
        <?php } else { ?>
          <button type="button" class="btn btn-danger" onclick="location.href='<?php echo base_url('Admin/unsetCurrentMission/'); ?>'">Unset "Current Mission"</button>
        <?php } ?>
      </div>
        <h4>Start: <?php echo $mission->start_date; ?> | End: <?php echo $mission->end_date; ?></h4>
        <?php if(isset($mission->flight_num)) { ?>
          <h4>Flight Number: <?php echo $mission->flight_num; ?> </h4>
        <?php } ?>
        <br>

        <table id="<?php echo $mission->mission_id; ?>book" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Bus ID</th>
                    <th>Name</th>
                    <th>Leader Name</th>
                    <th>Leader Phone</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                
            <?php
                if(isset($mission->bus)) {
                    foreach($mission->bus as $bus) { ?>
                    <tr>
                        <td><?php echo $bus->bus_id ;?></td>
                        <td><?php echo $bus->name ;?></td>
                        <td><?php echo $bus->leader_first.' '.$bus->leader_last ;?></td>
                        <td><?php echo $bus->leader_phone ;?></td>
                        <td><button type="button" class="btn btn-primary" onclick="location.href='<?php echo base_url('Admin/editBus/'.$bus->bus_id); ?>'" >Details</button></td>
                    </tr>
                <?php } 
                } ?>
            </tbody>
        </table>
        <hr/>
        <br>
    <?php } 
} ?>