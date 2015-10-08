<?php
namespace Ecommerce\Loja\Helpers;
use Ecommerce\Admin\Models\Categorias;
use Ecommerce\Admin\Models\Imagens;
use Ecommerce\Loja\Helpers\BaseHelper;
use Moltin\Cart\Cart;
use Moltin\Cart\Storage\Session;
use Moltin\Cart\Identifier\Cookie;
use Ecommerce\Admin\Models\Produtos;
class CartHelper extends BaseHelper{
	
	protected $cart;
	protected $attr;
	public $options = array(
		'tipo' => array()
	);
	protected $layouts = array(
		'HEADER_CART_LAYOUT' => array(
			'container' => 'div',
			'container_class' => '',
			'container_id' => '',
			'item_container' => 'div',
			'item_container_class' => '',
			// Imagem do produto
			'thumbnail_container' => 'div',
			'thumbnail_container_class' => '',
			'thumbnail_width' => '',
			'thumbnail_class' => '',
			// Informações do produto
			'info_container' => 'div',
			'info_container_class' => '',
			'info_title_wrap' => '<a href="%1Ss" class="%2Ss">%3Ss</a>',
			'info_title_class' => '',
			'info_price_wrap' => '<p class="%1Ss" >%2Ss</p>',
			'info_price_class' => '',
			'remove_link' => true,
			'remove_link_position' => 'INFO_CONTAINER',
			'remove_link_wrap' => '<a href="%1Ss" class="cart-remove %2Ss"><i class="fa fa-trash"></i></a>',
			'remove_link_class' => '',
			'subtotal_wrapper' => '<div id="subtotal-header" class="%1Ss">%2Ss</div>',
			'subtotal' => true,
			'subtotal_class' => '',
			'buttons' => true,
			'buttons_container' => 'div',
			'buttons_class' => '',
			'buttons_links' => array(
				'TO_CART' => array('class' => '','text' => 'Carrinho'),
				'CHECKOUT' => array('class' => '','text' => 'Finalizar'),
			)
		),
		'CART_LAYOUT' => array(
			'size' => 'col-md-8',
			'container_id' => '',
			'container_class' => '',
			'item_class' => '',
			'thead' => true,
			'resumo' => false,

		),
		'CART_TOTAL' => array(
			'size' => 'col-md-12',
			'container_id' => '',
			'container_class' => '',
			'item_class' => '',
			'cep_options' => array(
				'text_wrap' => '<h4>Calcular Frete:</h4>',
				'btn_class' => 'btn btn-primary',
				'input_class' => 'form-control',
				),
			'actions' => array(
				'CONTINUAR' => array(
					'class' => 'btn btn-default',
					'text' => 'Continuar Comprando'
				),
				'CHECKOUT' => array(
					'class' => 'btn btn-danger',
					'text' => 'Finalizar'
				),
			),
		),
	);

	public function __construct(){
		parent::__construct();
		$this->cart = new Cart(new Session, new Cookie);
	}

	public function getHelper($options = array()){
		$layout = $options['layout'];
		$this->options = $options + $this->layouts[$layout];
		$this->attr = parent::getHtmlAtributos($this->options);
		$string = $this->setHelper($layout);
		return $string;
	}

	protected function setHelper($layout){
		if($layout == 'HEADER_CART_LAYOUT'){
			$id = $this->attr['container_id'];
			$class = $this->attr['container_class'];
			$html = '<div class="cart-header-container">';
			$html .= "<{$this->options['container']} $id $class>";
			$html .= $this->setItens();
			$html .= $this->getSubtotal();
			$html .= $this->getActions();
			$html .= "</{$this->options['container']}>";
			$html .= '</div>';
		}else if($layout == 'CART_LAYOUT'){
			$html = $this->setTable();
		}else if($layout == 'CART_TOTAL'){
			$html = $this->setTotais();
		}
		return $html;
	}

	protected function setItens(){
		$html = '';
		foreach ($this->cart->contents() as $key => $value) {
			$produto = Produtos::findById($value->id)->toArray();
			$html .= "<{$this->options['item_container']} class='{$this->options['item_container_class']} cart-item'>";

			$html .= $this->setThumbnail($produto);
			$html .= $this->setInfo($value,$produto,$key);
			if($this->options['remove_link'] && $this->options['remove_link_position'] == 'BEFORE_ITEM'){

				$html .= $this->getRemoveLink($key);

			}
			$html .= "</{$this->options['item_container']}>";
		}
		return $html;
	}

