<?php
// Se incluye la clase para trabajar con la base de datos.
require_once('../../helpers/database.php');
/*
 *  Clase para manejar el comportamiento de los datos de la tabla administrador.
 */
class ProductoHandler
{
    /*
     *  Declaración de atributos para el manejo de datos.
     */
    protected $id = null;
    protected $producto = null;
    protected $precio = null;
    protected $marca = null;

    /*
     *  Métodos para realizar las operaciones SCRUD (search, create, read, update, and delete).
     */
    public function searchRows()
    {
        $value = '%' . Validator::getSearchValue() . '%';
        $sql = 'SELECT *
                FROM producto
                WHERE producto LIKE ? OR precio LIKE ? OR marca LIKE ?
                ORDER BY producto';
        $params = array($value, $value, $value);
        return Database::getRows($sql, $params);
    }

    public function createRow()
    {
        $sql = 'INSERT INTO producto(producto, precio, marca) 
        VALUES(?, ?, ?);';

        $params = array($this->producto, $this->precio, $this->marca);
        return Database::executeRow($sql, $params);
    }

    public function readAll()
    {
        $sql = 'SELECT producto, precio, marca FROM producto';
        return Database::getRows($sql);
    }

    public function readOne()
    {
        $sql = 'SELECT * FROM producto WHERE id= ?';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }

    public function updateRow()
    {
        $sql = 'UPDATE producto
                SET producto = ?, precio = ?, marca=?
                WHERE id = ?';
        $params = array($this->producto, $this->precio, $this->marca, $this->id);
        return Database::executeRow($sql, $params);
    }

    public function deleteRow()
    {
        $sql = 'DELETE FROM producto
                WHERE id = ?';
        $params = array($this->id);
        return Database::executeRow($sql, $params);
    }
}
