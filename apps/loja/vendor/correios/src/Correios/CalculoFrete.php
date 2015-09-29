<?php
namespace Correios;
use Ecommerce\Admin\Models\Produtos;
use Ecommerce\Loja\Helpers\BaseHelper;
class CalculoFrete{

	public $nCdEmpresa = '';
    public $sDsSenha = '';
    public $sCepOrigem;
    public $sCepDestino;
    public $nVlPeso;
    public $nCdFormato = 1;
    public $nVlComprimento;
    public $nVlAltura;
    public $nVlLargura;
    public $nVlDiametro = 0;
    public $sCdMaoPropria = 1;
    public $nVlValorDeclarado = 0;
    public $sCdAvisoRecebimento;
    public $StrRetorno = 'xml';
    public $nCdServico = '40010,40045,40215,40290,41106';

    protected $itens;
    protected $helper;

	function __construct($obj,$cep_origem,$cep_destino){
		$this->sCepOrigem = $cep_origem;
		$this->sCepDestino = $cep_destino;
        $this->itens = $obj;
        $this->helper = new BaseHelper();
        $this->nVlPeso = $this->setPeso();
        $this->nVlAltura = $this->setAltura();
        $this->nVlLargura = $this->setLargura();
        $this->nVlComprimento = $this->setComprimento();
	}

	public function getFretes(){
		$data['nCdEmpresa'] = '';
        $data['sDsSenha'] = '';
        $data['sCepOrigem'] = $this->sCepOrigem;
        $data['sCepDestino'] = $this->sCepDestino;
        $data['nVlPeso'] = $this->nVlPeso;
        $data['nCdFormato'] = $this->nCdFormato;
        $data['nVlComprimento'] = $this->setComprimento();
        $data['nVlAltura'] = $this->nVlAltura;
        $data['nVlLargura'] = $this->nVlLargura;
        $data['nVlDiametro'] = $this->nVlDiametro;
        $data['sCdMaoPropria'] = $this->sCdMaoPropria;
        $data['nVlValorDeclarado'] = $this->nVlValorDeclarado;
        $data['sCdAvisoRecebimento'] = $this->sCdAvisoRecebimento;
        $data['StrRetorno'] = $this->StrRetorno;
        $data['nCdServico'] = $this->nCdServico;
        $url = 'http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx';
        $curl = curl_init($url . '?' . http_build_query($data));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($curl);
        $result = simplexml_load_string($result);
        return $result;
	}

	public function setPeso(){
        $peso = 0;
        foreach ($this->obj as $key => $value) {
            $produto = Produtos::findById($value->id)->toArray();
            if($this->helper->ecommerce_options('produto_detalhes') == '1'){
                $chave = $this->helper->arrayMultiSearch($produto['detalhes'],'detalhe_id',$value->options['detalhe_id']);
                $peso += $produto['detalhes'][$chave]['peso'];
            }else{
                $peso += $produto['peso'];
            }
        }
        return $peso;
	}

	public function setAltura(){
        $altura = array();
        foreach ($this->obj as $key => $value) {
            $produto = Produtos::findById($value->id)->toArray();
            if($this->helper->ecommerce_options('produto_detalhes') == '1'){
                $chave = $this->helper->arrayMultiSearch($produto['detalhes'],'detalhe_id',$value->options['detalhe_id']);
                $altura[] = $produto['detalhes'][$chave]['altura'];
            }else{
                $altura[] = $produto['altura'];
            }
        }
        return (max($altura) > 2) ? max($altura) : 2;
	}

	public function setLargura(){
        $largura = array();
        foreach ($this->obj as $key => $value) {
            $produto = Produtos::findById($value->id)->toArray();
            if($this->helper->ecommerce_options('produto_detalhes') == '1'){
                $chave = $this->helper->arrayMultiSearch($produto['detalhes'],'detalhe_id',$value->options['detalhe_id']);
                $largura[] = $produto['detalhes'][$chave]['largura'];
            }else{
                $largura[] = $produto['largura'];
            }
        }
        return (max($largura) > 11) ? max($largura) : 11;
	}

	public function setComprimento(){
        $comprimento = array();
        foreach ($this->obj as $key => $value) {
            $produto = Produtos::findById($value->id)->toArray();
            if($this->helper->ecommerce_options('produto_detalhes') == '1'){
                $chave = $this->helper->arrayMultiSearch($produto['detalhes'],'detalhe_id',$value->options['detalhe_id']);
                $comprimento[] = $produto['detalhes'][$chave]['comprimento'];
            }else{
                $comprimento[] = $produto['comprimento'];
            }
        }
        return (max($comprimento) > 16) ? max($comprimento) : 16;
	}
}