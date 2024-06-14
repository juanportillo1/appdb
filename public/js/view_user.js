// Función para cargar contenido dinámicamente en el elemento con id 'main-content'
function loadContent(url) {
    fetch(url)
        .then(response => response.text())
        .then(html => {
            document.getElementById('main-content').innerHTML = html;
            initButtons();  // Inicializar botones después de cargar el contenido
        })
        .catch(error => {
            console.error('Error al cargar el contenido:', error);
        });
}

// Función para inicializar los botones y formularios
function initButtons() {
    var mainContent = document.getElementById('main-content') || document.body;

    // Para usuarios
    mainContent.querySelectorAll('.update-button').forEach(button => {
        button.addEventListener('click', function() {
            var id = this.getAttribute('data-id');
            loadContent('/appdb/view/user/update_user.php?id=' + id);
        });
    });

    // view_user.js

mainContent.querySelectorAll('.delete-button').forEach(button => {
    button.addEventListener('click', function() {
        var id = this.getAttribute('data-id');
        if (confirm('¿Estás seguro de que deseas eliminar este usuario?')) {
            fetch('/appdb/controllers/userController.php?action=delete', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'id=' + id
            })
            .then(response => response.text())
            .then(data => {
                alert(data);  // Mostrar mensaje de éxito o error
                loadContent('/appdb/view/user/list_user.php');  // Recargar la lista de usuarios
            })
            .catch(error => {
                console.error('Error al eliminar el usuario:', error);
            });
        }
    });
});


    // Para el formulario de actualización de usuarios
    var updateUserForm = mainContent.querySelector('#update-user-form');
    if (updateUserForm) {
        updateUserForm.addEventListener('submit', function(event) {
            event.preventDefault();
            var formData = new FormData(this);

            fetch(this.action, {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                alert(data);  // Mostrar mensaje de éxito o error
                loadContent('/appdb/view/user/list_user.php');  // Recargar la lista de usuarios
            })
            .catch(error => {
                console.error('Error al actualizar el usuario:', error);
            });
        });
    }
}

// Event listener para los enlaces del submenú
document.addEventListener('DOMContentLoaded', function() {
    initButtons();  // Inicializar botones y formularios al cargar la página
});
