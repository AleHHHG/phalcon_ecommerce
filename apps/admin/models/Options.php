<?php 

namespace Ecommerce\Admin\Models;
class Options extends \Phalcon\Mvc\Model
{

    public function initialize(){
        $this->setDados();
    }

    public function getSource(){
        return 'options';
    }

    public function setDados(){ 
        foreach (self::find() as $key => $value) {
            $nome = $value->nome;
            $this->$nome = $value->valor;
        } 
        $this->image_path = $this->url_base.'templates/'.$this->template_nome.'/images/'; 
    } 

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Categorias[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Categorias
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }
}