	protected function setThumbnail($produto){
		$html = '';
		$container_class = $this->attr['thumbnail_container_class'];
		$width = $this->attr['thumbnail_width'];
		$thumbnail_class = $this->attr['thumbnail_class'];
		if($this->options['thumbnail_container'] != ''){
			$html .= "<{$this->options['thumbnail_container']} $container_class >";
		}
		$imagem = Imagens::findFirst($produto['imagens'][0]);
		$html .= "<img src='{$this->ecommerce_options->url_base}{$imagem->url}' $thumbnail_class $width/>";
		if($this->options['thumbnail_container'] != ''){
			$html .= "</{$this->options['thumbnail_container']}>";
		}
		return $html;
	}

	protected function setInfo($item,$produto,$item_id){
		$container_class =  $this->attr['info_container_class'];
		$html = '';
		if($this->options['info_container'] != ''){
			$html .= "<{$this->options['info_container']} $container_class >";
		}
		$html .= $this->getInfoTitle($produto);
		$html .= $this->getPrice($item);
		if($this->options['remove_link'] == 'INFO_CONTAINER'){

			$html .= $this->getRemoveLink($item_id);

		}
		if($this->options['info_container'] != ''){
			$html .= "</{$this->options['info_container']}>";
		}
		return $html;
	}

	protected function getInfoTitle($produto){
		return parent::replaceWraper(3,
				array(
					parent::generateUrl($produto['nome'],$produto['_id'],'produto'),
					$this->options['info_title_class'],
					$produto['nome']
				),
				$this->options['info_title_wrap']
			);
	}

	protected function getPrice($item){
		$preco_real = ($item->valor_real) ? '<span class="preco-desconto">R$ '.number_format($item->valor_real,2,',','.').'</span>' : '';
		return parent::replaceWraper(2,
				array(
					$this->options['info_price_class'],
					$item->quantity.' x R$ '.number_format($item->price,2,',','.')
				),
				$this->options['info_price_wrap']
			);
	}

	protected function getRemoveLink($item_id){
		return parent::replaceWraper(2,
				array(
					$this->url_base.'cart/remove/'.$item_id,
					$this->options['remove_link_class']
				),
				$this->options['remove_link_wrap']
			);
	}

	protected function getSubtotal(){
		if($this->options['subtotal']){
			return parent::replaceWraper(2,
					array(
						$this->options['subtotal_class'],
						'Subtotal R$ '.number_format($this->cart->total(),2,',','.')
					),
					$this->options['subtotal_wrapper']
				);
		}
	}

	protected function getActions(){
		$html = '';
		if($this->options['buttons']){
			$buttons_class = $this->attr['buttons_class'];
			$html .= "<{$this->options['buttons_container']} $buttons_class>";
			foreach ($this->options['buttons_links'] as $key => $value) {
				if($key == 'TO_CART'){	
					$link = $this->url_base.'cart';
				}else if($key == 'CHECKOUT'){
					$link = $this->url_base.'checkout';
				}else{
					return false;
				}
				$html .= "<a href='$link' class='{$value['class']}'>{$value['text']}</a>";
			}
			$html .= "</{$this->options['buttons_container']}>";
		}
		return $html;
	}

	protected function setTable(){
		$class = $this->attr['container_class'];
		$id = $this->attr['container_id'];
		$html = "<table $id class='{$this->options['container_class']} {$this->options['size']}'>";
		if($this->options['thead']){
			$html .= '<thead>
						<th>Imagem</th>
						<th>Nome</th>
						<th>Quantidade</th>
						<th>Preço</th>
						<th>Total</th>
						<th>Remover</th>
					</thead>';	
		}
		$html .= $this->getItens();
		$html .= '</table>';
		return $html;
	}

