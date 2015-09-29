<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
   <div class="page-title">
      <div class="pull-left">
         <h1 class="title">Avaliação</h1>
      </div>
      <div class="pull-right hidden-xs">
         <ol class="breadcrumb">
             <li>
               {{ link_to('admin','<i class="fa fa-home"></i>Home</a>')}}
            </li>
            <li class='active'>
               {{ link_to('admin/avaliacoes','Avaliações')}}
            </li>
         </ol>
      </div>
   </div>
   <?php $this->flashSession->output() ?>
</div>
<div class="clearfix"></div>
<div class="col-lg-12">
   <section class="box ">
      <div class="content-body">
         <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
               {% if dados.usuario_id !=  0 %}
                  <h3><span class="label label-success"><i class="fa fa-thumbs-up"></i> Usuário Validado </span></h3>
                  <br/>
               {% endif %}
               <table class="table table-bordered">
                  <tr>
                     <th>Data</th>
                     <td>{{ Utilitarios.dateFormat(dados.data)}}</td>
                  </tr>
                  <tr>
                     <th>Nome</th>
                     <td>{{ dados.nome}}</td>
                  </tr>
                  <tr>
                     <th>Produto</th>
                     <td>{{ produto.nome}}</td>
                  </tr>
                  <tr>
                     <th>Nota</th>
                     <td>{{ dados.nota}}</td>
                  </tr>
                  <tr>
                     <th>Mensagem</th>
                     <td>{{ dados.descricao}}</td>
                  </tr>
                  <tr>
                     <th></th>
                     <td>
                        <select data-url="{{ url.getBaseUri()}}admin/avaliacoes/update/{{ dados.id}}" name="aprovado" class="form-control change-status-avaliacao">
                           <option value="1" {{ dados.aprovado ? 'selected' : '' }}>Aprovado</option>
                           <option value="0" {{ dados.aprovado == 0 ? 'selected' : '' }}>Aguardando aprovação</option>
                        </select>
                     </td>
                  </tr>
               </table>
            </div>
         </div>
      </div>
   </section>
</div>