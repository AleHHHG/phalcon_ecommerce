<div class="col-lg-12">
   <section class="box ">
	   	<header class="panel_header">
	        <h2 class="title pull-left">Loja - Produtos</h2>
	    </header>
         <div class="content-body">
			{{ form("admin/loja/produtos") }}
				{% for element in form %}
				   <div class="form-group">
				       {{ element.label(['class': 'form-label']) }}
				       {{ element.setAttribute('class','form-control') }}
				   </div>
				{% endfor %}
				<div class="form-group">
					<div class="page-header">
						<h4>
							Protudo Opções
							<a href='javascript:;' class='btn pull-right btn-success clone-detalhe'>Nova Opção</a>
						</h4>
					</div>
					{% if produto_opcoes is empty %}
					<div class='target'>
						<div class='form-clone'>
							<div class='col-md-6 paddingLeft0' >
								<label class='form-label'>Referencia</label>
								<input type='text' class='form-control' name="produto_opcoes[referencia][]" />
							</div>
							<div class='col-md-6 paddingRight0'>
								<label class='form-label'>Label</label>
								<input type='text' class='form-control' name="produto_opcoes[label][]" />
							</div>
							<div class='col-md-12 paddingLeft0'>
								<a href="javascript:;" class="btn btn-orange pull-right remove-detalhe">
		                          <i class="fa fa-times"></i>
		                          Remover Opção
		                        </a>
		                    </div>
							<br clear='all'/>
							<br clear='all'/>
						</div>
					</div>
					{% else %}
						<div class='target'>
							{% for detalhe in produto_opcoes %}
								<div class='form-clone'>
									<div class='col-md-6 paddingLeft0' >
										<label class='form-label'>Referencia</label>
										<input type='text' class='form-control' name="produto_opcoes[referencia][]" value="{{detalhe['referencia']}}" />
									</div>
									<div class='col-md-6 paddingRight0'>
										<label class='form-label'>Label</label>
										<input type='text' class='form-control' name="produto_opcoes[label][]" value="{{detalhe['label']}}" />
									</div>
									<div class='col-md-12 paddingLeft0'>
										<a href="javascript:;" class="btn btn-orange pull-right remove-detalhe">
				                          <i class="fa fa-times"></i>
				                          Remover Detalhe
				                        </a>
				                    </div>
									<br clear='all'/>
									<br clear='all'/>
								</div>
							{% endfor %}
						</div>
						{% endif %}
				</div>
				<div class="form-group">
					<div class="page-header">
						<h4>
							Detalhe Opções
							<a href='javascript:;' class='btn pull-right btn-success clone-detalhe'>Novo Detalhe</a>
						</h4>
					</div>
					{% if detalhe_opcoes is empty %}
					<div class='target'>
						<div class='form-clone'>
							<div class='col-md-6 paddingLeft0' >
								<label class='form-label'>Referencia</label>
								<input type='text' class='form-control' name="opcoes[referencia][]" />
							</div>
							<div class='col-md-6 paddingRight0'>
								<label class='form-label'>Label</label>
								<input type='text' class='form-control' name="opcoes[label][]" />
							</div>
							<div class='col-md-12 paddingLeft0'>
								<a href="javascript:;" class="btn btn-orange pull-right remove-detalhe">
		                          <i class="fa fa-times"></i>
		                          Remover Detalhe
		                        </a>
		                    </div>
							<br clear='all'/>
							<br clear='all'/>
						</div>
					</div>
					{% else %}
						<div class='target'>
							{% for detalhe in detalhe_opcoes %}
								<div class='form-clone'>
									<div class='col-md-6 paddingLeft0' >
										<label class='form-label'>Referencia</label>
										<input type='text' class='form-control' name="opcoes[referencia][]" value="{{detalhe['referencia']}}" />
									</div>
									<div class='col-md-6 paddingRight0'>
										<label class='form-label'>Label</label>
										<input type='text' class='form-control' name="opcoes[label][]" value="{{detalhe['label']}}" />
									</div>
									<div class='col-md-12 paddingLeft0'>
										<a href="javascript:;" class="btn btn-orange pull-right remove-detalhe">
				                          <i class="fa fa-times"></i>
				                          Remover Detalhe
				                        </a>
				                    </div>
									<br clear='all'/>
									<br clear='all'/>
								</div>
							{% endfor %}
						</div>
					{% endif %}
				</div>
			   	{{ submit_button("Editar", "class": "btn btn-primary btn-lg")  }}
			{{ endform() }}
		</div>
	</section>
</div>