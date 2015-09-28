
   <ul class="nav nav-tabs transparent">
      <li class="active">
         <a href="#home-2" data-toggle="tab">
         <i class="fa fa-picture-o"></i> Biblioteca
         </a>
      </li>
      <li>
         <a href="#profile-2" data-toggle="tab">
         <i class="fa fa-plus-square"></i>Upload 
         </a>
      </li>
   </ul>
   <div class="tab-content transparent">
      <div class="tab-pane fade in active" id="home-2">
         <div class="row">
            <div class="col-md-12" id="content-upload-images">
               {% for i in imagens%}
                  <div class="col-md-3 thumbnail" style="padding:20px">
                      <input type="checkbox" data-coluna='{{ coluna}}' name="imagens_selecionadas" class="pull-right imagem-select" value="{{ i.id }}">
                      <br/>
                      {{ image(i.url,'class':'img-responsive')}}
                  </div>
               {% endfor %}
            </div>   
         </div>
      </div>
      <div class="tab-pane fade" id="profile-2">
        <div class="row">
            <div class="col-md-12">
               <div id="progress" class="progress">
                <div class="progress-bar progress-bar-primary"></div>
               </div>
               {{ form("admin/upload/create",'enctype': 'multipart/form-data','id':'upload-form') }}
                  {{ file_field('files[]','id':'fileupload','multiple':'multiple')}}
                  <br/>
               {{endForm()}}
            </div>   
         </div>
      </div>
   </div>
