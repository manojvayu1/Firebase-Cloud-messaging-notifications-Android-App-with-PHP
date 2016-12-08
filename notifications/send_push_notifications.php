<!DOCTYPE html>
<html>
<title>Notifications</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
<link rel="shortcut icon" href="https://1.bp.blogspot.com/-YIfQT6q8ZM4/Vzyq5z1B8HI/AAAAAAAAAAc/UmWSSMLKtKgtH7CACElUp12zXkrPK5UoACLcB/s1600/image00.png">
<style>
.city {display:none;}
body {
  margin: 0;
}

div img.img1 {
  width:100px;
    display: block;
    margin-left: auto;
    margin-right: auto;
    margin-top:20px;
  }
  .w3-container
  {
    width:80%;
    margin: auto;
  }
  .w3-container2
  {
    width:100%;
    margin: auto;
  }
</style>
<body>
<?php
// Enabling error reporting
error_reporting(-1);
ini_set('display_errors', 'On');

require_once __DIR__ . '/firebase.php';
require_once __DIR__ . '/push.php';

$firebase = new Firebase();
$push = new Push();

// optional payload
$payload = array();
$payload['team'] = 'India';
$payload['score'] = '5.6';

// notification title
$title = isset($_GET['title']) ? $_GET['title'] : '';

// notification message
$message = isset($_GET['message']) ? $_GET['message'] : '';

// push type - single user / topic
$push_type = isset($_GET['push_type']) ? $_GET['push_type'] : '';

// whether to include to image or not
$include_image = isset($_GET['include_image']) ? TRUE : FALSE;


$push->setTitle($title);
$push->setMessage($message);
if ($include_image) {
    $push->setImage('https://1.bp.blogspot.com/-YIfQT6q8ZM4/Vzyq5z1B8HI/AAAAAAAAAAc/UmWSSMLKtKgtH7CACElUp12zXkrPK5UoACLcB/s1600/image00.png');
} else {
    $push->setImage('');
}
$push->setIsBackground(FALSE);
$push->setPayload($payload);
$json = '';
$response = '';

if ($push_type == 'Mapprr') {
    $json = $push->getPush();
    $response = $firebase->sendToTopic('global', $json);
} else if ($push_type == 'individual') {
    $json = $push->getPush();
    $regId = isset($_GET['regId']) ? $_GET['regId'] : '';
    $response = $firebase->send($regId, $json);
}
?>
<div class="w3-container w3-border">

  <h2 class="w3-center">Send Notifications</h2>

  <ul class="w3-navbar w3-blue">
    <li class="w3-col s12 m6"><a class="tablink w3-center" href="javascript:void(0)" onclick="openCity('single')">Single Device</a></li>
    <li class="w3-col s12 m6"><a class="tablink w3-center" href="javascript:void(0)" onclick="openCity('multiple')">Multiple Device</a></li>
  </ul>
  <div class="w3-container2 w3-border">
  <!--Single Device-->
  <div id="single" class="city">
  <div class="w3-col s12 m12"><h2 class="">Single Device</h2></div>
  <form class="pure-form pure-form-stacked" method="get">
    <div class="w3-col s12 m6">
    <div class="w3-col s12 m12">
    <p class="w3-col s12 m10">
      <label class="w3-text-grey">Reg ID</label>
      <input class="w3-input w3-border" placeholder="Enter Registration ID" id="regId" name="regId" type="text">
      </p>
      </div>
      <div class="w3-col s12 m12">
       <p class="w3-col s12 m10">
      <label class="w3-text-grey">Title</label>
      <input class="w3-input w3-border"  placeholder="Enter Title" id="title" name="title" type="text">
      </p>
      </div>
      <div class="w3-col s12 m12">
      <p class="w3-col s12 m10">
      <label class="w3-text-grey">Message</label>
      <textarea class="w3-input w3-border" style="resize:none" id="message" name="message" placeholder="Type Message"></textarea>
    </p>
    </div>
    <div class="w3-col s12 m12">
        <p class="w3-col s12 m10">
        <label class="w3-text-grey">
        <input name="include_image" id="include_image" type="checkbox">Send Image
        </label>  
        </p>
      </div>
    <p class="w3-col s12 m12">
        <input type="hidden" name="push_type" value="individual"/>
    <button type="submit" class="w3-col s12 m4 w3-btn w3-round w3-padding w3-green">Send</button></p>
  </div>
