

<?php // echo json_encode($veteran)?>

<table id = 'userList'>
  <tr>
    <th>Firstname</th>
    <th>Lastname</th>
    <th>id</th>
    <th>Action </th>
  </tr>

<?php foreach ($veteran as $vet): ?>
    
  <tr class = "clickable-row">
    <td><?php echo $vet->first_name ?></td>
    <td><?php echo$vet->last_name?></td>
    <td><?php echo$vet->veteran_id?></td>
    <td><button href="<?php echo base_url('vetView'. '/'. $vet->veteran_id) ?>" type="button" class="btn btn-primary">Primary</button></td>
  </tr>

<?php endforeach ?>

</table>
