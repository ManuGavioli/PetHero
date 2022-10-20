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

        
        

        public function AddKeeper($first_name, $last_name, $dni, $email, $passw, $phone_number, $pet_type){

            $this->KeeperDAO->GetAll(); 

            if($this->KeeperDAO->SearchEmail($email) == null){

                $Keeper = new Keeper;
                $Keeper->setFirstName($first_name);
                $Keeper->setLastName($last_name);
                $Keeper->setDni($dni);
                $Keeper->setEmail($email);
                $Keeper->setPassword($passw);
                $Keeper->setPhoneNumber($phone_number);
                $Keeper->setPetType($pet_type);

                $this->KeeperDAO->Add_Keeper($Keeper);

            }else{

                echo "<script> confirm('Ya hay un usuario en el sistema utilizando el email ingresado... vuelva a intentar con uno nuevo');</script>";
                require_once(VIEWS_PATH."keeper-register.php");
                
            } 
        }
    }
?>     