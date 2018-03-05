<?php
error_reporting();
require_once('sys/autoload.php');
require_once('model/class.VotingsData.php');
$data = new VotingsMethods;
$data->setCronStart();
$data->setCronStop();

// Initiating scheduled votings
$q = $data->db->query("UPDATE votings SET stat = '0' WHERE voting_start = '$data->cron_start' AND stat = '1'");

// Closing votings
$q2 = $data->db->query("UPDATE votings SET stat = '2' WHERE voting_stop = '$data->cron_stop' AND stat = '0'");

// Sending e-mail notification
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
$headers .= "From: Voter" . "\r\n"; 
$subject = 'Change of voting status';
$subject = "=?UTF-8?B?" . base64_encode($subject) . "?=";
$admin_email = [];
$q3 = $data->db->query("SELECT admin_email FROM votings");
$q3->setFetchMode(PDO::FETCH_ASSOC);
while($row = $q3->fetch()) {
    array_push($admin_email, $row['admin_email']);
}
$uniq_email = array_unique($admin_email);
foreach($uniq_email as $email) {
    // Selecting opened votes.
    $q4 = $data->db->query("SELECT title, voting_stop FROM votings WHERE admin_email = '$email' AND voting_start = '$data->cron_start'");
    $q4->setFetchMode(PDO::FETCH_CLASS, 'VotingsData');
    // Selecting closed votes.
    $q5 = $data->db->query("SELECT voting_id, title, voting_stop FROM votings WHERE admin_email = '$email' AND voting_stop = '$data->cron_stop'");
    $q5->setFetchMode(PDO::FETCH_CLASS, 'VotingsData');
    if(($q4->rowCount() || $q5->rowCount()) || ($q4->rowCount() && $q5->rowCount())) {
        $msg = '<p>Hello Admin,</p><p><strong>The status of the following votings have been changed:</strong></p>';
        while($row4 = $q4->fetch()) {
            $msg .= "{$row4->getTitle()} <strong>(Opened)</strong><br />- Date of closing: {$row4->getVotingStop()}<br /><br />";
        }
        while($row5 = $q5->fetch()) {
            $data->countVotes($row5->voting_id);
            $msg .= "{$row5->getTitle()} <strong>(Closed)</strong><br />- Date of closing: {$row5->getVotingStop()}<br />Results:<br />";
            foreach($data->count as $num) {
                $msg .= "- {$num['resp']}: {$num['COUNT(*)']}<br />";
            }
        }
        $msg .= '<p>For the detailed results of the closed votings please visit the Voter adminstration site!</p>';
        mail($email, $subject, $msg, $headers);
    } 
}         
unset($data);