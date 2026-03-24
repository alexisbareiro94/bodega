document.addEventListener('DOMContentLoaded', () => {

    // Calcula el margen de ganancia automáticamente
    const costInput = document.getElementById('product_cost');
    const priceInput = document.getElementById('product_price');
    const marginDisplay = document.getElementById('profit_margin');

    function calculateMargin() {
        if (!costInput || !priceInput || !marginDisplay) return;

        const cost = parseFloat(costInput.value) || 0;
        const price = parseFloat(priceInput.value) || 0;

        if (cost > 0 && price >= cost) {
            const margin = ((price - cost) / price) * 100;
            marginDisplay.textContent = margin.toFixed(2) + '%';

            // Visual feedback
            marginDisplay.className = margin > 20
                ? 'ml-2 font-semibold text-emerald-600'
                : 'ml-2 font-semibold text-amber-500';
        } else if (price > 0 && price < cost) {
            // Perdida
            const loss = ((cost - price) / cost) * 100;
            marginDisplay.textContent = '-' + loss.toFixed(2) + '% (Pérdida)';
            marginDisplay.className = 'ml-2 font-semibold text-red-500';
        } else {
            marginDisplay.textContent = '0.00%';
            marginDisplay.className = 'ml-2 font-semibold text-slate-500';
        }
    }

    if (costInput && priceInput) {
        costInput.addEventListener('input', calculateMargin);
        priceInput.addEventListener('input', calculateMargin);
        // Inicializar el valor si hay old data
        calculateMargin();
    }

    // Image Preview Logic
    const imageInput = document.getElementById('image_input');
    const imagePreview = document.getElementById('image_preview');
    const imagePlaceholder = document.getElementById('image_placeholder');
    const removeImageBtn = document.getElementById('remove_image_btn');

    function resetImagePreview() {
        imageInput.value = '';
        imagePreview.src = '#';
        imagePreview.classList.add('hidden');
        imagePlaceholder.classList.remove('hidden');
        removeImageBtn.classList.add('hidden');
    }

    if (imageInput) {
        imageInput.addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    imagePreview.src = e.target.result;
                    imagePreview.classList.remove('hidden');
                    imagePlaceholder.classList.add('hidden');
                    removeImageBtn.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            } else {
                resetImagePreview();
            }
        });
    }

    if (removeImageBtn) {
        removeImageBtn.addEventListener('click', resetImagePreview);
    }

    // Modal Logic
    const modals = {
        category: document.getElementById('modal_category'),
        distributor: document.getElementById('modal_distributor')
    };

    function showModal(modal) {
        if (!modal) return;
        modal.classList.remove('hidden');
        setTimeout(() => {
            modal.querySelector('.backdrop-blur-sm')?.classList.remove('opacity-0');
            modal.querySelector('[id$="_panel"]')?.classList.remove('opacity-0', 'translate-y-4', 'sm:scale-95');
        }, 10);
    }

    function hideModal(modal) {
        if (!modal) return;
        modal.querySelector('.backdrop-blur-sm')?.classList.add('opacity-0');
        modal.querySelector('[id$="_panel"]')?.classList.add('opacity-0', 'translate-y-4', 'sm:scale-95');
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }

    // Overlay Event Listeners
    document.getElementById('btn_add_category')?.addEventListener('click', () => showModal(modals.category));
    document.getElementById('btn_add_distributor')?.addEventListener('click', () => showModal(modals.distributor));

    document.querySelectorAll('.close-modal').forEach(btn => {
        btn.addEventListener('click', (e) => {
            hideModal(modals[e.target.dataset.target.replace('modal_', '')]);
        });
    });

    const tokenElement = document.querySelector('meta[name="csrf-token"]');
    const csrfToken = tokenElement ? tokenElement.getAttribute('content') : '';

    async function submitFetchForm(url, data, errorEl) {
        try {
            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify(data)
            });
            const resData = await response.json();
            if (!response.ok) {
                if (resData.errors) {
                    throw new Error(Object.values(resData.errors)[0][0]);
                }
                throw new Error(resData.message || 'Error occurred');
            }
            return resData;
        } catch (error) {
            if (errorEl) {
                errorEl.textContent = error.message;
                errorEl.classList.remove('hidden');
            }
            throw error;
        }
    }

    // Save Category
    document.getElementById('btn_save_category')?.addEventListener('click', async () => {
        const form = document.querySelector('form#form_category');
        const errorEl = document.getElementById('error_category_name');
        if (errorEl) errorEl.classList.add('hidden');

        const data = { name: document.getElementById('category_name').value };

        try {
            const res = await submitFetchForm(form.dataset.url, data, errorEl);
            if (res.success) {
                const select = document.getElementById('category_id');
                const opt = new Option(res.category.name, res.category.id, true, true);
                select.add(opt);
                form.reset();
                hideModal(modals.category);
                window.showToast('Categoría creada exitosamente', 'success');
            }
        } catch (e) {
            window.showToast(e.message, 'error');
        }
    });

    // Save Distributor
    document.getElementById('btn_save_distributor')?.addEventListener('click', async () => {
        const form = document.querySelector('form#form_distributor');
        const errorEl = document.getElementById('error_distributor_name');
        if (errorEl) errorEl.classList.add('hidden');

        const data = {
            name: document.getElementById('distributor_name').value,
            phone: document.getElementById('distributor_phone').value || null,
            email: document.getElementById('distributor_email').value || null,
            address: document.getElementById('distributor_address').value || null
        };

        try {
            const res = await submitFetchForm(form.dataset.url, data, errorEl);
            if (res.success) {
                const select = document.getElementById('distributor_id');
                const opt = new Option(res.distributor.name, res.distributor.id, true, true);
                select.add(opt);
                document.getElementById('form_distributor').reset();
                hideModal(modals.distributor);
                window.showToast('Distribuidor creado exitosamente', 'success');
            }
        } catch (e) {
            window.showToast(e.message, 'error');
        }
    });
});
