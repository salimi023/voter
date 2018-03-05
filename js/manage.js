$(document).ready(function() {
    var idCount = 1;
    var id;
    var baseurl = "http://localhost/voter/";

    // Functions

    function removeResponse() { // Removing responses. 
        $("button").each(function(index, item) {
            $(this).click(function() {
                $(this).parent().remove();
            });
        });
    }

    function manageUpdateButtons() { // Managing update buttons. 
        $("[name = btn_del]").each(function(index, item) {
            $(this).css("display", "none");
        });
        $("#btn_resp").css("display", "none");
        $("#save").css("display", "none");
        $("#btn_start").css("display", "none");
        $("#close").css("display", "none");
    }

    function manageButtons() { // Managing buttons by the status of the voting.
        var stat = $("#status").data("voting");
        switch (stat) {
            case 0:
                $("#btn_start").css("display", "none");
                $("#arch").css("display", "none");
                $("#del").css("display", "none");
                break;
            case 1:
                $("#arch").css("display", "none");
                $("#del").css("display", "none");
                break;
            case 2:
                manageUpdateButtons();
                break;
            case 3:
                $("#arch").css("display", "none");
                manageUpdateButtons();
                break;
        }
    }

    // Events

    $("#btn_resp").click(function() { // Adding and deleting responses.
        id = idCount++;

        // Adding response

        var res = $("<div></div").addClass("form-group");
        $(res).html('<label for="response">New Response Nr. ' + id + ':&nbsp</label>' +
            '<input type="text" class="form-control" id="respo[]" name="respo[]" required /><br />' +
            '<button id="' + id + '" type="button">Delete</button><br /><br />');
        $("#resp").append(res);
        $(res).attr("id", id);

        // Deleting response

        removeResponse();
    });

    function getVotingId() { // Getting voting id from URL.
        var lurl = window.location.search;
        var surl = lurl.split("=");
        id = surl[1];
        return id;
    }

    $("#btn_start").click(function() { // Starting voting mannually
        getVotingId();
        if (confirm("Do you want to start this voting?")) {
            $.ajax({
                url: baseurl + "ajax/manageVoting.php",
                type: "POST",
                data: { voting_id: id, action: "start" },
                dataType: "html",
                success: function(response) {
                    alert(response);
                    window.location.href = baseurl + "review";
                }
            });
        }
    });

    $("#close").click(function() { // Closing voting manually
        getVotingId();
        if (confirm("Do you want to close this voting?")) {
            $.ajax({
                url: baseurl + "ajax/manageVoting.php",
                type: "POST",
                data: { voting_id: id, action: "close" },
                dataType: "html",
                success: function(response) {
                    alert(response);
                    window.location.href = baseurl + "review";
                }
            });
        }
    });

    $("#arch").click(function() { // Archivate voting.
        getVotingId();
        if (confirm("Do you want to archivate this voting?")) {
            $.ajax({
                url: baseurl + "ajax/manageVoting.php",
                type: "POST",
                data: { voting_id: id, action: "archivate" },
                dataType: "html",
                success: function(response) {
                    alert(response);
                    window.location.href = baseurl + "review";
                }
            });
        }
    });

    $("#del").click(function() { // Delete voting.
        getVotingId();
        if (confirm("Do you want to delete this voting?")) {
            $.ajax({
                url: baseurl + "ajax/manageVoting.php",
                type: "POST",
                data: { voting_id: id, action: "delete" },
                dataType: "html",
                success: function(response) {
                    alert(response);
                    window.location.href = baseurl + "review";
                }
            });
        }
    });
    manageButtons();
    removeResponse();
    $("#start").datepick({ minDate: 0, dateFormat: "yyyy-mm-dd" }); // Datepicker start
    $("#stop").datepick({ minDate: 0, dateFormat: "yyyy-mm-dd" }); // Datepicker stop
});