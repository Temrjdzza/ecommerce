// Переключение темы
        const themeSwitch = document.getElementById('theme-switch');
        themeSwitch.addEventListener('change', function() {
            document.body.classList.toggle('dark-theme');
            // Обновляем графики при смене темы
            updateChartsTheme();
        });

        // Активация временных фильтров
        document.querySelectorAll('.time-option').forEach(option => {
            option.addEventListener('click', function() {
                document.querySelectorAll('.time-option').forEach(opt => {
                    opt.classList.remove('active');
                });
                this.classList.add('active');
                updateMarketChart();
            });
        });

        // Обработка чекбоксов криптовалют
        document.querySelectorAll('.crypto-option input').forEach(checkbox => {
            checkbox.addEventListener('change', updateMarketChart);
        });

        // Данные для графиков
        const cryptoData = {
            bts: { name: 'BTS', color: '#008FFB' },
            xrp: { name: 'XRP', color: '#00E396' },
            eth: { name: 'ETH', color: '#FEB019' },
            zec: { name: 'ZEC', color: '#FF4560' }
        };

        const timeData = {
            day: ['09:00', '12:00', '15:00', '18:00', '21:00'],
            week: ['Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вс'],
            month: ['Нед1', 'Нед2', 'Нед3', 'Нед4'],
            year: ['Янв', 'Фев', 'Мар', 'Апр', 'Май', 'Июн', 'Июл', 'Авг', 'Сен', 'Окт', 'Ноя', 'Дек']
        };

        // Инициализация графиков
        let marketChart;
        let pieChart;
        let storeVisitsChart;

        function initCharts() {
            // Линейный график
            const marketOptions = {
                series: getActiveSeries(),
                chart: {
                    height: 300,
                    type: 'line',
                    zoom: {
                        enabled: true
                    },
                    animations: {
                        enabled: true,
                        easing: 'linear',
                        speed: 800
                    }
                },
                colors: getActiveColors(),
                stroke: {
                    curve: 'smooth',
                    width: 3
                },
                markers: {
                    size: 4
                },
                xaxis: {
                    categories: timeData.day
                },
                yaxis: {
                    labels: {
                        formatter: function(value) {
                            return '$' + value.toLocaleString();
                        }
                    }
                },
                tooltip: {
                    y: {
                        formatter: function(value) {
                            return '$' + value.toLocaleString();
                        }
                    }
                },
                grid: {
                    borderColor: 'rgba(0, 0, 0, 0.1)'
                }
            };

            marketChart = new ApexCharts(document.querySelector("#marketChart"), marketOptions);
            marketChart.render();

            // Круговая диаграмма распределения активов
            const pieOptions = {
                series: [30, 25, 20, 25],
                chart: {
                    type: 'donut',
                    height: 250
                },
                colors: ['#008FFB', '#00E396', '#FEB019', '#FF4560'],
                labels: ['BTS', 'XRP', 'ETH', 'ZEC'],
                plotOptions: {
                    pie: {
                        donut: {
                            size: '65%'
                        }
                    }
                },
                dataLabels: {
                    enabled: true,
                    formatter: function(val) {
                        return val.toFixed(1) + "%";
                    }
                },
                legend: {
                    position: 'bottom'
                },
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 200
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }]
            };

            pieChart = new ApexCharts(document.querySelector("#pieChart"), pieOptions);
            pieChart.render();

            // Круговая диаграмма Store visits
            const storeVisitsOptions = {
                series: [25, 28.9, 21.81, 13.59, 10.93],
                chart: {
                    type: 'pie',
                    height: 280
                },
                labels: ['Direct', 'Social', 'Email', 'Other', 'Referrals'],
                colors: ['#008FFB', '#00E396', '#FEB019', '#FF4560', '#775DD0'],
                legend: {
                    position: 'bottom',
                    fontSize: '12px'
                },
                dataLabels: {
                    enabled: true,
                    formatter: function (val) {
                        return val.toFixed(1) + "%";
                    },
                    dropShadow: {
                        enabled: false
                    }
                },
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 200
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }]
            };

            storeVisitsChart = new ApexCharts(document.querySelector("#storeVisitsChart"), storeVisitsOptions);
            storeVisitsChart.render();
        }

        function getActiveSeries() {
            const activeSeries = [];
            document.querySelectorAll('.crypto-option input:checked').forEach(checkbox => {
                const crypto = checkbox.dataset.crypto;
                // Генерируем случайные данные для демонстрации
                const data = Array.from({length: 5}, () => Math.floor(Math.random() * 10000) + 5000);
                activeSeries.push({
                    name: cryptoData[crypto].name,
                    data: data
                });
            });
            return activeSeries;
        }

        function getActiveColors() {
            const colors = [];
            document.querySelectorAll('.crypto-option input:checked').forEach(checkbox => {
                const crypto = checkbox.dataset.crypto;
                colors.push(cryptoData[crypto].color);
            });
            return colors;
        }

        function updateMarketChart() {
            const period = document.querySelector('.time-option.active').dataset.period;
            const series = getActiveSeries();
            const colors = getActiveColors();
            
            marketChart.updateOptions({
                series: series,
                colors: colors,
                xaxis: {
                    categories: timeData[period]
                }
            });
        }

        function updateChartsTheme() {
            const isDark = document.body.classList.contains('dark-theme');
            const textColor = isDark ? '#fff' : '#333';
            const gridColor = isDark ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.1)';
            
            marketChart.updateOptions({
                theme: {
                    mode: isDark ? 'dark' : 'light'
                },
                grid: {
                    borderColor: gridColor
                }
            });

            pieChart.updateOptions({
                theme: {
                    mode: isDark ? 'dark' : 'light'
                }
            });

            storeVisitsChart.updateOptions({
                theme: {
                    mode: isDark ? 'dark' : 'light'
                }
            });
        }

        // Инициализация при загрузке
        document.addEventListener('DOMContentLoaded', initCharts);
    // Данные для таблиц
    const productsData = [
        { id: 1, name: "iPhone 13 Pro", icon: "📱", date: "12.05.2023", price: "$999", orders: 245, stock: "В наличии", amount: 189 },
        { id: 2, name: "MacBook Air M2", icon: "💻", date: "11.05.2023", price: "$1199", orders: 189, stock: "Ограничено", amount: 45 },
        { id: 3, name: "AirPods Pro", icon: "🎧", date: "10.05.2023", price: "$249", orders: 356, stock: "В наличии", amount: 267 },
        { id: 4, name: "iPad Mini", icon: "📟", date: "09.05.2023", price: "$499", orders: 167, stock: "Нет на складе", amount: 0 },
        { id: 5, name: "Apple Watch S7", icon: "⌚", date: "08.05.2023", price: "$399", orders: 278, stock: "В наличии", amount: 132 },
        { id: 6, name: "Mac Studio", icon: "🖥️", date: "07.05.2023", price: "$1999", orders: 78, stock: "Ограничено", amount: 12 },
        { id: 7, name: "Magic Keyboard", icon: "⌨️", date: "06.05.2023", price: "$99", orders: 312, stock: "В наличии", amount: 245 },
        { id: 8, name: "Studio Display", icon: "🖥️", date: "05.05.2023", price: "$1599", orders: 45, stock: "В наличии", amount: 38 }
    ];

    const sellersData = [
        { id: 1, name: "Apple", seller: "Тим Кук", product: "iPhone 14", type: "Смартфон", icon: "🍎", orders: 1245, revenue: "$1,245,800", change: "+12.5%" },
        { id: 2, name: "Samsung", seller: "Джон Смит", product: "Galaxy S23", type: "Смартфон", icon: "📱", orders: 987, revenue: "$876,500", change: "+8.3%" },
        { id: 3, name: "Sony", seller: "Кенширо Йошида", product: "PlayStation 5", type: "Консоль", icon: "🎮", orders: 756, revenue: "$453,600", change: "+15.2%" },
        { id: 4, name: "Microsoft", seller: "Сатья Наделла", product: "Xbox Series X", type: "Консоль", icon: "🎮", orders: 632, revenue: "$379,200", change: "+5.7%" },
        { id: 5, name: "Nike", seller: "Майкл Джордан", product: "Air Jordan", type: "Обувь", icon: "👟", orders: 1245, revenue: "$1,120,500", change: "+9.8%" },
        { id: 6, name: "Adidas", seller: "Каспер Рорштед", product: "Ultraboost", type: "Обувь", icon: "👟", orders: 876, revenue: "$743,400", change: "+6.4%" },
        { id: 7, name: "Tesla", seller: "Илон Маск", product: "Model Y", type: "Автомобиль", icon: "🚗", orders: 234, revenue: "$10,530,000", change: "+18.2%" },
        { id: 8, name: "Amazon", seller: "Джефф Безос", product: "Echo Dot", type: "Умная колонка", icon: "🔊", orders: 1567, revenue: "$783,500", change: "+7.1%" }
    ];

    // Данные для таблицы валют
    const currenciesData = [
        { id: 1, name: "Bitcoin", symbol: "BTC", price: "$29,455.75", change: "+2.35%", balance: "$15,345.35", total: "0.5234 BTC" },
        { id: 2, name: "Ethereum", symbol: "ETH", price: "$1,834.22", change: "-1.27%", balance: "$8,234.22", total: "4.49 ETH" },
        { id: 3, name: "Cardano", symbol: "ADA", price: "$0.3456", change: "+5.63%", balance: "$1,456.78", total: "4,214.56 ADA" },
        { id: 4, name: "Solana", symbol: "SOL", price: "$45.67", change: "+7.89%", balance: "$3,456.78", total: "75.67 SOL" },
        { id: 5, name: "Polkadot", symbol: "DOT", price: "$6.78", change: "-2.34%", balance: "$987.65", total: "145.67 DOT" },
        { id: 6, name: "Dogecoin", symbol: "DOGE", price: "$0.0789", change: "+12.45%", balance: "$456.78", total: "5,789.01 DOGE" },
        { id: 7, name: "Ripple", symbol: "XRP", price: "$0.5678", change: "-0.89%", balance: "$1,234.56", total: "2,173.45 XRP" },
        { id: 8, name: "Litecoin", symbol: "LTC", price: "$89.01", change: "+3.45%", balance: "$2,345.67", total: "26.34 LTC" },
        { id: 9, name: "Chainlink", symbol: "LINK", price: "$12.34", change: "+6.78%", balance: "$876.54", total: "71.05 LINK" },
        { id: 10, name: "Polygon", symbol: "MATIC", price: "$0.9876", change: "-4.56%", balance: "$654.32", total: "662.71 MATIC" }
    ];

    // Настройки пагинации
    const itemsPerPage = 5;

    // Функция для отображения данных в таблице
    function renderTable(data, tableBodyId, page, itemsPerPage) {
        const tableBody = document.getElementById(tableBodyId);
        tableBody.innerHTML = '';
        
        const startIndex = (page - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;
        const paginatedData = data.slice(startIndex, endIndex);
        
        paginatedData.forEach(item => {
            const row = document.createElement('tr');
            
            if (tableBodyId === 'productsTableBody') {
                row.innerHTML = `
                    <td>
                        <div class="product-info">
                            <div class="product-icon">${item.icon}</div>
                            <div class="truncate-text">${item.name}</div>
                        </div>
                    </td>
                    <td>${item.date}</td>
                    <td>${item.price}</td>
                    <td>${item.orders}</td>
                    <td>${item.stock}</td>
                    <td>${item.amount}</td>
                `;
            } else if (tableBodyId === 'sellersTableBody') {
                row.innerHTML = `
                    <td>
                        <div class="seller-info">
                            <div class="seller-avatar">${item.icon}</div>
                            <div class="truncate-text">${item.seller}</div>
                        </div>
                    </td>
                    <td class="truncate-text">${item.product}</td>
                    <td>${item.type}</td>
                    <td>${item.orders}</td>
                    <td>${item.revenue}</td>
                    <td class="${item.change.includes('+') ? 'positive-change' : 'negative-change'}">${item.change}</td>
                `;
            } else if (tableBodyId === 'currenciesTableBody') {
                row.innerHTML = `
                    <td class="truncate-text">${item.name} (${item.symbol})</td>
                    <td>${item.price}</td>
                    <td class="${item.change.includes('+') ? 'positive-change' : 'negative-change'}">${item.change}</td>
                    <td>${item.balance}</td>
                    <td>${item.total}</td>
                    <td><button class="action-btn">Trade</button></td>
                `;
            }
            
            tableBody.appendChild(row);
        });
        
        return paginatedData.length;
    }

    // Функция для создания пагинации
    function setupPagination(data, paginationId, infoId, tableBodyId, itemsPerPage) {
        const paginationContainer = document.getElementById(paginationId);
        const paginationInfo = document.getElementById(infoId);
        const totalPages = Math.ceil(data.length / itemsPerPage);
        let currentPage = 1;
        
        function updatePagination() {
            paginationContainer.innerHTML = '';
            
            // Информация о текущей странице
            const itemsCount = renderTable(data, tableBodyId, currentPage, itemsPerPage);
            const startItem = (currentPage - 1) * itemsPerPage + 1;
            const endItem = startItem + itemsCount - 1;
            paginationInfo.textContent = `Показано ${startItem}-${endItem} из ${data.length} записей`;
            
            // Кнопки пагинации
            if (totalPages > 1) {
                // Кнопка "Назад"
                const prevButton = document.createElement('button');
                prevButton.className = 'pagination-btn';
                prevButton.innerHTML = '&laquo;';
                prevButton.disabled = currentPage === 1;
                prevButton.addEventListener('click', () => {
                    if (currentPage > 1) {
                        currentPage--;
                        updatePagination();
                    }
                });
                paginationContainer.appendChild(prevButton);
                
                // Нумерация страниц
                for (let i = 1; i <= totalPages; i++) {
                    const pageButton = document.createElement('button');
                    pageButton.className = `pagination-btn ${i === currentPage ? 'active' : ''}`;
                    pageButton.textContent = i;
                    pageButton.addEventListener('click', () => {
                        currentPage = i;
                        updatePagination();
                    });
                    paginationContainer.appendChild(pageButton);
                }
                
                // Кнопка "Вперед"
                const nextButton = document.createElement('button');
                nextButton.className = 'pagination-btn';
                nextButton.innerHTML = '&raquo;';
                nextButton.disabled = currentPage === totalPages;
                nextButton.addEventListener('click', () => {
                    if (currentPage < totalPages) {
                        currentPage++;
                        updatePagination();
                    }
                });
                paginationContainer.appendChild(nextButton);
            }
        }
        
        updatePagination();
    }

    // Инициализация таблиц при загрузке страницы
    document.addEventListener('DOMContentLoaded', function() {
        setupPagination(productsData, 'productsPagination', 'productsPaginationInfo', 'productsTableBody', itemsPerPage);
        setupPagination(sellersData, 'sellersPagination', 'sellersPaginationInfo', 'sellersTableBody', itemsPerPage);
        setupPagination(currenciesData, 'currenciesPagination', 'currenciesPaginationInfo', 'currenciesTableBody', itemsPerPage);
    });