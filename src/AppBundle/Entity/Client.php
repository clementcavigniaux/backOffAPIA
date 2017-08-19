<?php

namespace AppBundle\Entity;


/**
 * Client
 */
class Client
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $nom;

    /**
     * @var array
     */
    private $type;

    /**
     * @var string
     */
    private $rue;

    /**
     * @var string
     */
    private $ville;

    /**
     * @var string
     */
    private $cP;

    /**
     * @var string
     */
    private $tel;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $sIRET;

    /**
     * @var string
     */
    private $iBAN;

    /**
     * @var string
     */
    private $interlocuteur;



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
     * Set nom
     *
     * @param string $nom
     *
     * @return Client
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set type
     *
     * @param array $type
     *
     * @return Client
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return array
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set rue
     *
     * @param string $rue
     *
     * @return Client
     */
    public function setRue($rue)
    {
        $this->rue = $rue;

        return $this;
    }

    /**
     * Get rue
     *
     * @return string
     */
    public function getRue()
    {
        return $this->rue;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return Client
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set cP
     *
     * @param string $cP
     *
     * @return Client
     */
    public function setCP($cP)
    {
        $this->cP = $cP;

        return $this;
    }

    /**
     * Get cP
     *
     * @return string
     */
    public function getCP()
    {
        return $this->cP;
    }

    /**
     * Set tel
     *
     * @param string $tel
     *
     * @return Client
     */
    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * Get tel
     *
     * @return string
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Client
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set sIRET
     *
     * @param string $sIRET
     *
     * @return Client
     */
    public function setSIRET($sIRET)
    {
        $this->sIRET = $sIRET;

        return $this;
    }

    /**
     * Get sIRET
     *
     * @return string
     */
    public function getSIRET()
    {
        return $this->sIRET;
    }

    /**
     * Set iBAN
     *
     * @param string $iBAN
     *
     * @return Client
     */
    public function setIBAN($iBAN)
    {
        $this->iBAN = $iBAN;

        return $this;
    }

    /**
     * Get iBAN
     *
     * @return string
     */
    public function getIBAN()
    {
        return $this->iBAN;
    }

    /**
     * Set interlocuteur
     *
     * @param string $interlocuteur
     *
     * @return Client
     */
    public function setInterlocuteur($interlocuteur)
    {
        $this->interlocuteur = $interlocuteur;

        return $this;
    }

    /**
     * Get interlocuteur
     *
     * @return string
     */
    public function getInterlocuteur()
    {
        return $this->interlocuteur;
    }
}
