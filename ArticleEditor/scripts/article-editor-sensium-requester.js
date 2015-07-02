var SensiumRequester = function (vals) {
	//var apiKey = "9f31a709-5d40-4eb4-bb79-43cac4030cfb" /*See php file*/
	var GLOBAL_controller = vals.controller;
	var sensiumRequester = {};

	sensiumRequester.sensium = function () {
		console.log("IN HERE");
		$.post("sensiumRequester.php", {
			operation : "sensium",

		})
		.done(function (data) {
			//console.log("data: " + data);
			var help = JSON.parse(data);
			console.log("score: " + help.polarity.score);
		});
	}

	sensiumRequester.sensiumURLRequest = function (url) {
		console.log("sensiumURLRequest");
		$.post("sensiumRequester.php", {
			operation : "sensiumURLRequest",
			url : url
		})
		.done(function (data) {
			//console.log("data: " + data);
			//console.log("DATA END");
			var help = JSON.parse(data);
			//console.log("score: " + help.polarity.score);
			$("#sensiumOverallScore").html("<b>Sensium(sentiment) score: " + help.polarity.score.toFixed(2) + "</b>");

			$('#progressBarSensiumOverallScoreController').css("right", 200 - help.polarity.score * 200);
			//$('#progressBarSensiumOverallScore').val(help.polarity.score * 50 + 50);
		});
	}

	sensiumRequester.sensiumTextRequest = function (text, sectionName) {
	//	console.log("sensiumTextRequest");
		
		//		console.log("UP:|"+sectionName+"|");
		/*jQuery.ajax({
		url : "sensiumRequester.php",
		type : "POST",
		data : {
		operation : "sensiumTextRequest",
		text : text
		},
		success : function (data) {
		//console.log("data: " + data);
		if (data != "") {
		var help = JSON.parse(data);
		if (help != undefined)
		if (help.polarity != undefined)
		if (help.polarity.score != undefined)
		console.log("TEXT score: " + help.polarity.score);
		else
		console.log("TEXT score: 0");
		else
		console.log("TEXT score: 0");
		else
		console.log("TEXT score: 0");

		}
		}
		});*/
		$.post("sensiumRequester.php", {
			operation : "sensiumTextRequest",
			sectionName: sectionName,
			text : text
		})
		.done(function (data) {
			//console.log("data: " + data);
			if (data != "") {
				var dataArray = data.split("||splithere||");
				var sectionName = dataArray[0];
				sectionName = sectionName.substring(1, sectionName.length);
				//console.log("DOWN:|"+sectionName+"|");
				data = dataArray[1];
				var help = JSON.parse(data);
				var score = 0;
				if (help != undefined)
					if (help.polarity != undefined)
						if (help.polarity.score != undefined){
							//console.log(sectionName + " TEXT score: " + help.polarity.score);
							score = help.polarity.score;
							}
				GLOBAL_controller.setSentimentScoreOfSection(score.toFixed(2), sectionName);
			}
		});
	}

	return sensiumRequester;

}
