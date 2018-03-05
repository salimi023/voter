<?php
error_reporting();
$title ='<h2>Voter - Simple PHP voting application</h2>';
require_once('view/template/head.html');
require_once('model/class.VotingsData.php');
require_once('sys/autoload.php');
$vote = new VotingsMethods;
$q = $vote->db->query("SELECT voting_id, title, quest, voting_stop FROM votings WHERE stat = '0' ORDER BY voting_stop ASC");
$q->setFetchMode(PDO::FETCH_CLASS, 'VotingsData');
require_once('view/page/home.html');
require_once('view/template/foot.html');
unset($vote);