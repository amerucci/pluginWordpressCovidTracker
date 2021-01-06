<?php get_header(); ?>

<?php require_once('wp-content/plugins/acs-covid-info/includes/class/Data.php');




$data = new Data();
if(isset($_GET['departement']) || isset($_GET['search'])){
    $datas = $data->search(); 
    //var_dump($datas); 
}
else{
    $datas = $data->allData();
    //var_dump($datas);
}



//var_dump($datas);
?>



<div class="container">

    <div class="sticky">

        <!-- Formulaire de recherche -->

        <form class="form-inline">
            <div class="form-row align-items-center">
                <div class="col-auto my-1">
                    <input type="hidden" name="invoice_id">
                    <input type="text" name='search' class="form-control" placeholder="Rechercher">
                    <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="departement">
                        <option selected value="">Département...</option>
                        <?php
                        $departementList = new Data();
                        $dept = $departementList->departmentList();
                        var_dump($dept);
                        for ($i = 0; $i < count($dept); $i++) {
                            echo '
            <option value="' . $dept[$i]['code'] . '">' . $dept[$i]['nom'] . '</option>';
                        }

                        ?>
                 </select>
                 <input type="number" name="reanimation" class="form-control" placeholder="Personne en réanimation">
                </div>
                <div class="col-auto my-1">
                    <div class="custom-control custom-checkbox mr-sm-2">
                        <input type="checkbox" class="custom-control-input" id="customControlAutosizing">
                        <label class="custom-control-label" for="customControlAutosizing">Remember my preference</label>
                    </div>
                </div>
                <div class="col-auto my-1">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>



        <table>
            <thead class="thead-dark ">
                <tr>
                    <th scope="col">Département</th>
                    <th scope="col">Personnes hospitalisés</th>
                    <th scope="col">Personnes en réanimation</th>
                    <th scope="col">Nouvelles hospitalisations</th>
                    <th scope="col">Nouvelles réanimations</th>
                    <th scope="col">Personnes guéries</th>
                    <th scope="col">Personnes décédés</th>
                </tr>
            </thead>
        </table>
    </div>


    <table>

        <tbody>

            <?php
            for ($i = 0; $i < count($datas); $i++) {
                echo '<tr>
                    <td>' . $datas[$i]['nom'] . '</td>
                    <td>' . $datas[$i]['hospitalises'] . '</td>
                    <td>' . $datas[$i]['reanimation'] . '</td>
                    <td>' . $datas[$i]['nouvellesHospitalisations'] . '</td>
                    <td>' . $datas[$i]['nouvellesReanimations'] . '</td>
                    <td>' . $datas[$i]['deces'] . '</td>
                    <td>' . $datas[$i]['gueris'] . '</td>
                 </tr>';
            }

            ?>
</div>


<?php get_footer(); ?>