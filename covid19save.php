<?php
// MySQL database credentials
$servername = "localhost";
$username = "root";
$password = "";
$database = "covid_2023";

// Create a new MySQLi object
$conn = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// API request and data retrieval
$apiKey = "baac386d8emshbc3402785045616p1901cfjsnee1aa50f23ef";
$endpoint = 'https://covid-193.p.rapidapi.com/statistics';

$curl = curl_init($endpoint);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, [
    "X-RapidAPI-Key: $apiKey"
]);

$response = curl_exec($curl);
curl_close($curl);

// Parse the API response
$data = json_decode($response, true);

if ($data && isset($data['response'])) {
    $statistics = $data['response'];

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO covid_cases (countryName, population, totalcases, deaths, tests, continent, date) VALUES (?, ?, ?, ?, ?, ?, ?)");

    
    
    foreach ($statistics as $stat) {
        // Extract the required data fields
        $countryName = $stat['country'];
        $population = $stat['population'] ?? 0;
        $totalCases = $stat['cases']['total'] ?? 0;
        $deaths = $stat['deaths']['total'] ?? 0;
        $tests = $stat['tests']['total'] ?? 0;
        $continent = $stat['continent'] ?? '';
        $date = date("Y-m-d");

        // Bind the values to the prepared statement
        $stmt->bind_param("sisssss", $countryName, $population, $totalCases, $deaths, $tests, $continent, $date);

    
        // Execute the statement
            if ($stmt->execute() !== true) {
                    echo "Error: " . $stmt->error;
                } 
            }
              
            echo "COVID-19 global information saved successfully..!";
            
            } else {
            echo "Error retrieving data from the API.";
            }

    // Close the statement
    $stmt->close();

    // Close the database connection
    $conn->close();
    
?>
