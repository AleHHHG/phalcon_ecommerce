<div class="col-lg-12">
   	<div class="page-title">
        <div class="pull-left">
          <h1 class="title">{{doc.nome}} <small>{{ link_to('/documentacao/update/'~doc.id,' <i class="fa fa-edit"></i>')}}</small></h1>
        </div>
        <div class="pull-right hidden-xs">
            <ol class="breadcrumb">
                <li>
                	{{ link_to('/documentacao','<i class="fa fa-home"></i>Home')}}
                </li>
                <li class="active">
                    <strong>{{ doc.nome}}</strong>
                </li>
            </ol>
        </div>
    </div>
   <section class="box">
   	  <div class="content-body">
        {% if childrens is not empty %}
			   <div class="col-md-3">
            <div class="list-group">
              {% for item in childrens%}
                {{ link_to('/documentacao/show/'~item['id'],item['nome'],'class':'list-group-item')}}
              {% endfor %}
            </div>
         </div>
         <div class="col-md-9">
            {{ doc.conteudo}}
         </div>
         {% else  %}
          <div class='col-md-12'>
            {{ doc.conteudo}}
          </div>
         {% endif %}
         <br clear="all"/>
		  </div>
      <br clear="all"/>
   </section>
</div>