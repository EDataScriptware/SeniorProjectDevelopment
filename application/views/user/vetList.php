

<?php // echo json_encode($veteran)?>

<table id = 'userList'>
  <tr>
    <th>Firstname</th>
    <th>Lastname</th>
    <th>id</th>
  </tr>

<?php foreach ($veteran as $vet): ?>

    <a href = '<?php echo base_url('vetView'. '/'. $vet->veteran_id) ?>' >
  <tr>
    <td><?php echo $vet->first_name ?></td>
    <td><?php echo$vet->last_name?></td>
    <td><?php echo$vet->veteran_id?></td>
  </tr>
</a>

<?php endforeach ?>

</table>
