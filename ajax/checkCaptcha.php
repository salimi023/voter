<?php
error_reporting();
require_once('../model/class.VotingsData.php');
require_once('../class/class.SaveVote.php');
$check = new SaveVote;
if(isset($_POST['captcha'])) {
    $check->checkCaptcha($_POST['captcha']);
    if($check->code === $check->captcha) {
        echo 'okay';        
    }
    else {
        echo 'Sorry! The security code is wrong!';
    }
}