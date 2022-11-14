<?php

namespace Models;

class Review{
    private $idBooking;
    private $idReview;
    private $desc;
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

    public function getDesc()
    {
        return $this->desc;
    }

    public function setDesc($desc)
    {
        $this->desc = $desc;
    }

    public function getIdReview()
    {
        return $this->idReview;
    }

    public function setIdReview($idReview)
    {
        $this->idReview = $idReview;
    }

    public function getidBooking()
    {
        return $this->idBooking;
    }

    public function setidBooking($idBooking)
    {
        $this->idBooking = $idBooking;
    }
}



?>