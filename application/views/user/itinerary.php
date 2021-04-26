<script> $(document).ready( function () {  
    $('#itinerary').addClass('active');
} ); 
</script>
<br>
<h1>Mission Itinerary</h1>
<hr/>
<?php if(!file_exists('./uploads/itinerary.pdf')) { ?>
    <h3>No itinerary found.</h3>
    <p>Admin must upload a pdf file named: "itinerary" to have it display here.</p>
<?php } else { ?>
    <iframe src=<?php echo base_url("./uploads/itinerary.pdf") ;?> width="100%" height="100%">
    </iframe>
<?php } ?>