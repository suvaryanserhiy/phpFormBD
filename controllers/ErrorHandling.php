<?php

class ErrorHandling
{

    public function validteTableName($tableName)
    {
        if (is_numeric($tableName)) {
            throw new RuntimeException("Nombre de la tabla no puede ser vacia o numerica");
        }
        return true;
    }

    public function validateTableInsert($table, $name, $telefono, $direccion, $email)
    {
        $RegExName = "/^[a-zA-Z]+$/";
        $RegExTelefojno = "/^[0-9]{9}$/";
        $RegExEmail = "/\b[\w\.-]+@[\w\.-]+\.\w{2,4}\b/";

        if (!($this->validteTableName($table))) {
            return false;
        }
        if (preg_match($RegExName,$name) === 0){
            throw new RuntimeException('Nombre solo puede contener a-z y A-Z');
        }
        if (preg_match($RegExTelefojno,$telefono) === 0){
            throw new RuntimeException('El telefono solo puede contener 9 numeros de 0 a 9');
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            throw new RuntimeException('El email incorrecto. Ejemplo juan.carlos@insti.es');
        }
//        if (preg_match()){
//            throw new RuntimeException();
//        }

        return true;
    }

}