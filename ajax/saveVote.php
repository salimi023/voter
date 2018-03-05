<?php
session_start();
error_reporting();
require_once('../sys/class.Dbc.php');
require_once('../model/class.VotingsData.php');
require_once('../class/class.SaveVote.php');
$dbc = new Dbc;
$data = new SaveVote;
if(!empty($_POST['voting_id'])) {
    if(!empty($_POST['voter_name'])) {
        if(!empty($_POST['response_id'])) {
            $data->setVotingsData($_POST['voting_id'], $_POST['voter_name'], $_POST['response_id'], $_SESSION['ip']);    
            $q = $dbc->dbc->query("SELECT voter_name FROM voter WHERE voting_id = '$data->voting_id' AND voter_name = '$data->voter_name' AND voter_ip = '$data->voter_ip' LIMIT 1");
            $q->setFetchMode(PDO::FETCH_CLASS, 'Votingsdata');
            $row = $q->fetch();
            if($q->rowCount()) {
                echo "Sorry, {$row->getVoterName()}! You have already voted!";        
            }
            else {
                if($data->code === $data->captcha) {                                    
                    $q2 = $dbc->dbc->prepare("INSERT INTO voter(voting_id, response_id, voter_name, voting_date, voter_ip) VALUES(?, ?, ?, ?, ?)");
                    $q2->execute([$data->voting_id, $data->response_id, $data->voter_name, $data->voting_date, $data->voter_ip]);
                    echo 'Your vote has been saved successfully! Thank you!';
                }           
            }
        }
        else {
            echo 'Oooops! The vote is missing!';
        }
    }
    else {
        echo 'Oooops! The name is missing!';
    }
}
unset($dbc, $data);