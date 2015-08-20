{% for element in form %}
   <div class="form-group">
       {{ element.label(['class': 'form-label']) }}
       {{ element.setAttribute('class','form-control') }}
   </div>
{% endfor %}
{% if dispatcher.getActionName() == 'update'%}
		{% for imagem in imagens%}
			<div class="col-md-3">
				{{ image('files/banners/'~imagem.url,'class':'img-responsive')}}
				<a href='#' class='btn btn-orange'><i class='fa fa-times'></i></a>
			</div>
		{% endfor %}
{% endif %}
<br clear='all' />
{% if dispatcher.getActionName() == 'create'%}
	{{ submit_button("Adicionar", "class": "pull-right  btn-lg btn btn-primary") }}
{% else %}
 	{{ submit_button("Editar", "class": "pull-right  btn-lg btn btn-danger") }}
{% endif %}
<br clear='all'/>