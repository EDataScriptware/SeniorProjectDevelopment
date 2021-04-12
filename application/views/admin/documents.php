<script> $(document).ready( function () {  
    $('#doc').addClass('active');
    $('#fileTable').DataTable();
} ); 

</script>

<html>
    <body>

        <?php echo getcwd() . "<br/>" ;?>
        <?php echo $error;?>
            <?php echo form_open_multipart('Admin/do_upload');?>

            <input type="file" name="fileToUpload" size="20" />
            <br /><br />

            <input type="submit" value="upload" />

        </form>

        <?php echo json_encode($files) . "<br/>" ;?>

        <table id="fileTable"  class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>File Name</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($files as $file): ?>
                <tr>
                    <td><a> <?php echo $file ?> </a></td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </body>
</html>