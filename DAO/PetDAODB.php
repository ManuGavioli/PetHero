<?php
namespace DAO;

    use DAO\IPetDAO as IPetDAO;
    use \Exception as Exception;
    use Models\Pet as Pet;   
    use Models\Owner as Owner; 
    use DAO\Connection as Connection;

class PetDAODB implements IPetDAO{

    private $connection;
    private $tableName = "Pets";

    

    function GetAll(){
        try
        {
            $petList = array();

            $query = "SELECT * FROM ".$this->tableName." inner join Owners on Owners.user_id= ".$this->tableName.".id_owner";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);
            
            foreach ($resultSet as $Pet)
            {                
                        $petNew=new Pet();
                        $petNew->setId($Pet['id_pet']);
                        $petNew->setName($Pet['name_pet']);
                        $petNew->setPhoto($Pet['photo']);
                        $petNew->setPetType($Pet['petType']);
                        $petNew->setRaze($Pet['raze']);
                        $petNew->setSize($Pet['size']);
                        $petNew->setVaccinationPhoto($Pet['vaccinationPhoto']);
                        $petNew->setObservations($Pet['observations']);
                        $petNew->setVideo($Pet['video']);

                    $ownerNew=new Owner();
                    $ownerNew->setUserId($Pet['user_id']);
                    $ownerNew->setFirstName($Pet['firstName']);
                    $ownerNew->setLastName($Pet['lastName']);
                    $ownerNew->setDni($Pet['dni']);
                    $ownerNew->setEmail($Pet['email']);
                    $ownerNew->setPassword($Pet['pass']);
                    $ownerNew->setPhoneNumber($Pet['phoneNumber']);

                    $petNew->setMyOwner($ownerNew);

                array_push($petList, $petNew);
            }

            return $petList;
        }
        catch(Exception $ex)
        {
            throw $ex;
        }

    }



    function AddPet(Pet $newPet){
        try
            {
                $query = "INSERT INTO ".$this->tableName." (name_pet, photo, petType, raze, size, vaccinationPhoto, observations, video, id_owner) VALUES ( :name_pet, :photo, :petType, :raze, :size, :vaccinationPhoto, :observations, :video, :id_owner);";

                $parameters['name_pet']=$newPet->getName();
                $parameters['photo']=$newPet->getPhoto();
                $parameters['petType']=$newPet->getPetType();
                $parameters['raze']=$newPet->getRaze();
                $parameters['size']=$newPet->getSize();
                $parameters['vaccinationPhoto']=$newPet->getVaccinationPhoto();
                $parameters['observations']=$newPet->getObservations();
                $parameters['video']=$newPet->getVideo();
                $parameters['id_owner']=$newPet->getMyOwner()->getUserId();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);

                
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
    }



    function Remove($id){
        


    }

    function GetAllforOwner($id){
        $allpets=$this->GetAll();
        $pet_owner=array();
        foreach ($allpets as $pets){
            if($pets->getMyOwner()->getUserId()==$id){
                array_push($pet_owner, $pets);
            }
        }
        return $pet_owner;
    }

    function GetOnePet($idpet){
        try
        {
            $query = "SELECT * FROM ".$this->tableName." inner join Owners on Owners.user_id= ".$this->tableName.".id_owner where pets.id_pet=".$idpet.';';

          
            $this->connection = Connection::GetInstance();
            $result = $this->connection->Execute($query);
            
            
            $petNew=new Pet();

            if(isset($result[0])){
                $row = $result[0];

                        $petNew->setId($row['id_pet']);
                        $petNew->setName($row['name_pet']);
                        $petNew->setPhoto($row['photo']);
                        $petNew->setPetType($row['petType']);
                        $petNew->setRaze($row['raze']);
                        $petNew->setSize($row['size']);
                        $petNew->setVaccinationPhoto($row['vaccinationPhoto']);
                        $petNew->setObservations($row['observations']);
                        $petNew->setVideo($row['video']);

                    $ownerNew=new Owner();
                    $ownerNew->setUserId($row['user_id']);
                    $ownerNew->setFirstName($row['firstName']);
                    $ownerNew->setLastName($row['lastName']);
                    $ownerNew->setDni($row['dni']);
                    $ownerNew->setEmail($row['email']);
                    $ownerNew->setPassword($row['pass']);
                    $ownerNew->setPhoneNumber($row['phoneNumber']);

                    $petNew->setMyOwner($ownerNew);
            }else
            {
                $petNew=null;
            }
            return $petNew;
        }
        catch(Exception $ex)
        {
            throw $ex;
        }

    }

    public function EditPet($newPet){
        try
        {
           if ($newPet->getPhoto()!=null){
            $query = "UPDATE ".$this->tableName." SET photo= :photo, petType= :petType, size= :size, observations= :observations, video= :video WHERE id_pet= :id_pet;";
            $parameters['photo']=$newPet->getPhoto();
           }else{
            $query = "UPDATE ".$this->tableName." SET petType= :petType, size= :size, observations= :observations, video= :video WHERE id_pet= :id_pet;";
           }
            
            $parameters['petType']=$newPet->getPetType();
            $parameters['size']=$newPet->getSize();
            $parameters['observations']=$newPet->getObservations();
            $parameters['video']=$newPet->getVideo();
            $parameters['id_pet']=$newPet->getId();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        }
        catch(Exception $ex)
        {
            throw $ex;
        }


    }

}


?>