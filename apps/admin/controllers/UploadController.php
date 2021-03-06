<?php
namespace Ecommerce\Admin\Controllers;
use Ecommerce\Admin\Models\Imagens;
use Phalcon\Mvc\View;
use Aws\S3\S3Client;
use Aws\S3\MultipartUploader;
use Aws\Exception\MultipartUploadException;
class UploadController extends ControllerBase
{

    public function indexAction(){
        $this->view->disableLevel(View::LEVEL_AFTER_TEMPLATE);
        $this->view->imagens = Imagens::find(array('order' => 'id desc'));
    }

    public function createAction(){
        if($this->request->isAjax()){
            $this->view->disable();
            if($this->request->hasFiles() == true) {
                // $s3 = new S3Client([
                //     'version' => $this->ecommerce_options->aws_version,
                //     'region'  => $this->ecommerce_options->aws_location,
                //     'credentials' => [
                //         'key'    => $this->ecommerce_options->aws_id,
                //         'secret' => $this->ecommerce_options->aws_secret_key,
                //     ],
                // ]);
                foreach ($this->request->getUploadedFiles() as $file)
                {
                    if($file->getName() != ''){
                        $file->moveTo('files/produtos/'.md5(date('Y-m-d H:i:s:u')).$file->getName());
                        $imagem = new Imagens;
                        $imagem->url = 'files/produtos/'.md5(date('Y-m-d H:i:s:u')).$file->getName();
                        $imagem->save();
                        $this->response->setContent(json_encode(array('status' => true,'mensagem' => 'Upload concluido com sucesso')));
                        //Comentado pois não funciona locacal
                        // $uploader = new MultipartUploader($s3, $file->getTempName(), [
                        //     'bucket' => $this->ecommerce_options->aws_bucket,
                        //     'key'    => 'files/'.$file->getName(),
                        //     'before_initiate' => function (\Aws\Command $command) {
                        //         // $command is a CreateMultipartUpload operation
                        //         $command['CacheControl'] = 'max-age=3600';
                        //     },
                        //     'before_upload' => function (\Aws\Command $command) {
                        //        // $command is an UploadPart operation
                        //        $command['RequestPayer'] = 'requester';
                        //     },
                        //     'before_complete' => function (\Aws\Command $command) {
                        //        // $command is a CompleteMultipartUpload operation
                        //        $command['RequestPayer'] = 'requester';
                        //     },
                        //     'acl' => 'public-read-write',
                        // ]);
                        // try {
                        //     $result = $uploader->upload();
                        //     $imagem = new Imagens;
                        //     $imagem->url =  'https://s3-sa-east-1.amazonaws.com/'.$this->ecommerce_options->aws_bucket.'/files/'.$file->getName();
                        //     $imagem->save();
                        //     $this->response->setContent(json_encode(array('status' => true,'mensagem' => 'Upload concluido com sucesso')));
                        // } catch (MultipartUploadException $e) {
                        //     $this->response->setContent(json_encode(array('status' => false,'mensagem' => $e->getMessage() )));
                        // }
                        return $this->response;
                    }
                } 
            }
        }
    }
     
    public function showAction(){
        $this->view->disableLevel(View::LEVEL_AFTER_TEMPLATE);
        $this->view->imagens = Imagens::find(array('order' => 'id desc'));
    }

    public function deleteAction()
    {
        if($this->request->isAjax()){
            $this->view->disable();
            $imagem =  Imagens::findFirst('id = '.$this->request->getPost('id'));
            if($imagem->delete()){
                $this->response->setContent(json_encode(array('status' => true,'mensagem' => 'Deletado com sucesso')));
            }else{
                 $this->response->setContent(json_encode(array('status' => false,'mensagem' => 'Houve um erro: Imagem não pode ser deletada')));
            }
            return $this->response;
        }
    }

}

