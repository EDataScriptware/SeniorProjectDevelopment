<script> $(document).ready( function () {  
    $('#itinerary').addClass('active');
} ); 
</script>
<br>
<h1>Mission Itinerary</h1>
<hr/>
<?php if(!file_exists('./uploads/itinerary.pdf')) { ?>
    <h3>No itinerary found.</h3>
    <p><b>Admin must upload a pdf file named: "itinerary" to have it display here.</b></p>
<?php } else { ?>
    <iframe src="http://docs.google.com/viewer?url=<?php echo base_url("./uploads/itinerary.pdf") ;?>&embedded=true" width="100%" height="200%" frameborder="0" scrolling="no">
    </iframe>
<?php } ?>

<style>
    .content {
        height: 50vh;
    }
</style>