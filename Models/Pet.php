<?php
    namespace Models;

    class Pet{
        private $id;
        private $name;
        private $photo;
        private $petType;
        private $raze;
        private $size;
        private $vaccinationPhoto;
        private $observations;
        private $video;
        private $myowner;

        public function getVideo()
        {
            return $this->video;
        }

        public function setVideo($video)
        {
            $this->video = $video;
        }
 
        public function getObservations()
        {
            return $this->observations;
        }

        public function setObservations($observations)
        {
            $this->observations = $observations;
        }

        public function getVaccinationPhoto()
        {
            return $this->vaccinationPhoto;
        }
 
        public function setVaccinationPhoto($vaccinationPhoto)
        {
            $this->vaccinationPhoto = $vaccinationPhoto;
        }

        public function getSize()
        {
            return $this->size;
        }

        public function setSize($size)
        {
            $this->size = $size;
        }

        public function getRaze()
        {
            return $this->raze;
        }

        public function setRaze($raze)
        {
            $this->raze = $raze;
        }

        public function getPhoto()
        {
            return $this->photo;
        }

        public function setPhoto($photo)
        {
            $this->photo = $photo;
        }

        public function getPetType()
        {
            return $this->petType;
        }

        public function setPetType($petType)
        {
            $this->petType = $petType;
        }

      
        public function getId()
        {
                return $this->id;
        }

        public function setId($id)
        {
                $this->id = $id;

        }

       
        public function getMyowner()
        {
                return $this->myowner;
        }

       
        public function setMyowner($myowner)
        {
                $this->myowner = $myowner;

        }

        public function getName()
        {
                return $this->name;
        }

      
        public function setName($name)
        {
                $this->name = $name;

        }
    }
?>