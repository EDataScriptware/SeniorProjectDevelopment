<script> $(document).ready( function () {  
    $('#itinerary').addClass('active');
} ); 
</script>

<h2> <b> Itinerary </b> </h2>

<div class = "buttonScrollView">
<?php foreach ($allTeams as $team): ?>
	<button id = "<?php echo strtolower($team->color) ?>" class = "scrollItem <?php echo strtolower($team->color) ?>" onClick ="show<?php echo $team->color ?>()"> <i class="fa fa-flag fa-3x"></i> <br> <b> <?php echo $team->color ?> </b></button>

    <script>
        function show<?php echo $team->color ?>() {
            
        }

    </script>

    <?php endforeach; ?>
</div>

<?php $first = true; ?>

<?php foreach ($allTeams as $tem): ?>
    <?php if ($first === true) { ?>
    <div id = "eventCon<?php echo $tem->color ?>"> 
    <?php 
    $first = false; 
        } else { ?>
        <div id = "eventCon<?php echo $tem->color ?>" style='display:none'> 
    <?php } ?>
    <script>
  $( function() {
      $("#eventTeam<?php echo $tem->color ?>" ).accordion({heightStyle: "content",collapsible: true,active: false });
  });
    </script>
</script>

<h3> Team <?php echo $tem->color ?> Events </h3>
<div id="eventTeam<?php echo $tem->color ?>"  class="table table-striped table-bordered">

<?php foreach ($event as $eve): ?>
        <?php if ($eve->team_id == $tem->team_id) { ?>
            <h3> <?php echo $eve->title ?>  </h3>
            <div>
            <p> <b>Description: </b> <?php echo $eve->description ?>  </p>
            <p> <b>Date: </b>  <?php echo date_format(date_create($eve->date),"Y/m/d"); ?>  </p>
            <p> <b>Start: </b>  <?php echo date_format(date_create($eve->start),"h:i A"); ?>  </p>
            <p> <b>End: </b>  <?php echo date_format(date_create($eve->end),"h:i A"); ?>  </p>
            <p> <b>Actions: </b>  <button type="button" class="btn btn-primary" onclick = "editBlock(<?php echo $eve->event_id ?>,'event')"  > EDIT </button> <button type="button" class="btn btn-danger" onclick = "removeBlock(<?php echo $eve->event_id ?>,'event')"  > REMOVE </button> </p>
        </tr>
        </div>
        <?php } ?>
        <?php endforeach ?>

</div>

</div>
<?php endforeach ?>