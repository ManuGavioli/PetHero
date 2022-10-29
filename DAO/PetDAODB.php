<?php
namespace DAO;

    use DAO\IPetDAO as IPetDAO;
    use \Exception as Exception;
    use Models\Pet as Pet;   
    use DAO\Connection as Connection;

class PetDAODB implements IPetDAO{

    private $connection;
    private $tableName = "Pets";

    

    function GetAll(){
        try
        {
            $petList = array();

            $query = "SELECT * FROM ".$this->tableName;

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
                        $petNew->setMyOwner($Pet['id_owner']);

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
                $parameters['id_owner']=$newPet->getMyOwner();

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
            if($pets->getMyOwner()==$id){
                array_push($pet_owner, $pets);
            }
        }
        return $pet_owner;
    }

}


?>