<?php
// echo "<pre>";
// var_dump($_SESSION);
// echo "</pre>";

?>

<div id = "teamBox">
<?php foreach ($teams as $team): ?>
<a href = "<?php echo base_url('vetList'. '/'. $team->team_id) ?>"><div  id = "<?php echo strtolower($team->color) ?>" class = "teamCube"><p><?php echo $team->color ?> Team</p></div></a>
	<?php endforeach; ?>
</div>
