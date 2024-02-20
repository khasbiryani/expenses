function search_req_data(table)
{
	
	var search_form=document.getElementById("search_form");
	var search_form_len=search_form.elements.length-1;
	//alert(table);
	var text="";
	var count=0;
	//collect columns
	for(i=0;i<search_form_len;i++)
	{
		if(search_form.elements[i].value=='')
		{
			count++;
			continue;
		}
		text=text+" and "+search_form.elements[i].id+"='"+search_form.elements[i].value+"'";
	}

	if(count==search_form_len)
	{
		alert("enter some data to search");
	//location.reload();
		window.getdata(table,1);
	}
	if(window.XMLHttpRequest)
{
	obj=new XMLHttpRequest();
}
else
{
	obj=new ActiveXObject('Microsoft.XMLHTTP');
}
obj.open("POST","search_fields.php?text="+text+"&table="+table,true);
obj.send();
obj.onreadystatechange=function()
{
if(obj.readyState==4 && obj.status==200)
{
	//alert(obj.responseText);
result_box.innerHTML=obj.responseText;
	
}
}
}


//


