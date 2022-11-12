<?php
    namespace DAO;

    use DAO\Connection as Connection;
    use \Exception as Exception;
    use Models\Coupon as Coupon;

    class CouponDAODB implements ICouponDAODB
    {
        private $connection;
        private $tableName = "Coupon";

        public function GetAll()
        {
        try
        {
            $couponList = array();

            $query = "SELECT * FROM ".$this->tableName;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);
            
            foreach ($resultSet as $coupon)
            {                
                $couponNew=new Coupon();
                $couponNew->setIdCoupon($coupon['idCoupon']);
                $couponNew->setPaidAlready($coupon['paidAlready']);
                $couponNew->setFullPayment($coupon['totalPay']);
                $couponNew->setBookingId($coupon['BookingId']);

                array_push($couponList, $couponNew);
            }

            return $couponList;
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
        }

        public function Add_Coupon($totalPay,$idBooking){
            try{ 
                $query = "INSERT INTO ". $this->tableName . " ( paidAlready, totalPay, BookingId ) VALUES ( :paidAlready, :totalPay, :BookingId );"; 
    
                    $parameters["paidAlready"] = 0;
                    $parameters["totalPay"] = $totalPay;
                    $parameters["BookingId"] = $idBooking;
    
                    $this->connection = Connection::GetInstance();
    
                    $this->connection->ExecuteNonQuery($query, $parameters);
    
            }catch(Exception $ex){
                throw $ex;
            }
        }

        public function Modify($idBooking, $mount, $voucher){
            try{ 
                $query = "UPDATE ". $this->tableName . " SET paidAlready=paidAlready+".$mount." , VoucherCode=".$voucher." where BookingId=".$idBooking.";"; 
    
                    $this->connection = Connection::GetInstance();
    
                    $this->connection->ExecuteNonQuery($query); 
    
            }catch(Exception $ex){
                throw $ex;
            }
        }

        public function GetOnlyOneCoupon($id){ //retorna cuando la id del booking es la pasada por parametro
            try
            {
                $BookingList = array();
    
                $query = "SELECT * FROM ".$this->tableName." c"." INNER JOIN Bookings b on b.idBooking = c.BookingId WHERE b.idBooking = ".$id;
    
                $this->connection = Connection::GetInstance();
    
                $resultSet = $this->connection->Execute($query);
    
                if($resultSet != null){
                    $coupon=$resultSet[0];  

                    $couponNew=new Coupon;

                    $couponNew->setIdCoupon($coupon['idCoupon']);
                    $couponNew->setPaidAlready($coupon['paidAlready']);
                    $couponNew->setFullPayment($coupon['totalPay']);
                    $couponNew->setVoucherNumInic($coupon['VoucherCode']);
                    $couponNew->setBookingId($coupon['BookingId']);
    
                    
                    return $couponNew;
                }else{
                    return null;
                }
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
    



    }
}
?>