$(document).ready(function() {
    var id, code;
    var baseurl = "http://localhost/voter/";
    $("button").click(function(event) {
        id = (event.target.id);
        $.ajax({
            url: baseurl + "ajax/getVotingData.php",
            type: "POST",
            data: { voting_id: id },
            dataType: "html",
            success: function(response) {
                $("#myModal").html(response);
                $("#code").blur(function() {
                        $("#code").addClass("thinking");
                        code = $("#code").val();
                        $.ajax({
                            url: baseurl + "ajax/checkCaptcha.php",
                            type: "POST",
                            data: { captcha: code },
                            dataType: "html",
                            success: function(status) {
                                if (status === "okay") {
                                    $("#code").removeClass("thinking");
                                    $("#code").removeClass("denied");
                                    $("#code").addClass("approved");
                                    $("#vote").attr("disabled", false);
                                } else {
                                    $("#code").removeClass("thinking");
                                    $("#code").removeClass("approved");
                                    $("#code").addClass("denied");
                                    $("#vote").attr("disabled", true);
                                    alert(status);
                                }
                            }
                        });
                    }),
                    $("#vote").click(function() {
                        var vid = $("#myModalLabel").data("vid");
                        var name = $("#name").val();
                        var rid = $("input[name=option]:checked", "form").data("rid");
                        $.ajax({
                            url: baseurl + "ajax/saveVote.php",
                            type: "POST",
                            data: { voting_id: vid, voter_name: name, response_id: rid },
                            dataType: "html",
                            success: function(response) {
                                alert(response);
                            }
                        });
                    });
            }
        });
    });
});