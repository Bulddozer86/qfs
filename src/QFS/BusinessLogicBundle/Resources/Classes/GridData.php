<?php

namespace QFS\BusinessLogicBundle\Resources\Classes;

class GridData
{
  
  /**
   * count of columns by default 
  */
  const STEP = 3; 

  /**
   * @var array
  */
  protected $data;

  /**
   * @var int
  */
  protected $step;

  /**
   * Initial object
   *
   * @param $data array
   * @param $step int
  */
  public function __construct(array $data, $step = self::STEP)
  {
    $this->data = $data;
    $this->step = $step;
  }
  
  /**
   * Generate array of columns in grid 
  */
  protected function getColumns()
  {
    $cols = [];

    // init columns
    for ($i = 0; $i < $this->step; $i++) {
      $cols[] = $i;
    }

    return $cols;
  }

  /**
   * Splitting data by columns and rows
  */
  protected function buildGridData()
  {
    $cols = $this->getColumns();

    // get counts of rows
    $rows = round(count($this->data) / self::STEP, 0, PHP_ROUND_HALF_UP);
    $data = [];

    //build grid
    for ($i = 0; $i < $rows; $i++) {
      foreach ($cols as $k => &$v) {
        if (isset($this->data[$v])) {
          $data[$k][] = $this->data[$v];
        }

        $v = $v + $this->step;
      }
    }

    return $data;
  }

  /**
   * Returning grid data =)
  */
  public function getGridData()
  {
    return $this->buildGridData();
  }

  public function getStep()
  {
    return $this->step;
  }
}