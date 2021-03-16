

<?php // echo json_encode($veteran)?>





<div class = "teamListView">
	<input type="text" id="name" name="search">

	<h3> Team View </h3>

<?php foreach ($veteran as $vet): ?>
	<a href="<?php echo base_url('vetView'. '/'. $vet->veteran_id) ?>" class="teamListElement"><?php echo $vet->first_name ?> <?php echo$vet->last_name?></a>
<?php endforeach ?>
</div>

