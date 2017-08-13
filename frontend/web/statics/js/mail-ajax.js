//Ajax发送邮件

function sendVerifyCode(email, url){
	var data = 'email=' + email;
	$.ajax({
		type: "POST",
		url: url,
		data: data,
		success: function(msg){
			alert( "Send Mail " + msg );
		}
	});
}