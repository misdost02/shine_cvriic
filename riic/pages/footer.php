<footer class="app-footer footer fixed-bottom bg-secondary text-white">
    <div class="container text-center py-3">
         <!--/* This template is free as long as you keep the footer attribution link. If you'd like to use the template without the attribution link, you can buy the commercial license via our website: themes.3rdwavemedia.com Thank you for your support. :) */-->
    <small class="copyright">Copyright <i class="fas fa-copyright" style="color: #fb866a;"></i> 2021-<?php echo date("Y");?> by RIIC 02. All rights reserved. | Developed by <i class="fas fa-code" style="color: #fb866a;"></i> by <a class="app-link" href="https://www.facebook.com/vilchor.perdido/" target="_blank">Vilchor Perdido</a></small>
       
    </div>
</footer><!--//app-footer-->

<div class="modal" id="logout">
  <div class="modal-dialog modal-sm  modal-dialog-centered">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Logout</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        Are you sure you want to exit?
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <a type="button" href="controller/logout.php" class="btn btn-danger">Logout</a>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>