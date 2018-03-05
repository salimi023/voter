$(document).ready(function() { // Search function
    var value;
    $("#title").keyup(function() {
        value = $("#title").val().toLowerCase();
        $("#list tr td:nth-child(2)").filter(function() {
            $(this).parent().toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });
    $("#status").change(function() {
        value = $("#status option:selected").text().toLowerCase();
        $("#list tr td:nth-child(3)").filter(function() {
            $(this).parent().toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });
    $("#clear").click(function() {
        location.reload();
    });
});