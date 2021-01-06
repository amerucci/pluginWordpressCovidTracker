<?php

require_once 'Database.php';

class Data extends Database
{

    public function deleteData(){
       
        $supprimer = $this->connect()->prepare('DELETE From coviddatas');
        $supprimer->execute();
        $this->connect()->query('ALTER TABLE coviddatas AUTO_INCREMENT = 1');
    }


    public function addData($code, $nom, $date, $hospitalises, $reanimation, $nouvelleshospitalisation, $nouvellesreanimations, $deces, $gueris){
     

        $ajouter = $this->connect()->prepare('INSERT INTO coviddatas (code, nom, date, hospitalises, reanimation, nouvellesHospitalisations, nouvellesReanimations, deces, gueris) VALUES (:code, :nom, :date, :hospitalises, :reanimation, :nouvelleshospitalisation, :nouvellesreanimations, :deces, :gueris)');
        $ajouter->bindParam (':code', $code); 
        $ajouter->bindParam (':nom', $nom);
        $ajouter->bindParam (':date', $date);
        $ajouter->bindParam (':hospitalises', $hospitalises);
        $ajouter->bindParam (':reanimation', $reanimation);
        $ajouter->bindParam (':nouvelleshospitalisation', $nouvelleshospitalisation);
        $ajouter->bindParam (':nouvellesreanimations', $nouvellesreanimations);
        $ajouter->bindParam (':deces', $deces);
        $ajouter->bindParam (':gueris', $gueris);
        $ajouter->execute(); 
        
            
    }

    public function allData(){
        $interventions = $this->connect()->prepare('SELECT * FROM coviddatas WHERE code LIKE "DEP-%"');
        $interventions->execute();
        $int = $interventions->fetchAll(); //On lui demande de nous retourner dans la variable $int le résultat de notre requête sous forme de tableau.
        return $int;
        //var_dump($int);
    }


    public function departmentList(){
        $departement = $this->connect()->prepare('SELECT code, nom FROM coviddatas WHERE code LIKE "DEP-%"');
        $departement->execute();
        $dept = $departement->fetchAll(); //On lui demande de nous retourner dans la variable $int le résultat de notre requête sous forme de tableau.
        return $dept;
        var_dump($dept);
    }

    public function search(){
        $req = array();
        $value = array();

        if(!empty($_GET['departement'])){
            array_push($req, 'AND code LIKE "%"?"%"');
            array_push($value, $_GET['departement']);
        }

        if(!empty($_GET['search'])){
            array_push($req, 'AND nom LIKE "%"?"%"');
            array_push($value, $_GET['search']);
        }

        $request = implode(" ", $req);
        $search = $this->connect()->prepare('SELECT * FROM coviddatas WHERE 1=1 '.$request.'');
        $search->execute($value);
        //$search->debugDumpParams();
        $resultSearch = $search->fetchAll();
        return $resultSearch;
    
    }


}



