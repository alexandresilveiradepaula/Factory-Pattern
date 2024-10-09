<?php 

abstract class TSqlInstruction {

  protected $sql;
  protected $criteria;
  protected $entity;


  final public function setEntity($entity) {
    $this->entity = $entity;
  }

  final public function getEntity() {
    return $this->entity;
  }

  public function setCriteria(Tcriteria $criteria) {
    $this->criteria = $criteria;
  }
  abstract function getInstruction();

}
?>