</form>
<!--image preview-->
  <div class="w3-col s12 m6">
     <div class="w3-col s12 img">
        <img class="img1" src="https://1.bp.blogspot.com/-YIfQT6q8ZM4/Vzyq5z1B8HI/AAAAAAAAAAc/UmWSSMLKtKgtH7CACElUp12zXkrPK5UoACLcB/s1600/image00.png" alt="Person">
    </div> 
    <div class="w3-col s12" class="json_preview">
      <p style="margin:50px 0px 50px 0px; overflow-wrap: normal; overflow-wrap: break-word;">
              <?php if ($json != '') { ?>
      <b>Request : </b>
      <?php echo json_encode($json) ?></p>
        <?php } ?>
       <?php if ($response != '') { ?>
      <p style="overflow-wrap: normal; overflow-wrap: break-word;"><b>Response : 
      </b><?php echo json_encode($response) ?></p>
      <?php } ?>
    </div>
  </div>
<!--// image preview-->
  </div>
<!--// Single Device-->
<!--Multiple Devices-->
  <div id="multiple" class=" city">
  <div class="w3-col s12 m12"><h2 class="">Multiple Devices</h2></div>
  <div class="w3-col s12 m6">
  <form class="pure-form pure-form-stacked" method="get">
      <div class="w3-col s12 m12">
        <p class="w3-col s12 m10">
        <label class="w3-text-grey">Title</label>
        <input class="w3-input w3-border" placeholder="Enter" name="title" Title" type="text">
        </p>
      </div>
      
      <div class="w3-col s12 m12">
      <p class="w3-col s12 m10">
        <label class="w3-text-grey">Message</label>
        <textarea class="w3-input w3-border" style="resize:none" name="message" placeholder="Type Message"></textarea>
      </p>
    </div>
    <div class="w3-col s12 m12">
        <p class="w3-col s12 m10">
        <label class="w3-text-grey">
        <input name="include_image" id="include_image" type="checkbox">Send Image
        </label>  
        </p>
      </div>
    <p class="w3-col s12 m12">
    <input type="hidden" name="push_type" value="Mapprr"/>
    <button type="submit" class="w3-col s12 m4 w3-btn w3-round w3-padding w3-green">Send</button></p>
    </form>
  </div>

<!--image preview-->
  <div class="w3-col s12 m6">
     <div class="w3-col s12 img">
        <img class="img1" src="https://1.bp.blogspot.com/-YIfQT6q8ZM4/Vzyq5z1B8HI/AAAAAAAAAAc/UmWSSMLKtKgtH7CACElUp12zXkrPK5UoACLcB/s1600/image00.png" alt="Person">
    </div> 
    <div class="w3-col s12" class="json_preview">
      <p style="margin:50px 0px 50px 0px; overflow-wrap: normal; overflow-wrap: break-word;">
              <?php if ($json != '') { ?>
      <b>Request : </b><?php echo json_encode($json) ?></p>
        <?php } ?>
       <?php if ($response != '') { ?>
      <p style="overflow-wrap: normal; overflow-wrap: break-word;"><b>Response : 
      </b><?php echo json_encode($response) ?></p>
      <?php } ?>
    </div>
  </div>
<!--// image preview-->
</div>
<!--// Multiple Devices-->

</div>
</div>

<script>
openCity("single")
function openCity(cityName) {
    var i;
    var x = document.getElementsByClassName("city");
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";  
    }
    document.getElementById(cityName).style.display = "block"; 
}
</script>

</body>
</html>
