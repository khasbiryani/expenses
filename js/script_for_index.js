
//reading data for any file
function getdata(id,pn,name)
{
	if(id.charAt(0)!='t')
	id="t"+id;//add t for id 

var obj;
var result_box=document.getElementById("result_box");
var search_box=document.getElementById("search_box");
var page_control=document.getElementById("page_control");
//result_box.innerHTML='<img src=\'images/loader.gif\' width=\'300px\' height=\'300px\'>';
if(window.XMLHttpRequest)
{
	obj=new XMLHttpRequest();
}
else
{
	obj=new ActiveXObject('Microsoft.XMLHTTP');
}
obj.open("POST","read.php?table="+id+"&pn="+pn+"&name="+name,true);
obj.send();
obj.onreadystatechange=function()
{
if(obj.readyState==4 && obj.status==200)
{
//result_box.innerHTML=obj.responseText;
var res=obj.responseText;
var search=res.slice(0,res.indexOf('$'));
var print=res.slice(res.indexOf('$')+1);
//alert(search);
	//alert(print);
	result_box.innerHTML="";
	search_box.innerHTML=search;
	result_box.innerHTML=print;
}
}
return;
}

//loading page //anypage
function loadpage(page){
var obj;
var result_box=document.getElementById("result_box");
if(window.XMLHttpRequest)
{
	obj=new XMLHttpRequest();
}
else
{
	obj=new ActiveXObject('Microsoft.XMLHTTP');
}
obj.open("POST","redirect.php?page="+page,true);
obj.send();
obj.onreadystatechange=function()
{
if(obj.readyState==4 && obj.status==200)
{
result_box.innerHTML=obj.responseText;
	
}
}

}

//teacher form validation
function myFunction(id) {
	
var form_id=document.getElementById(id);
 var no_of_element = form_id.elements.length-1;
 var data=id+",;";
 var i;
 	for(i=0;i<no_of_element;i++)
    {
    var id = form_id.elements[i].id;
    var value=form_id.elements[i].value;
	if(form_id.elements[i].required)
	if(value=="")
	{
	alert("Please fill the mandatory details correctly");
	form_id.elements[i].focus();
	return false;
	}
	if(value=="")
	continue;
    data=data+id+"="+value+";";
    
    }
	alert(data);
//document.getElementById("demo").innerHTML = data;
window.location.href = "insert.php?val="+data;
}

//search
function search(text,table)
{
	//alert(table);
	var obj;
var result_box=document.getElementById("result_box");
var page_control=document.getElementById("page_control").disable;
result_box.innerHTML='<img src=\'images/loader.gif\' width=\'300px\' height=\'300px\'>';
if(window.XMLHttpRequest)
{
	obj=new XMLHttpRequest();
}
else
{
	obj=new ActiveXObject('Microsoft.XMLHTTP');
}
obj.open("POST","search.php?text="+text+"&table="+table,true);
obj.send();
obj.onreadystatechange=function()
{
if(obj.readyState==4 && obj.status==200)
{
result_box.innerHTML=obj.responseText;
	
}
}
	if(text=="")
	{
		alert("Opps!! Search Box Empty.. ");
		window.getdata(table,1);
	}
	
}






