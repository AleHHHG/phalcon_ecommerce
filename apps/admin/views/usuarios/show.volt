<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
   <div class="page-title">
      <div class="pull-left">
         <h1 class="title">Usuário</h1>
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
               <table class="table table-bordered">
                  <tr>
                     <th>Nome</th>
                     <td>{{ dados.nome}}</td>
                  </tr>
                  <tr>
                     <th>E-mail</th>
                     <td>{{ dados.email}}</td>
                  </tr>
                  {% if cliente is defined %}
                     <tr>
                        <th>CPF/CNPJ</th>
                        <td>{{ cliente.documento}}</td>
                     </tr>
                     <tr>
                        <th>Telefone</th>
                        <td>{{ cliente.telefone}}</td>
                     </tr>
                     <tr>
                        <th>Celular</th>
                        <td>{{ cliente.celular}}</td>
                     </tr>
                  {% endif %}
               </table>
            </div>
            {% if endereco is not empty %}
               <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="page-header">
                     <h3>Endereço</h3>
                  </div>
                  <table class="table table-bordered">
                     <tr>
                        <th>Estado</th>
                        <td>{{ endereco.estado.sigla}}</td>
                     </tr>
                     <tr>
                        <th>Cidade</th>
                        <td>{{ endereco.cidade.nome}}</td>
                     </tr>
                     <tr>
                        <th>CEP</th>
                        <td>{{ endereco.cep}}</td>
                     </tr>
                     <tr>
                        <th>Logradouro</th>
                        <td>{{ endereco.logradouro}},{{ endereco.numero}}</td>
                     </tr>
                      <tr>
                        <th>Bairro</th>
                        <td>{{ endereco.bairro}}</td>
                     </tr>
                     {% if endereco.complemento != '' %}
                        <tr>
                           <th>Complemento</th>
                           <td>{{ endereco.complemento }}</td>
                        </tr>
                     {% endif %}
                  </table>
               </div>
            {% endif %}
         </div>
      </div>
   </section>
</div>