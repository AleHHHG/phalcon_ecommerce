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
        $this->view->imagens = Imagens::find(array(
        'conditions' => "relacao = 'banners' AND id_relacao = $id")
        );
        $this->view->form = new BannerForm($model,array('edit' => true));
        $this->view->banner = $model;
        if($this->request->isPost()){
            $this->save($model);
        }
    }

    public function deleteAction($id){
        $model = Banners::findById($id);
        if($model->delete()){
            $this->flash->success("Deletado com sucesso");
        }else{
            $this->flash->error("Houve um erro");
        }
        return $this->response->redirect("admin/banners");
    }

    protected function save($model){
        foreach ($_POST as $key => $value) {
            $model->$key = $this->request->getPost($key);
        }
        if($model->save()){
            if($this->request->hasFiles() == true) {
                foreach ($this->request->getUploadedFiles() as $file)
                {
                    if($file->getName() != ''){
                        $file->moveTo('files/banners/' . $file->getName());
                        $imagem = Imagens::findFirst("id_relacao = '$model->id' and relacao = 'banners'");
                        if(!empty($imagem)){
                            $imagem->url =  $file->getName();
                        }else{
                            $imagem = new Imagens();
                            $imagem->url =  $file->getName();
                            $imagem->relacao = 'banners';
                            $imagem->id_relacao = $model->id;
                        }
                        $imagem->save();
                    }
                }
            }
            $this->flash->success("Operação realizada com sucesso");
        }else{
            $this->flash->error("Houve um erro");
        }
        return $this->response->redirect("admin/banners");
    }



}

