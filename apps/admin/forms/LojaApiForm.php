<?php

namespace Ecommerce\Admin\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Numeric;
use Phalcon\Forms\Element\TextArea;


class LojaApiForm extends Form
{

    /**
     * Initialize the products form
     */
    public function initialize($entity = null, $options = array()){
           
        $f = new text("aws_bucket");
        $f->setLabel('AWS Bucket');
        $f->setAttribute('class','form-control');
        $this->add($f);

        $f = new text("aws_id");
        $f->setLabel('AWS ID');
        $f->setAttribute('class','form-control');
        $this->add($f);

        $f = new text("aws_location");
        $f->setLabel('AWS LOCATION');
        $f->setAttribute('class','form-control');
        $this->add($f);

        $f = new text("aws_secret_key");
        $f->setLabel('AWS SECRET KEY');
        $f->setAttribute('class','form-control');
        $this->add($f);

        $f = new text("facebook_appId");
        $f->setLabel('Facebook app id');
        $f->setAttribute('class','form-control');
        $this->add($f);

        $f = new text("facebook_appSecret");
        $f->setLabel('Facebooke app secret');
        $f->setAttribute('class','form-control');
        $this->add($f);

        $f = new text("sendgrid_username");
        $f->setLabel('Sendgrid username');
        $f->setAttribute('class','form-control');
        $this->add($f);

        $f = new text("sendgrid_password");
        $f->setLabel('sendgrid password');
        $f->setAttribute('class','form-control');
        $this->add($f);

        $f = new text("sendgrid_templateId");
        $f->setLabel('sendgrid template ID');
        $f->setAttribute('class','form-control');
        $this->add($f);

    }

}