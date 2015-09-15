{% for element in form %}
   <div class="form-group">
       {{ element.label(['class': 'form-label']) }}
       {{ element.setAttribute('class','form-control') }}
   </div>
{% endfor %}
{{ Utilitarios.getUploadCenter('imagens',dispatcher.getActionName(),banner is defined ? banner.imagens : null,imagens is defined ? imagens : null) }}
<br clear='all' />
{% if dispatcher.getActionName() == 'create'%}
	{{ submit_button("Adicionar", "class": "pull-right  btn-lg btn btn-primary") }}
{% else %}
 	{{ submit_button("Editar", "class": "pull-right  btn-lg btn btn-danger") }}
{% endif %}
<br clear='all'/>