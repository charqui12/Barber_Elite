document.getElementById("formCita").addEventListener("submit", function(e) {
    e.preventDefault(); // Evita recarga

    const datos = new FormData(this);

    fetch("../../backend/reservar_cita.php", {
        method: "POST",
        body: datos
    })
    .then(res => res.text())
    .then(data => {
        document.getElementById("respuestaCita").innerHTML = data;
        this.reset();
    })
    .catch(error => {
        console.error("Error:", error);
    });
});
