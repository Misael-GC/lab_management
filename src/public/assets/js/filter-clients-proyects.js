// Esperar a que el DOM esté cargado
document.addEventListener('DOMContentLoaded', function() {
    
    // Recuperar los datos desde el atributo data del HTML
    const dataContainer = document.getElementById('projects-data');
    if (!dataContainer) return;

    // Parsear el JSON que inyectó PHP en el HTML
    const allProjects = JSON.parse(dataContainer.dataset.json);
    
    const selectClient = document.getElementById('select-client');
    const selectProject = document.getElementById('select-project');

    if (!selectClient || !selectProject) return;

    selectClient.addEventListener('change', function() {
        const clientId = this.value;

        // Limpiar el select de proyectos
        selectProject.innerHTML = '<option value="" selected disabled>Select a project</option>';
        
        if (clientId) {
            // Filtrar proyectos (usamos == por si los tipos varían entre string/int)
            const filteredProjects = allProjects.filter(p => p.id_client == clientId);
            
            if (filteredProjects.length > 0) {
                filteredProjects.forEach(p => {
                    const option = document.createElement('option');
                    option.value = p.id;
                    option.textContent = p.name;
                    selectProject.appendChild(option);
                });
                selectProject.disabled = false;
            } else {
                const option = document.createElement('option');
                option.textContent = "No projects found for this client";
                option.disabled = true;
                selectProject.appendChild(option);
                selectProject.disabled = true;
            }
        } else {
            selectProject.disabled = true;
        }
    });
});