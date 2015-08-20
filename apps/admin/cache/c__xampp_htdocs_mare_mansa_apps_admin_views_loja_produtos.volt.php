<div class="col-lg-12">
   <section class="box ">
	   	<header class="panel_header">
	        <h2 class="title pull-left">Loja - Produto</h2>
	    </header>
         <div class="content-body">
			<?php echo $this->tag->form(array('admin/loja/produtos')); ?>
				<?php foreach ($form as $element) { ?>
				   <div class="form-group">
				       <?php echo $element->label(array('class' => 'form-label')); ?>
				       <?php echo $element->setAttribute('class', 'form-control'); ?>
				   </div>
				<?php } ?>
				<div class="form-group">
					<div class="page-header">
						<h4>
							Detalhe Opções
							<a href='javascript:;' class='btn pull-right btn-success clone-detalhe'>Novo Detalhe</a>
						</h4>
					</div>
					<?php if (empty($detalhe_opcoes)) { ?>
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
					<?php } else { ?>
						<div class='target'>
							<?php foreach ($detalhe_opcoes as $detalhe) { ?>
								<div class='form-clone'>
									<div class='col-md-6 paddingLeft0' >
										<label class='form-label'>Referencia</label>
										<input type='text' class='form-control' name="opcoes[referencia][]" value="<?php echo $detalhe['referencia']; ?>" />
									</div>
									<div class='col-md-6 paddingRight0'>
										<label class='form-label'>Label</label>
										<input type='text' class='form-control' name="opcoes[label][]" value="<?php echo $detalhe['label']; ?>" />
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
							<?php } ?>
						<?php } ?>
					</div>
				</div>
			   	<?php echo $this->tag->submitButton(array('Editar', 'class' => 'btn btn-primary btn-lg')); ?>
			<?php echo $this->tag->endform(); ?>
		</div>
	</section>
</div>