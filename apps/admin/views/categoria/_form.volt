{% for element in form %}
	<div class="form-group">
	 {{ element.label(['class': 'form-label']) }}
	 {{ element }}
	</div>
{% endfor %}