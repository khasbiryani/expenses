//on clicking the data 
function clicked(text,table)
{
	var obj;
	text=' and c1="'+text+'"';
var result_box=document.getElementById("result_box");
var search_box=document.getElementById("search_box").hide;
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
obj.open("POST","search_fields.php?text="+text+"&table="+table,true);
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
		location.reload();
		window.getdata(table,1);
	}
	
	
	
}


//variables for overlay
var $overlay=$('<div id="overlay"></div>');
var $close=$("<img>");


//update view script jquery
$(document).on('click', "td button,input[value='update']", function(){ 

	var value=$(this).attr("value");
	if(value=='update')
	{
		$overlay.append($close);
		$("body").append($overlay);
		
		
		$close.attr("src","images/close_icon.png")
		$close.attr("class","close_icon");	
		
			var column=$(this).attr("title");
			var id=$(this).attr("id");
			//alert(column);
			var text=" and "+column+"='"+id+"'";
			//alert(text);
			var table=$(this).attr("name");
			//alert(text);
			//ajax for getting data from view_data.php
			
	
			
			
			$.ajax({
				method: "POST",
				url: "view_update.php?text="+text+"&table="+table+"&column"+column
 
})
  .done(function( msg ) {
	//alert(msg);
    $overlay.append(msg);
  });
 
			
		$overlay.show("slow");
	}
	
}
);

$close.click(function(){
	//alert($(this).attr("src"));
	$overlay.hide('slow');
	$overlay.empty();
	
});

$(document).on('click','img[src="images/close_icon.png"]',function(){
	
	$overlay.hide("slow");
	$overlay.empty();
});

//updating form

function update_data(table,val,titl)
{
	result_box=document.getElementById("result_box");
	var update_form;
	if(document.getElementById('window_overlay').style.display=="block")
	{
		update_form=document.getElementById("update_form");
	}
	else
	{
		update_form=document.getElementById("update_form1");
	}
	
	var update_form_len=update_form.elements.length-1;
	link=" and "+val+"='"+titl+"'";
	//alert(link);
	var text="";
	var branch="";
	
	var count=0;
	//collect columns
	for(i=0;i<update_form_len-1;i++)
	{
		if(update_form.elements[i].readOnly==false)
		text=text+""+update_form.elements[i].name+"='"+update_form.elements[i].value+"',";
	if(update_form.elements[i].type=='select-one')
	{
		if(update_form.elements[i].name=="c13")
		{
			branch=update_form.elements[i].name+"='"+update_form.elements[i].value+"'";
		}
		text=text+""+update_form.elements[i].name+"='"+update_form.elements[i].value+"',";
	}
	//alert(update_form.elements[i].type);
	}
	//text=text+"c24='3',";
	$overlay.hide();
	if(window.XMLHttpRequest)
	{
		obj=new XMLHttpRequest();
	}
	else
	{
		obj=new ActiveXObject('Microsoft.XMLHTTP');
	}
	//alert(text);
obj.open("POST","update.php?text="+text+"&table="+table+"&link="+link+"&branch="+branch,true);
obj.send();
obj.onreadystatechange=function()
{
if(obj.readyState==4 && obj.status==200)
{	
result_box.innerHTML=obj.responseText;
//alert(obj.responseText);
	
}
}
}

//closing overlay on clicking 'update changes' button

$(document).on('click', "td button,input[type='button']", function(){ 
	var value=$(this).attr("value");
	if(value=='update changes'||value=='cancel')
	{
		$overlay.hide("slow");
		$overlay.empty();
		location.reload();
	}
});



//display data on overlay
$(document).on('click','td a[value="60"],img[value="60"]',dis=function(){
	
	$overlay.append($close);
		$("body").append($overlay);
		
		
		$close.attr("src","images/close_icon.png")
		$close.attr("class","close_icon");	
			var column=$(this).attr("title");
			var text=" and "+column+"='"+$(this).attr("id")+"'";
			var table=$(this).attr("name");
			//alert(text);
			//ajax for getting data from view_data.php
			$.ajax({
				method: "POST",
				url: "view_display.php?text="+text+"&table="+table,
 
})
  .done(function( msg ) {
	
   $overlay.append(msg);
   
  });
 $overlay.show("slow");
			
		
});



