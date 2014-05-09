<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>EMS - Education Management Systems</title>
		<!-- Bootstrap core CSS -->
		<link href="<?php echo base_url('/assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
		<!-- Just for debugging purposes. Don't actually copy this line! -->
		<!--[if lt IE 9]><script src="../../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<div class="container">
			<br>
			<button type="button" class="btn btn-default" id="start">Start</button>
			<button type="button" class="btn btn-default" id="stop">Stop</button>
			<hr/>
			<div class="progress">
				<div class="progress-bar" role="progressbar" style="width: 0%;">
					<!--span class="sr-only">0%</span-->
				</div>
			</div>
			<div id="test"></div>
		</div><!-- /.container -->
		<!--Bootstrap core JavaScript -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="<?php echo base_url('/assets/js/jquery-1.10.2.js'); ?>"></script>
		<script src="<?php echo base_url('/assets/js/bootstrap.min.js'); ?>"></script>
		<script type="text/javascript">
			$(function(){
				/*
				$.xhrPool=[];

				$.xhrPool.abortAll=function(){
					$(this).each(function(idx,jqXHR){ 
						jqXHR.abort();
					});
				};

				$.recurFunc=function(params){
					if(params <= 100){
						$.ajax({
							beforeSend:function(jqXHR){
								$.xhrPool.push(jqXHR);
							},
							dataType:"html",
							type:"POST",
							success:function(res){
								if(res){
									var currentWidth=$(".progress-bar").attr("style").split(":");
									var a=parseInt(currentWidth[1])+1;
									var b=a+"%";
									$(".progress-bar").css("width",b);
									$.recurFunc(params+=1);
								}
							},
							url:"<?php echo site_url('/welcome/ajax'); ?>"
						});
					}
				};
				*/

				$("#start").on("click",function(){
					$.ajax({
						/*beforeSend:function(jqXHR){
							$.xhrPool.push(jqXHR);
						},*/
						dataType:"html",
						type:"POST",
						success:function(responseMessage) {
							var obj = jQuery.parseJSON(responseMessage);
							for(var i = 1; i <= 1; i += 1) {
								$.each(obj, function(key, val) {
									/*$.each(val, function(k, v) {
										$("#test").append(k + ' = ' + v + '<br>');
									});*/
									$("#test").append(val['row_id']);
									$("#test").append('<br>');
									//$("#test").append(key + ' = ' + val + '<br>');
								});
								$.ajax({
									/*beforeSend:function(jqXHR){
										$.xhrPool.push(jqXHR);
									},*/
									data: {
										chromosomeNo: i
									},
									dataType:"html",
									type:"POST",
									success:function(rm) {
										//$("#test").append('<pre>' + rm + '</pre>');
									},
									url: "<?php echo site_url('/ct_ajax/do_insert_chromosome'); ?>"
								});
								$("#test").append('<hr>');
							}
							/*
							if(res) {
								var currentWidth=$(".progress-bar").attr("style").split(":");
								var a=parseInt(currentWidth[1])+1;
								var b=a+"%";
								$(".progress-bar").css("width",b);
								$.recurFunc(params+=1);
							}
							*/
						},
						url: "<?php echo site_url('/ct_ajax/'); ?>"
					});
					//$(this).attr("disabled","disabled");
					//$.recurFunc(1);
				});

				/*
				$("#stop").on("click",function(){
					$.xhrPool.abortAll();
				});
				*/
			});
		</script>
	</body>
</html>