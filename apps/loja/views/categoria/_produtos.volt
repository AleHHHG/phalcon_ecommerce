<ul class="products-grid">
{{ helper.produto.getHelper([
        'quantidade_itens':3,
        'container':'li',
        'container_class':'item col-lg-4 col-md-4 col-sm-6 col-xs-12 item-inner',
        'produto_thumbail_class':'product-image',
        'overlay_class':'product-action',
        'produto_info_class':'item-info',
        'produto_info_titulo':'<div class="%1Ss"><a href="%2Ss">%3Ss</a></div>',
        'produto_info_titulo_class':'item-title',
        'produto_info_preco':'<div class="price-box"> <span class="%1Ss">R$ %2Ss</span></div>',
        'produto_info_preco_class':'price',
        'categoria': indice,
        'pagina': pagina,
        'filtros':filtros
    ])
}}
</ul>