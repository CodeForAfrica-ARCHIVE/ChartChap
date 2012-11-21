</div>
<div class="span3">
										<div class="well">
											<div class="navbar">
												<div class="navbar-inner">
													<a class="brand" href="#">STATS</a><img src='<?php echo $home?>icons/stats.png' style='float:right;width:40px'>
												</div>
											</div>
											<div class="info-widget">
												<?php
												stats();
												?>
												
											</div>
										</div>
										<div class="well">
										<div class="navbar">
												<div class="navbar-inner"><a class="brand" href="#">Datasets by category</a></div>
											</div>
										<div class="progress-container">	
											
											<?php
											//find total datasets
											$datasets = mysql_num_rows(mysql_query("SELECT * FROM datasets"));
											
											//
											$categories = mysql_query("SELECT name FROM categories");
											while($category = mysql_fetch_array($categories))
											{
											//how many datasets of this category
												$cat_ds = mysql_num_rows(mysql_query("SELECT * FROM datasets WHERE category='".$category['name']."'"));
												$percentage = ($cat_ds*100)/$datasets;
												echo '<div class="progress-item">
												<small>'.$category['name'].'</small>
												<div class="progress small">
													<div class="bar" style="width: '.$percentage.'%"></div>
												</div>
												<span class="badge badge-info">'.$percentage.'%</span>
											</div>
												';
											}
											?>
												
											
										</div>
										</div>
										<div class="well">
										<div class="navbar">
												<div class="navbar-inner"><a class="brand" href="#">Datasets by country</a></div>
											</div>
										<div class="progress-container">	
											<?php
											//find total datasets
											$datasets = mysql_num_rows(mysql_query("SELECT * FROM datasets"));
											
											//
											$count_ds = array();
											$countries = mysql_query("SELECT printable_name FROM country");
											while($country = mysql_fetch_array($countries))
											{
												//how many datasets of this country
												$name = mysql_real_escape_string($country['printable_name']);
												
												$cnt_ds = mysql_num_rows(mysql_query("SELECT * FROM datasets WHERE country='".$name."'"));
												
												$percentage = ($cnt_ds*100)/$datasets;	
												$count_ds = array($name=>$percentage)+$count_ds;
											}
											arsort($count_ds);
											
											$totalshown=1;
											foreach($count_ds as $country=>$datasets)
											{
												if($totalshown<9)
												{
													$totalshown++;
													echo '<div class="progress-item">
												<small>'.$country.'</small>
												<div class="progress small">
													<div class="bar" style="width: '.$datasets.'%"></div>
												</div>
												<span class="badge badge-info">'.$datasets.'%</span>
											</div>
												';
												}
											}

											?>
										</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div id="footer">
		<div class="container-fluid">
			<div class="row-fluid">
				<div class="span12">
					<div class="navbar navbar-blue">
						<div class="navbar-inner">
							<ul class="nav pull-right">
								<li><a href="#">About</a></li>
								<li><a href="#">Terms of use</a></li>
								<li><a href="#">Contacts us</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>	
	</div>

	<!-- required js files -->
	<script src="<?php echo $home?>assets/js/jquery.js"></script>
	<script src="<?php echo $home?>assets/js/bootstrap.min.js"></script>	

	<!-- charts plugin -->
	<script src="<?php echo $home?>app/plugins/jquery.peity.min.js"></script>
	<script src="<?php echo $home?>app/plugins/jquery.knob.js"></script>
	<script src="<?php echo $home?>app/plugins/jqplot/jquery.jqplot.min.js"></script>
	<script src="<?php echo $home?>app/plugins/jqplot/jqplot.highlighter.min.js"></script>
	<script src="<?php echo $home?>app/plugins/jqplot/jqplot.cursor.min.js"></script>
	<script src="<?php echo $home?>app/plugins/jqplot/jqplot.dateAxisRenderer.min.js"></script>
	<script src="<?php echo $home?>app/plugins/jqplot/jqplot.pieRenderer.min.js"></script>
	<script src="<?php echo $home?>app/plugins/jqplot/jqplot.donutRenderer.min.js"></script>
	<script src="<?php echo $home?>app/plugins/jqplot/jqplot.barRenderer.min.js"></script>
	<script src="<?php echo $home?>app/plugins/jqplot/jqplot.categoryAxisRenderer.min.js"></script>
	<script src="<?php echo $home?>app/plugins/jqplot/jqplot.pointLabels.min.js"></script>
	
	<!-- form plugins -->
	<script src="<?php echo $home?>app/plugins/jquery.elastic.js"></script>
	<script src="<?php echo $home?>app/plugins/jquery.uniform.js"></script>
	<script src="<?php echo $home?>app/plugins/bootstrap-datepicker.js"></script>
	<script src="<?php echo $home?>app/plugins/jquery.timePicker.min.js"></script>
	<script src="<?php echo $home?>app/plugins/jquery.simple-color-picker.js"></script>
	<script src="<?php echo $home?>app/plugins/chosen.jquery.min.js"></script>
	<script src="<?php echo $home?>app/plugins/wysihtml5/wysihtml5-0.3.0.min.js"></script>
	<script src="<?php echo $home?>app/plugins/wysihtml5/bootstrap-wysihtml5.js"></script>
	<script src="<?php echo $home?>app/plugins/jquery.limit-1.2.js"></script>
	<script src="<?php echo $home?>app/plugins/formToWizard.js"></script>
	
	<!-- other plugins -->
	<script src="<?php echo $home?>app/plugins/jquery-ui-custom/jquery-ui-1.8.22.custom.min.js"></script>
	<script src="<?php echo $home?>app/plugins/DataTables/media/js/jquery.dataTables.js"></script>	
	<script src="<?php echo $home?>app/plugins/jscrollpane/jquery.mousewheel.js"></script>
	<script src="<?php echo $home?>app/plugins/jscrollpane/jquery.jscrollpane.min.js"></script>	
	<script src="<?php echo $home?>app/plugins/fullcalendar.min.js"></script>

	<script src="<?php echo $home?>assets/js/google-code-prettify/prettify.js"></script>
	
	<script src="<?php echo $home?>app/plugins/jPages.min.js"></script>
	<script src="<?php echo $home?>app/plugins/jquery.masonry.min.js"></script>

	<!-- js for templates -->
	<script src="<?php echo $home?>app/js/custom.js"></script>
</body>
</html>