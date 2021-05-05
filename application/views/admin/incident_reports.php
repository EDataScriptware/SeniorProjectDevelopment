<script> $(document).ready( function () {  
    $('#incident').addClass('active');
    $('#fileTable').DataTable();
} ); 

</script>

<h1>Incident Reports</h1>
<hr/>
<p>Here is where any reported incidents will appear.  Click on a report to download and view it.</p>

<?php if(isset($files)) { ?>
    <hr/>
    <h2>Incident Report Documents</h2>
    <br/>
    <table id="fileTable"  class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>File Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($files as $file): ?>
            <tr>
                <td><a href='<?php echo base_url('Admin/downloadIncident/'.$file); ?>'><?php echo $file ?> </a></td>
                <td><button class="btn btn-danger" onclick="location.href='<?php echo base_url('Admin/deleteFileIncident/'.$file); ?>'">Delete</button></td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
<?php } ?>