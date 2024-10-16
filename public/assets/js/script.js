
            function formatDate(value) {
                // Remove todos os caracteres não numéricos
                let digits = value.replace(/\D/g, '');
                if (digits.length <= 2) {
                    return digits;
                } else if (digits.length <= 4) {
                    return `${digits.slice(0, 2)}/${digits.slice(2)}`;
                } else {
                    return `${digits.slice(0, 2)}/${digits.slice(2, 4)}/${digits.slice(4, 8)}`;
                }
            }
            
            function formatTime(value) {
                // Remove todos os caracteres não numéricos
                let digits = value.replace(/\D/g, '');
                if (digits.length <= 2) {
                    return digits;
                } else {
                    return `${digits.slice(0, 2)}:${digits.slice(2, 4)}`;
                }
            }
            
            document.getElementById('date-picker').addEventListener('input', function(e) {
                e.target.value = formatDate(e.target.value);
            });
            
            document.getElementById('time-picker').addEventListener('input', function(e) {
                e.target.value = formatTime(e.target.value);
            });
            
            document.getElementById('date-return').addEventListener('input', function(e) {
                e.target.value = formatDate(e.target.value);
            });
            
            document.getElementById('time-return').addEventListener('input', function(e) {
                e.target.value = formatTime(e.target.value);
            });
            
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