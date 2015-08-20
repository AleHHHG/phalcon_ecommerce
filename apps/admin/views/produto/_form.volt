<button class="btn btn-orange pull-right"><i class="fa fa-angle-left"></i>&nbsp Voltar</button> 
<button class="btn btn-info pull-right"><i class="fa fa-save"></i> {% if acao == 'update' %} Editar {% else %} Salvar {% endif %}</button>
<br clear"all"/>
<ul class="nav nav-tabs">
    <li class="active">
       <a href="#step1" data-toggle="tab">
       <i class="fa fa-cube"></i> Informações basicas do Produto
       </a>
    </li>
    {% if this.ecommerce_options.produto_detalhes == '1'%}
    <li>
       <a href="#step2" data-toggle="tab">
       <i class="fa fa-cubes"></i>Detalhes do Produto
       </a>
    </li>
    {% endif %}
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
          {% for element in form %}
             <div class="form-group">
                 {{ element.label(['class': 'form-label']) }}
                 {{ element }}
             </div>
          {% endfor %}
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
            {% if acao == 'create'%}
              <div class="form-clone">
                  {% for element in form_detalhes %}
                    <div class="col-md-4">
                       <div class="form-group">
                           {{ element.label(['class': 'form-label']) }}
                           {{ element }}
                       </div>
                    </div>
                  {% endfor %}
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
            {% else %}
              {% for detalhe in form_detalhes%}
                <div class="form-clone">
                    {% for element in detalhe %}
                      <div class="col-md-3">
                         <div class="form-group">
                            {{ element.label(['class': 'form-label']) }}
                            {{ element }}
                         </div>
                      </div>
                    {% endfor %}
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
              {% endfor %}
            {% endif %}
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
        {% for imagem in produto.imagens  %}
          <div class="col-md-3 imagem-container" data-imagem ="{{ imagem}}">
            {{image('files/produtos/'~imagem,'class':'img-responsive')}}
          </div>
        {% endfor %}
        <input type="hidden" name="produto_id" id="produto_id" value="{{ produto._id}}" />
      </div>
      <br clear="all" />
      <hr/>
      <br clear="all" />
    </div>
 </div>
<div class="clearfix"></div>
