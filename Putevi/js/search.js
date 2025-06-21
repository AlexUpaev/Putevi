document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.querySelector('.search-container input[name="search"]');
    const dataTable = document.querySelector('.data-table');
    let originalTableContent = dataTable.innerHTML;

    // Поиск при вводе текста с задержкой 300 мс
    searchInput.addEventListener('input', debounce(function() {
        const searchTerm = this.value.trim().toLowerCase();
        filterTable(searchTerm);
    }, 300));

    // Функция для фильтрации таблицы
    function filterTable(searchTerm) {
        if (!searchTerm) {
            // Восстанавливаем оригинальное содержимое таблицы
            dataTable.innerHTML = originalTableContent;
            return;
        }

        const rows = dataTable.querySelectorAll('tbody tr');
        let hasMatches = false;

        rows.forEach(row => {
            const cells = row.querySelectorAll('td:not(:last-child)');
            let rowMatches = false;

            cells.forEach(cell => {
                let cellText = '';
                const input = cell.querySelector('input, textarea, select');
                
                // Получаем текст из input или из содержимого ячейки
                if (input) {
                    if (input.tagName === 'SELECT') {
                        cellText = input.options[input.selectedIndex].text.toLowerCase();
                    } else {
                        cellText = input.value.toLowerCase();
                    }
                } else {
                    cellText = cell.textContent.toLowerCase();
                }

                // Проверяем совпадение
                if (cellText.includes(searchTerm)) {
                    rowMatches = true;
                    highlightCell(cell, searchTerm);
                } else {
                    cell.innerHTML = input ? input.outerHTML : cell.textContent;
                }
            });

            // Показываем/скрываем строку в зависимости от наличия совпадений
            row.style.display = rowMatches ? '' : 'none';
            hasMatches = hasMatches || rowMatches;
        });

        // Если нет совпадений, показываем сообщение
        const noResultsRow = document.getElementById('no-results-message');
        if (!hasMatches) {
            if (!noResultsRow) {
                const tr = document.createElement('tr');
                tr.id = 'no-results-message';
                const td = document.createElement('td');
                td.colSpan = dataTable.querySelector('thead tr').cells.length;
                td.textContent = 'Ничего не найдено';
                td.style.textAlign = 'center';
                td.style.padding = '20px';
                tr.appendChild(td);
                dataTable.querySelector('tbody').appendChild(tr);
            }
        } else if (noResultsRow) {
            noResultsRow.remove();
        }
    }

    // Функция подсветки совпадений
    function highlightCell(cell, searchTerm) {
        const input = cell.querySelector('input, textarea, select');
        
        if (input) {
            // Для полей ввода сохраняем оригинальный HTML
            cell.dataset.originalInput = input.outerHTML;
            let displayValue = '';
            
            if (input.tagName === 'SELECT') {
                displayValue = input.options[input.selectedIndex].text;
            } else {
                displayValue = input.value;
            }
            
            // Подсвечиваем совпадения
            cell.innerHTML = displayValue.replace(
                new RegExp(searchTerm.replace(/[.*+?^${}()|[\]\\]/g, '\\$&'), 'gi'),
                match => `<span class="highlight">${match}</span>`
            );
            
            // Восстанавливаем поле ввода при клике
            cell.addEventListener('click', function restoreInput() {
                if (!this.querySelector('input, textarea, select')) {
                    this.innerHTML = this.dataset.originalInput;
                    const restoredInput = this.querySelector('input, textarea, select');
                    restoredInput.focus();
                    
                    // Повторно применяем поиск при изменении
                    restoredInput.addEventListener('input', function() {
                        filterTable(searchInput.value.trim().toLowerCase());
                    });
                }
            }, { once: true });
        } else {
            // Для обычных ячеек просто подсвечиваем текст
            cell.innerHTML = cell.textContent.replace(
                new RegExp(searchTerm.replace(/[.*+?^${}()|[\]\\]/g, '\\$&'), 'gi'),
                match => `<span class="highlight">${match}</span>`
            );
        }
    }

    // Функция для добавления задержки перед поиском
    function debounce(func, wait) {
        let timeout;
        return function() {
            const context = this, args = arguments;
            clearTimeout(timeout);
            timeout = setTimeout(() => {
                func.apply(context, args);
            }, wait);
        };
    }
});