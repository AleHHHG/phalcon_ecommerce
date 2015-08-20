<button class="btn btn-orange pull-right"><i class="fa fa-angle-left"></i>&nbsp Voltar</button> 
<button class="btn btn-info pull-right"><i class="fa fa-save"></i> <?php if ($acao == 'update') { ?> Editar <?php } else { ?> Salvar <?php } ?></button>
<br clear"all"/>
<ul class="nav nav-tabs">
    <li class="active">
       <a href="#step1" data-toggle="tab">
       <i class="fa fa-cube"></i> Informações basicas do Produto
       </a>
    </li>
    <?php if ($this->ecommerce_options->produto_detalhes == '1') { ?>
    <li>
       <a href="#step2" data-toggle="tab">
       <i class="fa fa-cubes"></i>Detalhes do Produto
       </a>
    </li>
    <?php } ?>
    <li>
       <a href="#step3" data-toggle="tab">
       <i class="fa fa-picture-o"></i> Imagens do Produto
       </a>
    </li>
 </ul>
 <div class="tab-content">
    <div class="tab-pane fade in active" id="step1">
       <br clear="all"/>
       <div class='col-md-12'>
          <?php foreach ($form as $element) { ?>
             <div class="form-group">
                 <?php echo $element->label(array('class' => 'form-label')); ?>
                 <?php echo $element; ?>
             </div>
          <?php } ?>
       </div>
       <br clear="all"/>
    </div>
    <div class="tab-pane fade" id="step2">
        <div class='col-md-12'>
          <br clear="all"/>
          <a href="javascript:;" class="btn clone-detalhe btn-success">
            <i class="fa fa-plus"></i>
            Novo Detalhe
          </a>
          <hr/>
          <br clear="all"/>
          <div class="target">
            <?php if ($acao == 'create') { ?>
              <div class="form-clone">
                  <?php foreach ($form_detalhes as $element) { ?>
                    <div class="col-md-4">
                       <div class="form-group">
                           <?php echo $element->label(array('class' => 'form-label')); ?>
                           <?php echo $element; ?>
                       </div>
                    </div>
                  <?php } ?>
                  <div class="col-md-12">
                    <a href="javascript:;" class="btn btn-orange pull-right remove-detalhe">
                      <i class="fa fa-times"></i>
                      Remover Detalhe
                    </a>
                  </div>
                  <br clear="all"/>
                  <hr/>
                  <br clear="all"/>
              </div>
            <?php } else { ?>
              <?php foreach ($form_detalhes as $detalhe) { ?>
                <div class="form-clone">
                    <?php foreach ($detalhe as $element) { ?>
                      <div class="col-md-3">
                         <div class="form-group">
                            <?php echo $element->label(array('class' => 'form-label')); ?>
                            <?php echo $element; ?>
                         </div>
                      </div>
                    <?php } ?>
                    <div class="col-md-12">
                      <a href="javascript:;" class="btn btn-orange pull-right remove-detalhe">
                        <i class="fa fa-times"></i>
                        Remover Detalhe
                      </a>
                    </div>
                    <br clear="all"/>
                    <hr/>
                    <br clear="all"/>
                </div>
              <?php } ?>
            <?php } ?>
        </div>
      </div>
      <br clear="all"/>
    </div>
    <div class="tab-pane fade" id="step3">
      <br clear="all"/>
      <div id="upload">
        <div id="drop">
          Arraste as imagens ou
          <a>Procurar Imagens</a>
          <input type="file" name="imagens" multiple />
        </div>
      </div>
      <div class="produto_imagens">
        <?php foreach ($produto->imagens as $imagem) { ?>
          <div class="col-md-3 imagem-container" data-imagem ="<?php echo $imagem; ?>">
            <?php echo $this->tag->image(array('files/produtos/' . $imagem, 'class' => 'img-responsive')); ?>
          </div>
        <?php } ?>
        <input type="hidden" name="produto_id" id="produto_id" value="<?php echo $produto->_id; ?>" />
      </div>
      <br clear="all" />
      <hr/>
      <br clear="all" />
    </div>
 </div>
<div class="clearfix"></div>
