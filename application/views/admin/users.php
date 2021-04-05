<script>
    $(document).ready( function () {
    $('#userTable').DataTable();
} );
    </script>
<div class = "scrunch"> 

<?php echo $user ?>

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
            <td> <?php $use->user_type ?> </td>
            <td> <?php $use->user_permissions ?>  </td>
            <td> <?php $use->username ?>  </td>
            <td> <?php $use->team_id ?>  </td>
            <td> <?php $use->notes ?>  </td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>
    </div>