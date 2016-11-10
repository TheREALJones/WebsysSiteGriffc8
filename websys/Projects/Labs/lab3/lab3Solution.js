function step1(current, depth){
	if (!depth) {
		depth=0;
	}
	if (current.nodeType == 1) {
		var txt = "";
	}
	for (var i = 0; i<depth; i++){
		txt+="-";
	}
	txt+=current.tagName+"\n";
	current.addEventListener("click", function() { alert(this.tagName); return false; });
	if (current.tagName=="DIV"){
		current.addEventListener("mouseover", function() { this.style.backgroundColor = "Aquamarine"; this.style.paddingLeft = "10px"; return false; });
		current.addEventListener("mouseout", function() { this.style.backgroundColor = "white"; this.style.paddingLeft = "0px"; return false; });
	}
	for (var n = 0; n<current.children.length; n++){
		var childTxt = step1(current.children[n], depth+1);
		if (childTxt != null && childTxt !="") {
			txt+=childTxt;
		}
	}
	return txt;
}

document.getElementById("info").innerHTML = step1(document.getElementsByTagName("html")[0]);
document.getElementsByTagName("body")[0].appendChild(document.getElementsByTagName("H2")[0].cloneNode(true));
document.getElementsByTagName("h2")[document.getElementsByTagName("h2").length-1].innerHTML= "\"Sometimes it is better to light a flamethrower than curse the darkness.\" -Terry Pratchett";