<div class="col-lg-12">
   <section class="box ">
	   	<header class="panel_header">
	        <h2 class="title pull-left">{{ param }}</h2>
	    </header>
         <div class="content-body">
			{{ form("admin/loja/opcoes/"~param, 'enctype':'multipart/form-data') }}
				{% if param == 'Geral'%}
					<input type="file" name="logo">
					<br clear="all"/>
				{% endif %}
				{% for element in form %}
				   <div class="form-group">
				       {{ element.label(['class': 'form-label']) }}
				       {{ element}}
				   </div>
				{% endfor %}
			   	{{ submit_button("Editar", "class": "btn btn-primary")  }}
			{{ endform() }}
		</div>
	</section>
</div>