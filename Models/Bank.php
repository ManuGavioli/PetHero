<?php

namespace Models;

class Bank{
    private $keeperBank;
    private $cbu;
    private $alias;
    private $total;

    /**
     * Get the value of keeperBank
     */
    public function getKeeperBank()
    {
        return $this->keeperBank;
    }

    /**
     * Set the value of keeperBank
     */
    public function setKeeperBank($keeperBank)
    {
        $this->keeperBank = $keeperBank;

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