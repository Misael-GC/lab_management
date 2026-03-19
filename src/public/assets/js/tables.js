document.addEventListener("DOMContentLoaded", () => {

    const ctx = document.getElementById("myAreaChart");
    if (!ctx) return;

    const clave = ctx.dataset.clave;

    // -------------------------------------
    // Inicializar gráfico vacío
    // -------------------------------------
    let chartInstance = new Chart(ctx, {
        type: "line",
        data: {
            labels: [],
            datasets: [{
                label: "Precio de cierre",
                data: [],
                tension: 0.3,
                borderWidth: 2,
                backgroundColor: "rgba(2,117,216,0.2)",
                borderColor: "rgba(2,117,216,1)",
                pointRadius: 0
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: true }},
            scales: {
                x: { grid: { display: false }},
                y: { grid: { color: "rgba(0,0,0,0.1)" }}
            }
        }
    });

    // -------------------------------------
    // Función para actualizar gráfico
    // -------------------------------------
    function updateChart(data) {
        const historial = [...data].reverse();
        chartInstance.data.labels = historial.map(r => r.fecha);
        chartInstance.data.datasets[0].data = historial.map(r => r.cierre);
        chartInstance.update();
    }

    // Cargar datos iniciales precargados desde PHP
    updateChart(window.HISTORIAL_DATA || []);

    // -------------------------------------
    // Evento botón de refrescar
    // -------------------------------------
    const btnRefresh = document.getElementById("btn-refresh");
    if (!btnRefresh) return;

    btnRefresh.addEventListener("click", async () => {

        const from = document.getElementById("filter-from")?.value || "";
        const to = document.getElementById("filter-to")?.value || "";

        // ---------------------------
        // ¿Qué hace esta línea?
        // const url = new URL("/historial/data", window.location.origin);
        //
        // R: Crea una URL absoluta segura:
        // https://tu-dominio.com/historial/data
        // ---------------------------
        const url = new URL("/historial/data", window.location.origin);

        // ---------------------------
        // ¿Qué hace searchParams.append?
        //
        // R: Agrega parámetros GET:
        // → /historial/data?clave=AC
        // ---------------------------
        url.searchParams.append("clave", clave);

        if (from) url.searchParams.append("from", from);
        if (to) url.searchParams.append("to", to);

        try {
            const res = await fetch(url.toString(), {
                credentials: "same-origin"
            });

            if (!res.ok) {
                const err = await res.json().catch(() => ({}));
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: err.error || "Error al obtener datos",
                    footer: '<a href="#">Comunicate con soporte</a>'
                });
                return;
            }

            const payload = await res.json();
            const historial = Array.isArray(payload.data) ? payload.data : [];

            updateChart(historial);

        } catch (error) {
            console.error("Error inesperado:", error);
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Error de servidor!",
                footer: '<a href="#">Comunicate con soporte</a>'
            });
        }

    });

});