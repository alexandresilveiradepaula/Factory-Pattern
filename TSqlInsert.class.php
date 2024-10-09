<?php

final class TSqlInsert extends TSqlInstruction {

  private $columnValues;


  public function setRowData($column , $value) {

    if(is_scalar($value)) {
      if(is_string($value) and (!empty($value))){
        
        $value = addslashes($value);

        $this->columnValues[$column] = "'$value'";
      }
      else if(is_bool($value)) { 

        $this->columnValues[$column] = $value;

        $this->columnValues[$column] = $value ? 'TRUE': 'FALSE';
      }
      else if($value!==''){
        $this->columnValues[$column] = $value;
      }
      else 
      {
        $this->columnValues[$column] = "NULL";
      }
    }
  }

  public function setCriteria(Tcriteria $criteria)
  {
    throw new Exception("Cannot call setCRiteria from ".__CLASS__);
  }

  public function getInstruction(){

    $this->sql = "INSERT INTO {$this->entity} (";
    $columns = implode(',', array_keys($this->columnValues));

    $values = implode(',', array_values($this->columnValues));
    $this->sql .= $columns.')';
    $this->sql .= "values ({$values})";
    return $this->sql;
  } 
} 
    
?>