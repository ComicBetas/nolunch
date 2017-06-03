<?php
/*
Including partial files most Content Management Systems (CMSs) divide out
*/
include("assets/includes/global-header.php"); // HTML head ?>
<?php include("assets/includes/main-header.php"); // Visible header ?>
<div id="product" class="container">
  <div id="content">
    <div id="main_content">
      <h1>product</h1>
      Hello World <a href="#">test</a>
    </div><!-- #main_content -->
    <?php include("assets/includes/sub-nav.php"); // An optional sub navigation ?>
  </div><!-- #content -->
  <?php include("assets/includes/main-footer.php"); // Visible footer ?>
</div><!-- #product -->
<?php include("assets/includes/global-footer.php"); // HTML foot ?>