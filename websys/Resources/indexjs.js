$(document).ready(function() {
	$.ajax({
		//reads from the JSON
		type: "GET",
		url: "resources/info.xml",
		dataType: "xml",
		//if it works add all the info to its corresponding place
		success: function(xml) {
		var $xml = $(xml);
        //adds every element in the "Home" work elements to the html as link list items
        //in the "homework" list 
        $xml.find('work[id="Home"]').each(function () {
            $(this).find('page').each(function () {
            	$(".homework").append(
                    "<li><a href=" +
                    $(this).find('location').text() + ">" +
                    $(this).find('name').text() + ": " +
                    $(this).find('description').text()  + "</a></li>"
            	);
        	});
        });
        //does the same as the above bit but for labs.
        $xml.find('work[id="Lab"]').each(function () {
            $(this).find('page').each(function () {
            	$(".labs").append(
            		"<li><a href=" +
                    $(this).find('location').text() + ">" +
                    $(this).find('name').text() + ": " +
                    $(this).find('description').text()  + "</a></li>"
            	);
        	});
        });
		},
		//if something goes wrong, say what it is.
		error: function(msg) {
      		alert("There was a problem: " + msg.status + " " + msg.statusText);
    	}
	});
});