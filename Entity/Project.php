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

    
    public function userCost() {
      return $this->convert('EURO') . ' €';
    }

    public function convert($devise) {
      switch ($devise) {
        case 'EURO':
          return round($this->unit_cost * 0.0015, 2);
        break;
      }
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
     * @var Brickstorm\SolidRBundle\Entity\Action
     */
    private $actions;


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
     * @var string $devise
     */
    private $devise;


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
}