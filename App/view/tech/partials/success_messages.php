<?php 
if(isset($_SESSION['success'])){
?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <p><?= $_SESSION['success']?></p>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

<?php 
 unset($_SESSION['success']);
}
