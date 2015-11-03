function sendmsg(_isbn,_id) {
	
	isbn=""+_isbn;
	id=""+_id;
	textid=isbn+id+"text";
	message=escape(document.getElementById(textid).value);
	if (message==(""))
		alert("Please enter a message!");
	else {
		//send to database
		$.ajax({
			type: "POST",
			url:"sendmessage.php",
			data:"isbn="+isbn+"&id="+id+"&message="+message,
			success: function(html){
				if(html=='true'){
					$(".msgstatus").text("");
					$(".send").css("display","block");
					var e=jQuery.Event("click");
					jQuery(".close-reveal-modal").trigger(e);
					alert("Message sent!");
				}
				else {
					$(".send").css("display","block");
					$(".msgstatus").text("");
					alert(html);
				}
			},
			beforeSend:function()
			{
				$(".msgstatus").text("Please wait...");
				$(".send").css("display","none");
				
			}
		});
	}
}
function replymsg(_isbn,_id,_counter) {
	isbn=""+_isbn;
	id=""+_id;
	counter=""+_counter;
	//alert("isbn: "+_isbn+" area_id: "+_counter);

	textid="reply"+counter;
	//alert("isbn: "+_isbn+" area_id: "+textid);
	message=escape(document.getElementById(textid).value);
	if (message==(""))
		alert("Please enter a message!");
	else {
		//send to database
		$.ajax({
			type: "POST",
			url:"sendmessage.php",
			data:"isbn="+isbn+"&id="+id+"&message="+message,
			success: function(html){
				if(html=='true'){
					//$(".msgstatus").text("");
					//$(".send").css("display","block");
					//var e=jQuery.Event("click");
					//jQuery(".close-reveal-modal").trigger(e);
					alert("Message sent!");
		           //$('#details').('i');
	 // refresh every 1000 milliseconds
				}
				else {
					//$(".send").css("display","block");
					//$(".msgstatus").text("");
					alert(html);
				}
			},
			beforeSend:function()
			{
				//$(".msgstatus").text("Please wait...");
				//$(".send").css("display","none");
				
			}
		});
	}
}
function readTag(_id, _isbn){
	isbn=""+_isbn;
	id=""+_id;

		//send to database
		$.ajax({
			type: "POST",
			url:"tag_process.php",
			data:"isbn="+isbn+"&partner="+id,
			success: function(html){
				if(html=='true'){
					alert("Updated!");

				}
				else {
					alert(html);
				}
			}
		});
}

function removeBook(_id, _isbn,_list){
	isbn=""+_isbn;
	id=""+_id;
	list=""+_list;
	//alert("isbn: "+isbn+" id: "+id+" list: "+list);
	var r = confirm("Are you sure you want to delete?");
	if(r== true){
		//send to database
		$.ajax({
			type: "POST",
			url:"remove_book.php",
			data:"isbn="+isbn+"&id="+id+"&list="+list,
			success: function(html){
				if(html=='true'){
					var e=jQuery.Event("click");
					jQuery(".close-reveal-modal").trigger(e);
					alert("Book deleted!");
					$('body').load("userProfile.php");

				}
				else {
					alert(html);
				}
			}
		});
	}
	else{
		var e=jQuery.Event("click");
		jQuery(".close-reveal-modal").trigger(e);
	}
	
}

