<?php foreach ($team as $tem): ?>

<h3> <?php echo $tem->color ?> Team View </h3>

<?php foreach ($veteran as $vet): ?>
<?php if ($vet->team_id === $tem->team_id) { ?>
<a href="<?php echo base_url('vetView'. '/'. $vet->veteran_id) ?>" class="teamListElement"><?php echo $vet->first_name ?> <?php echo$vet->last_name?></a>
<?php  }?>
<?php endforeach ?>

<?php endforeach ?>