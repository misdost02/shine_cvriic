<!-- Javascript --> 
<script src="js/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>         
<script src="<?php echo MAIN_ADMIN_URL; ?>assets/plugins/popper.min.js"></script>
<script src="<?php echo MAIN_ADMIN_URL; ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>  

<!-- Charts JS -->
<script src="<?php echo MAIN_ADMIN_URL; ?>assets/plugins/chart.js/chart.min.js"></script> 
<script src="<?php echo MAIN_ADMIN_URL; ?>assets/js/index-charts.js"></script> 
<script src="js/sweetalert/sweetalert.min.js"></script>
<!-- Page Specific JS -->
<script src="<?php echo MAIN_ADMIN_URL; ?>assets/js/app.js"></script>

<div class="modal fade" id="user_logout" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="user_logout" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-centered">
    <div class="modal-content">
    
      <div class="modal-header bg-info">
        <h4 class="modal-title">Logout</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body py-4 px-3">
        <p>Would you like to exit?</p>
      </div>
      <div class="modal-footer bg-light">
        <button class="btn btn-warning" id="aglogout" value="<?php echo $_SESSION['adminid']; ?>">Yes</button>
        <button class="btn btn-danger" data-bs-dismiss="modal">No</button>
	</div>
    </div>
  </div>
</div>


<script>
    $(document).ready(function() {
        $(document).on('click', '#aglogout', function() {  
            var adminid = $(this).attr('id');
            $.ajax({
                url:"controller/aglagout.php",
                method:"POST",
                data:{adminid:adminid},
                success: function(res) {
                    if(res == 200) {
                        $('#user_logout').modal('hide');

                        swal({
                            title: 'Success',
                            text: 'You have been logged out.',
                            icon: 'success',
                            buttons: false,
                            closeOnClickOutside: false,
                            closeOnEsc: false,
                            timer: 2000
                        }).then(function() {
                            window.location = 'https://www.cvriics.com/riic/';
                        });
                    } else {
                        swal({
                            title: 'Error',
                            text: 'Could not logout.',
                            icon: 'error',
                            buttons: false,
                            closeOnClickOutside: false,
                            closeOnEsc: false,
                            timer: 2000
                        })
                    }
                }
            });
        });
    });
</script>