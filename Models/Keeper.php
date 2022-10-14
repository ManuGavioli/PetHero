<?php
    namespace Models;

    class Keeper extends User{
        
        private $bookings;
        private $petType;
        
        public function getBookings()
        {
            return $this->bookings;
        }

        public function setBookings($bookings)
        {
            $this->bookings = $bookings;
        }

        public function getPetType()
        {
            return $this->petType;
        }

        public function setPetType($petType)
        {
            $this->petType = $petType;
        }
    }
?>