const selectContainers = document.querySelectorAll('.multiple-options-select');

selectContainers.forEach((container) => {
    const selectBtn = container.querySelector('.select-btn');
    const selectList = container.querySelector('.select-list');
    const options = container.querySelectorAll('.select-list__option');
    const btnText = selectBtn.querySelector('.select-btn__btn-text');
    const placeholder = container.getAttribute('data-placeholder');

    function closeSelect() {
        selectBtn.classList.remove('select-btn--active');
        selectList.classList.remove('select-list--active');
    }

    if (options.length === 0) {
        const noOptionsSpan = document.createElement('P');
        noOptionsSpan.classList.add('select-list__text--void');
        noOptionsSpan.innerText = 'Sin opciones para seleccionar';
        selectList.appendChild(noOptionsSpan);
    }

    selectBtn.addEventListener('click', () => {
        selectBtn.classList.toggle('select-btn--active');
        selectList.classList.toggle('select-list--active');
    });

    options.forEach((option) => {
        const checkbox = option.querySelector('.select-list__checkbox'); // Obtener el checkbox
    
        function updateButtonText() {
            const checked = Array.from(options).filter((opt) =>
                opt.querySelector('.select-list__checkbox').checked
            );
    
            if (checked.length > 0) {
                btnText.innerText = `${checked.length} seleccionados`;
            } else {
                btnText.innerText = placeholder;
            }
        }
    
        option.addEventListener('click', () => {
            checkbox.checked = !checkbox.checked; 
            updateButtonText(); 
        });
    
        checkbox.addEventListener('click', (e) => {
            e.stopPropagation(); 
            updateButtonText(); 
        });
    });

    selectList.addEventListener('click', (e) => {
        e.stopPropagation();
    });

    document.addEventListener('click', (e) => {
        if (!container.contains(e.target)) {
            closeSelect();
        }
    });

    btnText.innerText = placeholder;
});