
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

            function clearFilters() {
                // Limpa os checkboxes
                const checkboxes = document.querySelectorAll('input[name="concessionarias[]"]');
                checkboxes.forEach(checkbox => {
                    checkbox.checked = false;
                });
            
                // Limpa o select de número de malas
                const selectNumMalas = document.querySelector('select[name="num_malas"]');
                selectNumMalas.selectedIndex = 0; // Seleciona o primeiro item (opção vazia)
            
                // Limpa os campos de preço
                const minPriceField = document.querySelector('input[name="min_price"]');
                const maxPriceField = document.querySelector('input[name="max_price"]');
                minPriceField.value = '';
                maxPriceField.value = '';
            
                // Recarrega a página para mostrar todos os carros
                window.location.href = window.location.pathname; // Redireciona para a mesma URL
            }
            
            // Adiciona um evento ao botão "Limpar filtro"
            document.getElementById('clear-filters-button').addEventListener('click', clearFilters);
            