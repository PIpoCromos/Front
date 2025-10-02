document.querySelector('.alarm-btn').addEventListener('click', function(e) {
    e.preventDefault();
    alert('¡Alerta activada! El personal ha sido notificado.');
});

// Cargar pacientes desde localStorage 
let pacientes = JSON.parse(localStorage.getItem("pacientes")) || [
{ nombre: "Juan", apellido: "Pérez", dni: "12345678", estado: "Internados" },
{ nombre: "María", apellido: "López", dni: "23456789", estado: "Urgencias" },
{ nombre: "Carlos", apellido: "Gómez", dni: "34567890", estado: "Altas" },
{ nombre: "Lucía", apellido: "Fernández", dni: "45678901", estado: "Fallecidos" }
];

// Guardar en localStorage
function guardarPacientes() {
localStorage.setItem("pacientes", JSON.stringify(pacientes));
}

// Elementos del DOM
const pacientesBtn = document.getElementById("pacientesBtn");
const pacientesModal = document.getElementById("pacientesModal");
const closeModal = document.getElementById("closeModal");
const searchInput = document.getElementById("searchInput");
const resultsList = document.getElementById("resultsList");

// Botón agregar paciente y su modal
const addPatientBtn = document.getElementById("addPatientBtn");
const addPatientModal = document.getElementById("addPatientModal");
const closeAdd = document.getElementById("closeAdd");
const addNombre = document.getElementById("addNombre");
const addApellido = document.getElementById("addApellido");
const addDNI = document.getElementById("addDNI");
const addEstado = document.getElementById("addEstado");
const savePatient = document.getElementById("savePatient");

// Modales de opciones, editar y estado
const patientOptionsModal = document.getElementById("patientOptionsModal");
const closeOptions = document.getElementById("closeOptions");
const patientNameTitle = document.getElementById("patientNameTitle");
const editBtn = document.getElementById("editBtn");
const stateBtn = document.getElementById("stateBtn");
const deleteBtn = document.getElementById("deleteBtn");

const editModal = document.getElementById("editModal");
const closeEdit = document.getElementById("closeEdit");
const editNombre = document.getElementById("editNombre");
const editApellido = document.getElementById("editApellido");
const editDNI = document.getElementById("editDNI");
const saveEdit = document.getElementById("saveEdit");

const stateModal = document.getElementById("stateModal");
const closeState = document.getElementById("closeState");
const estadoSelect = document.getElementById("estadoSelect");
const saveState = document.getElementById("saveState");

let pacienteSeleccionado = null;

// Abrir y cerrar modales 
pacientesBtn.addEventListener("click", () => {
pacientesModal.style.display = "flex";
searchInput.value = "";
resultsList.innerHTML = "";
searchInput.focus();
mostrarResultados(""); // mostrar todos al abrir
});

[closeModal, closeOptions, closeEdit, closeState, closeAdd].forEach(btn => {
btn.addEventListener("click", () => {
pacientesModal.style.display = "none";
patientOptionsModal.style.display = "none";
editModal.style.display = "none";
stateModal.style.display = "none";
addPatientModal.style.display = "none";
});
});

window.addEventListener("click", (e) => {
if (e.target === pacientesModal) pacientesModal.style.display = "none";
if (e.target === patientOptionsModal) patientOptionsModal.style.display = "none";
if (e.target === editModal) editModal.style.display = "none";
if (e.target === stateModal) stateModal.style.display = "none";
if (e.target === addPatientModal) addPatientModal.style.display = "none";
});

// Buscar paciente
searchInput.addEventListener("input", () => {
mostrarResultados(searchInput.value);
});

function mostrarResultados(termino) {
const term = termino.toLowerCase();
resultsList.innerHTML = "";

const resultados = pacientes.filter(p =>
`${p.nombre} ${p.apellido}`.toLowerCase().includes(term)
);

if (resultados.length === 0 && term !== "") {
resultsList.innerHTML = "<li>No se encontraron resultados</li>";
} else {
resultados.forEach(p => {
const li = document.createElement("li");
li.textContent = `${p.nombre} ${p.apellido} - ${p.estado}`;
li.style.cursor = "pointer";
li.addEventListener("click", () => seleccionarPaciente(p));
resultsList.appendChild(li);
});
}
}

// Seleccionar paciente
function seleccionarPaciente(paciente) {
pacienteSeleccionado = paciente;
patientNameTitle.textContent = `${paciente.nombre} ${paciente.apellido}`;
pacientesModal.style.display = "none";
patientOptionsModal.style.display = "flex";
}

// Editar paciente
editBtn.addEventListener("click", () => {
if (!pacienteSeleccionado) return;
editNombre.value = pacienteSeleccionado.nombre;
editApellido.value = pacienteSeleccionado.apellido;
editDNI.value = pacienteSeleccionado.dni;
patientOptionsModal.style.display = "none";
editModal.style.display = "flex";
});

saveEdit.addEventListener("click", () => {
if (!pacienteSeleccionado) return;
pacienteSeleccionado.nombre = editNombre.value;
pacienteSeleccionado.apellido = editApellido.value;
pacienteSeleccionado.dni = editDNI.value;
guardarPacientes();
alert("✅ Datos actualizados correctamente");
editModal.style.display = "none";
});

// Cambiar estado 
stateBtn.addEventListener("click", () => {
if (!pacienteSeleccionado) return;
estadoSelect.value = pacienteSeleccionado.estado;
patientOptionsModal.style.display = "none";
stateModal.style.display = "flex";
});

saveState.addEventListener("click", () => {
if (!pacienteSeleccionado) return;
pacienteSeleccionado.estado = estadoSelect.value;
guardarPacientes();
alert("✅ Estado actualizado correctamente");
stateModal.style.display = "none";
});

// Eliminar paciente 
deleteBtn.addEventListener("click", () => {
if (!pacienteSeleccionado) return;
pacientes = pacientes.filter(p => p !== pacienteSeleccionado);
guardarPacientes();
alert(`🗑️ Paciente ${pacienteSeleccionado.nombre} eliminado.`);
patientOptionsModal.style.display = "none";
pacienteSeleccionado = null;
});

// Agregar paciente 
addPatientBtn.addEventListener("click", () => {
pacientesModal.style.display = "none";
addNombre.value = "";
addApellido.value = "";
addDNI.value = "";
addEstado.value = "Internados";
addPatientModal.style.display = "flex";
});

savePatient.addEventListener("click", () => {
if (!addNombre.value || !addApellido.value || !addDNI.value) {
alert("⚠️ Completá todos los campos.");
return;
}

pacientes.push({
nombre: addNombre.value,
apellido: addApellido.value,
dni: addDNI.value,
estado: addEstado.value
});

guardarPacientes();
alert("✅ Paciente agregado correctamente");
addPatientModal.style.display = "none";
pacientesModal.style.display = "flex";
mostrarResultados(""); // recargar lista
});