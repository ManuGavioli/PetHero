<?php
    namespace Models;

    class Message{
        private $idMessage;
        private $idChat;
        private $user;
        private $dateTimer;
        private $textMsg;

        

        public function getIdMessage()
        {
                return $this->idMessage;
        }

        public function setIdMessage($idMessage)
        {
                $this->idMessage = $idMessage;
        }

        
        public function getIdChat()
        {
                return $this->idChat;
        }

        public function setIdChat($idChat)
        {
                $this->idChat = $idChat;
        }

        public function getUser()
        {
                return $this->user;
        }

        public function setUser($user)
        {
                $this->user = $user;
        }

        public function getDateTimer()
        {
                return $this->dateTimer;
        }

        public function setDateTimer($dateTimer)
        {
                $this->dateTimer = $dateTimer;
        }

        
        public function getTextMsg()
        {
                return $this->textMsg;
        }

        public function setTextMsg($textMsg)
        {
                $this->textMsg = $textMsg;
        }
    }
?>