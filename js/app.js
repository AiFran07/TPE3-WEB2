"use strict";

const BASE_URL = "api/";

let vehicles = [];

let form = document.querySelector("#vehicle-form");
form.addEventListener("submit", insertVehicle);

async function getAll() {
    try {
        const response = await fetch(BASE_URL + "vehiculos");
        if (!response.ok) {
            throw new Error("Error al obtener los vehículos");
        }

        vehicles = await response.json();
        showVehicles();
    } catch (error) {
        console.log(error);
    }
}

async function insertVehicle(e) {
    e.preventDefault();

    let data = new FormData(form);
    let vehicle = {
        marca: data.get("marca"),
        modelo: data.get("modelo"),
        anio: parseInt(data.get("anio")),
        precio: parseFloat(data.get("precio")),
    };

    try {
        let response = await fetch(BASE_URL + "vehiculos", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(vehicle),
        });
        if (!response.ok) {
            throw new Error("Error del servidor al insertar vehículo");
        }

        let newVehicle = await response.json();
        vehicles.push(newVehicle);
        showVehicles();

        form.reset();
    } catch (e) {
        console.log(e);
    }
}

async function deleteVehicle(e) {
    e.preventDefault();

    try {
        let id = e.target.dataset.vehicle;
        let response = await fetch(BASE_URL + "vehiculos/" + id, { method: "DELETE" });
        if (!response.ok) {
            throw new Error("Recurso no existe");
        }

        vehicles = vehicles.filter((vehicle) => vehicle.id != id);
        showVehicles();
    } catch (e) {
        console.log(e);
    }
}

function showVehicles() {
    let ul = document.querySelector("#vehicle-list");
    ul.innerHTML = "";
    for (const vehicle of vehicles) {
        let html = `
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span> 
                    <b>${vehicle.marca}</b> - ${vehicle.modelo} (${vehicle.anio}) - $${vehicle.precio}
                </span>
                <div class="ml-auto">
                    <a href="#" data-vehicle="${vehicle.id}" type="button" class="btn btn-small btn-danger btn-delete">Borrar</a>
                </div>
            </li>
        `;

        ul.innerHTML += html;
    }

    // Actualizo el contador
    let count = document.querySelector("#count");
    count.innerHTML = vehicles.length;

    // Asigno event listener para los botones de eliminar
    const btnsDelete = document.querySelectorAll("a.btn-delete");
    for (const btnDelete of btnsDelete) {
        btnDelete.addEventListener("click", deleteVehicle);
    }
}

getAll();
