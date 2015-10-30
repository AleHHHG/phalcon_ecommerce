<?php
namespace Ecommerce\Loja\Helpers;
use Phalcon\Tag;
use Ecommerce\Loja\Helpers\InflectorHelper;
use Phalcon\Filter;
use Ecommerce\Admin\Models\Produtos;
class BaseHelper extends Tag {

	protected $ecommerce_options;
	public $url_base;
	protected $session;
	protected $cart;

	function __construct(){
		$this->ecommerce_options = $this->getDI()->getShared('ecommerce_options');
		$this->url_base = $this->getDI()->getShared('url')->getBaseUri();
		$this->session = $this->getDI()->getShared('session');
		$this->cart = $this->getDI()->getShared('cart');
	}

	public function getFiles($path){
		$array = array();
		$template = $this->ecommerce_options->template_nome;
		if ($handle = opendir("templates/$template/$path/")) {
		    while (false !== ($file = readdir($handle))) {
		        if($file != "." && $file != ".." && strtolower(substr($file, strrpos($file, '.') + 1)) == $path){
		        	$array[] = "templates/$template/$path/$file";
		        }
		    }
		    closedir($handle);
		}else{
			die(print('Erro ao carregar os arquivos staticos'));
		}
		return $array;
	}

	protected function replaceWraper($total,$replaces,$string){
		$parametros = array();
		for ($i=1; $i <= $total ; $i++) { 
			$parametros[] = '/%'.$i.'Ss/';
		}
		return preg_replace($parametros, $replaces, $string);
	}

	public function pluralize($string){
		return InflectorHelper::pluralize($string);
	}

	public function singularize($string){
		return InflectorHelper::singularize($string);
	}

	public function generateUrl($string,$id,$tipo){
		$filter = new Filter();
		$url = $filter->sanitize($string, "lower");
		$url = $this->sanitizeString($string);
		$url = str_replace(' ', '-', $url);
		return $this->url_base.$tipo.'/'.$url.'/'.$id;
	}

	public function sanitizeString($str) {
	    $str = preg_replace('/[áàãâä]/ui', 'a', $str);
	    $str = preg_replace('/[éèêë]/ui', 'e', $str);
	    $str = preg_replace('/[íìîï]/ui', 'i', $str);
	    $str = preg_replace('/[óòõôö]/ui', 'o', $str);
	    $str = preg_replace('/[úùûü]/ui', 'u', $str);
	    $str = preg_replace('/[ç]/ui', 'c', $str);
	    // $str = preg_replace('/[,(),;:|!"#$%&/=?~^><ªº-]/', '_', $str);
	    $str = preg_replace('/[^a-z0-9]/i', '_', $str);
	    $str = preg_replace('/_+/', '_', $str); // ideia do Bacco :)
	    return $str;
	}

	// protected function getHtmlAtributo($atributo,$valor){
	// 	return $atributo.'="'. $valor.'"';
	// }

	protected function getHtmlAtributos($array){
		$arr = array();
		foreach ($array as $key => $value) {
			$explode = explode('_', $key);
			$max = count($explode);
			if($explode[$max-1] == 'class' || $explode[$max-1] == 'id' || $explode[$max-1] == 'width'){
				$arr[$key] = $explode[$max-1].'="'. $value.'"';
			}
		}
		return $arr;
	}


	public function arrayMultiSearch($array,$posicao,$termo){
		foreach ($array as $key => $value) {
			if($value[$posicao] == $termo){
				return $key;
			}
		}
		return null;
	}

	public function toFloat($num){
		$dotPos = strrpos($num, '.');
        $commaPos = strrpos($num, ',');
        $sep = (($dotPos > $commaPos) && $dotPos) ? $dotPos : 
            ((($commaPos > $dotPos) && $commaPos) ? $commaPos : false);
       
        if (!$sep) {
            return floatval(preg_replace("/[^0-9]/", "", $num));
        } 

        return floatval(
            preg_replace("/[^0-9]/", "", substr($num, 0, $sep)) . '.' .
            preg_replace("/[^0-9]/", "", substr($num, $sep+1, strlen($num)))
        );
	}

 	public function limpaString($string){
        return preg_replace ('/\D/' ,'' ,$string);
    }

    public function getDesconto($produto,$index = 0){
    	if($this->ecommerce_options->produto_detalhes == '1'){
		 	if(is_object($produto)){
	    		$detalhes = $produto->detalhes;
	    	}else{
	    		$detalhes = $produto['detalhes'];
	    	}
    		if(is_string($index)){
    			$index = $this->arrayMultiSearch($detalhes,'detalhe_id',$index);
    		}
    		if(isset($detalhes[$index]['desconto']) && $detalhes[$index]['desconto'] != ''){
				$desconto = $detalhes[$index]['desconto'];
			}else{
				$desconto = 0;
			}
    	}else{
    		if($produto->desconto != ''){
				$desconto = $produto->desconto;
			}else{
				$desconto = 0;
			}
    	}
    	return $this->toFloat($desconto);
    }

    public function geraSenha($caracteres = 8){
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVXZWY0123456789';
        $string = '';
         for ($i = 0; $i < $caracteres; $i++) {
              $string .= $characters[rand(0, strlen($characters) - 1)];
         }
        return $string;
    }

 	public function setDesconto($valor,$desconto){
        $percentual = $desconto/100;
        $valor_final = $valor - ($percentual * $valor);
        return number_format($valor_final, 2, '.', '');
    }

}
