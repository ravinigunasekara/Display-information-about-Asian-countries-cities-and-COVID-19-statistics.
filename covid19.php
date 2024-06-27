<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
     <meta charset="UTF-8">
    <title>COVID19 Information in Europe</title>
	
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
                        <h3 class="text-center">COVID19 Information in Europe</h3>
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
           
		
<?php


		$apiKey = '89c985f0f8msh66d3562ca903373p1f3defjsn7bf81ab5b430';
		$endpoint = 'https://covid-193.p.rapidapi.com/statistics';

		$curl = curl_init();

		curl_setopt_array($curl, [
			CURLOPT_URL => $endpoint,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_CUSTOMREQUEST => 'GET',
			CURLOPT_HTTPHEADER => [
				'X-RapidAPI-Key: ' . $apiKey
			]
		]);

		$response = curl_exec($curl);
		curl_close($curl);

		$data = json_decode($response, true);

		if ($data && isset($data['response'])) {
			$europeanCountries = [];

			foreach ($data['response'] as $countryData) {
				$continent = $countryData['continent'];
				 $country = $countryData['country'];
				if ($continent === 'Europe' && $country !== 'Europe') {
					$country = $countryData['country'];
					$population = $countryData['population'];
					$totalCases = $countryData['cases']['total'] ?? '0';
					$totalDeaths = $countryData['deaths']['total'] ?? '0';
					$tests = $countryData['tests']['total'] ?? '0';

					$europeanCountries[] = [
						'country' => $country,
						'population' => $population,
						'totalCases' => $totalCases,
						'totalDeaths' => $totalDeaths,
						'tests' => $tests,
						'continent' => $continent
					];
				}
			}

				// Display the data on the page
				echo '<table class="table">
						<tr>
							<th>Country</th>
							<th>Population</th>
							<th>Total Covid Cases</th>
							<th>Total Deaths</th>
							<th>Tests</th>
							<th>Continent</th>
						</tr>';

				foreach ($europeanCountries as $countryData) {
					echo '<tr>
							<td>' . $countryData['country'] . '</td>
							<td>' . $countryData['population'] . '</td>
							<td>' . $countryData['totalCases'] . '</td>
							<td>' . $countryData['totalDeaths'] . '</td>
							<td>' . $countryData['tests'] . '</td>
							<td>' . $countryData['continent'] . '</td>
						</tr>';
				}

				echo '</table>';
			} else {
				echo 'Error retrieving data from the API.';
			}

	?>
			
			</div>
		</div>
	</div>
	
</section>
	
</body>
</head>
</html>
