<?php
namespace DAO;

    use DAO\IBookingDAODB as IBookingDAODB;
    use \Exception as Exception;
    use Models\Booking as Booking;   
    use Models\Pet as Pet;
    use DAO\Connection as Connection;

class BookingDAODB implements IBookingDAODB{

    private $connection;
    private $tableName = "Bookings";

    

    public function GetAll(){
        try
        {
            $BookingList = array();

            $query = "SELECT * FROM ".$this->tableName;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);
            
            foreach ($resultSet as $Booking)
            {                
                        $BookingNew=new Booking();
                        $BookingNew->setKeeperId($Booking['keeperId']);
                        $BookingNew->setIdBooking($Booking['idBooking']);
                        $BookingNew->setAmountPaid($Booking['amountPaid']);
                        $BookingNew->setTotalValue($Booking['totalValue']);
                        $BookingNew->setStartDate($Booking['startDate']);
                        $BookingNew->setFinalDate($Booking['finalDate']);
                        $BookingNew->setConfirmed($Booking['confirmed']);
                        $BookingNew->setPetId($Booking['petId']);

                array_push($BookingList, $BookingNew);
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
                $query = "INSERT INTO ".$this->tableName." (keeperId, amountPaid, totalValue, startDate, finalDate, petId) VALUES ( :keeperId, :amountPaid, :totalValue, :startDate, :finalDate, :petId);";


                $parameters['keeperId']=$newBooking->getKeeperId();
                $parameters['amountPaid']=$newBooking->getAmountPaid();
                $parameters['totalValue']=$newBooking->getTotalValue();
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
        return $Booking_keeper; // estaba puesto para que retornara esto: "$Booking_owner;". Creo que esta mal por eso lo cambio a $Booking_keeper
    }

    public function GetAllforOwner($pets){
        $allBookings=$this->GetAll();
        $Booking_owner=array();
        foreach ($allBookings as $Bookings){
            foreach($pets as $pet){
                if($Bookings->getPetId()==$pet->getId()){
                    array_push($Booking_owner, $Bookings);
                }
            }
        }
        return $Booking_owner;
    }

}


?>