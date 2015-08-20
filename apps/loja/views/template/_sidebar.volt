{{ 
    helper.sidebar.getHelper([
        'tipos': [
            'CATEGORIAS':[
                'layout': 'BASE_LAYOUT',
                'container_class': 'side-nav-categories',
                'wrap':'<div class="box-content box-category"><ul class="%1Ss">%2Ss</ul></div>',
                'base_class': 'cat-list',
                'categoria_id': id,
                'title_class':'block-title',
                'title_label': nome,
                'title_wrap':'<div class="%1Ss">%2Ss</div>'
            ],
            'PRICE_SLIDER':[
                'layout': 'PRICE_SLIDER_LAYOUT',
                'container_class': 'block block-layered-nav',
                'title_label': 'Filtro por Preço',
                'categoria_id': id,
                'title_class':'block-title',
                'title_wrap':'<div class="%1Ss"><span>%2Ss</span></div>'
            ],
            'PRODUTO_DETALHES':[
                'layout': 'BASE_LAYOUT',
                'container_class': 'block block-layered-nav',
                'base_class': 'cat-list',
                'categoria_id': id,
                'title_class':'block-title',
                'title_wrap':'<div class="%1Ss"><span>%2Ss</span></div>'
            ]
        ]
    ])
}}
