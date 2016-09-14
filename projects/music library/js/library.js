var request;
var sort = "Title";
var searchFields = Array(
        "Title", "Artist", "Album", "Year",
        "Tags", "Condition", "Rating");
var trackFields = Array(
        "Title", "Artist", "Album", "Year",
        "Tags", "Rating");
$(document).ready(function () {
    findTrackInfo();
    sortTrackTable();
    $("#Sort").change(sortTrackTable);
    //Initialize the request variable to null
    request = null;
    //Set keyup function for each field and tag
    for (i in searchFields) {
        if (searchFields[i] === "Tags") {
            $(".tagSearch").change(findTrackInfo);
        }
        else if (searchFields[i] === "Condition") {
            $("#Condition").change(findTrackInfo);
        }
        else {
            $("#" + searchFields[i]).keyup(findTrackInfo);
            $("#" + searchFields[i]).change(findTrackInfo);
        }
    }


});

function sortTrackTable() {
    sort = $("#Sort").val();
    findTrackInfo();
}

function findTrackInfo() {
//    alert("Test");
    //abandon any active server requests
    if (request) {
        request.abort();
    }
    //Get the value of the inputs
    var formInputs = [];
    for (i = 0; i < searchFields.length; i++) {
        if (searchFields[i] == "Tags") {
            formInputs[i] = $('input:checkbox:checked.tagSearch').map(function () {
                return this.value;
            }).get();
            if(formInputs[i].length <= 0) {
                formInputs[i] = new Array('');
            }
        } else {
            formInputs[i] = $("#" + searchFields[i]).val();
        }
    }

    ////Prepare the data by putting it in JSON format
    var dataToSend = {formInputs: formInputs, searchFields: searchFields, sort:sort};
    ////Initiate the ajax call
    request = $.ajax({
        url: "../includes/library_lookup.php",
        type: "get",
        data: dataToSend,
        dataType: "json"
    });
    //Set the displayTracks function to run on success
    request.done(displayTracks);
}

function displayTracks(response) {
    //remove all entries before populating the table again
    $("#tracks").find("tr:gt(0)").remove();
    
    //fill the table with tracks
    for (i in response) {
        var newRow = "<tr>";
        for(c in response[i]) {
            newRow += "<td>"+response[i][c]+"</td>";
        }
        newRow += "</tr>\n";
        $('#tracks tr:last').after(newRow);
    }
}