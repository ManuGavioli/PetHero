<?php

namespace Controllers;

use Models\Owner as Owner;
use Models\Pet as Pet;
use Models\Keeper as Keeper;
use Models\Booking as Booking;
use Models\Bank as Bank;
use Models\Availability as Availability;
//use DAO\OwnerDAO as OwnerDAO; Persistencia en JSON
use DAO\OwnerDAODB as OwnerDAODB;
//use DAO\PetDAO as PetDAO;
use DAO\PetDAODB as PetDAODB;
//use DAO\KeeperDAO as KeeperDAO;
use DAO\KeeperDAODB as KeeperDAODB;
use Helper\Validation as Validation;
use DAO\AvailabilityDAODB as AvailabilityDAODB;
use DAO\BookingDAODB as BookingDAODB;
use DAO\BankDAODB as BankDAODB;

class OwnerController{
    private $DataOwners;
    private $DataPets;
    private $DataKeepers;
    private $DataBookings;
    private $DataBank;

    function __construct(){
        //$this->DataOwners=new OwnerDAO();
        $this->DataOwners= new OwnerDAODB();
        //$this->DataPets=new PetDAO();
        $this->DataPets=new PetDAODB();
        //$this->DataKeepers=new KeeperDAO();
        $this->DataKeepers=new KeeperDAODB;
        $this->DataDates = new AvailabilityDAODB;
        $this->DataBookings = new BookingDAODB;
        $this->DataBanks = new BankDAODB;
    }

    function ShowRegisterView(){
        require_once(VIEWS_PATH."owner-register.php");
    }

    function ShowListPetView(){
        Validation::ValidUser();

        //PASAR lista de pets
        $petsofowner=$this->DataPets->GetAllforOwner($_SESSION['loggedUser']->getUserId());
        
        require_once(VIEWS_PATH."pet-list.php");
    }

    function ShowAddPetView(){
        Validation::ValidUser();
        require_once(VIEWS_PATH."pet-add.php");
    }

    function AddOwner($firstname, $lasName, $dni, $email, $password, $phonenumber){

        
            if($this->DataOwners->SearchEmail($email) == null){
                $ownerNew=new Owner();
                $ownerNew->setFirstName($firstname);
                $ownerNew->setLastName($lasName);
                $ownerNew->setDni($dni);
                $ownerNew->setEmail($email);
                $ownerNew->setPassword($password);
                $ownerNew->setPhoneNumber($phonenumber);

                $this->DataOwners->Add_Owner($ownerNew);
                echo "<script> confirm('Cuenta creada con exito!');</script>";
                require_once(VIEWS_PATH."login.php");
            }else{
                echo "<script> confirm('Ya hay un usuario en el sistema utilizando el email ingresado... vuelva a intentar con uno nuevo');</script>";
                require_once(VIEWS_PATH."owner-register.php");

            } 
    }

    function AddPet($name, $photo, $petType, $raze, $size, $vaccinationPhoto, $observations, $video){

        Validation::ValidUser();

        $petNew=new Pet();
        $petNew->setName($name);
        $petNew->setPhoto($photo);
        $petNew->setPetType($petType);
        $petNew->setRaze($raze);
        $petNew->setSize($size);
        $petNew->setVaccinationPhoto($vaccinationPhoto);
        $petNew->setObservations($observations);

        //convertir la url de un video para luego poder incrustarlo automaticamente en la vista 

        $video=substr($video, 32);

        $petNew->setVideo($video);
        //agrego solo el id //pasar el owner completo 
        $petNew->setMyowner($_SESSION['loggedUser']);

        $this->DataPets->AddPet($petNew);

        //no hay mas lista de pets en owner
       //$_SESSION['loggedUser']=$this->DataOwners->AddPet($_SESSION['loggedUser']->getUserId(), $petNew);

        $this->ShowListPetView();
    }

    public function MyProfile(){
        Validation::ValidUser();
        $petsofowner=$this->DataPets->GetAllforOwner($_SESSION['loggedUser']->getUserId());
        require_once(VIEWS_PATH."user-profile.php");
    }

    public function Edit($user_id){
        Validation::ValidUser();
        require_once(VIEWS_PATH."owner-edit.php");        
    }

    public function EditAux($firstname, $lasName, $dni, $email, $password, $phonenumber){
        Validation::ValidUser();
        $_SESSION['loggedUser']->setFirstName($firstname);
        $_SESSION['loggedUser']->setLastName($lasName);
        $_SESSION['loggedUser']->setDni($dni);
        $_SESSION['loggedUser']->setEmail($email);
        $_SESSION['loggedUser']->setPassword($password);
        $_SESSION['loggedUser']->setPhoneNumber($phonenumber);
        $this->DataOwners->EditUser($_SESSION['loggedUser']);
        echo "<script> confirm('Información actualizada con éxito!');</script>";
        $this->MyProfile();
    }

