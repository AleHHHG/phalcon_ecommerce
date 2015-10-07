{% for i in imagens%}
	<div class="col-md-3 thumbnail" style="padding:20px">
		<input type="checkbox" name="imagens_selecionadas" class="pull-right imagem-select" value="{{ i.id }}">
		<br/>
		<img src="{{this.ecommerce_options.url_base}}public/timthumb?src={{this.ecommerce_options.url_base}}public/{{i.url}}&q=90&w=215&h=161&zc=2" class="img-responsive" />
		<button class="delete-imagem btn btn-danger btn-sm" data-url="{{this.ecommerce_options.url_base}}admin/upload/delete" data-id="{{i.id}}">
		<i class="fa fa-trash-o"></i> Remover
		</button>
	</div>
{% endfor %}