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
  $( function() {$( "#eventTeam<?php echo $tem->color ?>" ).accordion();} );
    </script>
</script>

<h3> Team <?php echo $tem->color ?> Events </h3>
<div id="eventTeam<?php echo $tem->color ?>"  class="table table-striped table-bordered">

<?php foreach ($event as $eve): ?>
        <?php if ($eve->team_id == $tem->team_id) { ?>
            <h3> <?php echo $eve->title ?>  </h3>
            <div>
            <p> <?php echo $eve->description ?>  </p>
            <p> <?php echo date_format(date_create($eve->date),"Y/m/d"); ?>  </p>
            <p> <?php echo date_format(date_create($eve->start),"h:i A"); ?>  </p>
            <p> <?php echo date_format(date_create($eve->end),"h:i A"); ?>  </p>
            <p> <button type="button" class="btn btn-primary" onclick = "editBlock(<?php echo $eve->event_id ?>,'event')"  > EDIT </button> <button type="button" class="btn btn-danger" onclick = "removeBlock(<?php echo $eve->event_id ?>,'event')"  > REMOVE </button> </p>
        </tr>
        </div>
        <?php } ?>
        <?php endforeach ?>

</div>


<?php endforeach ?>