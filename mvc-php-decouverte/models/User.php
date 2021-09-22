<?php

session_start();

class User extends Model
{
    public function __construct()
    {
        $this->table = "Users";

        $this->getConnection();
    }

    public function supprimerById($id)
    {
        $sql = "DELETE FROM `Programme` WHERE `Users` =  $id";
        $query = $this->_connexion->prepare($sql);
        $query->execute();

        $sql = "DELETE FROM `Poids` WHERE `id_user` =  $id";
        $query = $this->_connexion->prepare($sql);
        $query->execute();

        $sql = "DELETE FROM `IMC` WHERE `id_user` = $id";
        $query = $this->_connexion->prepare($sql);
        $query->execute();

        $sql = "DELETE FROM `Users` WHERE `ID` = $id";
        $query = $this->_connexion->prepare($sql);
        $query->execute(); 

        header("Location: /users/admin");
    }

    public function modifierByID($id)
    {
        if (!empty($_POST['NomUser']))
        {
            $nom = $this->validate($_POST['NomUser']);
            $prenom = $this->validate($_POST['PrenomUser']);
            $tel = $this->validate($_POST['TelUser']);
            $poid = $this->validate($_POST['PoidUser']);
            $poidobj = $this->validate($_POST['objectifPoidUser']);
            $age = $this->validate($_POST['AgeUser']);
            $taille = $this->validate($_POST['TaileUser']);
            $email = $this->validate($_POST['EmailUser']);

            $imc = $this->IMC($poid,$taille);
            $sql = "UPDATE `Users` SET `ID`='$id',`Nom`='$nom',`Prénom`='$prenom',`Age`='$age',`Tel`='$tel',`Taille`='$taille',`poids`='$poid',`PoidsObjectif`='$poidobj',`Email`='$email',`IMC`='$imc' WHERE `ID` = '$id'";
            $query = $this->_connexion->prepare($sql);
            $query->execute();
            header("Location: /users/admin");
        }
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM `Users` WHERE `ID` = $id";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function setUser()
    {
        $nom = $this->validate($_POST['NomUser']);
        $prenom = $this->validate($_POST['PrenomUser']);
        $img = $this->validate($_POST['IMG']);
        $tel = $this->validate($_POST['TelUser']);
        $poid = $this->validate($_POST['PoidUser']);
        $poidobj = $this->validate($_POST['objectifPoidUser']);
        $age = $this->validate($_POST['AgeUser']);
        $taille = $this->validate($_POST['TaileUser']);
        $mois = $this->validate($_POST['MoisInscri']);
        $email = $this->validate($_POST['EmailUser']);
        $psw = $this->validate($_POST['PswUser']);

        $imc = $this->imc($poid,$taille);

        $sql = "INSERT INTO `Users`(`Nom`, `Prénom`, `IMG`, `Age`, `Tel`, `Taille`, `mois`,`poids`, `imc`, `PoidsObjectif`, `Email`, `MotDePasse`) VALUES 
        ('$nom','$prenom','$img','$age','$tel','$taille','$mois','$poid','$imc', '$poidobj','$email','$psw')";
        $query = $this->_connexion->prepare($sql);
        $query->execute();

        header("Location: /users");
    }

    public function connexionUser()
    {
        $emailCo = $_POST['CoEmailUser'];
        $pswCo = $_POST['CoPswUser'];

        $sql = "SELECT `ID`, `Nom`, `Prénom`,`IMG`, `Age`, `Tel`, `Taille`, `mois`, `poids`, `imc`,`PoidsObjectif`, `Email`, `MotDePasse` FROM `Users` WHERE `Email` = '$emailCo' AND `MotDePasse` = '$pswCo'";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        
        return  $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getIMC($id)
    {
        $sql = "SELECT `ID`, `IMC`, `id_user`, `id_mois` FROM `IMC` WHERE `id_user` = $id ";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPoids($id)
    {
        $sql = "SELECT `id_poid`, `Poids`, `id_user`, `id_mois` FROM `Poids` WHERE `id_user` = $id";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function setProgramme()
    {
        $id = $this->validate($_POST['idUser']);
        $activiter = $this->validate($_POST['ActivitéSelect']);
        $temps = $this->validate($_POST['TempsActi']);
        $jours = $this->validate($_POST['joursActi']);
        $heure = $this->validate($_POST['heureActi']);

        $sql = "INSERT INTO `Programme`(`Activité`, `Temps`, `Jour`, `heure`, `Users`) VALUES ('$activiter','$temps','$jours','$heure', $id)";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
    }

    public function getProgramme($id)
    {
        $sql = "SELECT * FROM `Programme` WHERE `Users` = $id ORDER BY `ID_pog` DESC";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function setPoidsAndIMC($id, $poids, $taille, $mois)
    {

        $imc = $this->imc($poids,$taille);

        $sql2 = "INSERT INTO `IMC`(`IMC`, `id_user`, `id_mois`) VALUES ('$imc','$id','$mois')";
        $sql = "INSERT INTO `Poids`(`Poids`, `id_user`, `id_mois`) VALUES ('$poids','$id','$mois')";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        $query2 = $this->_connexion->prepare($sql2);
        $query2->execute();
    }

    public function updatePoidsAndIMC()
    {
        $id = $this->validate($_POST['idUser']);
        $poids = $this->validate($_POST['PoidUser']);
        $mois = $this->validate($_POST['mois']);
        $taille = $this->validate($_POST['TaileUser']);

        $imc = $this->IMC($poids,$taille);

        $sql2 = "INSERT INTO `IMC`(`IMC`, `id_user`, `id_mois`) VALUES ('$imc','$id','$mois')";
        $sql = "INSERT INTO `Poids`(`Poids`, `id_user`, `id_mois`) VALUES ('$poids','$id','$mois')";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        $query2 = $this->_connexion->prepare($sql2);
        $query2->execute();
    }

    public function IMC($p, $t)
    {
        $t = $t / 100;
        $t = $t * $t;
        $imc = $p / $t;
        return $imc;
    }

    public function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
?>