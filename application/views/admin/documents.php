<script> $(document).ready( function () {  
    $('#doc').addClass('active');
    $('#fileTable').DataTable();
} ); 

</script>

<html>
    <body>
        <b><?php echo $error;?></b>
            <?php echo form_open_multipart('Admin/do_upload');?>

            <input type="file" name="fileToUpload" size="20" />
            <br /><br />

            <input type="submit" value="upload" />

        </form>

        <br/>

        <?php if(isset($files)) { ?>
            <table id="fileTable"  class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>File Name</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($files as $file): ?>
                    <tr>
                        <td><a href='<?php echo base_url('Admin/download/'.$file); ?>'><?php echo $file ?> </a></td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        <?php } ?>
    </body>
</html>