$(function(){
	
	addCart();
	removeCart();
	updateCart();

	//Notificador options
	toastr.options.timeOut = 2500;
	toastr.options.closeButton = true

	$('#detalhe').change(function(){
		detalhe_id = $(this).find(':selected').data('detalhe');
		estoque = $(this).find(':selected').data('estoque');
		$("#detalhe_id").val(detalhe_id);
		$('#quantidade').empty();
		for (var i = 1; i <= estoque; i++) {
			$('#quantidade').append('<option value='+i+'>'+i+'</option>')
		};
	})

	function addCart(){
		$('.addCart').click(function(){
			var obj = $(this);
			var quantidade  = $('#quantidade').val();
			var detalhe_id = $('#detalhe_id').val();
			var produto_id = $('#produto_id').val();
			var text = $(this).text();
			$.ajax({
				url: '/ecommerce/cart/insert',
				type: 'post',
				data : {quantidade:quantidade,detalhe_id:detalhe_id,produto_id:produto_id},
				beforeSend:function(){
					obj.html('<i class="fa fa-spin fa-spinner"></i> Aguarde');
				}
			}).done(function(data){
				response = jQuery.parseJSON(data);
				if(response.status){
					toastr.success(response.mensagem, 'Sucesso!')	
					cartReload()
				}else{
					toastr.error('Houve um erro, contate o administrador da Loja', 'Erro!')
				}
				obj.html(text);
			})
		})	
	}


	function cartReload(){
		$.post('/ecommerce/cart/fragment',function(callback){
			$(".cart-header-container").html(callback);
			removeCart();
		});
		removeCart();
	}


	function removeCart(){
		$('.cart-remove').click(function(){
			event.preventDefault();
			var obj = $(this);
			var text = $(this).text();
			$.ajax({
				url: obj.attr('href'),
			}).done(function(data){
				response = jQuery.parseJSON(data);
				if(response.status){
					toastr.success(response.mensagem, 'Sucesso!')
					$('#subtotal-header').text('Subtotal R$ '+response.valor);	
					$('#subtotal').text('Subtotal R$ '+response.valor);	
					item = obj.parent();
					if(item.hasClass('cart-item')){
						item.fadeOut().remove();
					}else{
						obj.parent().parent().fadeOut().remove();
					}
				}else{
					toastr.error('Houve um erro, contate o administrador da Loja', 'Erro!')
				}
			})
		})
	}
	function updateCart(){
		$('.cart-update').change(function(){
			var obj = $(this);
			$.ajax({
				url: '/ecommerce/cart/update/'+obj.data('identificador'),
				type: 'post',
				data:{quantidade:obj.val()}
			}).done(function(data){
				response = jQuery.parseJSON(data);
				if(response.status){
					toastr.success(response.mensagem, 'Sucesso!')
					cartReload()
					$('.cart-item-total').text('R$ '+response.item_valor)
				}else{
					toastr.error('Houve um erro, contate o administrador da Loja', 'Erro!')
				}
			})
		})
	}

})