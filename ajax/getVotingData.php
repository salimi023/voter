<?php
error_reporting();
require_once('../sys/class.Dbc.php');
require_once('../model/class.VotingsData.php');
$link = new Dbc;
$data = new VotingsData;
if(isset($_POST['voting_id'])) {
    $data->setVotingId(strip_tags(trim($_POST['voting_id'])));
    
    // Selecting voting's data
    
    $q = $link->dbc->prepare("SELECT title, quest FROM votings WHERE voting_id = ?");
    $q->execute([$data->voting_id]);
    $q->setFetchMode(PDO::FETCH_CLASS, 'VotingsData');
    $row = $q->fetch();
    
    // Selecting responses data

    $q2 = $link->dbc->prepare("SELECT response_id, resp FROM response WHERE voting_id = ? ORDER BY response_id ASC");
    $q2->execute([$data->voting_id]);
    $q2->setFetchMode(PDO::FETCH_CLASS, 'VotingsData');    

    echo "<div class=\"modal-dialog\" role=\"document\">
    <div id=\"content\" class=\"modal-content\">
        <div class=\"modal-header\">
            <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
            <h4 class=\"modal-title\" id=\"myModalLabel\" data-vid=\"{$data->voting_id}\">
                {$row->getTitle()}
            </h4>
        </div>
        <div class=\"modal-body\">
        <p style=\"color: red\">All fields are obligatory!</p>
            <h2>
                {$row->getQuest()} 
            </h2>
            <form id=\"form\" method=\"post\" action=\"\">
            <div class=\"form-group\">
            <label for=\"name\">Name: </label>
            <input type=\"text\" class=\"form-control\" name=\"name\" id=\"name\" required />
            </div>
            <p><strong>Please, select your vote!</strong></p>";
            while($row2 = $q2->fetch()) {
                echo "
                <div class=\"radio\">
                <label>
                <input type=\"radio\" name=\"option\" id=\"option\" data-rid=\"{$row2->getResponseId()}\" required />
                {$row2->getResp()}
                </label>
                </div>";                
            }
            echo "<div class=\"form-group\">
            <label for=\"code\">I am not a robot!</label>
            <input type=\"text\" name=\"code\" id=\"code\" class=\"form-control\" placeholder=\"What day is it today? (e.g. Monday)\" required/>
            </div>
            <input type=\"submit\" class=\"btn btn-primary\" name=\"vote\" id=\"vote\" value=\"Vote!\" disabled>
            </form>
        </div>
        <div class=\"modal-footer\">
            <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Close</button>            
        </div>        
    </div>
</div>";
}
unset($link, $data); 