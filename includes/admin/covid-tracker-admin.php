<?php 
require_once('../wp-content/plugins/acs-covid-info/includes/class/Data.php'); ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
    integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<div class="wrap">
    <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
    <hr />

    <h3>Choissiez un département</h3>
    <form method="GET" action='?'>
        <div class="form-row align-items-center">
            <div class="col-auto my-1">
                <label class="mr-sm-2 sr-only" for="inlineFormCustomSelect">Preference</label>
                <input type="hidden" name="page" value="covid_tracker_admin">
            </div>

            <div class="col-auto my-1">
                <button type="submit" class="btn btn-primary" name="importer" value="importer">Choisir</button>
            </div>
        </div>
    </form>

</div>

<?php

if(isset($_GET['importer'])){

//Traitement des données

$curl = curl_init("https://coronavirusapi-france.now.sh/AllLiveData");

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$coviddata = curl_exec($curl);


if($coviddata === false){
    var_dump(curl_error($curl));
}
else{
    $coviddata = json_decode($coviddata, true);
    //var_dump($coviddata);
    $data = $coviddata["allLiveFranceData"];
    //var_dump($data);
    $import = new Data();
    $delete = new Data();
    $delete->deleteData();
    
    for ($i=0; $i < count($data) ; $i++) {   
        $import->addData($data[$i]['code'], $data[$i]['nom'], $data[$i]['date'], $data[$i]['hospitalises'], $data[$i]['reanimation'], $data[$i]['nouvellesHospitalisations'], $data[$i]['nouvellesReanimations'], $data[$i]['deces'], $data[$i]['gueris']);
    }
}
curl_close($curl);
}







?>