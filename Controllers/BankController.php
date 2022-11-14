<?php
    namespace Controllers;

    use DAO\AvailabilityDAODB as AvailabilityDAODB;
    use DAO\BankDAODB as BankDAODB;

    class BankController
    {
        private $BankDAO;
        private $AvailablilityDAO;

        public function __construct(){
            $this->BankDAO = new BankDAODB;
            $this->AvailablilityDAO = new AvailabilityDAODB;
        }

        public function EditBank($cbu, $alias,$idBank){
            $this->BankDAO->EditBank($cbu,$alias,$idBank);
            echo "<script> confirm('Información guardada en su cuenta con éxito!');</script>";
            $availableDatesFromKeeper=$this->AvailablilityDAO->GetAllforKeeper($_SESSION['loggedUser']->getUserId());
            $bankInfo = $this->BankDAO->GetOneForId($_SESSION['loggedUser']->getBankKeeper());
            require_once(VIEWS_PATH."user-profile.php");
        }   
    }
?>