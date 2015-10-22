<?php
namespace Ecommerce\Admin\Controllers;
use Ecommerce\Admin\Forms\AtributoForm;
class AtributosController extends ControllerBase
{

    public function indexAction($param)
    {
        $referencia = $this->getReferencia($param);
        $this->view->dados = $referencia::find()->toArray();
    }

    public function createAction($param){
        $referencia = $this->getReferencia($param);
    	$this->view->form = new AtributoForm(null,array('referencia' => $referencia));
    	if($this->request->isPost()) {
    		$model = new $referencia;
    		$this->save($model,$param);
    	}
    }

    public function updateAction($param,$id){
        $referencia = $this->getReferencia($param);
        $model = $referencia::findFirst("id = $id");
        $this->view->id = $id;
        $this->view->form = new AtributoForm(
            $model,
            array(
                'edit' => true,
                'referencia' => $referencia
            )
        );
        if($this->request->isPost()) {
            $this->save($model,$param);
        }
    }

    public function deleteAction($param,$id){
        $referencia = $this->getReferencia($param);
        $model = $referencia::findFirst("id = $id");
        $exec = $model->delete();
        parent::notifica($exec,array('controller' => 'atributos','action' => 'index','param' => $param));
    }

    protected function save($model,$param){
        foreach ($this->request->getPost() as $key => $value) {
            $model->$key = $this->request->getPost($key);
        }
        if($param == 'marca'){
            if($this->request->hasFiles() == true) {
                foreach ($this->request->getUploadedFiles() as $file)
                {
                    if($file->getName() != ''){
                        $file->moveTo('files/extras/' . $file->getName());
                        $model->logo = $file->getName();
                    }
                }
            }
        }
        $exec = $model->save();
        parent::notifica($exec,array('controller' => 'atributos','action' => 'index','param' => $param));
    }

    protected function getReferencia($param){
        $this->view->titulo = $this->helper->pluralize($param);
        $this->view->param = $param;
        $chave = $this->helper->arrayMultiSearch($this->atributos,'label',$param);
        return $this->atributos[$chave]['referencia'];
    }
}

