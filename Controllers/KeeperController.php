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

        
        

        public function AddKeeper($first_name, $last_name, $dni, $email, $passw, $pet_type){
            $Keeper = new Keeper;
            $Keeper->setFirstName($first_name);
            $Keeper->setLastName($last_name);
            $Keeper->setDni($dni);
            $Keeper->setEmail($email);
            $Keeper->setPassword($passw);
            $Keeper->setPetType($pet_type);

            $this->KeeperDAO->Add_Keeper($Keeper);

    }
?>     