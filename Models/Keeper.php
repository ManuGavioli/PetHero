<?php
    namespace Models;

    class Keeper extends User{
        
        //private $bookings;   lista de reservas: listado de dias, id, importe_abonado, valor_total
        //private $reviews;   lista de reviews: desc, fecha, id, puntuacion
        private $petType;
        private $price;
        //private $availableDates;  lista de fechas_disponibles: dia, disponible, id_keeper (probablemente tabla intermedia)
        
        /*public function getBookings()
        {
            return $this->bookings;
        }

        public function setBookings($bookings)
        {
            $this->bookings = $bookings;
        }

        public function getReviews()
        {
            return $this->reviews;
        }

        public function setReviews($reviews)
        {
            $this->reviews = $reviews;
        }

        public function getAvailableDates()
        {
            return $this->availableDates;
        }

        public function setAvailableDates($availableDates)
        {
            $this->availableDates = $availableDates;
        }*/

        public function getPetType()
        {
            return $this->petType;
        }

        public function setPetType($petType)
        {
            $this->petType = $petType;
        }

        public function getPrice()
        {
            return $this->price;
        }

        public function setPrice($price)
        {
            $this->price = $price;
        }

        public function isKeeperOrOwner(){
            return 1;
        }
    }
?>