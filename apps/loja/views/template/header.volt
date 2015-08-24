<?php 
	use Ecommerce\Loja\Customs\MenuHelperCustom;
	$menu = new MenuHelperCustom;
?>

<div id="page">
	<!-- Push Wrapper -->
	<div class="mp-pusher" id="mp-pusher">
	<!-- mp-menu -->
		<nav id="mp-menu" class="mp-menu">
			<div class="mp-level">
				<h2>
					<a href="javascript:;" class="btn btn-info close-nav"><i class="fa fa-times"></i></a>
					&nbsp &nbsp Todas Categorias
				</h2>
				{{ menu.getHelper([
						'container_class':'mp-level',
						'home':false,
						'lateral':true
					])
				}}
			</div>
		</nav>
			<!-- /mp-menu -->
		<div class="scroller">
	<!-- this is for emulating position fixed of the nav -->
			<div class="scroller-inner">
				<header class="header-container">
					<div class="header-top">
						<div class="container">
							<div class="row">
								{{ helper.topBar.getHelper([
										'container_class':'col-lg-6 col-md-6 col-sm-5 col-xs-12',
										'wrap':'<div class="%1Ss">%2Ss</div>',
										'wrap_class':'phone hidden-xs',
										'item_wrap':'<div class="%1Ss"> %2Ss</div>',
										'item_class': 'phone-box',
										'actions':[
											'fone'
										]
									])
								}}

								<div class="col-lg-6 col-md-6 col-sm-7 col-xs-12">
						            <div class="top-cart-contain">
						              <div class="mini-cart">
							                <div data-toggle="dropdown" data-hover="dropdown" class="basket dropdown-toggle"> <a href="#"> <i class="icon-cart"></i></a>
							                 
							              	</div>
					                	</div>
						            </div>
						            {{ helper.topBar.getHelper([
										'container_class':'toplinks',
										'wrap':'<div class="%1Ss">%2Ss</div>',
										'wrap_class':'links',
										'item_wrap':'<div class="%1Ss"> %2Ss</div>',
										'item_class': 'phone-box',
										'actions':[
											'login','my_account','compare','to_cart'
										]
									])
								}}
						        </div>
							</div>
						</div>
					</div>
				</header>
				<!-- Navbar -->
				<nav>
					<div class="header container">
						<div class="row">
							<div class="col-xs-12">
								<div class="mm-toggle-wrap">
									<div class="mm-toggle"> <i class="icon-align-justify"></i><span class="mm-label">Menu</span> </div>
								</div>
							</div>

							{{ menu.getHelper([
									'container_class':'inner',
									'menu_id':'nav',
									'item_class':'level0 parent drop-menu',
									'submenu_class':'level1',
									'submenu_item_class':'level1 parent'
								])
							}}
						</div>
					</div>
				</nav>
