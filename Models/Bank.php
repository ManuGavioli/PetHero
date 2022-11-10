<?php

namespace Models;

class Bank{
    private $IdBank;
    private $cbu;
    private $alias;
    private $total;

    /**
     * Get the value of IdBank
     */
    public function getIdBank()
    {
        return $this->IdBank;
    }

    /**
     * Set the value of IdBank
     */
    public function setIdBank($IdBank)
    {
        $this->IdBank = $IdBank;

    }

    /**
     * Get the value of cbu
     */
    public function getCbu()
    {
        return $this->cbu;
    }

    /**
     * Set the value of cbu
     */
    public function setCbu($cbu)
    {
        $this->cbu = $cbu;

    }

    /**
     * Get the value of alias
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * Set the value of alias
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;

    }

    /**
     * Get the value of total
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set the value of total
     */
    public function setTotal($total)
    {
        $this->total = $total;

    }
}





?>