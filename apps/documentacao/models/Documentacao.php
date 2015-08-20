<?php
namespace Ecommerce\Documentacao\Models;
class Documentacao extends \Phalcon\Mvc\Model
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
    public $parent;

    /**
     *
     * @var string
     */
    public $nome;

    /**
     *
     * @var string
     */
    public $conteudo;

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'documentacao';
    }

    public static function getWithParent(){
        $dados = self::find(array('columns' => 'id,nome,parent'))->toArray();
        return array_map(array('self','getParent'), $dados);
    }

    protected static function getParent($dados){
        if($dados['parent'] != 0){
            $dados['nome'] = '&nbsp &nbsp'.$dados['nome'];
        }
        return $dados;
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Documentacao[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Documentacao
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
