document.addEventListener("DOMContentLoaded", function () {
    let myChart; // Variable global para almacenar el objeto de la gráfica

    const barrasButton = document.getElementById("barras");
    const pastelButton = document.getElementById("pastel");
    const donaButton = document.getElementById("dona");

    // Event listener para el botón de barras
    barrasButton.addEventListener("click", function () {
        obtenerDatosYDibujarGrafica("barras");
    });

    // Event listener para el botón de pastel
    pastelButton.addEventListener("click", function () {
        obtenerDatosYDibujarGrafica("pastel");
    });

    // Event listener para el botón de dona
    donaButton.addEventListener("click", function () {
        obtenerDatosYDibujarGrafica("dona");
    });

    // Función para obtener los datos de calificaciones del backend y dibujar la gráfica
    function obtenerDatosYDibujarGrafica(tipoGrafica) {
        $.ajax({
            url: "/files/getData",
            type: "POST",
            dataType: "json",
            data: {
                _token: $('meta[name="csrf-token"]').attr("content"), // El token CSRF
            },
            success: function (data) {
                // Procesar los datos para obtener los formatos requeridos por Chart.js
                const etiquetas = data.map((usuario) => usuario.nombre);
                const datos = data.map((usuario) => usuario.saldo);

                // Eliminar la gráfica existente si ya hay una
                if (myChart) {
                    myChart.destroy();
                }

                // Dibujar la nueva gráfica según el tipo seleccionado
                if (tipoGrafica === "barras") {
                    dibujarGraficaBarras(etiquetas, datos);
                } else if (tipoGrafica === "pastel") {
                    dibujarGraficaPastel(etiquetas, datos);
                } else if (tipoGrafica === "dona") {
                    dibujarGraficaDona(etiquetas, datos);
                }
            },
            error: function (xhr, status, error) {
                console.error("Error al obtener los datos:", error);
            },
        });
    }

    // Función para dibujar una gráfica de barras
    function dibujarGraficaBarras(labels, valores) {
        var ctx = document.getElementById("myChart").getContext("2d");
        myChart = new Chart(ctx, {
            type: "bar",
            data: {
                labels: labels,
                datasets: [
                    {
                        label: "Saldo",
                        data: valores,
                        backgroundColor: "rgba(255, 99, 132, 0.2)",
                        borderColor: "rgba(255, 99, 132, 1)",
                        borderWidth: 1,
                    },
                ],
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                    },
                },
            },
        });
    }

    // Función para dibujar una gráfica de pastel
    function dibujarGraficaPastel(labels, valores) {
        var ctx = document.getElementById("myChart").getContext("2d");
        myChart = new Chart(ctx, {
            type: "pie",
            data: {
                labels: labels,
                datasets: [
                    {
                        label: "Saldo",
                        data: valores,
                        backgroundColor: [
                            "rgba(255, 99, 132, 0.2)",
                            "rgba(54, 162, 235, 0.2)",
                            "rgba(255, 206, 86, 0.2)",
                            "rgba(75, 192, 192, 0.2)",
                        ],
                        borderColor: [
                            "rgba(255, 99, 132, 1)",
                            "rgba(54, 162, 235, 1)",
                            "rgba(255, 206, 86, 1)",
                            "rgba(75, 192, 192, 1)",
                        ],
                        borderWidth: 1,
                    },
                ],
            },
        });
    }

    // Función para dibujar una gráfica de dona
    function dibujarGraficaDona(labels, valores) {
        var ctx = document.getElementById("myChart").getContext("2d");
        myChart = new Chart(ctx, {
            type: "doughnut",
            data: {
                labels: labels,
                datasets: [
                    {
                        label: "Saldo",
                        data: valores,
                        backgroundColor: [
                            "rgba(255, 99, 132, 0.2)",
                            "rgba(54, 162, 235, 0.2)",
                            "rgba(255, 206, 86, 0.2)",
                            "rgba(75, 192, 192, 0.2)",
                        ],
                        borderColor: [
                            "rgba(255, 99, 132, 1)",
                            "rgba(54, 162, 235, 1)",
                            "rgba(255, 206, 86, 1)",
                            "rgba(75, 192, 192, 1)",
                        ],
                        borderWidth: 1,
                    },
                ],
            },
        });
    }
});
