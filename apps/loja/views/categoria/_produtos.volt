{{ helper.produto.getHelper([
        'quantidade_itens':3,
        'container':'ul',
        'container_class':'products-grid',
        'produto_info_titulo':'<div class="%1Ss"><a href="%2Ss">%3Ss</a></div>',
        'item_class':'item col-lg-4 col-md-4 col-sm-6 col-xs-12',
        'item_wrap':'<li class="%1Ss"><div class="item-inner">%2Ss</div><li>',
        'thumbnail_wrap':'<div class="product-block"><div class="%1Ss"><figure class="product-display">%2Ss</figure></div></div>',
        'thumbnail_class':'product-image',
        'info_titulo_wrap':'<div class="%1Ss"><a href="%2Ss">%3Ss</a></div>',
        'info_titulo_class':'item-title',
        'info_preco_wrap':'<div class="price-box"> <span class="%1Ss">R$ %2Ss</span></div>',
        'info_preco_class':'price',
        'info_wrap':'<div class="item-info"><div class="%1Ss">%2Ss</div></div>',
        'info_class':'info-inner',
        'overlay_wrap':'<div class="product-block"><div class="product-meta"><div class="%1Ss">%2Ss</div></div></div>',
        'overlay_class':'product-action',
        'categoria': indice,
        'pagina': pagina,
        'filtros':filtros,
        'overlay_options': [
            'QUICK_VIEW' : [
                'text': '<i class="fa fa-eye"></i> Preview',
                'class':'addcart'
            ],
            'COMPARE': [
                'text':'<i class="fa fa-signal"></i> Compare',
                'class':'addcart'
            ]
        ]
    ])
}}