// Mengelola interaksi UI seperti toggle sidebar dan pembaruan slider
document.addEventListener('DOMContentLoaded', () => {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebar-overlay');
    const toggleButtons = document.querySelectorAll('[data-toggle-sidebar]');
    const rangeInputs = document.querySelectorAll('[data-range]');

    // Menampilkan dan menyembunyikan sidebar pada layar kecil
    const openSidebar = () => {
        if (!sidebar) return;
        sidebar.classList.remove('-translate-x-full');
        overlay?.classList.remove('hidden');
    };

    const closeSidebar = () => {
        if (!sidebar) return;
        sidebar.classList.add('-translate-x-full');
        overlay?.classList.add('hidden');
    };

    toggleButtons.forEach((button) => {
        button.addEventListener('click', () => {
            if (sidebar?.classList.contains('-translate-x-full')) {
                openSidebar();
            } else {
                closeSidebar();
            }
        });
    });

    overlay?.addEventListener('click', closeSidebar);

    // Memperbarui tampilan slider agar selaras dengan nilai terkini
    const updateSlider = (input) => {
        const targetId = input.getAttribute('id');
        const valueBadge = document.querySelector(`[data-range-value="${targetId}"]`);
        const min = Number(input.min ?? 1);
        const max = Number(input.max ?? 5);
        const current = Number(input.value ?? min);
        const percent = ((current - min) / (max - min)) * 100;

        input.style.background = `linear-gradient(90deg, #f9a8d4 ${percent}%, #fde2e4 ${percent}%)`;
        if (valueBadge) {
            valueBadge.textContent = current.toString();
        }
    };

    rangeInputs.forEach((input) => {
        updateSlider(input);
        input.addEventListener('input', () => updateSlider(input));
    });
});
