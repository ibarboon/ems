<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>EMS - Education Management Systems</title>
		<link href="<?php echo base_url('/assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
	</head>
	<body>
		<div class="container">
			<br>
			<button type="button" class="btn btn-default" id="start">Start</button>
			<button type="button" class="btn btn-default" id="stop">Stop</button>
			<hr/>
			<div class="progress">
				<div class="progress-bar" role="progressbar" style="width: 0%;">
					<span class="sr-only">0%</span>
				</div>
			</div>
			<div id="test"></div>
		</div><!-- /.container -->
		<!--Bootstrap core JavaScript -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="<?php echo base_url('/assets/js/jquery-1.10.2.js'); ?>"></script>
		<script src="<?php echo base_url('/assets/js/bootstrap.min.js'); ?>"></script>
		<script type="text/javascript">
			$(function() {

				var numberOfChromosome = 0,
					numberOfGeneration = 0,
					studyGroups;

				$.ajax({
					url: "<?php echo site_url('/sys_options/get_options_list'); ?>",
					dataType: "json",
					success: function(data) {
						numberOfChromosome = parseInt(data['NUMBER_OF_CHROMOSOME']);
						numberOfGeneration = parseInt(data['NUMBER_OF_GENERATION']);
					},
					type: "POST"
				});
				
				$.recurFunc = function(in_params) {
					if(in_params[1] < studyGroups.length) {
						$.ajax({
							url: "<?php echo site_url('/genetic_algorithms/initialization'); ?>",
							data: {
								c_no: in_params[0],
								s_c_no: studyGroups[in_params[1]]['department_id'] + '#' + studyGroups[in_params[1]]['year_no']
							},
							dataType: "json",
							success: function(data) {
								if(data) {
									$.recurFunc([in_params[0], in_params[1] + 1]);
									if(in_params[0] == (numberOfChromosome - 1) && in_params[1] == (studyGroups.length - 1)) {
										setTimeout(3);
										for(var i = 0; i < numberOfChromosome; ++ i) {
											$.fitnessEva(i);
										}
									}
								}
							},
							type: "POST"
						});
					}
				};

				$.fitnessEva = function(in_params) {
					$.ajax({
						url: "<?php echo site_url('/genetic_algorithms/fitness_evaluation'); ?>",
						data: {
							c_no: in_params
						},
						dataType: "html",
						success: function(data) {
							//
						},
						type: "POST"
					});
				};

				$("#start").on("click", function() {
					$("#test").empty();
					$(".progress-bar").css("width", "0%");
					$.ajax({
						url: "<?php echo site_url('/workloads/get_s_g'); ?>",
						dataType: "json",
						success: function(data) {
							studyGroups = data;
							for(var i = 0; i < numberOfChromosome; i += 1) {
								var vAttr = $(".progress-bar").attr("style").split(":"),
									vCurrentWidth = ((parseInt(vAttr[1]) + 1) / numberOfChromosome) * 100,
									vNewWidth = vCurrentWidth + "%";
								$(".progress-bar").css("width", vNewWidth);
								$.recurFunc([i, 0]);
							}
						},
						type: "POST"
					});
				});
			});
		</script>
	</body>
</html>