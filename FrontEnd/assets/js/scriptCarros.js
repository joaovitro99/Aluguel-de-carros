document.getElementById('filter-header').addEventListener('click', () => {
    const filterPanel = document.getElementById('filter-panel');
    const toggleIcon = document.getElementById('toggle-icon');

    if (filterPanel.style.display === 'none' || filterPanel.style.display === '') {
        filterPanel.style.display = 'block';
        toggleIcon.style.transform = 'rotate(180deg)'; // Rotaciona o ícone para baixo
    } else {
        filterPanel.style.display = 'none';
        toggleIcon.style.transform = 'rotate(0deg)'; // Rotaciona o ícone para cima
    }
});

document.querySelector('.filter-button').addEventListener('click', () => {
    const vehicleTypes = Array.from(document.querySelectorAll('.filter-checkbox:checked')).map(cb => cb.parentNode.textContent.trim());
    const luggageNumber = document.querySelector('select').value;

    console.log('Tipos de Veículo:', vehicleTypes);
    console.log('Número de malas:', luggageNumber);
    // Aqui você pode aplicar os filtros na lógica do backend ou manipulação do DOM
});

