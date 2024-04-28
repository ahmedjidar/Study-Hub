var instanse = false;
var state;
var mes;
var file;

function Chat () {
    this.update = updateChat;
    this.send = sendChat;
	this.getState = getStateOfChat;
}

//gets the state of the chat
function getStateOfChat(){
	if(!instanse){
		// alert("getStateOfChat() invoked");
		 instanse = true;
		 $.ajax({
			   type: "POST",
			   url: "../PHPChat/process.php",
			   data: {  
			   			'function': 'getState',
						'file': file
						},
			   dataType: "json",
			
			   success: function(data){
				   state = data.state;
				   instanse = false;
			   },
			});
	}	 
}

//Updates the chat
function updateChat(){
	 if(!instanse){
		// alert("updateChat() invoked");
		var current_username = document.getElementById('current_username').value;
		 instanse = true;
	     $.ajax({
			   type: "POST",
			   url: "../PHPChat/process.php",
			   data: {  
			   			'function': 'update',
						'state': state,
						'file': file
						},
			   dataType: "json",
			   success: function(data){
				if(data.text){
					for (var i = 0; i < data.text.length; i++) {
						var messageParts = data.text[i].split(": ");
						var sender = messageParts[0];
						var messageText = messageParts[1];
						if (sender == current_username) { // Compare with the current username
							var p = $('<p>').text("【" + sender + "】" + " " + messageText).addClass('bg-purple-400 inline-block max-w-xs rounded-2xl rounded-br-none text-white font-medium p-2 mt-3 mx-2 shadow-md break-words');
							var div = $('<div>').append(p);
							div.css('justify-content', 'flex-end');
						} else {
							var p = $('<p>').text("【" + sender + "】" + " " + messageText).addClass('bg-blue-400 inline-block max-w-xs rounded-2xl rounded-bl-none text-white font-medium p-2 mt-3 mx-2 shadow-md break-words');
							var div = $('<div>').append(p);
							div.css('justify-content', 'flex-start');
						}
						div.addClass('flex');
						$('#chat-area').append(div);
						p.hide().fadeIn(100);
					}																		
				}
				document.getElementById('chat-area').scrollTop = document.getElementById('chat-area').scrollHeight;
				instanse = false;
				state = data.state;
			},								
		});
	 }
	 else {
		 setTimeout(updateChat, 1500);
	 }
}

//send the message
function sendChat(message, nickname)
{       
	// alert("sendChat() invoked");
    updateChat();
     $.ajax({
		   type: "POST",
		   url: "../PHPChat/process.php",
		   data: {  
		   			'function': 'send',
					'message': message,
					'nickname': nickname,
					'file': file
				 },
		   dataType: "json",
		   success: function(data){
			   updateChat();
		   },
		});
}





