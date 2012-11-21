<?php require_once('header.php');?>
									
									
										<div class="well">
											<div class="navbar">
												<div class="navbar-inner">
													<a class="brand" href="#">Upload file</a>
												</div>
											</div>
											
											<div class="info-widget">
												<div class="row-fluid">
													<?php
													include_once('upload_csv/index.php');
													?>
												</div>
												<div class="line-divider"></div>
												<div class="row-fluid">
													<h2>Most recent visualizations</h3>
												</div>
											</div>
										</div>
										
										<div class="row-fluid">
										<?php
										$latestCharts = mysql_query('SELECT id FROM charts ORDER by id Desc LIMIT 2');
												while($latestChart = mysql_fetch_array($latestCharts))
												{
												echo '<div class="span6">
												<div class="well">
													<div class="navbar">
														
													</div>
													<div class="info-widget stats">';
													mostrecent($latestChart['id']);
												echo '</div>
												</div>
											</div>';
												}

										?>
										
										</div>
										<div class="row-fluid">
										<?php
										$latestCharts = mysql_query('SELECT id FROM charts ORDER by id Desc LIMIT 2 OFFSET 2');
												while($latestChart = mysql_fetch_array($latestCharts))
												{
												echo '<div class="span6">
												<div class="well">
													<div class="navbar">
														
													</div>
													<div class="info-widget stats">';
													mostrecent($latestChart['id']);
												echo '</div>
												</div>
											</div>';
												}

										?>
										
										</div>
										
									
<?php
require_once('footer.php');
?>