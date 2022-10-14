<?php
    namespace Models;

    class Pet{
        private $photo;
        private $raze;
        private $size;
        private $vaccinationPhoto;
        private $observations;
        private $video;

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
    }
?>