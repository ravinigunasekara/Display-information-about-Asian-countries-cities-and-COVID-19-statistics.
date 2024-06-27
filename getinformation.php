<?php
if (isset($_GET['q'])) {
    $cityInput = $_GET['q'];

$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL => "https://city-and-state-search-api.p.rapidapi.com/search?q=$cityInput",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => [
        "X-RapidAPI-Host: city-and-state-search-api.p.rapidapi.com",
        "X-RapidAPI-Key: 89c985f0f8msh66d3562ca903373p1f3defjsn7bf81ab5b430"
    ],
]);

$response = curl_exec($curl);
$error = curl_error($curl);

curl_close($curl);

if ($error) {
    echo "cURL Error #:" . $error;
} else {
    $c = json_decode($response, true);
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" 
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>City Details</title>
	
	
</head>

<body>

<div class="container">
	<div class="text-black bg-white">
		<div class="row">
        
			<table class="table">
				<thead>
					<tr>
						<th>ID</th>
						<th>City Name</th>
						<th>State Name</th>
						<th>Country Name</th>
						<th></th>
					</tr>
				</thead>
					
				<tbody>
				
					<?php 
					if (!empty($c) && is_array($c)) {
					foreach ($c as $v) { ?>
						<tr>
							<td><?php echo $v['id']; ?></td>
							<td><?php echo $v['name']; ?></td>
							<td>
								<?php 
									if (isset($v['state_name'])) {
										echo $v['state_name'];
									}
									else {
										echo 'No data available';
									}
							
								?>
							</td>
							<td>
								<?php
									if (isset($v['country_name'])) {
										echo $v['country_name'];
									}
									else {
										echo 'No data available';
									}
								?>
						
							</td>
							
							<td><a href="citydetails.php?q=<?php echo $v['id'];?>">
                                                        <?php echo '<button type="button" class="btn btn-success">City Details</button>'; ?></a></td>
						
						</tr>
						
					<?php }} ?>
					
					</tbody>
					
				</table>
				
			</div>
			
	</body>
</html>
