<?php
namespace Ecommerce\Admin\Models;
use Ecommerce\Admin\Models\Produtos;
class Avaliacoes extends \Phalcon\Mvc\Model
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
    public $avaliacao_tipo_id;

    /**
     *
     * @var string
     */
    public $produto_id;

    /**
     *
     * @var integer
     */
    public $usuario_id;

    /**
     *
     * @var string
     */
    public $nome;


    /**
     *
     * @var string
     */
    public $descricao;

    /**
     *
     * @var integer
     */
    public $nota;

    /**
     *
     * @var integer
     */
    public $aprovado;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('avaliacao_tipo_id', 'Ecommerce\Admin\Models\AvaliacaoTipos', 'id', array('alias' => 'AvaliacaoTipos'));
        $this->belongsTo('usuario_id', 'Ecommerce\Admin\Models\Usuarios', 'id', array('alias' => 'Usuario'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'avaliacoes';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Avaliacoes[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    public static function getStars($nota){
        if($nota == 5){
            return self::setStars(5);
        }else if($nota >= 4.50 && $nota < 5){
            return self::setStars(4,true);
        }else if($nota >= 4 && $nota <= 4.50){
            return self::setStars(4);
        }else if($nota >= 3.50 && $nota < 4){
            return self::setStars(3,true);
        }else if($nota >= 3 && $nota < 3.50){
            return self::setStars(3);
        }else if($nota >= 2.50 && $nota < 3){
            return self::setStars(2,true);
        }else if($nota >= 2 && $nota < 2.50 ){
            return self::setStars(2);
        }else if($nota >= 1.50 && $nota < 2){
            return self::setStars(1,true);
        }else if($nota >= 1 && $nota <= 1.50){
            return self::setStars(1);
        }

    }

    public static function findWithProduto($usuario_id,$limit = null){
        $avaliacoes = self::find(array(
            "usuario_id = $usuario_id and avaliacao_tipo_id = 2",
            'order' => 'data DESC',
            'limit' => $limit
        ))->toArray();
        return array_map(array('self','withProduto'),$avaliacoes);
    }   

    public static function withProduto($array){
        $produto_id = new \MongoId($array['produto_id']);
        $array['produto'] = Produtos::findFirst(array(
            'conditions' => array(
                    '_id' => $produto_id
                )
            ))->toArray();
        $array['nota'] = self::getStars($array['nota']);
        $array['data'] = date('d/m/Y',strtotime($array['data']));
        return $array;
    }


    private static function setStars($quantidade,$half = null){
        $html = '';
        for ($i= 1; $i <= $quantidade ; $i++) { 
            if($quantidade == $i && !is_null($half)){
                $html .= '<i class="fa fa-star-half stars stars-active"></i>';
            }else{
                $html .= '<i class="fa fa-star stars stars-active"></i>';
            }
        }
        for ($i=1; $i <= 5-$quantidade ; $i++) { 
            if($quantidade == $i && !is_null($half)){
                $html .= '<i class="fa fa-star-half stars"></i>';
            }else{
                $html .= '<i class="fa fa-star stars"></i>';
            }
        }
        return $html;
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Avaliacoes
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
