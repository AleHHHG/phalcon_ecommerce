{{ javascript_include('js/jquery-1.11.3.min.js') }}
{{ javascript_include('js/bootstrap.min.js') }}
{% for arquivo in js%}
	{{ javascript_include(arquivo) }}
{% endfor %}
{{ javascript_include('js/loja/jquery-ias.min.js') }}
{{ javascript_include('js/loja/toastr.js') }}
{{ javascript_include('js/loja/cart.js') }}
{{ javascript_include('js/loja/frete.js') }}
{{ javascript_include('js/loja/checkout.js') }}
{{ javascript_include('js/loja/filtros.js') }}
{{ javascript_include('js/loja/options.js') }}
{{ javascript_include('js/loja/endereco.js') }}
