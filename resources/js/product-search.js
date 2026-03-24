document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('search-input');
    const tableBody = document.getElementById('products-table-body');
    const paginationContainer = document.getElementById('pagination-container');

    if (!searchInput || !tableBody) return;

    let debounceTimer;

    const performSearch = async (url) => {
        try {
            const response = await fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            });

            if (!response.ok) {
                throw new Error('Error en la petición de búsqueda');
            }

            const data = await response.json();
            
            if (data.success) {
                tableBody.innerHTML = data.html;
                
                if (paginationContainer) {
                    if (data.links && data.links.trim() !== '') {
                        paginationContainer.innerHTML = `<div class="bg-white px-6 py-4 border-t border-slate-200">${data.links}</div>`;
                    } else {
                        paginationContainer.innerHTML = '';
                    }
                }
            }
        } catch (error) {
            console.error('Search failed:', error);
            if (window.showToast) {
                window.showToast('Ha ocurrido un error al cargar los productos.', 'error');
            }
        }
    };

    searchInput.addEventListener('input', (e) => {
        clearTimeout(debounceTimer);
        const searchQuery = e.target.value;
        
        // Esperamos 300ms luego de escribir para recargar
        debounceTimer = setTimeout(() => {
            const url = new URL(window.location.href);
            
            if (searchQuery.trim() !== '') {
                url.searchParams.set('search', searchQuery);
            } else {
                url.searchParams.delete('search');
            }
            
            // Reiniciar a la página 1 en una nueva búsqueda
            url.searchParams.delete('page');
            
            performSearch(url.toString());
            
            // Actualiza la barra del navegador
            window.history.pushState({}, '', url.toString());
        }, 300);
    });

    // Evitar que la paginación recargue la página (spa-like)
    if (paginationContainer) {
        paginationContainer.addEventListener('click', (e) => {
            const link = e.target.closest('a');
            if (link && link.href) {
                e.preventDefault();
                performSearch(link.href);
                window.history.pushState({}, '', link.href);
            }
        });
    }
});
