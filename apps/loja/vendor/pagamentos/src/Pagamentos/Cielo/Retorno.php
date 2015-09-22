<?php
namespace Pagamentos\Cielo;
use Ecommerce\Admin\Models\Pedidos;
class Retorno{

    public static function init($retorno,$pedido){;
        $pedido = Pedidos::findFirst("id=$pedido");
        if(isset($retorno->autorizacao) && $retorno->autorizacao->codigo == 6){
            $pedido->status_id = 3;
        }else{
            $pedido->status_id = 6;
        }
        $pedido->tid = "{$retorno->tid}";
        $pedido->save();
    }

}