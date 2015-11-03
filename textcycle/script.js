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

function searchBook(isbn, title) {
	var page="https://www.googleapis.com/books/v1/volumes?q="+isbn+"+isbn&callback=?";
	var num=0;
	$("#add-section").html("");
	$("#add-section").append("<h1>Add Book</h1>");
	$.getJSON(page,function(data) {
		$.each(data, function(key, value) {
			if (key=="totalItems") {
				if (value==0) {
					var search_by_name=true;
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
					picture=value[i]["volumeInfo"]["imageLinks"]["smallThumbnail"];
					category=value[i]["volumeInfo"]["categories"];
					list=0;
					$("#add-section").append("<div id='book_"+i+"'>");
					$("#add-section").append("<h2>"+title+"</h2>");
					$("#add-section").append("<img src='"+picture+"' >");
					$("#add-section").append("<input type='button' value='Add this book' onClick='addBook(\""+isbn +"\", \""+title+"\", \""+author+ "\",\""+ picture +"\", \""+ category+"\", \""+list+"\")'>");
					$("#add-section").append("</div>");
				}
			}
		});
	});
}

function addBook(isbn,title,author,picture,category,list) {
	alert(author);
	$.ajax({
		type: "POST",
		url:"addbook.php",
		data:"isbn="+isbn+"&title="+title+"&author="+author+"&picture="+picture+"&category="+category+"&list="+list,
		success: function(html){
			if(html=='true'){
				alert("Book added!");
			}
			else {
				alert("Technical difficulty");
			}
		},
		beforeSend:function()
		{
			
		}
	});
	
}