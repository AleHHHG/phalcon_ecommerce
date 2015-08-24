<section class="main-container col2-left-layout">
    <div class="main container">
        <div class="row">
            <section class="col-main col-sm-9 col-sm-push-3 wow bounceInUp animated">
                <div class="category-title">
                    <h1>{{nome}}</h1>
                </div>
                <div class="category-description std">
                    <div class="slider-items-products">
                    
                        {{ helper.banner.getHelper([
                                'container_id':'category-desc-slider',
                                'container_class':'product-flexslider hidden-buttons',
                                'caption':false,
                                'slide_wrap':'<div id="%1Ss" class="%2Ss">%3Ss</div>',
                                'slide_class': 'slider-items slider-width-col1',
                                'slide_item_wrap':'<div id="%1Ss" class="%2Ss">%3Ss %4Ss</div>',
                                'categoria': id
                            ])
                        }}

                    </div>
                </div>
                <div class="category-products">
                   <div class="toolbar">
                      <div id="sort-by">
                        <label class="left">Sort By: </label>
                        <ul>
                          <li><a href="#">Position<span class="right-arrow"></span></a>
                            <ul>
                              <li><a href="#">Name</a></li>
                              <li><a href="#">Price</a></li>
                              <li><a href="#">Position</a></li>
                            </ul>
                          </li>
                        </ul>
                        <a class="button-asc left" href="#" title="Set Descending Direction"><span style="color:#999;font-size:11px;" class="glyphicon glyphicon-arrow-up"></span></a> </div>
                      <div class="pager">
                        <div id="limiter">
                          <label>View: </label>
                          <ul>
                            <li><a href="#">15<span class="right-arrow"></span></a>
                              <ul>
                                <li><a href="#">20</a></li>
                                <li><a href="#">30</a></li>
                                <li><a href="#">35</a></li>
                              </ul>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    {{ partial("categoria/_produtos") }}
                </div>
            </section>
            <aside class="col-left sidebar col-sm-3 col-xs-12 col-sm-pull-9 wow bounceInUp animated">
                 {{ partial("template/_sidebar") }}
            </aside>
        </div>
    </div>
</section>
