<?php
/*
Including partial files most Content Management Systems (CMSs) divide out
*/
include("assets/includes/global-header.php"); // HTML head ?>
<?php include("assets/includes/main-header.php"); // Visible header ?>
<div id="about" class="container">
  <div id="content">
    <div id="main_content">
      <div class="row">
        <div class="col-xs-12">
          <h1>about</h1>
          <center><img src="assets/images/1431892117.jpg"></center>
          <p>Katrina and Tadashi have been traveling the world since 2004, mainly to Southeast Asia.  They travel flexibly, and if they don't like a place, they'll leave early, and if they fall in love with a place, they'll stay longer.  They strive to meet the local people, and so they tend to stay away from the big cities and hotels, preferring smaller places where it's easier to make connections.  In this way, they have made friends all over the world, and have helped bring running water to people's house, payed for many children to attend school, helped an adult finish their education, and helped start two small businesses.  They see themselves as providing the support that student loans have given so many of us in the United States.  Except instead of being payed back, the people they support pay it forward.  Their first book, "<a href="/" title="">No Lunch, No Money, No Rice: The Pursuit of Education in Asia</a>" was a labor of love, and is filled with the stories they would tell friends when they asked, "How was your trip?"</p>
        </div><!-- .col-xs-12 -->
      </div><!-- .row -->
      <div class="row">
        <div class="col-xs-6">
          <h3>Katrina Keating</h3>
          <p>Katrina is a mathematics professor at Diablo Valley College in Pleasant Hill, California.  She has a Masters in Mathematics, but was an anthropology major until her last year of undergraduate work.  Studying anthropology opened her eyes and instilled a passion for cultures and a need  for travel. Traveling the world, mostly in Southeast Asia, has taught her a respect for how precarious and precious life and education are, and she is determined to help raise awareness.</p>
          <a href="http://katrinakphotography.blogspot.com/2009/03/parahawking.html" class="btn btn-default" target="_blank">Katrina's Blog</a>
        </div><!-- .col-xs-6 -->
        <div class="col-xs-6">
          <h3>Tadashi Tsuchida</h3>
          <p>Tadashi is a mathematics professor at Skyline College in San Bruno, California.  He has a Masters in Mathematics, but has always had a passion for photography and is rarely seen without his camera.  As a young boy, he and his father would take road trips on every holiday, giving him an appreciation for travel.  He lives with his wife, Katrina, in Oakland, California.</p>
          <a href="http://tadashiphotography.blogspot.com" class="btn btn-default" target="_blank">Tadashi's Blog</a>
          <a href="http://tadashifinephoto.com" class="btn btn-default" target="_blank">Tadashi's Photos</a>
        </div><!-- .col-xs-6 -->
      </div><!-- .row -->
      <h3>Contact Us</h3>
      <?php
      /*
        if(isset($_POST['submit'])) {
          $con=mysqli_connect('localhost', 'root', 'root', 'database');
          // Check connection
          if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
          }
          $sql="INSERT INTO `table` (field1) VALUES ('$_POST[field1]')";
          if (!mysqli_query($con,$sql)) {
            die('Error: ' . mysqli_error($con));
          } else {
            echo "1 record added";
          }
          mysqli_close($con);
        }
        */
        $to = '';
        $subject = (isset($_POST['subject'])) ? $_POST['subject'] : 'test subject';
        $message = (isset($_POST['field1'])) ? $_POST['field1'] : 'Test Body';
        if (isset($_POST['from'])) {
          $headers = 'From: ' . $_POST['from'] . "\r\n" .
            'Reply-To: ' . $_POST['from'] . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
         } else {
          $headers = 'X-Mailer: PHP/' . phpversion();
         }

        if(isset($_POST['submit'])) {
          mail($to, $subject, $message, $headers);
        }
      ?>
      <div class="row">
        <form action="about.php" method="POST" class="col-xs-12">

          <div>
            <span>Name <span class="form-required">*</span></span>
            <div style="clear:both;"></div>
            <div class="form-input-first-name">
              <input type="text" name="fname" id="fname" value="" placeholder="First Name">
              <label for="fname">First</label>
            </div>
            <div class="wsite-form-input-container wsite-form-right wsite-form-input-last-name">
              <input type="text" name="lname" id="lname" value="" placeholder="Last Name">
              <label for="lname">Last</label>
            </div>
          </div>
          
          <div>
            <label for="email">Email <span class="form-required">*</span></label>
            <input type="text" name="email" id="email" value="" placeholder="Email">
          </div>

          <div>
            <label for="comment">Comment <span class="form-required">*</span></label>
            <textarea name="comment" id="comment">
            </textarea>
          </div>
          <input type="submit" name="submit" id="submit" value="submit">
        </form><!-- .col-xs-12 -->
      </div><!-- .row -->
    </div><!-- #main_content -->
    <?php include("assets/includes/sub-nav.php"); ?>
  </div><!-- #content -->
  <?php include("assets/includes/main-footer.php"); // Visible footer ?>
</div><!-- #about -->
<?php include("assets/includes/global-footer.php"); // HTML foot ?>