    public function FilterKeepers($beginning, $end){
        //funcion que devuelva una lista de keepers filtrada
        $dates_list=$this->DataDates->GetFiltersDates($beginning, $end); 
        $pets_list=$this->DataPets->GetAllforOwner($_SESSION['loggedUser']->getUserId());
        $pets_listAll=$this->DataPets->GetAll();
        $keeper_list=$this->DataKeepers->GetAll();
        $booking_list = $this->DataBookings->GetAll();
        
        require_once(VIEWS_PATH.'home.php');
    }

    /*public function ShowReservationView(){
        var_dump($selectdates);
        //$keeperreservation=$this->DataKeepers->KeeperForId($id_keeper); funcion que devuelva un keeper especifico 
        //require_once(VIEWS_PATH."reservation-confirm.php");
        //require_once(VIEWS_PATH."reservation-confirm.php"); mascotas listado segun lo que cuida el keeper, tamaño y con boton para asignar mascota a la reserva 
        /* una vez selecciona la mascota, se crea la reserva, se lo redirige al home con mensaje de reserva creada con exito y la reserva se guarda
        cuando el keeper inicie sesion ve la reserva la acepta y al aceptarla, se genera el cupon de pago que se va  aguaradr en la reserva, el owner inicia sesion
        ve el cupon de pago pendiente, con un boton que dice pagar, apreta pagar y se confirma la reserva, una vez confirmada se busca el keeper que está en la reserva, se torna
        los días a false, el sistema chequea si el dia de fin de la reserva ya paso entonces elimina los días ocupados hasta esa fecha y de los dias disponibles del keeper.
        en owner cuando una de sus reservas ya finalizo le habilita la opcion de review. 
        

        */

   // }

    public function NewBooking($first_date, $end_date, $id_mascot, $id_keeper){


        if($first_date > $end_date){
            echo "<script> confirm('La fecha de inicio debe ser anterior a la fecha final... Vuelva a intentar');</script>";
            $this->ShowHome();
        }else{

            $first_date2 = strtotime($first_date);
            $end_date2 = strtotime($end_date);

            $day = 86400; //24 horas * 60 minutos x hora * 60 segundos x minuto (24*60*60)=86400 
            $dates = array();
            for($i = $first_date2; $i <= $end_date2; $i += $day){
                $dateToAdd = date("Y-m-d", $i);
                array_push($dates,$dateToAdd);
            }
            
            if($this->DataDates->DatesAvailability($dates, $id_keeper)==true){
                $bookininProgres=new Booking;
                $bookininProgres->setPetId($id_mascot);
                $bookininProgres->setStartDate($first_date);
                $bookininProgres->setFinalDate($end_date);
                $bookininProgres->setKeeperId($id_keeper);
                // la vamos a usar coupon $bookininProgres->setTotalValue(count($dates)* $this->DataKeepers->getKeeper($id_keeper)->getPrice());
            
                //falta hacer el bookingdao   
                $this->DataBookings->Add($bookininProgres);
                
                echo "<script> confirm('Reserva Creada con exito!! Una vez confirmada por el Keeper sera notificado');</script>";
                $this->ShowHome();
            }else{
                echo "<script> confirm('El rango de fechas seleccionado no es valido');</script>";
                $this->ShowHome();
            }
        }
    }

        public function ShowListReservas(){
        Validation::ValidUser();
        //PASAR lista de pets
        $petsofowner=$this->DataPets->GetAllforOwner($_SESSION['loggedUser']->getUserId());
        $Booking_list=$this->DataBookings->GetAllforOwner($petsofowner);
        require_once(VIEWS_PATH."owner-reservations.php");
        }

        public function ShowHome(){
            Validation::ValidUser();
    
        $pets_list=$this->DataPets->GetAllforOwner($_SESSION['loggedUser']->getUserId());
        $pets_listAll=$this->DataPets->GetAll();
        $keeper_list=$this->DataKeepers->GetAll();
        $dates_list=$this->DataDates->GetAll();
        $booking_list = $this->DataBookings->GetAll();
            require_once(VIEWS_PATH.'home.php');
        }

        public function PayBooking($voucher, $idbooking){
            //ultimo requisito de la logica

            //busco el keeper

            //le agrego la plata en su banco

            //busco el cupon por el id de reserva

            //le cargor el comprobante 

            //cambia el estado de la reserva a super confirmada

            $this->ShowHome();
        }

        
        

    
    
        /* se crea una nueva reserva se guarad y se redirije al home al owner, va a tener una pestaña mas con una solapa que dice reservas y le van a aparecer las reservas, pendiente o a pagar o confirmada*/ 
        /*el keeper al cancelar la reserva la elimina directamente*/
        /*el keeper al entrar a su home va a a ver la reserva pendiente y la va  aconfirmar y se cambia el confirmar a true y se espera a que el owner pague el 50 % */
        /*el owner paga y se confirma y se borran los dias disponibles del keeper*/ 
        /*listo terminaria el proceso por ahora ya que luego tenemos que ver la finalizacion de la estadia  */

    }



?>