function postRequest(strURL,fromFunction)
{
    var xmlHttp;
    if (window.XMLHttpRequest)
    {
    // Mozilla, Safari, ...
     var xmlHttp = new XMLHttpRequest();
    }
    else if (window.ActiveXObject)
    { // IE
     var xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlHttp.open('POST', strURL, true);
    xmlHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xmlHttp.onreadystatechange = function()
    {
    if (xmlHttp.readyState == 4)
    {
        updatepage(xmlHttp.responseText,fromFunction);
    }
    }
    xmlHttp.send(strURL);
}

function updatepage(str,fromFunction)
{
    if(fromFunction == "getSubTopics")
    {
		document.getElementById("subtopic_td").innerHTML = str;
	}
    else if(fromFunction == "getTemplateDetails")
    {
		document.getElementById("ajax_div").display = "none";
		document.getElementById("ajax_div").innerHTML = str;

		for(var i=1;i<=parseInt(global_current_records);i++)
		{
			document.getElementById("subject_id_"+i).value = document.getElementById("ajax_subject_id_"+global_rowNo).value;
			document.getElementById("subject_name_"+i).value = document.getElementById("ajax_subject_name_"+global_rowNo).value;
			document.getElementById("subtopic_td_"+i).innerHTML = document.getElementById("ajax_subtopic_td_"+i).innerHTML;	
		}

		// get current qns from the selected template
		getCurrentTemplateValues();
	}
    else if(fromFunction == "addTemplateRow")
    {
		new_record = parseInt(global_current_records) + 1;
		document.getElementById("table_"+new_record).innerHTML = str;
		document.getElementById("current_records").value = new_record;
		getTemplateDetails(new_record);
	}
    else if(fromFunction == "getCurrentTemplateValues")
    {
		document.getElementById("listTemplates_div").innerHTML = str;
	}
	else if(fromFunction == "confirmTemplate")
	{
		document.getElementById("ajax_div").innerHTML = str;
		alert(document.getElementById("MsgDiv").innerHTML);
		window.location.href = "buildTemplate.php";
	}
	else if(fromFunction == "deleteTemplateEntry")
	{
		document.getElementById("ajax_div").innerHTML = str;
		alert(document.getElementById("MsgDiv").innerHTML);
		window.location.href = "buildTemplate.php";
	}
	
}

global_current_records = "";
global_rowNo = "";

function getCurrentTemplateValues()
{
	var template_id = document.getElementById("template_id").value;
	var url= "doOper.php?sn=1&doOper=getCurrentTemplateValues&template_id="+template_id;
	postRequest(url,"getCurrentTemplateValues");
}

function getTemplateDetails(rowNo)
{
	var template_id = document.getElementById("template_id").value;
	var current_records = document.getElementById("current_records").value;
	var url= "doOper.php?sn=1&doOper=getTemplateDetails&template_id="+template_id+"&rowNo="+rowNo+"&current_records="+current_records;
	global_rowNo = rowNo;
	global_current_records = current_records; // this is if there are multiple rows and you wnat to populate multiple row subjects/subtopics
	postRequest(url,"getTemplateDetails");
}

function addTemplateRow()
{
	var current_records = document.getElementById("current_records").value;
	global_current_records = current_records; 
	var url= "doOper.php?sn=1&doOper=addTemplateRow&current_records="+current_records;
	postRequest(url,"addTemplateRow");
}

function getSubTopics()
{
	var subject_id = document.getElementById("subject_id").value;
	var url= "doOper.php?sn=1&doOper=getSubTopics&subject_id="+subject_id;
	postRequest(url,"getSubTopics");
}

function val_addSubject()
{
	var subjectname = document.getElementById("subject_name").value;
	if(subjectname == "")
	{
		alert("Enter Subject Name");
		return false;
	}
}

function val_addSubtopic()
{
	var subtopic_name = document.getElementById("subtopic_name").value;
	var subject_id = document.getElementById("subject_id").value;
	if(subtopic_name == "")
	{
		alert("Enter Subtopic Name");
		return false;
	}
	else if(subject_id == "-1")
	{
		alert("Select Subject Name");
		return false;
	}
}

function confirmTemplate(added_marks,total_marks)
{
	if(parseInt(added_marks) == parseInt(total_marks))
	{
		var template_id = document.getElementById("template_id").value;
		var url= "doOper.php?sn=1&doOper=confirmTemplate&template_id="+template_id;
		postRequest(url,"confirmTemplate");	
	}
	else
	{
		alert("Added Marks not matching Total Marks. Please Add or Remove entries");
	}
}

function deleteTemplateEntry(autoId)
{
	var template_id = document.getElementById("template_id").value;
	var url= "doOper.php?sn=1&doOper=deleteTemplateEntry&autoId="+autoId+"&template_id="+template_id;
	postRequest(url,"deleteTemplateEntry");	
}