<!-- Footer Section -->
<footer class="footer_section section_wrapper section_wrapper" >
	<div class="footer_top_section">
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					<div class="text_widget footer_widget">
					<div class="footer_widget_title"><h2>About</h2></div>
		         
		         	<div class="footer_widget_content">This is a test project.
					</div>
					</div><!--text_widget-->
				</div><!--col-xs-3-->

				<div class="col-md-6">
					<div class="footer_widget">
                        <div class="footer_widget_title"><h2>Discover</h2></div>
					    <div class="footer_menu_item ">
						<div class="row">
							<div class="col-sm-4"> 
								<ul class="nav navbar-nav ">
									@php
										$categories = \App\Models\Category::take(9)->get();
										foreach ($categories as $category)
											echo '<li><a href="/category/'.$category->id.'">' . $category->name . '</a></li>';
									@endphp
								</ul>
						    </div><!--col-sm-4-->
					        <div class="col-sm-4 "> 
					        </div><!--col-sm-4-->
					        <div class="col-sm-4"> 
					        </div><!--col-sm-4-->
				      	</div><!--row-->
			      	</div><!--footer_menu_item-->
                    </div><!--footer_widget-->
				</div><!--col-xs-6-->

				<div class="col-md-3">
 					<div class="text_widget footer_widget">
						<div class="footer_widget_title"><h2>Candidate Info</h2></div>
						<div class="footer_widget_content">
							<div>Name: Jonathan Ijeh</div>
							<div>Email: captajo2@gmail.com</div>
						</div>
					</div>
				</div><!--col-xs-3-->
			</div><!--row-->
		</div><!--container-->
	</div><!--footer_top_section-->
	<a href="#" class="crunchify-top"><i class="fa fa-angle-up" aria-hidden="true"></i></a>
	
	<div class="copyright-section">
			<div class="container">
				<div class="row">
					<div class="col-md-3">
							Editor: JONATHAN IJEH
					</div><!--col-xs-3-->
					<div class="col-md-6">
						<div class="copyright">
						© Copyright @php echo Date('Y') @endphp
						</div>
					</div><!--col-xs-6-->
					<div class="col-md-3">
						Sports News Magazine
					</div><!--col-xs-3-->
				</div><!--row-->
			</div><!--container-->
		</div><!--copyright-section-->
</footer>