<?php

class ErrorHandling
{

    public function validteTableName($tableName) //function to validate a table name. Couldn`t be a number
    {
        if (is_numeric($tableName)) {
            throw new RuntimeException("Nombre de la tabla no puede ser vacia o numerica");
        }
        return true;
    }

    public function validateTableInsert($table, $name, $telefono, $email)
    {
        $RegExName = "/^[a-zA-Z]+$/"; //regex for a name, letter from a to z, al least 1
        $RegExTelefono = "/^[0-9]{9}$/"; //regex for a tlf, number from 0 to 9, 9 times
        $RegExEmail = "/\b[\w\.-]+@[\w\.-]+\.\w{2,4}\b/"; // regex to validate an email, example: andrew-tate@top.gg


        //validating exceptions
        if (!($this->validteTableName($table))) {
            return false;
        }
        if (preg_match($RegExName,$name) === 0){
            throw new RuntimeException('Nombre solo puede contener a-z y A-Z');
        }
        if (preg_match($RegExTelefono,$telefono) === 0){
            throw new RuntimeException('El telefono solo puede contener 9 numeros de 0 a 9');
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            throw new RuntimeException('El email incorrecto. Ejemplo juan.carlos@insti.es');
        }
//        if (preg_match()){
//            throw new RuntimeException();  //template for future validations
//        }

        return true;
    }

}