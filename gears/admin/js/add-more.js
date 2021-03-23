
function addFeatures()
{
	newDiv = document.createElement("div");
	
        str = "<label class='col-sm-2 control-label'><strong>Feature?</strong></label>"
        str += "<div class='col-sm-10'>"
        str += "<input type='text' class='form-control' name='features[]'/>"
        str += "</div>"
        str += "<hr style='clear: both;'>"

	newDiv.innerHTML = str;

	document.getElementById('featureHolder').appendChild(newDiv);
}

