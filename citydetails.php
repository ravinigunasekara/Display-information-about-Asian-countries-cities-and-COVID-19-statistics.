<?php
if (isset($_GET['q'])) {
    $cityInput = $_GET['q'];

    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://city-and-state-search-api.p.rapidapi.com/cities/$cityInput",
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
        $cityDetails = json_decode($response, true);
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
     <meta charset="UTF-8">
    <title>City Details</title>
	
	<style>
		
		section{
			padding:5rem 0;
			max-width: 1700px;
			margin:0 auto;
		}
 
	</style>

</head>
<body>
<section>
    <div id="main">
        <div id="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-1">&nbsp;</div>
                    <div class="col-md-10">
                        <h3 class="text-center">City Information</h3>
                        <div class="container">
                            
                            <hr />
                            
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    <div class="text-black bg-white">
        <div class="row">
            <div class="col-2">&nbsp;</div>
            <div class="col-8">
                
                <table class="table table-striped">

                    <?php
                    if (isset($cityDetails)) {
                        $data = [
                            $ci = ['City ID', $cityDetails['id']],
                            $cityn = ['City Name', $cityDetails['name']],
                            $sn = ['State Name', $cityDetails['state_name'] ?? 'No data available'],
                            $cn = ['Country Name', $cityDetails['country_name'] ?? 'No data available'],
                        ];

                        
                    }
                    ?>

                    <?php if (isset($cityDetails['country_code'])) { ?>

                        <tr>
                            <th><?php echo "City ID"; ?></th>
                            <td><?php echo $ci[1]; ?></td>
                        </tr>

                        <tr>
                            <th><?php echo "City Name"; ?></th>
                            <th><?php echo $cityn[1]; ?></th>
                        </tr>

                        <tr>
                            <th><?php echo "State Name"; ?></th>
                            <td><?php echo $sn[1]; ?></td>
                        </tr>

                        <tr>
                            <th><?php echo "Country Name"; ?></th>
                            <td><?php echo $cn[1]; ?></td>
                        </tr>


                        <tr>
                            <th>Country Flag:</th>
                            <th>
                                <?php
                                echo "<img src='https://flagcdn.com/w320/" . strtolower($cityDetails['country_code']) . ".png' alt='" . $cityDetails['country_name'] . " Flag width='100' height='50'>";
                                ?>
                            </th>
                        </tr>

                    <?php } ?>
                    <?php if (isset($cityDetails['name']) && isset($cityDetails['country_name'])) { ?>
                        <tr>
                            <th colspan="2">
                                <iframe
                                        width="100%"
                                        height="300"
                                        frameborder="1" style="border:1"
                                        referrerpolicy="no-referrer-when-downgrade"
                                        src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBQixFlS-WXbyr4poC13tidbH63sd5gHKc&q=<?php echo urlencode($cityDetails['name'] . ', ' . $cityDetails['country_name']); ?>&zoom=12"
                                            <?php echo urlencode($cityDetails['name'] . ', ' . $cityDetails['country_name']); ?>&zoom=12"
                                        allowfullscreen>
                                </iframe>
                            </th>
                        </tr>
                    <?php } ?>
                </table>

            </div>
        </div>
    </div>
</section>
</body>

</html>
