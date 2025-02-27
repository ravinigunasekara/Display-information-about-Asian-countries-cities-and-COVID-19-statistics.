<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>City Information</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#search').on('input', function() {
                var searchTerm = $(this).val().trim();
                
                if (searchTerm === "") {
                    $('#city-details').html("");
                    return;
                }
                
                $.ajax({
                    url: 'getinformation.php',
                    type: 'GET',
                    data: { q: searchTerm },
                    success: function(response) {
                        $('#city-details').html(response);
                    },
                    error: function(err) {
                        console.error(err);
                    }
                });
            });
        });
		
    </script>
	
	
    <style>
        section {
            padding: 5rem 0;
            max-width: 1300px;
            margin: 0 auto;
        }
    </style>
	
</head>
	<section>
		<body style="background-color: white; color: black;">
			<div id="main">
				<div id="content">
					<div class="container">
						<div class="row">
							<div class="col-md-1">&nbsp;</div>
							<div class="col-md-10">
								<h5 class="text-center">City Information</h5>
								<div class="container">
									<h5 class="text text-primary">
										<div class="row">
											<div class="col-md-4">Search Cities:</div>
											<div class="col-md-8">
												<input type="text" id="search" class="form-control" />
											</div>
										</div>
									</h5>
									<hr />
									<div id="city-details">Load Cities</div>
								</div>
							</div>
							<div class="col-md-1">&nbsp;</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</body>
</html>
