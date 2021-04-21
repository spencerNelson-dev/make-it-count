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

    $("#excludeCharacter").change(function() {
        if($(this).is(":checked")){
            $("#characterTextBox")
            .html('Enter Character to Exclude: <input id="characterToExclude" name="characterToExclude" type="text"></input>')
        }
        else {
            $("#characterTextBox").html('')
        }
    })

    $("#inputString").keyup(function(event){
        $("#count").html("Total Characters: " + $("#inputString").val().length)
    })
});

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

    console.log(dataPoints);

	var chart = new CanvasJS.Chart("charts", {
		title:{
			text: "Total Counted: " + dataPoints.length              
		},
        axisX:{
            title: "Number of Instances",
            valueFormatString: ""
        },
        axisY:{
            title: "Character"
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
