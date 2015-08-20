$(document).ready(function(){

	$('.clone-detalhe').click(function(){
		clone = $('.form-clone').last().clone();
		$('.target').append(clone);
		$('.form-clone').last().find('.detalhe_id').val('0')
		removeDetalhe();
		$(".money").maskMoney({decimal:",", thousands:"."});
		$('.form-clone').last().find('.remove-detalhe').show()
	})

	removeDetalhe();

	geraSelectCores()


	$('.form-clone').first().find('.remove-detalhe').hide()

	function removeDetalhe(){
		$('.remove-detalhe').click(function(){
			$(this).parent().parent().remove()
		})
	}

	$(".money").maskMoney({decimal:",", thousands:"."});

	function geraSelectCores(){
	    var array = [];
	    var string = '';
	    if($('.cor').length  == 0) return false;
	     array.push('<option value="">Selecione...</option>');
	    $.each($('.cor'),function(key,value){
	        valor = $('.cor option:selected').eq(key).val();
	        array.push('<option value="'+valor+'">'+valor+'</option>');
	    });
	    $('.imagem-container').append('<select class="form-control produto-cores"></slect>')
	    for (var i = 0; i < $.unique(array).length; i++) {
	        $('.produto-cores').append(array[i]);
	    };
	    $('.imagem-container').append('<a href="#" class="btn btn-danger"><i class="fa fa-times"></i></a>')
		alteraCor();
	}

	function alteraCor(){
		$('.produto-cores').change(function(){
			var obj = $(this);
			cor  = obj.val();
			imagem = obj.parent().data('imagem');
			produto = obj.parent().parent().find('#produto_id').val()
			$.ajax({
				type:'post',
				url:'/ecommerce/admin/produto/set-cor',
				data:{produto:produto,cor:cor,imagem:imagem}
			}).done(function(data){

			})
		})
	}

	$('.summernote').summernote({
        lang: 'pt-BR',
        toolbar: [
        ['style', ['style']], // no style button
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['font', ['strike']],
        ['fontsize', ['fontsize']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        //['height', ['height']],
        ['insert', ['picture','video','link',]], // no insert buttons
        ['table', ['table']], // no table button
        //['help', ['help']] //no help button
        ['misc',['fullscreen','codeview']]
      ]
      });

})