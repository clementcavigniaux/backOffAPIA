<?php

namespace AppBundle\Entity;

/**
 * Parameter
 */
class Parameter
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $prixReal;

    /**
     * @var string
     */
    private $prixProd;

    /**
     * @var string
     */
    private $numCompte;

    /**
     * @var string
     */
    private $adresseAPIA;

    /**
     * @var string
     */
    private $telAPIA;

    /**
     * @var string
     */
    private $nomBanque;

    /**
     * @var string
     */
    private $sIRETAPIA;

    /**
     * @var string
     */

    private $numAsso;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set prixReal
     *
     * @param string $prixReal
     *
     * @return Parameter
     */
    public function setPrixReal($prixReal)
    {
        $this->prixReal = $prixReal;

        return $this;
    }

    /**
     * Get prixReal
     *
     * @return string
     */
    public function getPrixReal()
    {
        return $this->prixReal;
    }

    /**
     * Set prixProd
     *
     * @param string $prixProd
     *
     * @return Parameter
     */
    public function setPrixProd($prixProd)
    {
        $this->prixProd = $prixProd;

        return $this;
    }

    /**
     * Get prixProd
     *
     * @return string
     */
    public function getPrixProd()
    {
        return $this->prixProd;
    }

    /**
     * Set numCompte
     *
     * @param string $numCompte
     *
     * @return Parameter
     */
    public function setNumCompte($numCompte)
    {
        $this->numCompte = $numCompte;

        return $this;
    }

    /**
     * Get numCompte
     *
     * @return string
     */
    public function getNumCompte()
    {
        return $this->numCompte;
    }

    /**
     * Set adresseAPIA
     *
     * @param string $adresseAPIA
     *
     * @return Parameter
     */
    public function setAdresseAPIA($adresseAPIA)
    {
        $this->adresseAPIA = $adresseAPIA;

        return $this;
    }

    /**
     * Get adresseAPIA
     *
     * @return string
     */
    public function getAdresseAPIA()
    {
        return $this->adresseAPIA;
    }

    /**
     * Set telAPIA
     *
     * @param string $telAPIA
     *
     * @return Parameter
     */
    public function setTelAPIA($telAPIA)
    {
        $this->telAPIA = $telAPIA;

        return $this;
    }

    /**
     * Get telAPIA
     *
     * @return string
     */
    public function getTelAPIA()
    {
        return $this->telAPIA;
    }

    /**
     * Set nomBanque
     *
     * @param string $nomBanque
     *
     * @return Parameter
     */
    public function setNomBanque($nomBanque)
    {
        $this->nomBanque = $nomBanque;

        return $this;
    }

    /**
     * Get nomBanque
     *
     * @return string
     */
    public function getNomBanque()
    {
        return $this->nomBanque;
    }

    /**
     * Set sIRETAPIA
     *
     * @param string $sIRETAPIA
     *
     * @return Parameter
     */
    public function setSIRETAPIA($sIRETAPIA)
    {
        $this->sIRETAPIA = $sIRETAPIA;

        return $this;
    }

    /**
     * Get sIRETAPIA
     *
     * @return string
     */
    public function getSIRETAPIA()
    {
        return $this->sIRETAPIA;
    }

    /**
     * @var string
     */
    private $numAPIA;


    /**
     * Set numAPIA
     *
     * @param string $numAPIA
     *
     * @return Parameter
     */
    public function setNumAPIA($numAPIA)
    {
        $this->numAPIA = $numAPIA;

        return $this;
    }

    /**
     * Get numAPIA
     *
     * @return string
     */
    public function getNumAPIA()
    {
        return $this->numAPIA;
    }
}
