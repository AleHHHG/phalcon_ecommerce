$(function(){

	// Calcula o frete quando perde o foco do input
	$('.frete-calcular').blur(function(){
		calculaFrete();
		selecionaFrete();
	});

	// Calcula quando clica no botão
	$('.frete-calcular-btn').click(function(){
		calculaFrete();
		selecionaFrete();
	});

	// Calcula o Quando clica no botão
	if(typeof $(".frete-calcular").val() !== "undefined" && $(".frete-calcular").val() != ''){
		calculaFrete();
		selecionaFrete();
	}

	function calculaFrete(){
		botao = $('.frete-calcular-btn');
		botao.html('<i class="fa fa-spin fa-spinner"></i> Aguarde')
		$.post('/ecommerce/cart/calculo',{cep:$('.frete-calcular').val(),action:'calculo'},function(callback){
			$("#frete-opcoes").show('slow')
			$("#frete-opcoes td").html(callback);
			botao.html('Calcular');
			selecionaFrete();
		});
	}

	function selecionaFrete(){
		$('.frete-tipo').click(function(){
			var frete = $(this).data('valor')
			var valor = toFloat($(this).data('valor'));
			var valor_atual =  toFloat($('#cart-subtotal').text());
			var total = (parseFloat(valor) + parseFloat(valor_atual));
			$.ajax({
				url: '/ecommerce/cart/calculo',
				type:'post',
				data:{codigo:$(this).val(),valor:valor,action:'setFrete'},
			}).done(function(){
				$('#cart-total').show().text(total.format(2,3,'.',','));
				$('#cart-frete').text(frete)
			})
		})
	}

	//Transforma string em float.
	function toFloat(valor){
		str = valor;
		str2 = str.replace('.','');
		valor_formatado = str2.replace(',','.');
		return valor_formatado
 	}

 	//Funcão semelhante ao number format do php;
    Number.prototype.format = function(n, x, s, c) {
        var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\D' : '$') + ')',
            num = this.toFixed(Math.max(0, ~~n));

        return (c ? num.replace('.', c) : num).replace(new RegExp(re, 'g'), '$&' + (s || ','));
    }

})