<?php
error_reporting();
require_once('../sys/class.Dbc.php');
require_once('../model/class.VotingsData.php');
$link = new Dbc;
$data = new VotingsData;
if(isset($_POST['voting_id']) && isset($_POST['action'])) {
    $data->setVotingId(strip_tags(trim($_POST['voting_id'])));
    $data->setVotingDate();
    $action = strip_tags(trim($_POST['action']));

    switch($action) {
        case 'archivate': // Archivate voting
        $arch = $link->dbc->prepare("UPDATE votings SET stat = '3' WHERE voting_id = ?");
        $arch->execute([$data->voting_id]);    
        echo 'The voting has been successfully archived!';
        break;
        case 'close': // Close voting
        $close = $link->dbc->prepare("UPDATE votings SET stat = '2', voting_stop = ? WHERE voting_id = ?");
        $close->execute([$data->voting_date, $data->voting_id]);
        echo 'The voting has been successfully closed!';
        break;
        case 'delete': // Delete voting
        // Delete voting and responses    
        $del = $link->dbc->prepare("DELETE v, r FROM votings AS v INNER JOIN response AS r ON r.voting_id = v.voting_id WHERE v.voting_id = ?");
        $del->execute([$data->voting_id]);
        // Delete voters
        $del_voter = $link->dbc->prepare("DELETE FROM voter WHERE voting_id = ?");
        $del_voter->execute([$data->voting_id]);    
        echo 'The voting has been successfully deleted!';
        break;
        case 'start': // Start voting
        $start = $link->dbc->prepare("UPDATE votings SET stat = '0', voting_start = ? WHERE voting_id = ? AND stat = '1'");
        $start->execute([$data->voting_date, $data->voting_id]);
        echo 'The voting has been started successfully!';
        break;
    }
}
unset($link, $data);