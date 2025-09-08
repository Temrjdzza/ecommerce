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

            // Круговая диаграмма
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
        }

        // Инициализация при загрузке
        document.addEventListener('DOMContentLoaded', initCharts);