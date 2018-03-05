<?php
$title = '<h2>Review your votings!</h2>';
require_once('sys/autoload.php');
require_once('model/class.VotingsData.php');
$manage = new VotingsMethods;
require_once('view/template/head.html');
$nr = 1;
// Listing existing votings
$q = $manage->db->query("SELECT voting_id, stat, title FROM votings ORDER BY voting_start ASC");
$q->setFetchMode(PDO::FETCH_CLASS, 'VotingsData');
require_once('view/page/review.html');
require_once('view/template/foot.html');
unset($manage);