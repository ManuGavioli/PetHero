<?php
    namespace Models;

    class Chat{
        private $idChat;
        private $OwnerId;
        private $KeeperId;

        

        public function getIdChat()
        {
                return $this->idChat;
        }

      
        public function setIdChat($idChat)
        {
                $this->idChat = $idChat;
        }

       
        public function getOwnerId()
        {
                return $this->OwnerId;
        }

       
        public function setOwnerId($OwnerId)
        {
                $this->OwnerId = $OwnerId;
        }

        
        public function getKeeperId()
        {
                return $this->KeeperId;
        }

        
        public function setKeeperId($KeeperId)
        {
                $this->KeeperId = $KeeperId;
        }
    }

?>