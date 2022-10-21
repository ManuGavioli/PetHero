<?php
    namespace Controllers;

    use DAO\KeeperDAO as KeeperDAO;
    use Models\Keeper as Keeper;

    class KeeperController{
        private $KeeperDAO;

        public function __construct(){
            $this->KeeperDAO = new KeeperDAO;
        }

        public function RegisterNewKeeper(){
            require_once(VIEWS_PATH."keeper-register.php");
        }
        
        public function EditKeeperContent(){
            require_once(VIEWS_PATH."keeper-content.php");
        }
        
        public function MyProfile(){
            require_once(VIEWS_PATH."user-profile.php");
        }

        public function AddKeeper($first_name, $last_name, $dni, $email, $passw, $phone_number){

            $this->KeeperDAO->GetAll(); 

            if($this->KeeperDAO->SearchEmail($email) == null){

                $Keeper = new Keeper;
                $Keeper->setFirstName($first_name);
                $Keeper->setLastName($last_name);
                $Keeper->setDni($dni);
                $Keeper->setEmail($email);
                $Keeper->setPassword($passw);
                $Keeper->setPhoneNumber($phone_number);

                $this->KeeperDAO->Add_Keeper($Keeper);
                echo "<script> confirm('Cuenta creada con exito!');</script>";
                require_once(VIEWS_PATH."login.php");
            }else{

                echo "<script> confirm('Ya hay un usuario en el sistema utilizando el email ingresado... vuelva a intentar con uno nuevo');</script>";
                require_once(VIEWS_PATH."keeper-register.php");

            } 
        }

        public function AddContent($first_date, $end_date, $price, $pet_type){
            if($first_date > $end_date){
                echo "<script> confirm('La fecha de inicio debe ser anterior a la fecha final... Vuelva a intentar');</script>";
                require_once(VIEWS_PATH."keeper-content.php");
            }else{
                $first_date = strtotime($first_date);
                $end_date = strtotime($end_date);

                $day = 86400; //24 horas * 60 minutos x hora * 60 segundos x minuto (24*60*60)=86400 
                $dates = array();
                for($i = $first_date; $i <= $end_date; $i += $day){
                    $dateToAdd = date("d-m-Y", $i);
                    array_push($dates,$dateToAdd);
                }
                $_SESSION['loggedUser']->setAvailableDates($dates);
                $this->KeeperDAO->EditDates($_SESSION['loggedUser'],$dates);
            }
            if($price <= 0){
                echo "<script> confirm('Ingreso un valor invalido como precio por estadia... Vuelva a intentar');</script>";
                require_once(VIEWS_PATH."keeper-content.php");
            }else{
                $_SESSION['loggedUser']->setPrice($price);
                $this->KeeperDAO->EditPrice($_SESSION['loggedUser'],$price);
            }
            $_SESSION['loggedUser']->setPetType($pet_type);
            $this->KeeperDAO->EditPetType($_SESSION['loggedUser'],$pet_type);
            echo "<script> confirm('Información guardada en su cuenta con éxito!');</script>";
            require_once(VIEWS_PATH."home.php");
        }

        public function Edit($user_id){
            require_once(VIEWS_PATH."keeper-edit.php");
        }

        public function EditAux($first_name, $last_name, $dni, $email, $passw, $phone_number){
            $_SESSION['loggedUser']->setFirstName($first_name);
            $_SESSION['loggedUser']->setLastName($last_name);
            $_SESSION['loggedUser']->setDni($dni);
            $_SESSION['loggedUser']->setEmail($email);
            $_SESSION['loggedUser']->setPassword($passw);
            $_SESSION['loggedUser']->setPhoneNumber($phone_number);
            $this->KeeperDAO->EditUser($_SESSION['loggedUser']);
            echo "<script> confirm('Información actualizada con éxito!');</script>";
            require_once(VIEWS_PATH."user-profile.php");
        }

    }
?>     