$(function(){

	$('.frete-calcular').blur(function(){
		cepAjax();
	})

	cepAjax();

	function cepAjax(){
		var val = $(".frete-calcular").val().replace("-","");
		if(val != ""){
			$.ajax({
				url: "https://viacep.com.br/ws/"+val+"/json/"
			}).done(function(data){
				if(data['resultado'] != 0){
					$('.endereco-estado').val(data['uf'])
					$('.endereco-cidade').val(data['localidade'])
					$('.endereco-logradouro').val(data['logradouro'])
					$('.endereco-bairro').val(data['bairro'])
				}
			})
		}
	}
})