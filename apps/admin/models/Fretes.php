<?php
namespace Ecommerce\Admin\Models;
class Fretes extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

     /**
     *
     * @var integer
     */
    public $tipo;

    /**
     *
     * @var string
     */
    public $nome;

     /**
     *
     * @var double
     */
    public $valor_minimo;

    /**
     *
     * @var string
     */
    public $cep_inicial;

    /**
     *
     * @var string
     */
    public $cep_final;

    /**
     *
     * @var string
     */
    public $produtos;

    /**
     *
     * @var integer
     */
    public $ativo;

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'fretes';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Fretes[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Fretes
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    public static function verificaFrete($cep,$cart){
        $fretes = self::find("ativo = 1 and valor_minimo <= ".$cart->total())->toArray();
        if(empty($fretes)){
            return false;
        }else{
            foreach ($fretes as $key => $value) {
                $cep_inicial =intval(str_replace('-', '', $value['cep_inicial']));
                $cep_final = intval(str_replace('-', '', $value['cep_final']));
                $cep_int = intval($cep);
                $obj = new \stdClass;
                $obj->Valor = '0,00';
                $obj->Codigo = '00001';
                $obj->PrazoEntrega = 'em até 10';
                if($value['tipo'] == 1 || $value['tipo'] == 2){
                    if($cep_int >= $cep_inicial && $cep_int <= $cep_final){
                        return $obj;
                    }
                }else{
                    $produtos = unserialize($value['produtos']);
                    foreach ($cart->contents() as $chave => $valor) {
                        if(in_array($valor->id, $produtos)){
                            return $obj;
                        }
                    }
                }
            }
        }
        return false;
    }

}
