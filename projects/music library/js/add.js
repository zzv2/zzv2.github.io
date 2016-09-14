$(document).ready(function () {
    updateNumTags();
    $("#NumTags").change(updateNumTags);
});

function updateNumTags() {
    var NumTags = $("#NumTags").val();
//        alert("Change to "+NumTags+" tags.");
    for (i = 0; i < 10; i++) {
        if (i < NumTags) {
            $("#Tags" + i).css("display", "block");
//                $("#Tags"+i).prop('required',true);
        }
        else {
            $("#Tags" + i).css("display", "none");
            $("#Tags" + i).val('');
//                $("#Tags"+i).prop('required',false);
        }
    }
}