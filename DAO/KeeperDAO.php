<?php
    namespace DAO;

    use Models\Keeper as Keeper;

    class KeeperDAO implements IKeeperDAO
    {
        private $KeeperList = array();
        private $fileName = ROOT."Data/keepers.json";

        public function GetAll()
        {
            $this->RetrieveData();

            return $this->KeeperList;
        }

        public function Add_Keeper(Keeper $newKeeper)
        {
            $this->RetrieveData();

            $newKeeper->setUserId($this->GetNextId());
            $newKeeper->setBookings(null);
            $newKeeper->setAvailableDates(null);
            $newKeeper->setPrice(null);
            $newKeeper->setPetType(null);

            array_push($this->KeeperList, $newKeeper);

            $this->SaveData();
        }

        public function SearchEmail($email)
        {
            $this->RetrieveData();

            $keepers = array_filter($this->KeeperList, function($keeperExist) use($email){
                return $keeperExist->getEmail() == $email;
            });

            $keepers = array_values($keepers);

            return (count($keepers) > 0) ? $keepers[0] : null;
        }

        private function GetNextId()
        {
            $id = 0;
            foreach($this->KeeperList as $Keeper){
                $id = ($Keeper->getUserId() > $id) ? $Keeper->getUserId() : $id; 
            }
            return $id + 1;
        }

        public function Remove($id)
        {
            $this->RetrieveData();

            $this->KeeperList = array_filter($this->KeeperList, function($Keeper) use ($id){
                return $Keeper->getUserId() != $id;
            });

            $this->SaveData();
        }

        public function EditDates($keeper,$dates){
            $id = $keeper->getUserId(); 
            $this->Remove($keeper->getUserId());

            $this->RetrieveData();

            $keeper->setUserId($id);
            $keeper->setAvailableDates($dates);

            array_push($this->KeeperList, $keeper);

            $this->SaveData();
        }

        public function EditPrice($keeper, $price){
            $id = $keeper->getUserId(); 
            $this->Remove($keeper->getUserId());

            $this->RetrieveData();

            $keeper->setUserId($id);
            $keeper->setPrice($price);

            array_push($this->KeeperList, $keeper);

            $this->SaveData();
        }

        public function EditPetType($keeper, $pet_type){
            $id = $keeper->getUserId(); 
            $this->Remove($keeper->getUserId());

            $this->RetrieveData();

            $keeper->setUserId($id);
            $keeper->setPetType($pet_type);

            array_push($this->KeeperList, $keeper);

            $this->SaveData();
        }

        public function EditUser($keeper){
            $id = $keeper->getUserId(); 
            $this->Remove($keeper->getUserId());

            $this->RetrieveData();

            $keeper->setUserId($id);

            array_push($this->KeeperList, $keeper);

            $this->SaveData();
        }

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->KeeperList as $Keeper){

                $valuesArray["user_id"] = $Keeper->getUserId();
                $valuesArray["first_name"] = $Keeper->getFirstName();
                $valuesArray["last_name"] = $Keeper->getLastName();
                $valuesArray["dni"] = $Keeper->getDni();
                $valuesArray["email"] = $Keeper->getEmail();
                $valuesArray["password"] = $Keeper->getPassword();
                $valuesArray["phone_number"] = $Keeper->getPhoneNumber();

                //type
                $valuesArray["bookings"] = $Keeper->getBookings();
                $valuesArray["pet_type"] = $Keeper->getPetType();
                $valuesArray["available_dates"] = $Keeper->getAvailableDates();
                $valuesArray["price"] = $Keeper->getPrice();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

            file_put_contents($this->fileName, $jsonContent);
        }

        private function RetrieveData()
        {

            $this->KeeperList = array();

            if(file_exists($this->fileName)){

                $jsonToDecode = file_get_contents($this->fileName);
                $contentArray = ($jsonToDecode) ? json_decode($jsonToDecode, true) : array();

                foreach($contentArray as $content){

                    $Keeper = new Keeper();
                    $Keeper->setUserId($content["user_id"]);
                    $Keeper->setFirstName($content["first_name"]);
                    $Keeper->setLastName($content["last_name"]);
                    $Keeper->setDni($content["dni"]);
                    $Keeper->setEmail($content["email"]);
                    $Keeper->setPassword($content["password"]);
                    $Keeper->setPhoneNumber($content["phone_number"]);

                    //type
                    $Keeper->setBookings($content["bookings"]);
                    $Keeper->setPetType($content["pet_type"]);
                    $Keeper->setAvailableDates($content["available_dates"]);
                    $Keeper->setPrice($content["price"]);


                    array_push($this->KeeperList, $Keeper);
                }
            }
        }

    }
?>