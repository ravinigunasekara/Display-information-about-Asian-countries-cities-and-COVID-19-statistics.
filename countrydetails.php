<!DOCTYPE html>

<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" 
             integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <meta charset="UTF-8">
        <title>Country Details</title>
    </head>
    <body>
       <?php $cco=$_POST['country_code'];
        $path=json_decode(file_get_contents("https://restcountries.com/v3.1/region/Asia"),true);
        foreach ($path as $v){
            if($v['cca2']==$cco){
                $fc=$v['name']['common'];
                $cf=$v['flags']['png'];
                $cc=$v['name']['official'];
                $sca=$v['capital'][0];
                $ccur=$v['currencies'][key($v['currencies'])]['name'];
                $csub=$v['subregion'];
                $ccont=$v['continents'][0];
                $clang=$v['languages'];
                $cbord = isset($v['borders']) ? $v['borders'] : [];
                $cpop=$v['population'];
                $car=$v['area'];
            }
        }
               ?>
        <h2 class="text-center"><?php echo $fc; ?></h2>
        <table class="table table-striped">
            <p class="text-center"><img src="<?php echo $cf;?>"/></p>
            
                <th><?php echo "Official Name";?></th>
                <td><?php echo $cc; ?></td>
            </tr>
            
            <tr>
                <th><?php echo "Capital";?></th>
                <td><?php echo $cco; ?></td>
            </tr>
            
            <tr>
                <th><?php echo "Currency"; ?></th>
                <td><?php echo $ccur;?></td>
            </tr>
            
            <tr>
                <th><?php echo "Subregion"; ?></th>
                <td><?php echo $csub; ?></td>
            </tr>
            
            <tr>
                <th><?php echo "Continent";?></th>
                <td><?php echo $ccont;?></td>
            </tr>
            
            <tr>
                <th><?php echo"Languages"; ?></th>
                <td><?php foreach($clang as $lan){echo $lan.", ";} ?></td>
            </tr>
            
            <tr>
                <th><?php echo"Borders"; ?></th>
                <td>
        <?php
        if (isset($cbord) && is_array($cbord)) {
            foreach ($cbord as $border) {
                echo $border . ", ";
            }
        } else {
            echo "No bordering countries.";
        }
        ?>
    </td>
            </tr>
            
            <tr>
                <th><?php echo"Population"; ?></th>
                <td><?php echo $cpop; ?></td>
            </tr>
            
            <tr>
                <th><?php echo"Area"; ?></th>
                <td><?php echo $car; ?></td>
            </tr>
        </table>
    </body>
</html>
