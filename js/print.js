function print()
	{
		var prtContent = document.getElementById("result_box");
		//alert(prtContent.innerHTML);
		var table= document.getElementById("table").setAttribute("border","1px");
		var WinPrint = window.open('', '', 'left=0,top=0,width=1080,height=900,toolbar=0,scrollbars=0,status=0');
		WinPrint.document.write(prtContent.innerHTML);
		WinPrint.document.close();
		WinPrint.focus();
		WinPrint.print();
		var table= document.getElementById("table").removeAttribute("border");
		WinPrint.close();
	}