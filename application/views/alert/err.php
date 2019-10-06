<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Lorem ipsum</title>
	<link rel="shortcut icon" href="<?=base_url();?>assets/icon/favicon.ico">
	<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/mdi/css/materialdesignicons.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/css/style.css">
	<style type="text/css">
		body {
			background-color: #3f4a51;
		}

		.wrp {
			max-width: 350px !important;
		}

		@media screen and (min-width: 768px) {
			body {
				/*background-image: url('../assets/img/lp.jpg');*/
				background-blend-mode: soft-light;
				background-repeat: no-repeat;
				-webkit-background-size: cover;
				background-size: cover;
			}

			.wrp {
				min-width: 350px !important;
				max-width: 350px !important;
			}
		}
	</style>
</head>
<body>

	<div class="container">
		<div class="row d-flex justify-content-center mt-5">
			<div class="col-md-4 wrp">
				<div class="card">
					<div class="card-body">
						<p class="text-center mt-3 text-danger" style="font-size: 20px;"><?=$message;?></p>
						<h1 class="text-center"><i style="font-size: 120px;" class="text-danger mdi mdi-check-circle-outline"></i></h1>
						<p class="text-center">
							<button class="btn btn-danger" id="getButton"><?=$buttonText;?></button>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>

	
	<script type="text/javascript" src="../assets/js/slim/jquery-slim.min.js"></script>
	<script type="text/javascript" src="../assets/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		var getButtonId = document.getElementById('getButton');
		getButtonId.addEventListener('click', function(e) {
			window.location.href = '<?=$getLink;?>';
		});
	</script>
</body>
</html>