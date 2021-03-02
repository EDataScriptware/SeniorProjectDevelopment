

<?php // echo json_encode($veteran)?>

<table id = 'userList'>
  <tr>
    <th>Firstname</th>
    <th>Lastname</th>
    <th>id</th>
  </tr>

<?php foreach ($veteran as $vet): ?>

    <a href = <?php base_url('vetView/'$vet->veteran_id) ?>>
  <tr>
    <td><?php$vet->first_name ?></td>
    <td><?php$vet->last_name?></td>
    <td><?php$vet->veteran_id?></td>
  </tr>
</a>

</table>

<?php endforeach ?>
