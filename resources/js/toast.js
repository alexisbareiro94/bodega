export function showToast(message, type = 'success') {
    // Contenedor de Toasts
    let container = document.getElementById('toast-container');
    if (!container) {
        container = document.createElement('div');
        container.id = 'toast-container';
        container.className = 'fixed bottom-4 right-4 z-50 flex flex-col gap-3 pointer-events-none';
        document.body.appendChild(container);
    }

    const toast = document.createElement('div');
    const isSuccess = type === 'success';

    // Aplicamos colores según el tipo de alerta (éxito o error)
    const baseClasses = 'pointer-events-auto transform transition-all duration-300 translate-y-4 opacity-0 flex items-center p-4 w-full min-w-[300px] max-w-xs rounded-lg shadow-sm border';
    const colorClasses = isSuccess 
        ? 'bg-emerald-100 border-emerald-300 text-emerald-800' 
        : 'bg-red-100 border-red-300 text-red-800';
        
    toast.className = `${baseClasses} ${colorClasses}`;

    const iconColor = isSuccess ? 'text-emerald-700 bg-emerald-200' : 'text-red-700 bg-red-200';
    const iconPath = isSuccess
        ? '<path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />'
        : '<path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3Z" />';

    const btnClasses = isSuccess
        ? 'text-emerald-700 hover:text-emerald-900 focus:ring-emerald-400 hover:bg-emerald-200'
        : 'text-red-700 hover:text-red-900 focus:ring-red-400 hover:bg-red-200';

    toast.innerHTML = `
        <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 ${iconColor} rounded-lg">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                ${iconPath}
            </svg>
        </div>
        <div class="ml-3 text-sm font-bold mr-4">${message}</div>
        <button type="button" class="ml-auto -mx-1.5 -my-1.5 rounded-lg focus:ring-2 p-1.5 inline-flex items-center justify-center h-8 w-8 transition-colors ${btnClasses}">
            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    `;

    container.appendChild(toast);

    // Cerrar manualmente
    const closeBtn = toast.querySelector('button');
    closeBtn.addEventListener('click', () => {
        removeToast(toast);
    });

    // Animar entrada
    requestAnimationFrame(() => {
        setTimeout(() => {
            toast.classList.remove('translate-y-4', 'opacity-0');
            toast.classList.add('translate-y-0', 'opacity-100');
        }, 10);
    });

    // Remover automáticamente después de 3.5 segundos
    setTimeout(() => {
        removeToast(toast);
    }, 3500);
}

function removeToast(toast) {
    if (!toast) return;
    toast.classList.remove('translate-y-0', 'opacity-100');
    toast.classList.add('translate-y-4', 'opacity-0');
    setTimeout(() => {
        if (toast.parentNode) {
            toast.remove();
        }
    }, 300); // duracion de la transicion Tailwind
}

window.showToast = showToast;
