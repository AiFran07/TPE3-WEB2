# TPE3-WEB2


API REST para Gestión de Vehículos
Descripción del Proyecto
API REST para gestionar vehículos en una base de datos, incluye funcionalidad para listar, filtrar, agregar, modificar y eliminar vehículos. Esta diseñada para integrarse con otros sistemas como plataformas comerciales o aplicaciones para celular

Funcionalidades Principales:
Listar todos los vehículos, con opciones de ordenamiento y filtrado.
Obtener detalles de un vehículo específico por su ID.
Crear, actualizar y eliminar vehículos.
Autenticación mediante tokens JWT para acciones sensibles.

ENDPOINTS de la API

Endpoint: /usuarios/token
Método: GET
Descripción: Devuelve un token JWT para autenticación:

{
    "token": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."
}


Vehículos
Listar todos los vehículos
Endpoint: /api/vehiculos
Método: GET
Descripción: Devuelve una lista de todos los vehículos.
Opciones de Ordenamiento: ?sort=precio&order=asc
Opciones de Filtrado: ?categoria=SUV
    {
        "id": 1,
        "marca": "Toyota",
        "modelo": "Corolla",
        "año": 2020,
        "precio": 20000.00,
        "categoria": "Sedan"
    }

Obtener un vehículo por ID
Endpoint: /api/vehiculos/:id
Método: GET
Descripción: Devuelve los detalles de un vehículo específico
{
    "id": 1,
    "marca": "Toyota",
    "modelo": "Corolla",
    "año": 2020,
    "precio": 20000.00,
    "categoria": "Sedan"
}


Crear un vehículo
Endpoint: /api/vehiculos
Método: POST
{
    "id": 5,
    "marca": "Chevrolet",
    "modelo": "Tracker",
    "año": 2023,
    "precio": 28000.00,
    "categoria": "SUV"
}


Modificar un vehículo
Endpoint: /api/vehiculos/:id
Método: PUT
{
    "marca": "Chevrolet",
    "modelo": "Tracker",
    "año": 2024,
    "precio": 29000.00,
    "categoria": "SUV"
}

Eliminar un vehículo
Endpoint: /api/vehiculos/:id
Método: DELETE
Descripción: Elimina un vehículo por su ID.
Respuesta: 200 OK

Códigos de Estado
200: Operación exitosa.
201: Recurso creado exitosamente.
400: Error en la solicitud (datos inválidos).
404: Recurso no encontrado.





    
    


