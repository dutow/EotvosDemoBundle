<?php

namespace Eotvos\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Eotvos\VersenyrBundle\Entity\Round;

/**
 * Eotvos\DemoBundle\Entity\UploadRoundSecurityToken
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class UploadRoundSecurityToken
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $token
     *
     * @ORM\Column(name="token", type="string", length=255, unique=true)
     */
    private $token;

    /**
     * @var integer $term
     *
     * @ORM\Column(name="term", type="string", length=255)
     */
    private $term;

    /**
     * @var integer $round_id
     *
     * @ORM\ManyToOne(targetEntity="Eotvos\VersenyrBundle\Entity\Round")
     * @ORM\JoinColumn(name="round_id", referencedColumnName="id", nullable=false)
     */
    private $round_id;

    /**
     * @var integer $user_id
     *
     * @ORM\ManyToOne(targetEntity="Eotvos\VersenyrBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    private $user_id;

    /**
     * @var integer $created_at
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $created_at;

    /**
     * @var boolean $used_up;
     *
     * @ORM\Column(name="used_up", type="boolean", nullable=false)
     */
    private $used_up;

    public function __construct(){
      $this->created_at = new \DateTime();
      $this->token = uniqid("upltok", true);
      $this->used_up = false;
    }


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set token
     *
     * @param string $token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }

    /**
     * Get token
     *
     * @return string 
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set term
     *
     * @param integer $term
     */
    public function setTerm($term)
    {
        $this->term = $term;
    }

    /**
     * Get term
     *
     * @return integer 
     */
    public function getTerm()
    {
        return $this->term;
    }

    /**
     * Set round_id
     *
     * @param integer $roundId
     */
    public function setRound($roundId)
    {
        $this->round_id = $roundId;
    }

    /**
     * Get round_id
     *
     * @return integer 
     */
    public function getRound()
    {
        return $this->round_id;
    }

    /**
     * Set user_id
     *
     * @param integer $userId
     */
    public function setUser($userId)
    {
        $this->user_id = $userId;
    }

    /**
     * Get user_id
     *
     * @return integer 
     */
    public function getUser()
    {
        return $this->user_id;
    }

    /**
     * Set created_at
     *
     * @param datetime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;
    }

    /**
     * Get created_at
     *
     * @return datetime 
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function isStillValid(){
      if($this->getUsedUp()) return false;
      $minCreatedAt = new \DateTime();
      $minCreatedAt->sub(new \DateInterval("PT30M"));
      return ($this->created_at > $minCreatedAt);
    }

    /**
     * Set used_up
     *
     * @param boolean $usedUp
     */
    public function setUsedUp($usedUp)
    {
        $this->used_up = $usedUp;
    }

    /**
     * Get used_up
     *
     * @return boolean 
     */
    public function getUsedUp()
    {
        return $this->used_up;
    }

    /**
     * Set round_id
     *
     * @param Eotvos\DemoBundle\Entity\Round $roundId
     */
    public function setRoundId(\Eotvos\DemoBundle\Entity\Round $roundId)
    {
        $this->round_id = $roundId;
    }

    /**
     * Get round_id
     *
     * @return Eotvos\DemoBundle\Entity\Round 
     */
    public function getRoundId()
    {
        return $this->round_id;
    }

    /**
     * Set user_id
     *
     * @param Eotvos\DemoBundle\Entity\User $userId
     */
    public function setUserId(\Eotvos\DemoBundle\Entity\User $userId)
    {
        $this->user_id = $userId;
    }

    /**
     * Get user_id
     *
     * @return Eotvos\DemoBundle\Entity\User 
     */
    public function getUserId()
    {
        return $this->user_id;
    }
}
