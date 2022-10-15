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
            
        }

    }
?>     