<?php
    namespace Controllers;

    //use DAO\KeeperDAO as KeeperDAO;

    use Helper\Validation as Validation;
    use DAO\AvailabilityDAODB as AvailabilityDAODB;
    use DAO\BookingDAODB as BookingDAODB;
    use DAO\CouponDAODB as CouponDAODB;
    use DAO\KeeperDAODB as KeeperDAODB;
    use Models\Keeper as Keeper;
    use Models\Booking as Booking;


    class KeeperController{
        private $KeeperDAO;
        private $AvailablilityDAO;
        private $BookingDAO;
        private $CouponDAO;
        

        public function __construct(){
            //$this->KeeperDAO = new KeeperDAO;
            $this->KeeperDAO = new KeeperDAODB;
            $this->AvailablilityDAO = new AvailabilityDAODB;
            $this->BookingDAO = new BookingDAODB;
            $this->CouponDAO = new CouponDAODB;
        }

        public function RegisterNewKeeper(){
            require_once(VIEWS_PATH."keeper-register.php");
        }
        
        public function EditKeeperContent(){
            Validation::ValidUser();
            
            $this->isNotAvailable($_SESSION['loggedUser']->getUserId());
            if($this->isNotAvailable($_SESSION['loggedUser']->getUserId())){    
                echo "<script> confirm('Si ya dispone de una reserva no puede editar los atributos de cuidador!');</script>";
                $booking_list = $this->BookingDAO->GetAll();
                $this->ShowHome();
            }else{
                $dates_list=$this->AvailablilityDAO->IfExistReturnDates($_SESSION['loggedUser']->getUserId());
                require_once(VIEWS_PATH."keeper-content.php");
            }
        }
        
        public function MyProfile(){
            Validation::ValidUser();
            $_SESSION['loggedUser'] = $this->KeeperDAO->getKeeper($_SESSION['loggedUser']->getUserId());
            $availableDatesFromKeeper=$this->AvailablilityDAO->GetAllforKeeper($_SESSION['loggedUser']->getUserId());
            require_once(VIEWS_PATH."user-profile.php");
        }

        public function MyBookings(){
            Validation::ValidUser();
            $booking_list = $this->BookingDAO->GetOneBooking($_SESSION['loggedUser']->getUserId());
            $coupon_list = $this->CouponDAO->GetAll();
            require_once(VIEWS_PATH."keeper-bookings.php");
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
            Validation::ValidUser();
            if($first_date > $end_date){
                echo "<script> confirm('La fecha de inicio debe ser anterior a la fecha final... Vuelva a intentar');</script>";
                $dates_list=$this->AvailablilityDAO->IfExistReturnDates($_SESSION['loggedUser']->getUserId());
                require_once(VIEWS_PATH."keeper-content.php");
            }else{
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
                if($price <= 0){
                    echo "<script> confirm('Ingreso un valor invalido como precio por estadia... Vuelva a intentar');</script>";
                }else{
                    $_SESSION['loggedUser']->setPrice($price);
                    $this->KeeperDAO->EditPrice($_SESSION['loggedUser']->getUserId(),$price);
                }
                $_SESSION['loggedUser']->setPetType($pet_type);
                $this->KeeperDAO->EditPetType($_SESSION['loggedUser']->getUserId(),$pet_type);
                echo "<script> confirm('Información guardada en su cuenta con éxito!');</script>";
            }
            $dates_list=$this->AvailablilityDAO->IfExistReturnDates($_SESSION['loggedUser']->getUserId());
            require_once(VIEWS_PATH."keeper-content.php");
        }

        public function Edit($user_id){  // hay que cambiar esta redireccion por un header en el "user-profile"
            Validation::ValidUser();
            require_once(VIEWS_PATH."keeper-edit.php");
        }

        public function EditAux($first_name, $last_name, $dni, $email, $passw, $phone_number){
            Validation::ValidUser();
            $_SESSION['loggedUser']->setFirstName($first_name);
            $_SESSION['loggedUser']->setLastName($last_name);
            $_SESSION['loggedUser']->setDni($dni);
            $_SESSION['loggedUser']->setEmail($email);
            $_SESSION['loggedUser']->setPassword($passw);
            $_SESSION['loggedUser']->setPhoneNumber($phone_number);
            $this->KeeperDAO->EditUser($_SESSION['loggedUser']);

            echo "<script> confirm('Información actualizada con éxito!');</script>";

            $availableDatesFromKeeper=$this->AvailablilityDAO->GetAllforKeeper($_SESSION['loggedUser']->getUserId());

            require_once(VIEWS_PATH."user-profile.php");
        }

        public function Action($action){
            $actionSepared = explode(",",$action);
            $Booking = new Booking;
            $Booking = $this->BookingDAO->GetOnlyOneBooking($action[0]);
            
            if($actionSepared[1] == "Approve"){
                $this->AvailablilityDAO->CancelAvailability($Booking);
                $this->BookingDAO->ApproveBooking($Booking);

                $date1 = date_create($Booking->getStartDate());
                $date2 = date_create($Booking->getFinalDate());
                $diff = $date1->diff($date2);

                $precioTotal = $_SESSION['loggedUser']->getPrice() * ($diff->days+1);
                $this->CouponDAO->Add_Coupon($precioTotal,$Booking->getIdBooking());
                $this->ShowHome();
            }else{
                $this->BookingDAO->RejectBooking($Booking);
                $this->ShowHome();
            }
        }

        public function ShowHome(){
            Validation::ValidUser();

            $booking_list = $this->BookingDAO->BookingsConfirmationPendient($_SESSION['loggedUser']->getUserId());
            $coupon_list = $this->CouponDAO->GetAll();
            $dates_list=$this->AvailablilityDAO->GetAll();
            require_once(VIEWS_PATH.'home.php');
        }

        private function isNotAvailable($keeperID){   // retorna 1 si en la lista de availableDates hay fechas en true y 0 si estan todas ocupadas
            $dates = $this->AvailablilityDAO->IfExistReturnDates($keeperID);
            $validation=0;
            foreach ($dates as $date){
                if($date->getAvailable() == 1){
                    $validation = 1;
                }
            }
            return $validation;
        }
        


    }
?>     