<?php

namespace Models;

class Review{
    private $idReview;
    private $description;
    private $reviewDate;
    private $score;
    

    public function getScore()
    {
        return $this->score;
    }

    public function setScore($score)
    {
        $this->score = $score;
    }
 
    public function getReviewDate()
    {
        return $this->reviewDate;
    }

    public function setReviewDate($reviewDate)
    {
        $this->reviewDate = $reviewDate;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getIdReview()
    {
        return $this->idReview;
    }

    public function setIdReview($idReview)
    {
        $this->idReview = $idReview;
    }
}



?>