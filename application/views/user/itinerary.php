<script> $(document).ready( function () {  
    $('#itinerary').addClass('active');
} ); 
</script>

<h2> <b> Itinerary </b> </h2>

<div class = "buttonScrollView">
<?php foreach ($allTeams as $team): ?>
	<button id = "<?php echo strtolower($team->color) ?>" class = "scrollItem <?php echo strtolower($team->color) ?>" onClick ="showAbout()"> <i class="fa fa-flag fa-3x"></i> <br> <b> <?php echo $team->color ?> </b></button>

    <?php endforeach; ?>
</div>



<?php foreach ($allTeams as $tem): ?>
    <script>
    $(document).ready( function () {
    $('#eventTeam<?php echo $tem->color ?>').DataTable();
    } );
    </script>
</script>

<h3> Team <?php echo $tem->color ?> Events </h3>
<table id="eventTeam<?php echo $tem->color ?>"  class="table table-striped table-bordered">
<thead>
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Date</th>
            <th>Start Time</th>
            <th>End time</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($event as $eve): ?>
        <?php if ($eve->team_id == $tem->team_id) { ?>
        <tr>
            <td> <?php echo $eve->title ?>  </td>
            <td> <?php echo $eve->description ?>  </td>
            <td> <?php echo date_format(date_create($eve->date),"Y/m/d"); ?>  </td>
            <td> <?php echo date_format(date_create($eve->start),"h:i A"); ?>  </td>
            <td> <?php echo date_format(date_create($eve->end),"h:i A"); ?>  </td>
            <td> <button type="button" class="btn btn-primary" onclick = "editBlock(<?php echo $eve->event_id ?>,'event')"  > EDIT </button> <button type="button" class="btn btn-danger" onclick = "removeBlock(<?php echo $eve->event_id ?>,'event')"  > REMOVE </button> </td>
        </tr>
        <?php } ?>
        <?php endforeach ?>
    </tbody>
</table>


<?php endforeach; ?>