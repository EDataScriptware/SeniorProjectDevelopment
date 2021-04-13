<script> $(document).ready( function () {  
    $('#book').addClass('active');
} ); 

<?php foreach($bus_book_data as $bus) { ?>
    $('#<?php echo $bus->bus_book_id; ?>book').DataTable();
<?php } ?> 

</script>

<?php 
    echo json_encode($bus_book_data) ;

    if(isset($bus_book_data)) {
    foreach($bus_book_data as $book) { ?>


        <h2>Bus Book <?php echo $book->bus_book_id; ?> | Mission ID: <?php echo $book->mission_id; ?></h2>
        <h4>Start: <?php echo $book->start; ?> | End: <?php echo $book->end; ?></h4>
        <?php if(isset($book->notes)) { ?>
                <p><?php echo $book->notes; ?></p>
        <?php } ?>

        <table id="<?php echo $book->bus_book_id; ?>book" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Bus ID</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($book->bus as $bus) { ?>
                    <tr>
                        <td><?php $bus->bus_id ;?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } 
    }
?>