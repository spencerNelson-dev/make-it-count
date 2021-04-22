// Ajax request and response handling
$(document).ready(function () {

    $("#input-form").submit(function(event) {
        var ajaxRequest;

        /* Stop default behavior */
        event.preventDefault();

        var values = $(this).serialize();        

        ajaxRequest = $.ajax({
            url: "count_string.php",
            type: "POST",
            dataType: "JSON",
            data: values
        });

        ajaxRequest.done(function (response, textStatus, jqXHR){

            // show success
            if(response.error == null){
                $("#result").html(response.htmlTables)
                loadCharts(response.dataArrays)
            }
            // if the php returns an error
            else {
                $("#result").html(response.error);
                $("#charts").html("");
            }

        });

        ajaxRequest.fail(function(){
            $("#result").html('There is an error with the submitted request')
        });
    });

    // Excluded Character checkbox behavior:
    // if checked show the input box.
    $("#excludeCharacter").change(function() {
        if($(this).is(":checked")){
            $("#characterTextBox")
            .html('Enter Character to Exclude: <input id="characterToExclude" name="characterToExclude" type="text"></input>')
        }
        else {
            $("#characterTextBox").html('')
        }
    })

    // Counts total characters entered into the textarea
    $("#inputString").keyup(function(event){
        $("#count").html("Total Characters: " + $("#inputString").val().length)
    })
});

// loadCharts forms data from count_string.php
// into a form that CanvasJs can handle
// www.CanvasJs.com
function loadCharts(dataArrays){

    var dataPoints = []

    console.log(dataArrays);

    arrayNames = Object.keys(dataArrays);

    arrayNames.forEach((name) => {
        
        var letters = Object.keys(dataArrays[name]);

        letters.forEach((letter) => {
            dataPoints.push({label: letter, y: dataArrays[name][letter]})
        })
    })
    dataPoints.sort((a,b) => (a.label < b.label) ? 1 : -1)

    var totalCount = 0

    if(dataPoints.length > 0)
        totalCount = dataPoints.map(el => el.y).reduce((acc, val) => acc + val);

	var chart = new CanvasJS.Chart("charts", {
		title:{
			text: "Unique Chars: " + dataPoints.length + " Total Counted: " + totalCount              
		},
        axisX:{
            title: "Character"
        },
        axisY:{
            title: "Number of Instances"
        },
		data: [              
		{
			type: "bar",
			dataPoints: dataPoints
		}
		]
	});
	chart.render();
}
