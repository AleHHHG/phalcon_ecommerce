<?php

namespace Ecommerce\Admin\Controllers;
class UploadController extends ControllerBase
{

    public function indexAction()
    {
        $this->view->disable();
        if($this->request->hasFiles() == true) {
            $arr = array();
            // Print the real file names and sizes
            foreach ($this->request->getUploadedFiles() as $file) {

                //Print file details
                $arr[] = $file->getName();

                //Move the file into the application
                $file->moveTo('files/produtos/' . $file->getName());
            }

             $this->session->set("produto_imagens", $arr);
        }
    }

}

