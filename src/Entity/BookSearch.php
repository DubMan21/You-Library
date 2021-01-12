<?php
namespace App\Entity;

class BookSearch {

  /**
   * @var Array(Category)|null
   */
  private $category;

  /**
   * @var string|null
   */
  private $search;

  /**
   * @var float|null
   */
  private $maxPrice;

  /**
   * @var float|null
   */
  private $minPrice;


  /**
   * Get the value of category
   *
   * @return Array(Category)|null
   */ 
  public function getCategory()
  {
    return $this->category;
  }

  /**
   * Set the value of category
   *
   * @param Array(Category)|null  $category
   *
   * @return  self
   */ 
  public function setCategory($category)
  {
    $this->category = $category;

    return $this;
  }

  /**
   * Get the value of search
   *
   * @return  string|null
   */ 
  public function getSearch()
  {
    return $this->search;
  }

  /**
   * Set the value of search
   *
   * @param  string|null  $search
   *
   * @return  self
   */ 
  public function setSearch($search)
  {
    $this->search = $search;

    return $this;
  }

  /**
   * Get the value of maxPrice
   *
   * @return  float|null
   */ 
  public function getMaxPrice()
  {
    return $this->maxPrice;
  }

  /**
   * Set the value of maxPrice
   *
   * @param  float|null  $maxPrice
   *
   * @return  self
   */ 
  public function setMaxPrice($maxPrice)
  {
    $this->maxPrice = $maxPrice;

    return $this;
  }

  /**
   * Get the value of minPrice
   *
   * @return  float|null
   */ 
  public function getMinPrice()
  {
    return $this->minPrice;
  }

  /**
   * Set the value of minPrice
   *
   * @param  float|null  $minPrice
   *
   * @return  self
   */ 
  public function setMinPrice($minPrice)
  {
    $this->minPrice = $minPrice;

    return $this;
  }
}