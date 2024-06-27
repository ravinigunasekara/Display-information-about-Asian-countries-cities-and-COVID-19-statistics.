<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" >
	
    <meta charset="UTF-8">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    
	
	
           
		<script type="text/javascript">
		
				google.charts.load('current', {'packages':['corechart']});
				google.charts.setOnLoadCallback(drawChart);

				function drawChart() {
					
				  // Fetch the COVID-19 data from the RapidAPI endpoint
				  var apiKey = "89c985f0f8msh66d3562ca903373p1f3defjsn7bf81ab5b430";
				  var endpoint = 'https://covid-193.p.rapidapi.com/statistics';

				  var xhr = new XMLHttpRequest();
				  xhr.open("GET", endpoint, true);
				  xhr.setRequestHeader("X-RapidAPI-Key", apiKey);

				  xhr.onreadystatechange = function() {
					if (xhr.readyState === 4 && xhr.status === 200) {
					  var response = JSON.parse(xhr.responseText);

					  if (response && response.response) {
						var statistics = response.response;

						// Filter out only the European countries
						var europeanData = statistics.filter(function(countryData) {
						  return countryData.continent === 'Europe' && countryData.country !== 'Europe';
						});

						// Format the data for Google Charts API
						var chartData = [['Country', 'Cases']];
						europeanData.forEach(function(countryData) {
						  chartData.push([countryData.country, countryData.cases.total]);
						});

						var data = google.visualization.arrayToDataTable(chartData);
						

						
						var options = {
							title: 'Cases vs. Countries in Europe',
							width: 1100,
							height: 570,
							bar: {groupWidth: "60%"},
							legend: {position: 'bottom', textStyle: {color: 'black', fontSize: 16}},
							
							};
						  
						 


						var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
						chart.draw(data, options);
					  }
					}
				  };

				  xhr.send();
				}
				
	
		</script>
		
	

    <title>COVID19 Information in Europe - Bar Chart</title>
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
		
			<div class="container">
				<h3 class="text-center">COVID19 Information in Europe - Bar Chart</h3>
			
					<center><div id="chart_div"></div></center>
					
					</div>
				
		</section>
	</body>
</html>

