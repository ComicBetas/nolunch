<?php
/*
Including partial files most Content Management Systems (CMSs) divide out
*/
include("assets/includes/global-header.php"); // HTML head ?>
<?php include("assets/includes/main-header.php"); // Visible header ?>
<div id="homepage" class="container">
  <div id="content">
    <div id="main_content">
      Hello World <a href="#">test</a>
    </div><!-- #main_content -->
    <?php include("assets/includes/sub-nav.php"); // An optional sub navigation ?>
  </div><!-- #content -->
  <?php include("assets/includes/main-footer.php"); // Visible footer ?>
</div><!-- #homepage -->
<?php include("assets/includes/global-footer.php"); // HTML foot ?>