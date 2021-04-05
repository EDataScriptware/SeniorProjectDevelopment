<script>
    $(document).ready( function () {
    $('#userTable').DataTable();
} );
    </script>
<div class = "scrunch"> 

<table id="userTable"  class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>User Type</th>
            <th>Permission Level</th>
            <th>Username</th>
            <th>Team ID</th>
            <th>Notes</th>
            <th>Action</th>
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
            <td> <button type="button" class="btn btn-primary" onclick = "editBlock(<?php echo $use->iduser ?>)"  > EDIT </button> </td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>
    </div>



<div id="whiteEdit" class="whiteEdit">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

</div>


    <script>

        function editBlock($id) {
        $.post('Admin/getUser', {id: $id}, function (data) {
            var $result = data;
            alert($result);
            document.getElementById("whiteEdit").style.width = "250px";
        });       
        }

        function closeNav() {
        document.getElementById("whiteEdit").style.width = "0";
        }

    </script>



