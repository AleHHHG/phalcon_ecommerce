<div class="col-lg-12">
   	<div class="page-title">
        <div class="pull-left">
            <h1 class="title">Criar Documentação</h1>
        </div>
        <div class="pull-right hidden-xs">
            <ol class="breadcrumb">
                <li>
                	{{ link_to('/documentacao','<i class="fa fa-home"></i>Home')}}
                </li>
                <li class="active">
                    <strong>Criar Documentação</strong>
                </li>
            </ol>
        </div>
    </div>
   <section class="box">
   		<div class="content-body">
			{{ form("documentacao/create",'enctype': 'multipart/form-data') }}
				{{ partial("index/_form") }}
			{{endForm()}}
		</div>
   </section>
</div>