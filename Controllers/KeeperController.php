<?php
    namespace Controllers;

    //use DAO\KeeperDAO as KeeperDAO;

    use Helper\Validation as Validation;
    use DAO\AvailabilityDAODB as AvailabilityDAODB;
    use DAO\BookingDAODB as BookingDAODB;
    use DAO\CouponDAODB as CouponDAODB;
    use DAO\KeeperDAODB as KeeperDAODB;
    use DAO\BankDAODB as BankDAODB;
    use DAO\OwnerDAODB as OwnerDAODB;
    use Models\Keeper as Keeper;
    use Models\Owner as Owner;
    use Models\Booking as Booking;
    use Models\Bank as Bank;
    use \Exception as Exception;
    use Controllers\MailController as MailController;


    class KeeperController{
        private $KeeperDAO;
        private $AvailablilityDAO;
        private $BookingDAO;
        private $CouponDAO;
        private $BankDAO;
        private $MailController;
        private $OwnerDAO;
        

        public function __construct(){
            //$this->KeeperDAO = new KeeperDAO;
            $this->KeeperDAO = new KeeperDAODB;
            $this->AvailablilityDAO = new AvailabilityDAODB;
            $this->BookingDAO = new BookingDAODB;
            $this->CouponDAO = new CouponDAODB;
            $this->BankDAO = new BankDAODB;
            $this->MailController = new MailController;
            $this->OwnerDAO = new OwnerDAODB;

        }
        
        
        public function AddKeeper($first_name, $last_name, $dni, $email, $passw, $phone_number, $cbu, $alias){
            
            try{
            $this->KeeperDAO->GetAll(); 

            if($this->KeeperDAO->SearchEmail($email) == null && $this->OwnerDAO->SearchEmail($email) == null){

                $Keeper = new Keeper;
                $Keeper->setFirstName($first_name);
                $Keeper->setLastName($last_name);
                $Keeper->setDni($dni);
                $Keeper->setEmail($email);
                $Keeper->setPassword($passw);
                $Keeper->setPhoneNumber($phone_number);

                $Bank = new Bank;
                $Bank->setCbu($cbu);
                $Bank->setAlias($alias);
                $Bank->setTotal(0);
                $this->BankDAO->Add($Bank);
                
                $KeeperBank = $this->BankDAO->GetforCbu($cbu);

                $Keeper->setBankKeeper($KeeperBank);

                $this->KeeperDAO->Add_Keeper($Keeper);

                echo "<script> confirm('Cuenta creada con exito!');</script>";
                require_once(VIEWS_PATH."login.php");
            }else{

                echo "<script> confirm('Ya hay un usuario en el sistema utilizando el email ingresado... vuelva a intentar con uno nuevo');</script>";
                require_once(VIEWS_PATH."keeper-register.php");

            } 
        }catch(Exception $ex)
        {
            $message='Motivo: Alguno de los datos pueden estar siendo usados por otro User ya registrado (DNI, EMAIL, DATOS BANCARIOS)';
            require_once(VIEWS_PATH."error-page.php");
        }
        }
        
        public function Edit($user_id){
            Validation::ValidUser();
            require_once(VIEWS_PATH."keeper-edit.php");
        }

        public function EditAux($first_name, $last_name, $dni, $email, $passw, $phone_number){
            Validation::ValidUser();

            try{
            $_SESSION['loggedUser']->setFirstName($first_name);
            $_SESSION['loggedUser']->setLastName($last_name);
            $_SESSION['loggedUser']->setDni($dni);
            $_SESSION['loggedUser']->setEmail($email);
            $_SESSION['loggedUser']->setPassword($passw);
            $_SESSION['loggedUser']->setPhoneNumber($phone_number);
            $this->KeeperDAO->EditUser($_SESSION['loggedUser']);

            echo "<script> confirm('Información actualizada con éxito!');</script>";

            $availableDatesFromKeeper=$this->AvailablilityDAO->GetAllforKeeper($_SESSION['loggedUser']->getUserId());
            $bankInfo = $this->BankDAO->GetOneForId($_SESSION['loggedUser']->getBankKeeper());
            require_once(VIEWS_PATH."user-profile.php");
        }catch(Exception $ex)
        {
            require_once(VIEWS_PATH."error-page.php");
        }
        }
        
        public function RegisterNewKeeper(){
            require_once(VIEWS_PATH."keeper-register.php");
        }
        
        public function EditKeeperContent(){
            Validation::ValidUser();

            try{
            $dates_list = $this->AvailablilityDAO->IfExistReturnDates($_SESSION['loggedUser']->getUserId());
            $booking_list = $this->BookingDAO->GetAllforKeeper($_SESSION['loggedUser']->getUserId());
            if($booking_list == null){
                $minDate = date("Y-m-d");
                require_once(VIEWS_PATH."keeper-content.php");
            }else{
                if($this->isNotAvailable($dates_list) == 1){
                    echo "<script> confirm('ATENCION! = las fechas libres que no fueron reservadas se pisaran!');</script>";
                }
                $minDate = $this->MaxDate($booking_list);
                $minDate=date("Y-m-d",strtotime($minDate."+ 1 days"));
                require_once(VIEWS_PATH."keeper-content.php");
            }
        }catch(Exception $ex)
        {
            require_once(VIEWS_PATH."error-page.php");
        }
        }

        public function MyProfile(){
            Validation::ValidUser();
            try{
            $_SESSION['loggedUser'] = $this->KeeperDAO->getKeeper($_SESSION['loggedUser']->getUserId());
            $availableDatesFromKeeper=$this->AvailablilityDAO->GetAllforKeeper($_SESSION['loggedUser']->getUserId());
            $bankInfo = $this->BankDAO->GetOneForId($_SESSION['loggedUser']->getBankKeeper());
            require_once(VIEWS_PATH."user-profile.php");
        }catch(Exception $ex)
        {
            require_once(VIEWS_PATH."error-page.php");
        }
        }
        
        public function AddContent($first_date, $end_date, $price, $pet_type){
            Validation::ValidUser();
            try{
            if($first_date > $end_date){
                echo "<script> confirm('La fecha de inicio debe ser anterior a la fecha final... Vuelva a intentar');</script>";
                $dates_list=$this->AvailablilityDAO->IfExistReturnDates($_SESSION['loggedUser']->getUserId());
                $minDate = date("Y-m-d");
                require_once(VIEWS_PATH."keeper-content.php");
            }else{

                $this->CountDates($first_date, $end_date);

                $this->ControllAndSetPrice($price);

                $_SESSION['loggedUser']->setPetType($pet_type);
                $this->KeeperDAO->EditPetType($_SESSION['loggedUser']->getUserId(),$pet_type);
                echo "<script> confirm('Información guardada en su cuenta con éxito!');</script>";
            }
            $dates_list = $this->AvailablilityDAO->IfExistReturnDates($_SESSION['loggedUser']->getUserId());
            $minDate = date("Y-m-d");
            require_once(VIEWS_PATH."keeper-content.php");
        }catch(Exception $ex)
        {
            require_once(VIEWS_PATH."error-page.php");
        }
        }
        
        private function CountDates($first_date, $end_date){

            Validation::ValidUser();

            try{
            $first_date = strtotime($first_date);
            $end_date = strtotime($end_date);

            $day = 86400; //24 horas * 60 minutos x hora * 60 segundos x minuto (24*60*60)=86400 
            $dates = array();
            for($i = $first_date; $i <= $end_date; $i += $day){
                $dateToAdd = date("Y-m-d", $i);
                array_push($dates,$dateToAdd);
            }
            if($this->AvailablilityDAO->Exist($_SESSION['loggedUser']->getUserId()) != null){   //si hay datos cargados previamente por el usuario logueado
                $this->AvailablilityDAO->Remove($_SESSION['loggedUser']->getUserId());          //borra todos los datos de la tabla para evitar superponerlos
            }
            foreach($dates as $date){
                $this->AvailablilityDAO->Add_AvailavilityDate($date, $_SESSION['loggedUser']->getUserId());
            }
        }catch(Exception $ex)
        {
            require_once(VIEWS_PATH."error-page.php");
        }
        }

        private function ControllAndSetPrice($price){
            Validation::ValidUser();
            try{
            if($price <= 0){
                echo "<script> confirm('Ingreso un valor invalido como precio por estadia... Vuelva a intentar');</script>";
            }else{
                $_SESSION['loggedUser']->setPrice($price);
                $this->KeeperDAO->EditPrice($_SESSION['loggedUser']->getUserId(),$price);
            }
        }catch(Exception $ex)
        {
            require_once(VIEWS_PATH."error-page.php");
        }
        }

        public function ShowHome(){
            Validation::ValidUser();

            try{
            $booking_list = $this->BookingDAO->BookingsConfirmationPendient($_SESSION['loggedUser']->getUserId());
            $coupon_list = $this->CouponDAO->GetAll();
            $dates_list=$this->AvailablilityDAO->GetAll();
            require_once(VIEWS_PATH.'home.php');
        }catch(Exception $ex)
        {
            require_once(VIEWS_PATH."error-page.php");
        }
        }

        private function MaxDate($booking_list){
            Validation::ValidUser();
            $max = $booking_list[count($booking_list)-1]->getFinalDate();
            foreach($booking_list as $booking){
                if($max < $booking->getFinalDate()){
                    $max = $booking->getFinalDate();
                }
            }
            return $max;
        }

        private function isNotAvailable($dates_list){  // retorna 1 si en la lista de availableDates hay fechas en true y 0 si estan todas ocupadas
            Validation::ValidUser();
            
            $validation=0;
            foreach ($dates_list as $date){
                if($date->getAvailable() == 1){
                    $validation = 1;
                }
            }
            return $validation;
        }

        public function EditNotification($keeper){
            Validation::ValidUser();
        try{
                if($keeper->getNotification()==1){
                    $this->KeeperDAO->EditNotification($keeper);
                    //mandar mail
                    $this->MailController->sendChatPending($keeper);
                }else if($keeper->getNotification()>1){
                    $this->KeeperDAO->EditNotification($keeper);
                }else{
                    $this->KeeperDAO->EditNotification($keeper);
                }
        }catch(Exception $ex)
        {
            require_once(VIEWS_PATH."error-page.php");
        }
        }
    }
?>     