//looks for coverart being clicked
$("#coverart").click(function() {
	$.ajax({
		//reads from the JSON
		type: "GET",
		url: "songlist.JSON",
		dataType: "json",
		//if it works add all the info to its corresponding place
		success: function(responseData, status) {
			$("#title").html(responseData.song.name);
			$("#artist").html(responseData.song.artist);
			$("#album").html(responseData.song.album);
			$("#date").html(responseData.song.year);
			$("#site").attr("href", responseData.song.site);
			$("#coverart").attr("src", responseData.song.albumcover);
			//loops through the genre list and adds them to the a string to be added to the ul
			var output = "";
			$.each(responseData.song.genres, function(i, thisgenre) {
				output += "<li>"+thisgenre.genre+"</li>";
      		});
      		$("#genres").html(output);
		},
		//if something goes wrong, say what it is.
		error: function(msg) {
      		alert("There was a problem: " + msg.status + " " + msg.statusText);
    	}
	});
});