	protected function getItens(){
		$html = '';
		foreach ($this->cart->contents() as $key => $value) {
			$produto = Produtos::findById($value->id)->toArray();
			$html .= "<tr class='cart-item {$this->options['item_class']}'>";
			$preco = number_format($value->price,2,',','.');
			$total = number_format($value->price*$value->quantity,2,',','.');
			$imagem = Imagens::findFirst($produto['imagens'][0]);
			$preco_real = ($value->valor_real) ? '<span class="preco-desconto">R$ '.number_format($value->valor_real,2,',','.').'</span>' : '';
			if(!$this->options['resumo']){
				$html .= "<td><img src='{$this->url_base}{$imagem->url}' class='img-responsive' style='width:100px'/></td>";
				$chave = parent::arrayMultiSearch($produto['detalhes'],'detalhe_id',$value->options['detalhe_id']);
				if($this->ecommerce_options->produto_detalhes == '1'){
					$variacao = '';
					foreach (unserialize($this->ecommerce_options->produto_detalhe_options) as $c => $v) {
						$variacao .= ucwords($v['label']).': '.$produto['detalhes'][$chave]["{$v['label']}"];
					}
				}else{
					$variacao = '';
				}
				$html .= "<td>{$value->name}<br/> <span class='cart-variacao'>{$variacao}</span></td>";
				$select = "<select class='form-control cart-update' data-identificador='$key'>";
				if($this->ecommerce_options->produto_detalhes == '0'){
					$estoque = $produto['estoque'];
				}else{
					$estoque =(isset($value->options)) ? $produto['detalhes'][$chave]['estoque'] : $produto['detalhes'][0]['estoque'];
				}
				for ($i=1; $i <= $estoque ; $i++) { 
					$selected = ($value->quantity == $i) ? 'selected' : '';
					$select .= "<option value='$i' $selected>$i</option>";
				}
				$select .= '</select>';
				$html .= "<td>$select</td>";
				$html .= "<td>R$ $preco $preco_real</td>";
				$html .= "<td class='cart-item-total'>R$ $total</td>";
				$link = $this->url_base.'cart/remove/'.$key;
				$html .= "<td><a href='$link' class='cart-remove'><i class='fa fa-trash fa-2x'></i></a></td>";
			}else{
				$html .= "<td><img src='{$this->url_base}{$imagem->url}' class='img-responsive' style='width:100px'/></td>";
				$html .= "<td>
							{$value->name} <br/>
							<strong>{$value->quantity} x R$ $preco</strong>
							<h5>R$ $total</h5>
				</td>";
			}
			$html .= '<tr/>';
		}
		return $html;
	}


	public function setTotais(){
		$html = '<div class="'.$this->options['size'].'">';
		$html .= '<table class="'.$this->options['container_class'].'" id="'.$this->options['container_id'].'">';
		$html .= $this->getTotais();
		$html .= '</table>';
		$html .= '</div>';
		return $html;
	}

	protected function getTotais(){
		$html = '<tr><td style="padding:20px">'.$this->getCepOption().'</td></tr>';
		$html .= '<tr id="frete-opcoes" style="display:none"><td>'.$this->getCepOption().'</td></tr>';
		$html .= '<tr><td style="padding:20px"><h5>SubTotal: <strong>R$ <span id="cart-subtotal">'. number_format($this->cart->total(),2,',','.').'</span> </strong></h5></td> </tr>';
		$html .= $this->getFreteOption();
		$html .= '<tr class="active"><td style="padding:20px"><h5>Total: <strong>R$ <span id="cart-total">'.number_format($this->cart->total() + $this->session->get('frete')['valor'],2,',','.').'</span> </strong></h5></td></tr>';
		$html .= '<tr><td>'.$this->getActionsOptions().'</td></tr>';
		return '<tbody>'.$html.'</tbody>';
	}

	protected function getCepOption(){
		return $this->options['cep_options']['text_wrap'].'
				<div class="row">
                    <div class="col-md-6 no-padding-right">
                         <input type="text" class="'.$this->options['cep_options']['input_class'].' frete-calcular" value="'.$this->session->get('cep').'" data-mask="99999-999" />
                    </div>
                    <div class="col-md-6">
                        <button class="'.$this->options['cep_options']['btn_class'].' frete-calcular-btn">Calcular</button>
                    </div>
                </div>';
	}

	protected function getFreteOption(){
		$style = ($this->session->has('frete')) ? 'style="disyplay:none"' : '';
		return '<tr '.$style.'>
                    <td style="padding:20px">
                        <h5>Frete: 
                            <strong>R$
                                <span id="cart-frete">
                                   '.number_format($this->session->get('frete')['valor'],2,',','.').'
                                </span>
                            </strong>
                        </h5>
                    </td>
                </tr>';
	}

	protected function getActionsOptions(){
		$html = '';
		foreach ($this->options['actions'] as $key => $value) {
			if($key == 'CHECKOUT'){
				$link = $this->url_base.'checkout';
			}else if($key == 'CONTINUAR'){
				$link = $this->url_base;
			}else{
				return false;
			}
			$html .=  '<a href="'.$link.'" class="'.$value['class'].'">'.$value['text'].'</a> ';
		}
		return $html;
	}

}