addToCompare();
notaAvaliacao();
sendAvaliacao();
//Notificador options
toastr.options.timeOut = 2500;
toastr.options.closeButton = true
function addToCompare(){
	$('.addToCompare').click(function(){
		var produto = $(this).data('produto')
		$.ajax({
			url: '/ecommerce/comparacao/create',
			type: 'post',
			data: {produto_id:produto}
		}).done(function(data){
			response = jQuery.parseJSON(data);
			if(response.status){
				toastr.success(response.mensagem, 'Sucesso!')
			}else{
				toastr.error('Houve um erro, contate o administrador da Loja', 'Erro!')
			}
		})
	})
}

function notaAvaliacao(){
	$('.nota-avaliacao').click(function(){
		$('.nota-avaliacao').removeClass('stars-active');
		nota = $(this).data('nota');
		$('.nota-avaliacao:lt('+nota+')').addClass('stars-active');
		$('#avaliacao-nota').val(nota)
	})
}

function sendAvaliacao(){
	$('#sendAvaliacao').submit(function(){
		event.preventDefault();
		obj = $(this)
		dados = $(this).serialize();
		if($('#avaliacao-nota').val() != 0){
			$.ajax({
				url:'/ecommerce/produto/avaliacao',
				data: dados,
				type:'post',
				beforeSend:function(){
					obj.find('button').text('Aguarde ...').prop('disabled',true)
				}
			}).done(function(data){
				obj.find('button').text('Enviar Avaliação').prop('disabled',false)
				response = jQuery.parseJSON(data);
				if(response.status){
					toastr.options.timeOut = 6000;
					toastr.success(response.mensagem,'Sucesso');
				}else{
					toastr.options.timeOut = 6000;
					toastr.error(response.mensagem, 'Erro!');
				}
			}).fail(function(){
				toastr.options.timeOut = 4000;
				toastr.error('Houve um erro, contate o administrador da Loja', 'Erro!')
			})
		}else{
			toastr.options.timeOut = 4000;
			toastr.info('Você precisa selecionar uma nota, Clique na estrela referente a sua satisfação com o produto .','Alerta');	
		}
	})
}

var ias = jQuery.ias({
  container:  '#produto_container',
  item:       '.produto_item',
  pagination: '#pagination',
  next:       '.next'
});