//approve data 
$(document).on('click','img[value="30"]',function(){
	$table=$(this).attr("name");
	link=$(this).attr("id");
	text="c24='2',";
	link=" and c1='"+link+"'";
	
	$.ajax({
				method: "POST",
				url: "update.php?text="+text+"&table="+$table+"&link="+link
 
})
  .done(function( msg ) {
	//alert(msg);
    $(this).hide();
	$overlay.hide('slow');
	$overlay.empty();
	location.reload();
  });
});


//deleting data 
$(document).on('click','img[value="40"]',function(){
	$table=$(this).attr("name");
	link=$(this).attr("id");
	key=$(this).attr("title");
	
	
		//alert("in process");
		link=key+"='"+link+"'";
		$.ajax({
				method: "POST",
				url: "delete.php?table="+$table+"&link="+link
 
})
  .done(function( msg ) {
alert(msg);
    $(this).hide();
	$overlay.hide('slow');
	$overlay.empty();
	location.reload();
  });
		
		
	
});

$col_count=0;

//insert data

$(document).on('click','img[value="10"]',function(){
	
	$("#search_box").html(" ");
	$table=$(this).attr("name");

	
	$.ajax({
				method: "POST",
				url: "insert_view.php?table="+$table
 
})
  .done(function(msg) {
	  $col_count=msg.substr(msg.indexOf("$")+1,msg.length);
	  msg=msg.substr(0,msg.indexOf("$"));
		$("#result_box").html(msg);

  });
});
$no_rec=1;
//add record
$(document).on('click','input[value="+Add"]',function(){
	$table=$(this).attr("name");

	
	$.ajax({
				method: "POST",
				url: "insert_input.php?table="+$table+"&id="+$no_rec
 
})
  .done(function(msg) {
	  $no_rec++;
		$("#table_insert").append(msg);

  });
});

function insert_multiple(table)
{
	var values="(";
	var cols="(";
	insert_form=document.getElementById("10");
	insert_form_len=insert_form.elements.length;
	//alert(insert_form_len);
	//alert($col_count);
	for(i=0;i<insert_form_len;i++)
	{
		n=i+1;
		//if((n%$col_count==0))
				//alert(n%$col_count);
		
		value=insert_form.elements[i].value;
		if(insert_form.elements[i].hasAttribute("required")&&value=='')
		{
			alert("fill in maditory details correctly");
			insert_form.elements[i].focus();
		}
		if(n%$col_count==0)
		{
			cols=cols+insert_form.elements[i].id+")";
		values=values+"'"+insert_form.elements[i].value+"')";
		//alert(n);
		if(n!=insert_form_len)
		{
			cols=cols+":(";
			values=values+":(";
		}
		continue;
		}
		cols=cols+insert_form.elements[i].id+",";
		values=values+"'"+insert_form.elements[i].value+"',";
		
	}
	//alert(cols);
	//alert(values);
	if(window.XMLHttpRequest)
	{
		obj=new XMLHttpRequest();
	}
	else
	{
		obj=new ActiveXObject('Microsoft.XMLHTTP');
	}
obj.open("POST","insert_new.php?table="+table+"&cols="+cols+"&values="+values,true);
obj.send();
obj.onreadystatechange=function()
{
	if(obj.readyState==4 && obj.status==200)
	{
		result_box=document.getElementById("result_box");
		result_box.innerHTML=obj.responseText;
	
	}
}
}

//remove empty record set
$(document).on('click','img[value="remove"]',function(){
	id_now="#"+$(this).attr("title");
		//alert(id_now);
	$("id_now").live(function(){
		
		alert($(this.attr("title")));
		
	})
	

});




$(document).on('click','input[value="Delete"]',function(){
	
	$overlay.append($close);
		$("body").append($overlay);
		$close.attr("src","images/close_icon.png")
		$close.attr("class","close_icon");	
			var text1=$(this).attr("title");
			alert(text1);
			$.ajax({
				method: "POST",
				url: "verify_delete.php?text="+text1,
 
})
  .done(function( msg ) {
	

   $overlay.append(msg);
   
  });
 $overlay.show("slow");
			
		
});
