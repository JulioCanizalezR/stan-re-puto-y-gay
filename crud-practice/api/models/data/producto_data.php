<?php
// Se incluye la clase para validar los datos de entrada.
require_once('../../helpers/validator.php');

// Se incluye la clase padre.
require_once('../../models/handlers/producto_handler.php');
/*
 *  Clase para manejar el encapsulamiento de los datos de la tabla USUARIO.
 */
class ProductoData extends ProductoHandler
{
    // Atributo genérico para manejo de errores.
    private $data_error = null;

    /*
     *  Métodos para validar y asignar valores de los atributos.
     */
    public function setId($value)
    {
        if (Validator::validateNaturalNumber($value)) {
            $this->id = $value;
            return true;
        } else {
            $this->data_error = 'El identificador del producto es incorrecto';
            return false;
        }
    }

    public function setProducto($value, $min = 2, $max = 50)
    {
        if (!Validator::validateAlphabetic($value)) {
            $this->data_error = 'El producto debe ser un valor alfabético';
            return false;
        } elseif (Validator::validateLength($value, $min, $max)) {
            $this->nombre = $value;
            return true;
        } else {
            $this->data_error = 'El producto debe tener una longitud entre ' . $min . ' y ' . $max;
            return false;
        }
    }

    public function setPrecio($value, $min = 0.01, $max = 999)
    {
        // Verifica si el valor pasado es un número válido
        if (!is_numeric($value)) {
            $this->data_error = 'El precio no es válido';
            return false;
        }
    
        // Convierte el valor a float para asegurar que sea un número decimal
        $precio = (float)$value;
    
        // Verifica si el precio está dentro del rango permitido
        if ($precio < $min || $precio > $max) {
            $this->data_error = 'El precio debe estar entre ' . $min . ' y ' . $max;
            return false;
        }
    
        // Si pasa ambas validaciones, actualiza el precio en la base de datos
        $this->precio = $precio;
        // Aquí iría el código para actualizar el precio en la base de datos, por ejemplo:
        // UPDATE producto SET precio = $precio WHERE id = $this->id;
        
        return true;
    }
    

    public function setMarca($value, $min = 2, $max = 50)
    {
        // Verifica si el valor pasado es una cadena válida
        if (!is_string($value)) {
            $this->data_error = 'La marca no es válida';
            return false;
        }

        // Verifica si la longitud de la marca está dentro del rango permitido
        if (strlen($value) < $min || strlen($value) > $max) {
            $this->data_error = 'La marca debe tener una longitud entre ' . $min . ' y ' . $max;
            return false;
        }

        // Si pasa ambas validaciones, actualiza la marca en el objeto
        $this->marca = $value;
        // Aquí iría el código para actualizar la marca en la base de datos, por ejemplo:
        // UPDATE producto SET marca = '$value' WHERE id = $this->id;
        
        return true;
    }

    // Método para obtener el error de los datos.
    public function getDataError()
    {
        return $this->data_error;
    }
}
