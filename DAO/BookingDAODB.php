<?php
namespace DAO;

    use DAO\IBookingDAODB as IBookingDAODB;
    use \Exception as Exception;
    use Models\Booking as Booking;   
    use Models\Pet as Pet;
    use DAO\Connection as Connection;
    use Models\Keeper as Keeper;
    use Models\Owner as Owner;
    use Models\Bank as Bank;

class BookingDAODB implements IBookingDAODB{

    private $connection;
    private $tableName = "Bookings";

    

    public function GetAll(){
        try
        {
            $BookingList = array();

            $query = "SELECT * FROM ".$this->tableName." INNER JOIN keepers on bookings.keeperId = keepers.user_id INNER JOIN pets on bookings.petId = pets.id_pet INNER JOIN owners on pets.id_owner = owners.user_id;";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);
            
            foreach ($resultSet as $Booking)
            {                
                        $BookingNew=new Booking();

                        $newKeeper = new Keeper;
                        $newKeeper->setUserId($Booking["keeperId"]);
                        $newKeeper->setFirstName($Booking["firstName"]);
                        $newKeeper->setLastName($Booking["lastName"]);
                        $newKeeper->setDni($Booking["dni"]);
                        $newKeeper->setEmail($Booking["email"]);
                        $newKeeper->setPassword($Booking["pass"]);
                        $newKeeper->setPhoneNumber($Booking["phoneNumber"]);
                        $newKeeper->setPetType($Booking["petType"]);
                        $newKeeper->setPrice($Booking["price"]);
                       

                        $bank = new Bank;
                $bank->setIdBank($row["IdBank"]);
                $bank->setCbu($row["cbu"]);
                $bank->setAlias($row["alias"]);
                $bank->setTotal($row["total"]);

                $newKeeper->setBankKeeper($bank);

                $BookingNew->setKeeperId($newKeeper);

                        $newOwner = new Owner;
                        $newOwner->setUserId($Booking['id_owner']);
                        $newOwner->setFirstName($Booking['firstName']);
                        $newOwner->setLastName($Booking['lastName']);
                        $newOwner->setDni($Booking['dni']);
                        $newOwner->setEmail($Booking['email']);
                        $newOwner->setPassword($Booking['pass']);
                        $newOwner->setPhoneNumber($Booking['phoneNumber']);

                        $newPet = new Pet;
                        $newPet->setId($Booking['petId']);
                        $newPet->setName($Booking['name_pet']);
                        $newPet->setPhoto($Booking['photo']);
                        $newPet->setPetType($Booking['petType']);
                        $newPet->setRaze($Booking['raze']);
                        $newPet->setSize($Booking['size']);
                        $newPet->setVaccinationPhoto($Booking['vaccinationPhoto']);
                        $newPet->setObservations($Booking['observations']);
                        $newPet->setVideo($Booking['video']);
                        $newPet->setMyowner($newOwner);
                        $BookingNew->setPetId($newPet);
                        
                      //  $BookingNew->setAmountPaid($Booking['amountPaid']); // es un objeto coupon?

                        $BookingNew->setIdBooking($Booking['idBooking']);
                        $BookingNew->setStartDate($Booking['startDate']);
                        $BookingNew->setFinalDate($Booking['finalDate']);
                        $BookingNew->setConfirmed($Booking['confirmed']);

                        array_push($BookingList,$BookingNew);
            }
            return $BookingList;
        }
        catch(Exception $ex)
        {
            throw $ex;
        }

    }



    public function Add(Booking $newBooking){
        try
            {
                $query = "INSERT INTO ".$this->tableName." (keeperId, startDate, finalDate, petId) VALUES ( :keeperId, :startDate, :finalDate, :petId);";


                $parameters['keeperId']=$newBooking->getKeeperId();
                $parameters['startDate']=$newBooking->getStartDate();
                $parameters['finalDate']=$newBooking->getFinalDate();
                $parameters['petId']=$newBooking->getPetId();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);

                
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
    }



    public function Remove($id){
        


    }

    public function GetAllforKeeper($id){
        $allBookings=$this->GetAll();
        $Booking_keeper=array();
        foreach ($allBookings as $Bookings){
            if($Bookings->getKeeperId()==$id){
                array_push($Booking_keeper, $Bookings);
            }
        }
        return $Booking_keeper;
    }

    public function GetAllforOwner($pets){
        $allBookings=$this->GetAll();
        $Booking_owner=array();
        foreach ($allBookings as $Bookings){ 
            foreach($pets as $pet){
                if($Bookings->getPetId()->getId() == $pet->getId()){
                    array_push($Booking_owner, $Bookings);
                }
            }
        }
        return $Booking_owner;
    }

    public function GetOneBooking($id){   //si encuentra la id del Keeper devuelve el booking, sino null
        try
        {
            $BookingList = array();

            $query = "SELECT * FROM ".$this->tableName." INNER JOIN keepers on bookings.keeperId = keepers.user_id INNER JOIN pets on bookings.petId = pets.id_pet INNER JOIN owners on pets.id_owner = owners.user_id
            WHERE keeperId = ".$id;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            if($resultSet != null){
                foreach ($resultSet as $Booking)
                {                
                    $BookingNew=new Booking();

                    $newKeeper = new Keeper;
                    $newKeeper->setUserId($Booking["keeperId"]);
                    $newKeeper->setFirstName($Booking["firstName"]);
                    $newKeeper->setLastName($Booking["lastName"]);
                    $newKeeper->setDni($Booking["dni"]);
                    $newKeeper->setEmail($Booking["email"]);
                    $newKeeper->setPassword($Booking["pass"]);
                    $newKeeper->setPhoneNumber($Booking["phoneNumber"]);
                    $newKeeper->setPetType($Booking["petType"]);
                    $newKeeper->setPrice($Booking["price"]);
                    

                    $bank = new Bank;
                $bank->setIdBank($row["IdBank"]);
                $bank->setCbu($row["cbu"]);
                $bank->setAlias($row["alias"]);
                $bank->setTotal($row["total"]);

                $newKeeper->setBankKeeper($bank);

                $BookingNew->setKeeperId($newKeeper);

                    $newOwner = new Owner;
                    $newOwner->setUserId($Booking['id_owner']);
                    $newOwner->setFirstName($Booking['firstName']);
                    $newOwner->setLastName($Booking['lastName']);
                    $newOwner->setDni($Booking['dni']);
                    $newOwner->setEmail($Booking['email']);
                    $newOwner->setPassword($Booking['pass']);
                    $newOwner->setPhoneNumber($Booking['phoneNumber']);

                    $newPet = new Pet;
                    $newPet->setId($Booking['petId']);
                    $newPet->setName($Booking['name_pet']);
                    $newPet->setPhoto($Booking['photo']);
                    $newPet->setPetType($Booking['petType']);
                    $newPet->setRaze($Booking['raze']);
                    $newPet->setSize($Booking['size']);
                    $newPet->setVaccinationPhoto($Booking['vaccinationPhoto']);
                    $newPet->setObservations($Booking['observations']);
                    $newPet->setVideo($Booking['video']);
                    $newPet->setMyowner($newOwner);
                    $BookingNew->setPetId($newPet);
                            
                    //$BookingNew->setAmountPaid($Booking['amountPaid']); // es un objeto coupon?

                    $BookingNew->setIdBooking($Booking['idBooking']);
                    $BookingNew->setStartDate($Booking['startDate']);
                    $BookingNew->setFinalDate($Booking['finalDate']);
                    $BookingNew->setConfirmed($Booking['confirmed']);

                    array_push($BookingList,$BookingNew);
                }
                
                return $BookingList;
            }else{
                return null;
            }
        }
        catch(Exception $ex)
        {
            throw $ex;
        }

    }

    public function GetOnlyOneBooking($id){ //retorna cuando la id del booking es la pasada por parametro
        try
        {
            $BookingList = array();

            $query = "SELECT * FROM ".$this->tableName." INNER JOIN keepers on bookings.keeperId = keepers.user_id INNER JOIN pets on bookings.petId = pets.id_pet INNER JOIN owners on pets.id_owner = owners.user_id
            WHERE idBooking = ".$id;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            if($resultSet != null){
                $Booking=$resultSet[0];  

                $BookingNew=new Booking();

                $newKeeper = new Keeper;
                $newKeeper->setUserId($Booking["keeperId"]);
                $newKeeper->setFirstName($Booking["firstName"]);
                $newKeeper->setLastName($Booking["lastName"]);
                $newKeeper->setDni($Booking["dni"]);
                $newKeeper->setEmail($Booking["email"]);
                $newKeeper->setPassword($Booking["pass"]);
                $newKeeper->setPhoneNumber($Booking["phoneNumber"]);
                $newKeeper->setPetType($Booking["petType"]);
                $newKeeper->setPrice($Booking["price"]);

                $bank = new Bank;
                $bank->setIdBank($row["IdBank"]);
                $bank->setCbu($row["cbu"]);
                $bank->setAlias($row["alias"]);
                $bank->setTotal($row["total"]);

                $newKeeper->setBankKeeper($bank);

                $BookingNew->setKeeperId($newKeeper);

                

                $newOwner = new Owner;
                $newOwner->setUserId($Booking['id_owner']);
                $newOwner->setFirstName($Booking['firstName']);
                $newOwner->setLastName($Booking['lastName']);
                $newOwner->setDni($Booking['dni']);
                $newOwner->setEmail($Booking['email']);
                $newOwner->setPassword($Booking['pass']);
                $newOwner->setPhoneNumber($Booking['phoneNumber']);

                $newPet = new Pet;
                $newPet->setId($Booking['petId']);
                $newPet->setName($Booking['name_pet']);
                $newPet->setPhoto($Booking['photo']);
                $newPet->setPetType($Booking['petType']);
                $newPet->setRaze($Booking['raze']);
                $newPet->setSize($Booking['size']);
                $newPet->setVaccinationPhoto($Booking['vaccinationPhoto']);
                $newPet->setObservations($Booking['observations']);
                $newPet->setVideo($Booking['video']);
                $newPet->setMyowner($newOwner);
                $BookingNew->setPetId($newPet);
                            
                //$BookingNew->setAmountPaid($Booking['amountPaid']); // es un objeto coupon?

                $BookingNew->setIdBooking($Booking['idBooking']);
                $BookingNew->setStartDate($Booking['startDate']);
                $BookingNew->setFinalDate($Booking['finalDate']);
                $BookingNew->setConfirmed($Booking['confirmed']);

                array_push($BookingList,$BookingNew);
                
                
                return $BookingList[0];
            }else{
                return null;
            }
        }
        catch(Exception $ex)
        {
            throw $ex;
        }

    }

    public function ApproveBooking ($Booking){
        try{
            $query = "UPDATE ".$this->tableName." SET confirmed = :confirmed WHERE idBooking = ".$Booking->getIdBooking();

            $parameters["confirmed"] = 1;
            
            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters);
            
        }catch(Exception $ex){
            throw $ex;
        }
    }

    public function RejectBooking ($Booking){
        try{
            $query = "UPDATE ".$this->tableName." SET confirmed = :confirmed WHERE idBooking = ".$Booking->getIdBooking();

            $parameters["confirmed"] = 2;
            
            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters);
            
        }catch(Exception $ex){
            throw $ex;
        }
    }

    public function BookingsConfirmationPendient($id){
        $booking_list=array();
        if($this->GetOneBooking($id)!=null){
            foreach ($this->GetOneBooking($id) as $bookings){
                if($bookings->getConfirmed()==0){
                    array_push($booking_list, $bookings);
                }
            }
        }
        return $booking_list;
    }

}


?>