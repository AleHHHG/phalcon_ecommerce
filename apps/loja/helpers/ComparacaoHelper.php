<?php
namespace Ecommerce\Loja\Helpers;
use Ecommerce\Admin\Models\Avaliacoes;
use Ecommerce\Admin\Models\Imagens;
class ComparacaoHelper extends BaseHelper{

	public $options = array(
		'id' => '',
		'class' => 'table table-bordered',
		'colunas' => array(
			'imagem',
			'nome',
			'valor',
			'avaliação',
			'descrição',
			'peso',
			'dimensões',
			'opções',
		),
		'produtos' => array(),
	);

	public function getHelper($options = array()){
		$this->options = $options + $this->options;
		if(count($this->options['produtos']) >= 1){
			$string = $this->setHelper();
		}else{
			$string = '<div class="alert alert-warning">Não existem produtos para ser comparado</div>';
		}
		return $string;
	}

	protected function setHelper(){
		$html = '';
		$html .= "<table id='".$this->options['id']."' class='comparacaoTable ".$this->options['class']."'>".$this->setItens()."</table>";
		return $html;
	}

	protected function setItens(){
		$html = '';
		for ($i=0; $i < count($this->options['colunas']) ; $i++){ 
			$html .= '<tr><th style="width:10%">'.strtoupper($this->options['colunas'][$i]).'</th>';
			$html .= $this->getItens($this->options['colunas'][$i]);
			$html .= '</tr>';
		}
		return $html;
	}

	protected function getItens($param){
		$html = '';
		$size = 90/count($this->options['produtos']);
		foreach ($this->options['produtos'] as $key => $value) {
			$html .= '<td style="width:'.$size.'%">';
			if($param == 'imagem'){
				$imagem = Imagens::findFirst($value['imagens'][0])->url;
				$html .= '<img src="'.$this->url_base.$imagem.'" class="img-responsive" width="150px" />';
			}else if($param == 'valor' || $param == 'peso' || $param == 'dimensões'){
				if($param == 'valor'){
					if($this->ecommerce_options->produto_detalhes == '1'){
						$html .= 'R$ '.number_format($value['detalhes'][0][$param],2,',','.');
					}else{
						$html .= 'R$ '.number_format($value[$param],2,',','.');
					}
				}else if($param == 'dimensões'){
					if($this->ecommerce_options->produto_cubagem_detalhe == '1'){
						$html .= $value['detalhes'][0]['altura'].' / '.$value['detalhes'][0]['largura'].' / '.$value['detalhes'][0]['comprimento'];
					}else{
						$html .= $value['altura'].' / '.$value['largura'].' / '.$value['comprimento'];
					}
				}else if($param == 'peso'){
					if($this->ecommerce_options->produto_cubagem_detalhe == '1'){
						$html .= $value['detalhes'][0][$param];
					}else{
						$html .= $value[$param];
					}
					$html .= ' KG';
				}else{
					$html .= $value['detalhes'][0][$param];
				}
			}else if($param == 'avaliação'){
				$star = Avaliacoes::getStars(Avaliacoes::average(array(
						"produto_id = '{$value['_id']}' and avaliacao_tipo_id = 2 and aprovado = 1",
						'column' => 'nota',
					))
				);
				if($star == ''){
					$html .= 'Produto não foi avaliado';
				}else{
					$html .= $star.' '.Avaliacoes::count("produto_id = '{$value['_id']}' and avaliacao_tipo_id = 2 and aprovado = 1").' -Avaliação(oes)' ;
				}
			}else if($param == 'opções'){
				$html .= '<a href="javascript:;" class="btn btn-primary"><i class="fa fa-plus"></i> Mais detalhes</a> ';
				$html .= '<a href="'.$this->url_base.'comparacao/delete/'.$value['_id'].'" class="btn btn-danger"><i class="fa fa-times"></i> Remover</a>';
			}else{
				if($param == 'descrição'){
					$html .= $value['descricao'];
				}else{
					$html .= $value[$param];
				}
			}
			$html .= '</td>';
		}
		return $html;
	}
	
}