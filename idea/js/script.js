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