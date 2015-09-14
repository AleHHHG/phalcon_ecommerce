{% for element in form %}
   <div class="form-group">
       {{ element.label(['class': 'form-label']) }}
       {{ element.setAttribute('class','form-control') }}
   </div>
{% endfor %}
{% if dispatcher.getActionName() == 'update'%}
		<h4>Imagem Atual</h4>
		{% for imagem in imagens%}
			<div class="col-md-6 no-padding-left">
				{{ image('files/banners/'~imagem.url,'class':'img-responsive')}}
			</div>
		{% endfor %}
{% endif %}
<a href="#target-upload" id="call-upload" data-url="{{ url.getBaseUri()~'admin/upload/banners/imagens' }}" data-toggle="modal" class="btn btn-info" style="bottom:15px;position:relative">Adicionar Imagem</a>
<br clear='all' />
{% if dispatcher.getActionName() == 'create'%}
	{{ submit_button("Adicionar", "class": "pull-right  btn-lg btn btn-primary") }}
{% else %}
 	{{ submit_button("Editar", "class": "pull-right  btn-lg btn btn-danger") }}
{% endif %}
<br clear='all'/>