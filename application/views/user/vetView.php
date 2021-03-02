<p> vet view </p>

<?php console.log (json_encode($veteran))?>

<h2> <?php echo $veteran[0]->first_name $veteran[0]->middle_initial $veteran[0]->last_name ?> </h2>

<p>Contact Info: <?php echo $veteran[0]->cell_phone ?></p>
<p>dob: <?php echo $veteran[0]->dob ?></p>