<?php
    namespace Controllers;

    use Helper\Validation as Validation;
    use DAO\BookingDAODB as BookingDAODB;
    use DAO\CouponDAODB as CouponDAODB;
    use DAO\PetDAODB as PetDAODB;
    use DAO\BankDAODB as BankDAODB;

    class BookingController
    {   
        private $BookingDAO;
        private $CouponDAO;
        private $DataPets;
        private $BankDAO;

        public function __construct(){
            $this->BookingDAO = new BookingDAODB;
            $this->CouponDAO = new CouponDAODB;
            $this->DataPets=new PetDAODB;
            $this->BankDAO = new BankDAODB;
        }

        public function MyBookings(){
            Validation::ValidUser();
            $booking_list = $this->BookingDAO->GetOneBooking($_SESSION['loggedUser']->getUserId());
            $coupon_list = $this->CouponDAO->GetAll();
            require_once(VIEWS_PATH."keeper-bookings.php");
        }

        public function ShowListReservas(){
            Validation::ValidUser();
            //PASAR lista de pets
            $petsofowner=$this->DataPets->GetAllforOwner($_SESSION['loggedUser']->getUserId());
            $Booking_list=$this->BookingDAO->GetAllforOwner($petsofowner);
            //aca va un get for bookings, pero estaba cansado si me acuerdo lo hago 
            $coupons_list=$this->CouponDAO->GetAll();
            require_once(VIEWS_PATH."owner-reservations.php");
        }

        public function PayBooking($voucher, $idbooking){
            //ultimo requisito de la logica

            //busco el keeper
            $bookingselect= $this->BookingDAO->GetOnlyOneBooking($idbooking);
            $couponselect= $this->CouponDAO->GetOnlyOneCoupon($idbooking);
            $this->CouponDAO->Modify($idbooking, $couponselect->getFullPayment()/2, $voucher);
            //le agrego la plata en su banco
            $this->BankDAO->ModifyTotal($couponselect->getFullPayment()/2, $bookingselect->getKeeperId()->getBankKeeper());
            //cambia el estado de la reserva a super confirmada
            $this->BookingDAO->ConfirmationBooking($bookingselect);

            $this->ShowListReservas();
        }
    }
?>