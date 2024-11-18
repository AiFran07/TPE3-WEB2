<?php
require_once './app/models/vehicle.model.php';
require_once './app/views/json.view.php';

class VehicleApiController {
    private $model;
    private $view;

    public function __construct() {
        $this->model = new VehicleModel();
        $this->view = new JSONView();
    }

    // /api/vehiculos (GET)
    public function getAll($req, $res) {
        $vehicles = $this->model->getVehicles(); // Método en el modelo que obtiene todos los vehículos
        return $this->view->response($vehicles);
    }

    // /api/vehiculos/:id (GET)
    public function get($req, $res) {
        $id = $req->params->id;
        $vehicle = $this->model->getVehicle($id); // Método en el modelo para obtener un vehículo por ID

        if (!$vehicle) {
            return $this->view->response("El vehículo con el ID=$id no existe", 404);
        }

        return $this->view->response($vehicle);
    }

    // /api/vehiculos/:id (DELETE)
    public function delete($req, $res) {
        $id = $req->params->id;
        $vehicle = $this->model->getVehicle($id);

        if (!$vehicle) {
            return $this->view->response("El vehículo con el ID=$id no existe", 404);
        }

        $this->model->deleteVehicle($id); // Método para borrar un vehículo por ID
        return $this->view->response("El vehículo con el ID=$id se eliminó con éxito");
    }

    // /api/vehiculos (POST)
    public function create($req, $res) {
        if (empty($req->body->marca) || empty($req->body->modelo) || empty($req->body->anio) || empty($req->body->precio) || empty($req->body->categoria)) {
            return $this->view->response('Faltan completar datos', 400);
        }

        // Obtengo los datos
        $marca = $req->body->marca;
        $modelo = $req->body->modelo;
        $anio = $req->body->anio;
        $precio = $req->body->precio;
        $categoria = $req->body->categoria;

        // Inserto el vehículo
        $id = $this->model->insertVehicle($marca, $modelo, $anio, $precio, $categoria);

        if (!$id) {
            return $this->view->response("Error al insertar vehículo", 500);
        }

        // Devuelvo el recurso insertado
        $vehicle = $this->model->getVehicle($id);
        return $this->view->response($vehicle, 201);
    }

    // /api/vehiculos/:id (PUT)
    public function update($req, $res) {
        $id = $req->params->id;
        $vehicle = $this->model->getVehicle($id);

        if (!$vehicle) {
            return $this->view->response("El vehículo con el ID=$id no existe", 404);
        }

        if (empty($req->body->marca) || empty($req->body->modelo) || empty($req->body->anio) || empty($req->body->precio) || empty($req->body->categoria)) {
            return $this->view->response('Faltan completar datos', 400);
        }

        // Actualizo los datos
        $marca = $req->body->marca;
        $modelo = $req->body->modelo;
        $anio = $req->body->anio;
        $precio = $req->body->precio;
        $categoria = $req->body->categoria;

        $this->model->updateVehicle($id, $marca, $modelo, $anio, $precio, $categoria);

        // Devuelvo el recurso actualizado
        $vehicle = $this->model->getVehicle($id);
        return $this->view->response($vehicle, 200);
    }
}
