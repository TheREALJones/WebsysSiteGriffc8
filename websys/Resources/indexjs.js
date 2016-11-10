$(document).ready(function() {
	$.ajax({
		//reads from the JSON
		type: "GET",
		url: "resources/info.xml",
		dataType: "xml",
		//if it works add all the info to its corresponding place
		success: function(xml) {
		var xmlDoc = $.parseXML(xml),
		$xml = $(xmlDoc);
        $xml.find('work[id="classwork"]').each(function () {
            $xml.find('page').each(function () {
            	$("#homework").append($(this).text() + "<br />");
        	});
        });
		},
		//if something goes wrong, say what it is.
		error: function(msg) {
      		alert("There was a problem: " + msg.status + " " + msg.statusText);
    	}
	});
});