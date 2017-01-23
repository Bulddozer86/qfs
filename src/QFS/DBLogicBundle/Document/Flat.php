<?php

namespace QFS\DBLogicBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 */
class Flat
{
  /**
   * @MongoDB\Id
   */
  protected $id;

  /**
   * @MongoDB\Field(type="string")
  */
  protected $price;

  /**
   * @MongoDB\Field(type="int")
   */
  protected $rooms;

  /**
   * @MongoDB\Field(type="date")
   */
  protected $date;

  /**
   * @MongoDB\Field(type="string")
   */
  protected $headline;

  /**
   * @MongoDB\Field(type="string")
   */
  protected $district;

  /**
   * @MongoDB\Field(type="string")
   */
  protected $resource;

  /**
   * @MongoDB\Field(type="string")
   */
  protected $phones;

  /**
   * @MongoDB\Field(type="string")
   */
  protected $images;


    /**
     * Get id
     *
     * @return id $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set price
     *
     * @param string $price
     * @return $this
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    /**
     * Get price
     *
     * @return string $price
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set rooms
     *
     * @param int $rooms
     * @return $this
     */
    public function setRooms($rooms)
    {
        $this->rooms = $rooms;
        return $this;
    }

    /**
     * Get rooms
     *
     * @return int $rooms
     */
    public function getRooms()
    {
        return $this->rooms;
    }

    /**
     * Set date
     *
     * @param date $date
     * @return $this
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * Get date
     *
     * @return string $date
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set headline
     *
     * @param string $headline
     * @return $this
     */
    public function setHeadline($headline)
    {
        $this->headline = $headline;
        return $this;
    }

    /**
     * Get headline
     *
     * @return string $headline
     */
    public function getHeadline()
    {
        return $this->headline;
    }

    /**
     * Set district
     *
     * @param string $district
     * @return $this
     */
    public function setDistrict($district)
    {
        $this->district = $district;
        return $this;
    }

    /**
     * Get district
     *
     * @return string $district
     */
    public function getDistrict()
    {
        return $this->district;
    }

    /**
     * Set resource
     *
     * @param string $resource
     * @return $this
     */
    public function setResource($resource)
    {
        $this->resource = $resource;
        return $this;
    }

    /**
     * Get resource
     *
     * @return string $resource
     */
    public function getResource()
    {
        return $this->resource;
    }

    /**
     * Set phones
     *
     * @param string $phones
     * @return $this
     */
    public function setPhones($phones)
    {
        $this->phones = $phones;
        return $this;
    }

    /**
     * Get phones
     *
     * @return string $phones
     */
    public function getPhones()
    {
        return $this->phones;
    }

    /**
     * Set images
     *
     * @param string $images
     * @return $this
     */
    public function setImages($images)
    {
        $this->images = $images;
        return $this;
    }

    /**
     * Get images
     *
     * @return array $images
     */
    public function getImages()
    {
        return $this->images;
    }
}
