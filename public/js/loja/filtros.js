$(function(){

	    //PRICE RANGE

    $('#slider-container').slider({
        range: true,
        min: 0,
        max: 2000,
        values: [0,2000],
        create: function(event,ui){
        	$("#amount").text("R$ 0 - R$ 2000");
        },
        slide: function (event, ui) {
            $("#amount").text("R$ " + ui.values[0] + " - R$ " + ui.values[1]);
        },
        change: function( event, ui ) {
            var array = getDetalhes();
        	var categoria_id = $(this).data('categoria');
			sendRequest(array,categoria_id);
        }
    })

	$('.filtro-detalhe').click(function(){
		var categoria_id = $(this).data('categoria');
		if($(this).hasClass('filtro-detalhe-selecionado')){
			$(this).removeClass('filtro-detalhe-selecionado');
		}else{
			$(this).addClass('filtro-detalhe-selecionado');
		}
		var array = getDetalhes();
		sendRequest(array,categoria_id);
	})

	function getDetalhes(){
		array = [];
		$('.filtro-detalhe-selecionado').each(function(){
			itens =  {tipo: $(this).data('tipo'), valor:$(this).data('valor') };
			array.push(itens);
		})
		if($('#slider-container').length >= 1){
			values = $( "#slider-container" ).slider( "values" )
            itens =  {tipo: 'valor', valor: values[0]+';'+values[1] };
        	array.push(itens)
		}
		return array;
	}

	function sendRequest(array,categoria_id){
		$.ajax({
			url: '/ecommerce/categoria/filtro/'+categoria_id,
			type: 'post',
			data:{filtros:array},
			beforeSend:function(){
				//$('#produto_container').prepend('<div class="alert alert-info">Aguarde <i class="fa fa-spin fa-spinner fa-2x"></i></div><br clear="all"/>')
			}
		}).done(function(data){
			$('#produto_container').html(data);
			$("html, body").animate({ scrollTop: $('#produto_container').offset().top - 150}, 500);
			addToCompare();
			ias.reinitialize();
		})
	}

})