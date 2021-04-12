<script> $(document).ready( function () {  $('#doc').addClass('active');} ); </script>

<html>
    <body>

        <?php echo getcwd() . "<br/>" ;?>
        <?php echo $error;?>
            <?php echo form_open_multipart('Admin/do_upload');?>

            <input type="file" name="fileToUpload" size="20" />
            <br /><br />

            <input type="submit" value="upload" />

        </form>
    </body>
</html>