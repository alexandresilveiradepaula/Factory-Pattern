<?php

/* Classe Delete
* Essa classe provê meios para manipulação de de uma instrução de DELETE no BD
*/

final class TSqlDelete extends TSqlInstruction {

    /* Metodo getInstruction()
    * retorna a instrução de Delete em forma de String
    */
    public function getInstruction()
    {
        // monta a string do DELETE
        $this->sql = "DELETE FROM {$this->entity}";

        // retorna a clausula WHERE do objeto $this->criteria
        if($this->criteria) {

            $expression = $this->criteria->dump();
            if ($expression)
            {
                $this->sql .= 'WHERE' . $expression;
            }
            return $this->sql;
        }
    }

}
    ?>






