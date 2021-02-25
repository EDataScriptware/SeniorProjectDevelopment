<button type="button" onclick = "getName()">Get Veteran Names</button>


<script>
  function getName() {

               $.ajax({
                   type: "POST",
                   url: "<?php echo base_url('get_vetNames')?>",
                   data: {},
                   complete: function (DATA) {
                       console.log(DATA);
                   }
               });
           }


	</script>