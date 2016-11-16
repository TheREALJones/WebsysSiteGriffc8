$.fn.hexed = function() {
	var initTime;
	var difficulty = 5;
	var turns = 10;
	var tries_taken = 0;
	var running_score = 0;
	var obj = this;
	var updateOnSlide = true;

	function genFF() {
		return Math.floor(Math.random() * 255).toString(16);
	}

	function gen255() {
		return Math.floor(Math.random() * 255);
	}

	function hexFromRGB(r, g, b) {
		var hex = [
			r.toString( 16 ),
			g.toString( 16 ),
			b.toString( 16 )
		];
		$.each( hex, function( nr, val ) {
			if ( val.length === 1 ) {
				hex[ nr ] = "0" + val;
			}
		});
		return hex.join( "" ).toUpperCase();
	}

	function updateHex() {
		var red =	 $("#red").slider("value"),
				green = $("#green").slider("value"),
				blue =	$("#blue").slider("value"),
				hex =	hexFromRGB(red, green, blue);
		$("#yours").css("background-color", "#" + hex );
	}

	function randomize() {
		$("#red").slider("value", gen255());
		$("#green" ).slider("value", gen255());
		$("#blue").slider("value", gen255());
		updateHex();
		$("#theirs").css("background-color", "#" + genFF() + genFF() + genFF());
	}

	// add pregame controls
	$("#content").append(
		'<button id="begin" class="pregame">Begin!</button>' +
		'<div class="control pregame">Turns: <input type="number" min=0 value=' + turns + ' id="turns" class="pregame"/></div>' +
		'<div class="control pregame">Difficulty: <input type="number" min=0 max=10 value=' + difficulty + ' id="difficulty" class="pregame"/></div>' +
		'<div class="control pregame">Update hex on slider change: <input type="checkbox" checked=true id="updateOnSlide"/></div>');
	$("#begin").on("click", function() {
		// insert controls/game stuff
		difficulty = $("#difficulty").val() || 5;
		turns = $("#turns").val() || 10;
		updateOnSlide = $("#updateOnSlide").is(":checked");
		console.log(updateOnSlide);
		$("#content").append(
			'<div class="hex" id="yours"/>' +
			'<div class="hex" id="theirs"/>' +
			'<div id="controls">' +
				'<div class="input-wrap">' +
					'<div id="red" data-id="#red-input" class="color-slider"></div>' +
					'<input type="text" maxlength=2 id="red-input" data-id="#red"></input>' +
				'</div>' +
				'<div class="input-wrap">' +
					'<div id="green" data-id="#green-input" class="color-slider"></div>' +
					'<input type="text" maxlength=2 id="green-input" data-id="#green"></input>' +
				'</div>' +
				'<div class="input-wrap">' +
					'<div id="blue" data-id="#blue-input" class="color-slider"></div>' +
					'<input type="text" maxlength=2 id="blue-input" data-id="#blue"></input>'  +
				'</div>' +
				'<button id="check">Check inputs!</button>' +
			'</div>' +
			'<div id="history"/>');
		//set up sliders
		$("#red, #green, #blue").slider({
			orientation: "horizontal",
			range: "min",
			max: 255,
			slide: function(event, ui) {
				$($(this).attr("data-id")).val(parseInt(ui.value).toString(16).toUpperCase()); if (updateOnSlide) { updateHex(); }}, //i know those could be put in functions; also, I'm still not 100% sure about whether updateHex should be called
			change: function(event, ui) {
				$($(this).attr("data-id")).val(parseInt(ui.value).toString(16).toUpperCase()); if (updateOnSlide) { updateHex(); }}
		});
		//set up text input things
		$("#red-input, #green-input, #blue-input").change(function() {
			var value = parseInt(this.value, 16);
			$($(this).attr("data-id")).slider("value", value);
		});
		//set up the check button
		$("#check").on("click", function() {
			var elapsedTime = new Date().getTime() - initTime;
			if (elapsedTime > 15000) { elapsedTime = 15000;} //cap off so we don't multiple two negatives - score is 0 if you take too long!
			++tries_taken;
			$("#turnRem").text(turns - tries_taken);
			//compute score
			var rgb = $("#theirs").css("background-color").replace(/[^\d,]/g, '').split(","); // replace all non-digits and commas with nothing, leaving rrr,ggg,bbb out of rgb(rrr, ggg, bbb), and then split it at commas

			var red	= $("#red").slider("value");
			var green = $("#green").slider("value");
			var blue = $("#blue").slider("value");

			var rpct  = Math.abs(rgb[0] - red  ) / 255 * 100;
			var gpct  = Math.abs(rgb[1] - green) / 255 * 100;
			var bpct  = Math.abs(rgb[2] - blue ) / 255 * 100;

			var avg	 = (rpct + gpct + bpct) / 3;
			score = Math.round(((15 - difficulty - avg) / ( 15 - difficulty)) * (15000 - elapsedTime) * 100) / 100;

			if (score < 0) { score = 0; }

			rpct = Math.round(rpct);
			gpct = Math.round(gpct);
			bpct = Math.round(bpct);

			// add thing to history of scores

			$("#history").append(
				'<div class="item">' +
					'<div class="info" style="background: #' + hexFromRGB(red, green, blue) + '"><p>Score: '	+ score +
						'</p><span class="red">' + rpct + '</span>' +
						'<span class="green">' + gpct + '</span>' +
						'<span class="blue">' + bpct + '</span>' +
					'</div>' +
				'</div>');
			running_score += score;
			$("#score").text(running_score);
			if (tries_taken >= turns) {
				//remove controls; add "new game" button
				$("#check, #yours, #theirs, #controls").remove();
				$("#header").append('\n<button id="playAgain">Play again!</button>');
				$("#playAgain").on("click", function() {
					$("#content").empty();
					$(obj).hexed();
					$("#playAgain").remove();
				});
			} else {
				randomize();
				initTime = new Date().getTime();
			}
		});

		// finish init

		randomize();
		$("#header").html(
			"Difficulty: " + $("#difficulty").val() +
			"\n<span id='turnRem'>" + $("#turns").val() + "</span> turn(s) remaining" +
			"\nScore: <span id='score'>0</span>");
		initTime = new Date().getTime();
		$(".pregame").remove();
	});
}

$(document).ready(function() {
	$("#content").hexed();
});
