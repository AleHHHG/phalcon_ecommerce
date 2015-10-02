<?php
namespace Ecommerce\Admin\Models;
use Ecommerce\Admin\Models\Produtos;
use Ecommerce\Admin\Models\Pedidos;
use Ecommerce\Admin\Models\Widgets;
class Notificacoes extends \Phalcon\Mvc\Model
{

    public static function retornoPagseguro($dados){
        $widget = Widgets::findFisrt('id = 3');
        $opcoes = unserialize($widget->opcoes);
        $url = 'https://ws.pagseguro.uol.com.br/v2/transactions/notifications/' . $dados['notificationCode'] . '?email=' . $opcoes['email'] . '&token=' . $opcoes['token'];
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $retorno = curl_exec($curl);
        curl_close($curl);
        if($retorno == 'Unauthorized'){
            exit;//Mantenha essa linha
        }
        $retorno = simplexml_load_string($retorno);
        $pedido = Pedidos::findFirst('id = '.$retorno->reference);
        $pedido->status_id = self::deParaStatus($retorno->status,3);
        $pedido->save();
    }

    private static function deParaStatus($status,$id){
        if($id == 3){
            switch ($status) {
                case ($status == '1' || $status == '2' || $status == '5'):
                    return 2;
                    break;
                case ($status == '3' || $status == '4'):
                    return 3;
                    break;
                case ($status == '6' || $status == '7'):
                    return 7;
                    break;
            }
        }else if($id == 2){
            switch ($status) {
                case '0':
                    return 2;
                    break;
                case '1' :
                    return 3;
                    break;
                case '2':
                    return 6;
                    break;
            }
        }else{
            switch ($status) {
                case '0':
                    return 1;
                    break;
                case '6' :
                    return 3;
                    break;
                case '10':
                    return 3;
                    break;
                default:
                    return 8;
                    break;
            }
        }
    }
}
