<?php echo $this->helper->sidebar->getHelper(array('tipos' => array('SEARCH' => array('layout' => 'SEARCH_LAYOUT', 'container_class' => 'side-widget space30', 'form_class' => 'search-widget', 'button_wrap' => '<button type="submit"><i class="fa fa-search"></i></button>', 'categoria_id' => $id), 'CATEGORIAS' => array('layout' => 'BASE_LAYOUT', 'container_class' => 'side-widget space30', 'base_class' => 'cat-list', 'categoria_id' => $id, 'title_label' => $nome), 'PRICE_SLIDER' => array('layout' => 'PRICE_SLIDER_LAYOUT', 'container_class' => 'side-widget space30', 'title_label' => 'Filtro por Preço', 'categoria_id' => $id, 'title_wrap' => '<h1><button>%1Ss</button></h1>'), 'PRODUTO_DETALHES' => array('layout' => 'BASE_LAYOUT', 'container_class' => 'side-widget space30', 'base_class' => 'cat-list', 'categoria_id' => $id)))); ?>
