//Ajax发送邮件

function addToCart(goods_id, url){
	var data = 'goods_id=' + goods_id;
	$.ajax({
		type: "GET",
		url: url,
		data: data,
		success: function(msg){
			$('#cart-count').text(msg);
		}
	});
}