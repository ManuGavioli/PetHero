<?php

namespace Models;

class Bank{
    private $IdBank;
    private $cbu;
    private $alias;
    private $total;


    public function getIdBank()
    {
        return $this->IdBank;
    }

    public function setIdBank($IdBank)
    {
        $this->IdBank = $IdBank;
    }

    public function getCbu()
    {
        return $this->cbu;
    }

    public function setCbu($cbu)
    {
        $this->cbu = $cbu;
    }

    public function getAlias()
    {
        return $this->alias;
    }

    public function setAlias($alias)
    {
        $this->alias = $alias;

    }

    public function getTotal()
    {
        return $this->total;
    }

    public function setTotal($total)
    {
        $this->total = $total;
    }
}





?>