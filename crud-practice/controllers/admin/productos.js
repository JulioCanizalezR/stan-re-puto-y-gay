const PRODUCTO_API = 'services/admin/producto.php';
// Constantes para establecer el contenido de la tabla.
const TABLE_BODY = document.getElementById('tableBody'),
    ROWS_FOUND = document.getElementById('rowsFound');

/*
*   Función asíncrona para llenar la tabla con los registros disponibles.
*   Parámetros: form (objeto opcional con los datos de búsqueda).
*   Retorno: ninguno.
*/
const fillTable = async (form = null) => {
    // Se inicializa el contenido de la tabla.
    ROWS_FOUND.textContent = '';
    TABLE_BODY.innerHTML = '';
    // Se verifica la acción a realizar.
    (form) ? action = 'readAll' : action = 'readAll';
    // Petición para obtener los registros disponibles.
    const DATA = await fetchData(PRODUCTO_API, 'readAll', form);
    // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
    if (DATA.status) {
        // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
        DATA.dataset.forEach(row => {
            // Se establece un icono para el estado del producto.
            (row.estado_producto) ? icon = 'bi bi-eye-fill' : icon = 'bi bi-eye-slash-fill';
            // Se crean y concatenan las filas de la tabla con los datos de cada registro.
            TABLE_BODY.innerHTML += `
            <tr>
                <td id="nombre">
                ${row.nombre_producto}
                </td>

                <td id="precio">
                ${row.nombre_precio}
                </td>

                <td id="marca"">
                ${row.nombre_marca}
                </td>
                
                <td>
                    <a onclick="openDelete(${row.id_producto}) class="no-decoration" >
                        <img src="../../resources/svg/trash.svg" alt="">
                    </a>
                    <a href="#" class="btn-editar" data-bs-toggle="modal" data-bs-target="#modal_editar_producto" onclick="openUpdate(${row.id_producto})">
                        <img src="../../resources/svg/edit.svg" alt="">
                    </a>
                </td>
            </tr>
            `;
        });
        // Se muestra un mensaje de acuerdo con el resultado.
        ROWS_FOUND.textContent = DATA.message;
    } else {
        sweetAlert(4, DATA.error, true);
    }
}

fillTable()