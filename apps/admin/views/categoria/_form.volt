{% for element in form %}
	<div class="form-group">
	 {{ element.label(['class': 'form-label']) }}
	 {{ element }}
	</div>
{% endfor %}
{% if dispatcher.getActionName() == 'update'%}
	<div class="form-group">
		<label class="form-label">Selecione a categoria pai*</label>
		<select name="parent" class="form-control">
			<option value="">Nenhuma</option>
			{% for key,value in categorias %}
				<option value="{{key}}" {{ categoria._id == key ? 'selected' : ''}}>{{value}}</option>
			{% endfor %}
		</select>
	</div>
{% endif %}