<?php
namespace Pagamentos\Pagseguro;
use Ecommerce\Admin\Models\Pedidos;
class Retorno{

    public static function init($retorno,$pedido){;
        $pedido = Pedidos::findFirst("id=$pedido");
        if($retorno->status == 1 || $retorno->status == 2 || $retorno->status == 5){
            $pedido->status_id = 2;
        }else if($retorno->status == 3 || $retorno->status == 4){
            $pedido->status_id = 3;
        }else{
             $pedido->status_id = 7;
        }
        $pedido->tid = "{$retorno->code}";
        if(isset($retorno->paymentLink)){
            $pedido->link = "{$retorno->paymentLink}";
            $pedido->meio_pagamento = "{$retorno->paymentMethod->type}";
        }
        $pedido->save();
    }

}