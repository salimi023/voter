<?php
error_reporting();
$title = '<h2>Votes</h2>';
require_once('model/class.VotingsData.php');
require_once('sys/autoload.php');
require_once('view/template/head.html');
$votes = new VotingsMethods;
if(isset($_GET['voting_id'])) {
    $votes->setVotingId($_GET['voting_id']);
    // Selecting basic voting data
    $q = $votes->db->prepare("SELECT title, descr, quest, voting_start, voting_stop FROM votings WHERE voting_id = ?");
    $q->execute([$votes->voting_id]);
    $q->setFetchMode(PDO::FETCH_CLASS, 'VotingsData');
    $row = $q->fetch();    
    // Selecting voters
    $q2 = $votes->db->prepare("SELECT r.resp, vr.voter_name, vr.voting_date, vr.voter_ip FROM response AS r INNER JOIN voter AS vr ON r.response_id = vr.response_id WHERE r.voting_id = ? ORDER BY vr.voter_name ASC");
    $q2->execute([$votes->voting_id]);
    $q2->setFetchMode(PDO::FETCH_CLASS, 'VotingsData');
    // Counting votes
    $votes->countVotes($votes->voting_id);    
}
require_once('view/page/votes.html');
require_once('view/template/foot.html');
unset($votes);