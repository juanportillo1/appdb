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

// Función para alternar la visibilidad de los submenús
function toggleSubmenu(submenuId) {
    var submenu = document.getElementById(submenuId);
    submenu.style.display = (submenu.style.display === "none" || submenu.style.display === "") ? "block" : "none";
}

// Función para inicializar los botones y formularios
function initButtons() {
    var mainContent = document.getElementById('main-content') || document.body;

    // Para productos
    mainContent.querySelectorAll('.update-button').forEach(button => {
        button.addEventListener('click', function() {
            var id = this.getAttribute('data-id');
            loadContent('/appdb/view/product/update_product.php?id=' + id);
        });
    });

    mainContent.querySelectorAll('.delete-button').forEach(button => {
        button.addEventListener('click', function() {
            var id = this.getAttribute('data-id');
            if (confirm('¿Estás seguro de que deseas eliminar este producto?')) {
                fetch('/appdb/controllers/productController.php?action=delete', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'id=' + id
                })
                .then(response => response.text())
                .then(data => {
                    alert(data);  // Mostrar mensaje de éxito o error
                    loadContent('/appdb/view/product/list_product.php');  // Recargar la lista de productos
                })
                .catch(error => {
                    console.error('Error al eliminar el producto:', error);
                });
            }
        });
    });

    var updateProductForm = mainContent.querySelector('#update-product-form');
    if (updateProductForm) {
        updateProductForm.addEventListener('submit', function(event) {
            event.preventDefault();
            var formData = new FormData(this);

            fetch(this.action, {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                alert(data);  // Mostrar mensaje de éxito o error
                loadContent('/appdb/view/product/list_product.php');  // Recargar la lista de productos
            })
            .catch(error => {
                console.error('Error al actualizar el producto:', error);
            });
        });
    }

    var addProductForm = mainContent.querySelector('#add-product-form');
    if (addProductForm) {
        addProductForm.addEventListener('submit', function(event) {
            event.preventDefault();
            var formData = new FormData(this);

            fetch(this.action, {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                alert(data);  // Mostrar mensaje de éxito o error
                loadContent('/appdb/view/product/list_product.php');  // Recargar la lista de productos
            })
            .catch(error => {
                console.error('Error al agregar el producto:', error);
            });
        });
    }

    // Para usuarios
    mainContent.querySelectorAll('.update-buttons').forEach(button => {
        button.addEventListener('click', function() {
            var id = this.getAttribute('data-id');
            loadContent('/appdb/view/user/update_user.php?id=' + id);
        });
    });

    mainContent.querySelectorAll('.delete-buttons').forEach(button => {
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
    var submenuLinks = document.querySelectorAll('.submenu a');
    submenuLinks.forEach(function(link) {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            var url = this.getAttribute('href');
            loadContent(url);
        });
    });

    initButtons();  // Inicializar botones y formularios al cargar la página
});
