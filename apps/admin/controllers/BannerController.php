<?php

namespace Ecommerce\Admin\Controllers;
use Ecommerce\Admin\Models\Banners;
use Ecommerce\Admin\Models\Imagens;
use Ecommerce\Admin\Models\Posicao;
use Ecommerce\Admin\Forms\BannerForm;
class BannerController extends ControllerBase
{

    public function indexAction()
    {
  	   	$this->view->banners = Banners::find();
    }

    public function createAction(){
		$this->view->form = new BannerForm();
        if($this->request->isPost()){
            $model = new Banners();
            $this->save($model);
        }
    }

    public function updateAction($id){
        $model = Banners::findFirst($id);
        $arr = array();
        for ($i=0; $i < count(unserialize($model->imagens)) ; $i++) { 
            $imagem = unserialize($model->imagens);
            $img = Imagens::findFirst("id = ".$imagem[$i]);
            $arr[] = $img;
        };
        $this->view->imagens = $arr;
        $this->view->form = new BannerForm($model,array('edit' => true));
        $this->view->banner = $model;
        if($this->request->isPost()){
            $this->save($model);
        }
    }

    public function deleteAction($id){
        $model = Banners::findById($id);
        $exec = $model->delete();
        parent::notifica($exec,array('controller' => 'banner','action' => 'index'));
    }

    protected function save($model){
        $imagens = $_POST['imagens'];
        unset($_POST['imagens']);
        foreach ($_POST as $key => $value) {
            $model->$key = $this->request->getPost($key);
        }
        if($imagens != ''){
            $model->imagens = serialize(explode(',',$imagens));
        }
        $exec = $model->save();
        parent::notifica($exec,array('controller' => 'banner','action' => 'index'));
    }



}

