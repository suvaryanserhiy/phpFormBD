# phpFormBD
Exercise using php, form and BBDD

* Controllers directory is used for stores:

        ErrorHandling.php --> Handles errors
        OperationsConrtroller.php --> Managing a functionality of table

* Models directory is used for store next files:

      1. Database.php --> Connect to a Database
    
      2. Operations.php --> Stores and launch MySQL commands

* Views directory is used for stores a views of a page

        1. index.php -->  Home page (menu) to navigate through a different link
        2. creareTable.php --> Used for crete a new table
        3. insertData.php --> Used for inseet a new data into a table
        4. updateData.php --> Used for update data inside a table (For properly use requieres some
          knowledge in programming)
        5. showData.php --> Used for show a table data on the screen
* Setting.ini --> configuration file

<h1>Regex de creacion de la tabla</h1>

* Nombre de la tabla no puede ser in tipo int;
  * Ejemplo invalido:
    * 123
    * 43242
    * 1
  * Ejemplos validos
    * t1
    * 1r
    * agenda
    * Algo

<h1>Regex de insertacion en la tabla</h1>

* Nombre solo debe conteler letras a-z y A-Z
  * Ejemplo invalido:
  * Juan1
  * 43242
  * 1Pele
  * Ejemplos validos
    * agenda
    * Pele
    * Joaquin
    * Juan
* Telefono solo debe contener 9 numeros de 0 a 9
  * Ejempo invalido:
    * 12345678
    * 1ads21348
    * 123456789A
  * Ejemplo valido:
    * 123456789
    * 124323466
    * 984524534
* Email debe estar parecido a la plantilla:
  * 'andrew-tate@top.gg' (sin comillas)

    
