<?php
    include "includes/header.php";
?>   


<div class="row my-4">

    <h3 class="my-3 text-center">Profile</h3>

    <div class="mx-auto" style="width: 40vw;">
    <div class="card text-center">
  <div class="card-header text-bold"><b>
    Hi, <?=user('username')?></b>
  </div>
  <div class="card-body">
    <img class="card-img mb-4" src="<?=user('image')?>" alt="" style="width: 150px; height: 150px; border-radius: 50%;">
    <h5 class="card-title">Email: <?=user('email')?></h5>
    <p class="card-text">Date of joining: <?=user('date')?></p>
    <p class="card-text">Role: <?=user('role')?></p>
    <a href="<?=ROOT?>" class="btn btn-primary">Home</a>
  </div>

  <div class="card-footer text-muted">
    5 days ago
  </div>
</div>

    </div>
</div>

<?php
    include "includes/footer.php";
?>