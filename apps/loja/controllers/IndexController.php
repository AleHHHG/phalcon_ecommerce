<?php
namespace Ecommerce\Loja\Controllers;
use Ecommerce\Admin\Models\Paginas;
use Ecommerce\Admin\Models\Newsletter;
use Ecommerce\Admin\Models\Mailer;
class IndexController extends ControllerBase
{

    public function indexAction(){
    }

    public function paginaAction($id)
    {	
        if($this->request->isPost() && $id == 2){
            $array = array(
                'email' => $this->request->getPost('email'),
                'assunto' => 'Contato loja '.$this->ecommerce_options->titulo,
                'conteudo' => $this->setContent(),
            );
            $email = new Mailer($this->ecommerce_options,$array);
            $send = $email->send();
            $this->flashSession->success($send['mensagem']);
            return $this->response->redirect('/pagina/'.$id);
        }else{
            $this->view->pagina = Paginas::findFirst('id ='.$id);
        }
    }

    public function newsletterAction()
    {	
        $this->view->disable();
        if($this->request->isPost()){
            $model = new Newsletter();
            $model->email = $this->request->getPost('email');
            if ($model->save()) {
                $this->response->setContent(json_encode(array('status' => true,'mensagem' => 'Cadastrado com sucesso, ')));
            }else{
                 $this->response->setContent(json_encode(array('false' => true,'mensagem' => 'Houve um erro e não pode ser completada sua requisão')));
            }
            return $this->response;
        }
    }

    private function setContent(){
        $conteudo = 'Nome: '.$this->request->getPost('nome').'<br/>';
        $conteudo .= 'E-mail: '.$this->request->getPost('email').'<br/>';
        $conteudo .= 'Telefone: '.$this->request->getPost('telefone').'<br/>';
        $conteudo .= 'Mensagem: '.$this->request->getPost('mensagem').'<br/>';
        return $conteudo;
    }
}

