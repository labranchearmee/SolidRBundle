<?php

namespace Brickstorm\SolidRBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Translatable\Translatable;

/**
 * Brickstorm\SolidRBundle\Entity\Project
 */
class Project
{
  
    protected $locale;
    
    public function __toString() {
      return $this->name;
    }

    public function __construct()
    {
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
        $this->areas = new \Doctrine\Common\Collections\ArrayCollection();
        $this->cities = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function localCost() {
      return $this->unit_cost . ' ' . $this->devise;
    }

    
    public function userFees() {
      return round($this->userCost() * 0.1, 2);
    }
    
    public function userCost() {
      return round($this->convert('EURO'),2);
    }
    
    public function userTotalCost() {
      return round($this->userCost() + $this->userFees(), 2);
    }

    public function convert($devise) {
      switch ($devise) {
        case 'EURO':
          return round($this->unit_cost/656, 2);
        break;
      }
    }

    public function getAchievement()
    {
        return 100 * ($this->quantity_wanted - $this->quantity_remaining) / $this->quantity_wanted;
    }

    /**
     * Get quantities
     */
    public function getQuantityWanted()
    {
        if ($children = $this->getChildren()) {
          $qtty = 0;
          foreach($children as $child) {
            $qtty = $qtty + $child->getQuantityWanted();
          }
          return $qtty;
        } else {
          return $this->quantity_wanted;
        }
    }
    public function getQuantityRemaining()
    {
        if ($children = $this->getChildren()) {
          $qtty = 0;
          foreach($children as $child) {
            $qtty = $qtty + $child->getQuantityRemaining();
          }
          return $qtty;
        } else {
          return $this->quantity_remaining;
        }
    }

    /**
     * Get organization
     *
     * @return Brickstorm\SolidRBundle\Entity\Organization 
     */
    public function getOrganization()
    {
        return $this->getParent() ? $this->getParent()->getOrganization() : $this->organization;
    }


  // -- autogenerated
  
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $name
     */
    private $name;

    /**
     * @var text $description
     */
    private $description;

    /**
     * @var date $created_at
     */
    private $created_at;

    /**
     * @var datetime $updated_at
     */
    private $updated_at;

    /**
     * @var Brickstorm\SolidRBundle\Entity\Project
     */
    private $children;

    /**
     * @var Brickstorm\SolidRBundle\Entity\Project
     */
    private $parent;

    /**
     * @var Application\Sonata\UserBundle\Entity\User
     */
    private $creator;

    /**
     * @var Brickstorm\WorldBundle\Entity\City
     */
    public $cities;

    /**
     * @var Brickstorm\SolidRBundle\Entity\Area
     */
    public $areas;
    
    /**
     * @var float $unit_cost
     */
    private $unit_cost;

    /**
     * @var string $slug
     */
    private $slug;

    /**
     * @var Application\Sonata\MediaBundle\Entity\Media
     */
    public $medias;

    /**
     * @var Brickstorm\SolidRBundle\Entity\Action
     */
    private $actions;

    /**
     * @var string $devise
     */
    private $devise;

    /**
     * @var Brickstorm\SolidRBundle\Entity\Organization
     */
    private $organization;

    /**
     * @var integer $quantity_wanted
     */
    private $quantity_wanted;

    /**
     * @var integer $quantity_remaining
     */
    private $quantity_remaining;

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
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param text $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get description
     *
     * @return text 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set created_at
     *
     * @param date $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;
    }

    /**
     * Get created_at
     *
     * @return date 
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set updated_at
     *
     * @param datetime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;
    }

    /**
     * Get updated_at
     *
     * @return datetime 
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Add children
     *
     * @param Brickstorm\SolidRBundle\Entity\Project $children
     */
    public function addProject(\Brickstorm\SolidRBundle\Entity\Project $children)
    {
        $this->children[] = $children;
    }

    /**
     * Get children
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Set parent
     *
     * @param Brickstorm\SolidRBundle\Entity\Project $parent
     */
    public function setParent(\Brickstorm\SolidRBundle\Entity\Project $parent)
    {
        $this->parent = $parent;
    }

    /**
     * Get parent
     *
     * @return Brickstorm\SolidRBundle\Entity\Project 
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set creator
     *
     * @param Application\Sonata\UserBundle\Entity\User $creator
     */
    public function setCreator(\Application\Sonata\UserBundle\Entity\User $creator)
    {
        $this->creator = $creator;
    }

    /**
     * Get creator
     *
     * @return Application\Sonata\UserBundle\Entity\User 
     */
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * Add cities
     *
     * @param Brickstorm\WorldBundle\Entity\City $cities
     */
    public function addCity(\Brickstorm\WorldBundle\Entity\City $cities)
    {
        $this->cities[] = $cities;
    }

    /**
     * Get cities
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getCities()
    {
        return $this->cities;
    }


    /**
     * Add areas
     *
     * @param Brickstorm\SolidRBundle\Entity\Area $areas
     */
    public function addArea(\Brickstorm\SolidRBundle\Entity\Area $areas)
    {
        $this->areas[] = $areas;
    }

    /**
     * Get areas
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getAreas()
    {
        return $this->areas;
    }

    /**
     * Set unit_cost
     *
     * @param float $unitCost
     */
    public function setUnitCost($unitCost)
    {
        $this->unit_cost = $unitCost;
    }

    /**
     * Get unit_cost
     *
     * @return float 
     */
    public function getUnitCost()
    {
        return $this->unit_cost;
    }

    /**
     * Set slug
     *
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }


    /**
     * Add medias
     *
     * @param Application\Sonata\MediaBundle\Entity\Media $medias
     */
    public function addMedia(\Application\Sonata\MediaBundle\Entity\Media $medias)
    {
        $this->medias[] = $medias;
    }

    /**
     * Get medias
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getMedias()
    {
        return $this->medias;
    }

    /**
     * Add actions
     *
     * @param Brickstorm\SolidRBundle\Entity\Action $actions
     */
    public function addAction(\Brickstorm\SolidRBundle\Entity\Action $actions)
    {
        $this->actions[] = $actions;
    }

    /**
     * Get actions
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getActions()
    {
        return $this->actions;
    }

    /**
     * Set devise
     *
     * @param string $devise
     */
    public function setDevise($devise)
    {
        $this->devise = $devise;
    }

    /**
     * Get devise
     *
     * @return string 
     */
    public function getDevise()
    {
        return $this->devise;
    }

    /**
     * Set organization
     *
     * @param Brickstorm\SolidRBundle\Entity\Organization $organization
     */
    public function setOrganization(\Brickstorm\SolidRBundle\Entity\Organization $organization)
    {
        $this->organization = $organization;
    }


    /**
     * Set quantity_wanted
     *
     * @param integer $quantityWanted
     */
    public function setQuantityWanted($quantityWanted)
    {
        $this->quantity_wanted = $quantityWanted;
    }

    /**
     * Set quantity_remaining
     *
     * @param integer $quantityRemaining
     */
    public function setQuantityRemaining($quantityRemaining)
    {
        $this->quantity_remaining = $quantityRemaining;
    }
}