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
use DAO\CouponDAODB as CouponDAODB;
use DAO\ReviewDAODB as ReviewDAODB;
use \Exception as Exception;

class OwnerController{
    private $DataOwners;
    private $DataPets;
    private $DataKeepers;
    private $DataBookings;
    private $DataBanks;
    private $DataCoupon;
    private $DataReviews;

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
        $this->DataCoupon = new CouponDAODB;
        $this->DataReviews=new ReviewDAODB();
    }

    function ShowRegisterView(){
        require_once(VIEWS_PATH."owner-register.php");
    }

    function ShowAddPetView(){
        Validation::ValidUser();
        require_once(VIEWS_PATH."pet-add.php");
    }

    function AddOwner($firstname, $lasName, $dni, $email, $password, $phonenumber){
        
        try{
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
        }catch(Exception $ex)
        {
            require_once(VIEWS_PATH."error-page.php");
        }
    }

    public function MyProfile(){
        Validation::ValidUser();
        try{
        $petsofowner=$this->DataPets->GetAllforOwner($_SESSION['loggedUser']->getUserId());
        require_once(VIEWS_PATH."user-profile.php");
    }catch(Exception $ex)
    {
        require_once(VIEWS_PATH."error-page.php");
    }
    }

    public function Edit($user_id){
        Validation::ValidUser();
        require_once(VIEWS_PATH."owner-edit.php");        
    }

    public function EditAux($firstname, $lasName, $dni, $email, $password, $phonenumber){
        Validation::ValidUser();

        try{
        $_SESSION['loggedUser']->setFirstName($firstname);
        $_SESSION['loggedUser']->setLastName($lasName);
        $_SESSION['loggedUser']->setDni($dni);
        $_SESSION['loggedUser']->setEmail($email);
        $_SESSION['loggedUser']->setPassword($password);
        $_SESSION['loggedUser']->setPhoneNumber($phonenumber);
        $this->DataOwners->EditUser($_SESSION['loggedUser']);
        echo "<script> confirm('Información actualizada con éxito!');</script>";
        $this->MyProfile();
    }catch(Exception $ex)
    {
        require_once(VIEWS_PATH."error-page.php");
    }
    }

    public function FilterKeepers($beginning, $end){
        //funcion que devuelva una lista de keepers filtrada
        Validation::ValidUser();
        try{
        $dates_list=$this->DataDates->GetFiltersDates($beginning, $end); 
        $pets_list=$this->DataPets->GetAllforOwner($_SESSION['loggedUser']->getUserId());
        $pets_listAll=$this->DataPets->GetAll();
        $keeper_list=$this->DataKeepers->GetAll();
        $booking_list = $this->DataBookings->GetAll();
        
        require_once(VIEWS_PATH.'home.php');
    }catch(Exception $ex)
    {
        require_once(VIEWS_PATH."error-page.php");
    }
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

    public function ShowHome(){
        Validation::ValidUser();
        
        try{
        $pets_list=$this->DataPets->GetAllforOwner($_SESSION['loggedUser']->getUserId());
        $pets_listAll=$this->DataPets->GetAll();
        $keeper_list=$this->DataKeepers->GetAll();
        $dates_list=$this->DataDates->GetAll();
        $booking_list = $this->DataBookings->GetAll();
        $reviews_list=$this->DataReviews->GetAll();
            require_once(VIEWS_PATH.'home.php');
        }catch(Exception $ex)
        {
            require_once(VIEWS_PATH."error-page.php");
        }
    }

        
        

    
    
        /* se crea una nueva reserva se guarad y se redirije al home al owner, va a tener una pestaña mas con una solapa que dice reservas y le van a aparecer las reservas, pendiente o a pagar o confirmada*/ 
        /*el keeper al cancelar la reserva la elimina directamente*/
        /*el keeper al entrar a su home va a a ver la reserva pendiente y la va  aconfirmar y se cambia el confirmar a true y se espera a que el owner pague el 50 % */
        /*el owner paga y se confirma y se borran los dias disponibles del keeper*/ 
        /*listo terminaria el proceso por ahora ya que luego tenemos que ver la finalizacion de la estadia  */

    }



?>