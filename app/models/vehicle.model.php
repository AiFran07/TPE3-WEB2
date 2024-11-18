<?php

class VehicleModel {
    private $db;

    public function __construct() {
        // Cambiar el nombre de la base de datos 
        $this->db = new PDO('mysql:host=localhost;dbname=db_vehiculos;charset=utf8', 'root', '');
    }

    // Obtener todos los vehículos
    public function getVehicles($filterCategory = null, $orderBy = false) {
        $sql = 'SELECT * FROM vehiculos';

        // Filtrar  categoría 
        if ($filterCategory != null) {
            $sql .= ' WHERE categoria = ?';
        }

        // Ordenar por columna 
        if ($orderBy) {
            switch ($orderBy) {
                case 'marca':
                    $sql .= ' ORDER BY marca';
                    break;
                case 'modelo':
                    $sql .= ' ORDER BY modelo';
                    break;
                case 'precio':
                    $sql .= ' ORDER BY precio';
                    break;
                case 'año':
                    $sql .= ' ORDER BY año';
                    break;
            }
        }

        $query = $this->db->prepare($sql);
        if ($filterCategory != null) {
            $query->execute([$filterCategory]);
        } else {
            $query->execute();
        }

        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    // Obtener un vehículo por  ID
    public function getVehicle($id) {
        $query = $this->db->prepare('SELECT * FROM vehiculos WHERE id = ?');
        $query->execute([$id]);

        return $query->fetch(PDO::FETCH_OBJ); // Retorna el vehículo como un objeto
    }

    // Insertar un nuevo vehículo
    public function insertVehicle($marca, $modelo, $anio, $precio, $categoria) {
        $query = $this->db->prepare('INSERT INTO vehiculos (marca, modelo, año, precio, categoria) VALUES (?, ?, ?, ?, ?)');
        $query->execute([$marca, $modelo, $anio, $precio, $categoria]);

        return $this->db->lastInsertId(); // Retorna el ID del vehículo insertado
    }

    // Eliminar un vehículo por su ID
    public function deleteVehicle($id) {
        $query = $this->db->prepare('DELETE FROM vehiculos WHERE id = ?');
        $query->execute([$id]);
    }

    // Actualizar los datos de un vehículo
    public function updateVehicle($id, $marca, $modelo, $anio, $precio, $categoria) {
        $query = $this->db->prepare('UPDATE vehiculos SET marca = ?, modelo = ?, año = ?, precio = ?, categoria = ? WHERE id = ?');
        $query->execute([$marca, $modelo, $anio, $precio, $categoria, $id]);
    }
}
