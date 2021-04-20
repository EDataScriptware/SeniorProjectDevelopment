<script> $(document).ready( function () {  
    $('#itinerary').addClass('active');
} ); 
</script>

<div class = "buttonScrollView">
<?php foreach ($allTeams as $team): ?>
	<button id = "<?php echo $team->color ?>" class = "scrollItem <?php echo strtolower($team->color) ?>" onClick ="showAbout()"> <i class="fa fa-flag fa-3x"></i> <br> <b> <?php echo $team->color ?> </b></button>

    <?php endforeach; ?>
</div>
