const clave = window.HIST_CLAVE;
const from = document.getElementById("filter-from").value;
const to   = document.getElementById("filter-to").value;

document.getElementById("btn-export-csv").addEventListener("click", () => {
    dryURLget("/historial/export", from, to, clave, "csv");
});

document.getElementById("btn-export-excel").addEventListener("click", () => {
    dryURLget("/historial/export", from, to, clave, "excel");
});

let dryURLget = function(url, from, to, clave, format) {
    let urlObj = new URL(url, window.location.origin);
    urlObj.searchParams.append("clave", clave);
    urlObj.searchParams.append("format", format);
    if (from) urlObj.searchParams.append("from", from);
    if (to) urlObj.searchParams.append("to", to);
    
    Swal.fire({
        icon: "info",
        title: "Exportando...",
        text: "Si la descarga no inicia, verifica que no haya bloqueadores activos.",
    });
    
    setTimeout(() => {
        window.location.href = urlObj.toString();
    }, 1000);
}