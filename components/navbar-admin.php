<?php
$url_base = "http://localhost/restaurant/admin";
?>

<style>
  .navbarComponent {
    top: 0;
    left: 0;
    width: 100%;
    height: 100px;
    font-family: "Ultra", serif;
  }

  .brandTitle {
    margin-right: 35px;
    font-size: 40px;
  }
</style>

<nav class="navbar navbar-expand-lg navbar-light bg-light navbarComponent">
  <a class="navbar-brand brandTitle" href="<?php echo $url_base;?>">ADMIN</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
</nav>
