<script> $(document).ready( function () {  
    $('#doc').addClass('active');
    $('#fileTable').DataTable();
} ); 


</script>

<html>
    <body>
        <h1>Documents Management</h1>
        <hr/>
        <b><?php echo $error;?></b>
            <?php echo form_open_multipart('Admin/do_upload');?>

            <input type="file" name="fileToUpload" size="20" />
            <br /><br />

            <input type="submit" value="upload" />

        </form>
        <br/>
        <hr/>
        <p>NOTE: This button will rebuild the Mission PDF Report.  This button should only be pressed once per mission or if mission data is changed. Only the admin can press this button/rebuild the report.</p>
        <p>After the report is built it will be placed in the "uploads" folder and will be served to staff with adequate permissions on the trip.</p>
        <button type="button" class="btn btn-primary" onclick="location.href='<?php echo base_url('Admin/buildVetPdf/'); ?>'">Build Mission Report PDF</button>


        <?php if(isset($files)) { ?>
            <hr/>
            <h2>Uploaded Documents</h2>
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
                        <td><a href='<?php echo base_url('Admin/download/'.$file); ?>'><?php echo $file ?> </a></td>
                        <td><button class="btn btn-danger" onclick="location.href='<?php echo base_url('Admin/deleteFile/'.$file); ?>'">Delete</button></td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        <?php } ?>
    </body>
</html>