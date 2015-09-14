{% for i in imagens%}
	<div class="col-md-3 thumbnail" style="padding:20px">
		 <input type="checkbox" data-coluna='{{ coluna}}' name="imagens_selecionadas" class="pull-right imagem-select" value="{{ i.id }}">
		 <br/>
		 {{ image(i.url,'class':'img-responsive')}}
	</div>
{% endfor %}