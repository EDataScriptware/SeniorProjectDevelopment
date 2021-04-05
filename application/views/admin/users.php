<script>
    $(document).ready( function () {
    $('#userTable').DataTable();
} );
    </script>
<div class = "scrunch"> 

<?php echo json_encode($user) ?>

<table id="userTable"  class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>User Type</th>
            <th>Permission Level</th>
            <th>Username</th>
            <th>Team ID</th>
            <th>Notes</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($user as $use): ?>
        <tr>
            <td> <?php echo $use->user_type ?> </td>
            <td> <?php echo $use->user_permissions ?>  </td>
            <td> <?php echo $use->username ?>  </td>
            <td> <?php echo $use->team_id ?>  </td>
            <td> <?php echo $use->notes ?>  </td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>
    </div>