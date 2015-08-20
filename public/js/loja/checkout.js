$(function(){
	$('.checkout-forma-pagamento').click(function(){
		$('.ckeckout-form').find('input').prop('disabled',true);
		$('.ckeckout-form').find('select').prop('disabled',true);
		$('.ckeckout-form').hide();
		$('.radio label').removeClass('forma-pagamento-active')
		obj = $(this).parent().parent().find('.ckeckout-form')
		$(this).parent().addClass('forma-pagamento-active')
		$("html, body").animate({ scrollTop: $(this).offset().top }, 500);
		obj.find('input').prop('disabled',false);
		obj.find('select').prop('disabled',false);
		obj.show()
	})

	$('#numero-cartao').blur(function(){
	  cardNumber = $(this).val();
	  var regexVisa = /^4[0-9]{12}(?:[0-9]{3})?/;
	  var regexMaster = /^5[1-5][0-9]{14}/;
	  var regexAmex = /^3[47][0-9]{13}/;
	  var regexDiners = /^3(?:0[0-5]|[68][0-9])[0-9]{11}/;
	  var regexDiscover = /^6(?:011|5[0-9]{2})[0-9]{12}/;
	  var regexJCB = /^(?:2131|1800|35\d{3})\d{11}/;
	  var regexElo = /^((((636368)|(438935)|(504175)|(451416)|(636297))\d{0,10})|((5067)|(4576)|(4011))\d{0,12})$/;
	  
	  if(regexVisa.test(cardNumber)){
	   bandeira = 'visa';
	  }
	  if(regexMaster.test(cardNumber)){
	   bandeira = 'master';
	  }
	  if(regexAmex.test(cardNumber)){
	   bandeira = 'amex';
	  }
	  if(regexDiners.test(cardNumber)){
	   bandeira = 'diners';
	  }
	  if(regexDiscover.test(cardNumber)){
	   bandeira = 'discover'
	  }
	  if(regexJCB.test(cardNumber)){
	   bandeira = 'jcb';
	  }
	  if(regexElo.test(cardNumber)){
	   bandeira = 'elo';
	  }
	  $('#cartao-bandeira').val(bandeira);
	  url = '/ecommerce/img/loja/bandeiras/'+bandeira+'.png';
	  if($('.cartao-bandeira').length == 0){
	  	$(this).parent().parent().prepend('<img src="'+url+'" class="img-responsive thumbnail cartao-bandeira" width="80px" />')
	  }else{
	  	$('.cartao-bandeira').attr('src',url)
	  }
})

})