<?php get_header(); ?>

<?php require_once('wp-content/plugins/acs-covid-info/includes/class/Data.php');




$data = new Data();
if(isset($_GET['departement']) || isset($_GET['search']) || isset($_GET['region'])){
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
                    <input type="text" name='search' class="form-control mb-3" placeholder="Rechercher">
                    <select class="custom-select mr-sm-2 mb-3" id="inlineFormCustomSelect" name="departement">
                        <option selected value="">Département...</option>
                        <?php
                        $departementList = new Data();
                        $dept = $departementList->departmentList();
                        //var_dump($dept);
                        for ($i = 0; $i < count($dept); $i++) {
                            echo '
            <option value="' . $dept[$i]['code'] . '">' . $dept[$i]['nom'] . '</option>';
                        }

                        ?>
                 </select>
                 <select class="custom-select mr-sm-2 mb-3" id="inlineFormCustomSelect" name="region">
                        <option selected value="">Région...</option>
                        <?php
                        $regionList = new Data();
                        $regionList = $departementList->regionList();
                        //var_dump($dept);
                        for ($i = 0; $i < count($regionList); $i++) {
                            echo '
            <option value="' . $regionList[$i]['code'] . '">' . $regionList[$i]['nom'] . '</option>';
                        }

                        ?>
                 </select>

                 <a class="btn btn-primary mb-3" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
    Plus d'options
  </a>

  <div class="collapse" id="collapseExample">

  <input type="number" name="hospitalisation" class="form-control" placeholder="Pers. hospitalisées">
                 <input type="number" name="reanimation" class="form-control" placeholder="Pers. en réanimation">
                 <input type="number" name="newhospitalisation" class="form-control" placeholder="Nouv. hospitalisations">
                 <input type="number" name="newreanimation" class="form-control" placeholder="Nouv. réanimations">
                 <input type="number" name="mort" class="form-control" placeholder="Pers. décédés">
                 <input type="number" name="gueris" class="form-control" placeholder="Pers. guéries">

</div>

                 
                </div>
             
                <div class="col-auto my-1">
                    <button type="submit" class="btn btn-primary mb-3">Rechercher</button>
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
                    <th scope="col">Personnes décédés</th>
                    <th scope="col">Personnes guéries</th>
                </tr>
            </thead>
        </table>
    </div>


    <table>

        <tbody>

            <?php
            for ($i = 0; $i < count($datas); $i++) {
                if(substr( $datas[$i]['code'], 0, 3 ) === "REG"){
                    echo '<tr class="region">';
                }
                else{
                    echo '<tr>';
                }
                
               echo '
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