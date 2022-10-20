<?php
    namespace Models;

    class Keeper extends User{
        
        private $bookings;
        private $petType;
        private $availableDates;
        
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

        public function getAvailableDates()
        {
            return $this->availableDates;
        }

        public function setAvailableDates($availableDates)
        {
            $this->availableDates = $availableDates;
        }

        public function isKeeper(){
            return 1;
        }
    }
?>