function searchBook(isbn,list) {
	if (isbn=="") {
		alert("Please enter ISBN or Book title");
		return false;
	}
	else if (validateISBN(isbn)==true){
		var page="https://www.googleapis.com/books/v1/volumes?q="+isbn+"+isbn&callback=?";
	}
	else {
		var para_list=new Array();
		para_list=isbn.split(" ");
		var para="";
		for (i=0; i<para_list.length; i++)
			para=para+"intitle:"+para_list[i];
		var page="https://www.googleapis.com/books/v1/volumes?q="+isbn+"+&callback=?";
	}
	var num=0;
	$("#add-section").html("<p>Cannot find the book here?</p> <p><a>Click here</a> to manually add the book</a>");
	counter=0;
	$.getJSON(page,function(data) {
		$.each(data, function(key, value) {
			if (counter>5)
				return false;
			counter++;
			if (key=="totalItems") {
				if (value==0) {
					$("#add-section").append("<h2>Sorry, we cannot find the book you entered</h2>");
					return false;
				} else {
					num=value;
				}
			}
			if (key=="items"){
				for (i=0; i<num; i++) {
					//var title, isbn, picture, category, list;
					title=value[i]["volumeInfo"]["title"];
				    isbn=value[i]["volumeInfo"]["industryIdentifiers"][1]["identifier"];
				    author=value[i]["volumeInfo"]["authors"];
					picture=value[i]["volumeInfo"]["imageLinks"]["thumbnail"];
					category=value[i]["volumeInfo"]["categories"];
					description=value[i]["volumeInfo"]["description"];
					//list=0;
					
					$("#add-section").append("<div id='book_"+i+"' style='margin-bottom:60px'>");
					$("#add-section").append("<h2>"+title+"</h2>");
					$("#add-section").append("<img src='"+picture+"' alt='No picture' style='float:left; margin-right:10px'>");
					$("#add-section").append("<div>");
					$("#add-section").append("<p>ISBN: "+isbn+"</p>");
					$("#add-section").append("<p'>Author: "+author+"</p>");
					if (description)
						$("#add-section").append("<p'>Description: "+description+"</p>");
					$("#add-section").append("</div>");
					$("#add-section").append("<input type='button' value='Add this book' onClick='addBook(\""+isbn +"\", \""+title+"\", \""+author+ "\",\""+ picture +"\", \""+ category+"\", \""+list+"\")'>");
					$("#add-section").append("</div>");
					$("#add-section").append("<hr/>");
				}
			}
		});
	});
}

function addBook(isbn,title,author,picture,category,list) {
	$.ajax({
		type: "POST",
		url:"addbook.php",
		data:"isbn="+isbn+"&title="+escape(title)+"&author="+author+"&picture="+escape(picture)+"&category="+category+"&list="+list,
		success: function(html){
			if(html=='true'){
				var e=jQuery.Event("click");
				jQuery(".close-reveal-modal").trigger(e);
				alert("Book added!");
				$('body').load("userProfile.php");
			}
			else {
				alert(html);
			}
		},
		beforeSend:function()
		{
			
		}
	});
	
}

function validateISBN(isbn) {
	  if(isbn.match(/[^0-9xX\.\-\s]/)) {
	    return false;
	  }
	 
	  isbn = isbn.replace(/[^0-9xX]/g,'');
	 
	  if(isbn.length != 10 && isbn.length != 13) {
	    return false;
	  }
	     
	    checkDigit = 0;
	  if(isbn.length == 10) {
	    checkDigit = 11 - ( (
	                 10 * isbn.charAt(0) +
	                 9  * isbn.charAt(1) +
	                 8  * isbn.charAt(2) +
	                 7  * isbn.charAt(3) +
	                 6  * isbn.charAt(4) +
	                 5  * isbn.charAt(5) +
	                 4  * isbn.charAt(6) +
	                 3  * isbn.charAt(7) +
	                 2  * isbn.charAt(8)
	                ) % 11);
	              
	    if(checkDigit == 10) {
	      return (isbn.charAt(9) == 'x' || isbn.charAt(9) == 'X') ? true : false;
	    } else {
	      return (isbn.charAt(9) == checkDigit ? true : false);
	    }
	  } else {
	    checkDigit = 10 -  ((
	                 1 * isbn.charAt(0) +
	                 3 * isbn.charAt(1) +
	                 1 * isbn.charAt(2) +
	                 3 * isbn.charAt(3) +
	                 1 * isbn.charAt(4) +
	                 3 * isbn.charAt(5) +
	                 1 * isbn.charAt(6) +
	                 3 * isbn.charAt(7) +
	                 1 * isbn.charAt(8) +
	                 3 * isbn.charAt(9) +
	                 1 * isbn.charAt(10) +
	                 3 * isbn.charAt(11)
	                ) % 10);
	              
	    if(checkDigit == 10) {
	      return (isbn.charAt(12) == 0 ? true : false) ;
	    } else {
	      return (isbn.charAt(12) == checkDigit ? true : false);
	    }
	  }
	}
