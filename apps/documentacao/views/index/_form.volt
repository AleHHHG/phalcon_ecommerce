 {% for element in form %}
 <div class="form-group">
     {{ element.label(['class': 'form-label']) }}
     {{ element }}
 </div>
{% endfor %}
{{ submit_button('Salvar','class':'btn btn-primary btn-lg') }}