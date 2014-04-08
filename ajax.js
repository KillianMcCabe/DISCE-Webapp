var xmlhttp = createXmlHttpRequestObject();

function createXmlHttpRequestObject() {
	var xmlhttp;
	
	if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	} else {// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	if (!xmlhttp)
		alert("Can't create that object host.");
	else
		return xmlhttp;
}

function view_persona(id) {
	if (xmlhttp.readyState == 0 || xmlhttp.readyState == 4) {
		xmlhttp.open("GET", "ajax.php?persona_id=" + id, true);
		xmlhttp.onreadystatechange = handleServerResponse;
		xmlhttp.send(null); // null because not POST
	} else {
		setTimeout('view_persona('+id+')', 1000);
	}
}

function handleServerResponse() {

	if (xmlhttp.readyState == 4) {
		if (xmlhttp.status == 200) {
			xmlResponse = xmlhttp.responseXML;
			root = xmlResponse.documentElement;
			
			names = root.getElementsByTagName("name");
			persona_locations = root.getElementsByTagName("location");
			ages = root.getElementsByTagName("age");
			genders = root.getElementsByTagName("gender");
			family_sizes = root.getElementsByTagName("family_size");
			incomes = root.getElementsByTagName("income");
			occupations = root.getElementsByTagName("occupation");
			educations = root.getElementsByTagName("education");
			
			name = names.item(0).firstChild.data;
			persona_location = persona_locations.item(0).firstChild.data;
			age = ages.item(0).firstChild.data;
			gender = genders.item(0).firstChild.data;
			family_size = family_sizes.item(0).firstChild.data;
			income = incomes.item(0).firstChild.data;
			occupation = occupations.item(0).firstChild.data;
			education = educations.item(0).firstChild.data;
			
			document.getElementById("persona_name").innerHTML = name;
			document.getElementById("persona_location").innerHTML = persona_location;
			document.getElementById("persona_age").innerHTML = age;
			document.getElementById("persona_gender").innerHTML = gender;
			document.getElementById("persona_family_size").innerHTML = family_size;
			document.getElementById("persona_income").innerHTML = income;
			document.getElementById("persona_occupation").innerHTML = occupation;
			document.getElementById("persona_education").innerHTML = education;
		} else {
			alert('Something went wrong.');
		}
	}
}