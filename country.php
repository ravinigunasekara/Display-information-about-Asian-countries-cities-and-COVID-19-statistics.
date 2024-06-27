<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" 
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" 
        crossorigin="anonymous">
    <meta charset="UTF-8">
    <title>Country</title>
</head>
<body>
    <?php
        $data = json_decode(file_get_contents("https://restcountries.com/v3.1/region/Asia"), true);
    ?>
    <h2 class="text-center">Asian Countries</h2>
    <table class="table table-striped">
        <tr>
            <th class="text text-primary">Flag</th>
            <th class="text text-primary">Country Name</th>
            <th class="text text-primary">Capital City</th>
            <th class="text text-primary">Region</th>
            <th class="text text-primary">Subregion</th>
            <th class="text text-primary">Currencies</th>
            <th class="text text-primary">Country Code</th>
            <th></th>
        </tr>
        <?php
        foreach ($data as $v) {
            ?>
            <tr>
                <td><img src="<?php echo $v['flags']['png']; ?>" height="30px" width="40px"/></td>
                <td><?php echo $v['name']['common']; ?></td>
                <td><?php echo $v['capital'][0]?? 'No capital'; ?></td>
                <td><?php echo $v['region']; ?></td>
                <td><?php echo $v['subregion']; ?></td>
                <td><?php echo $v['currencies'][key($v['currencies'])]['name']."(".$v['currencies'][key($v['currencies'])]['symbol'].")"; ?></td>
                <td><?php echo $v['cca2']; ?></td>
                <td>
                    <form method="POST" action="countrydetails.php">
                        <input type="hidden" name="country_code" value="<?php echo $v['cca2']; ?>">
                        <button type="submit" class="btn btn-success" name="details">View</button>
                    </form>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
</body>
</html>
