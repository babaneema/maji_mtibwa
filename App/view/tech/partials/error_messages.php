<?php 
if(isset($_SESSION['error'])){
?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <p><?= $_SESSION['error']?></p>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

<?php 
unset($_SESSION['error']);
}

