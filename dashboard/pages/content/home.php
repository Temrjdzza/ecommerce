<section class="content-section">
    <div class="dashboard">
        <!-- Первый слой - 4 блока информации -->
        <div class="info-block">
            <div class="info-left">
                <div class="info-title">Общая прибыль</div>
                <div class="info-value">$24,563.00</div>
                <a href="#" class="info-link">просмотреть все заказы</a>
            </div>
            <div class="info-right">
                <div class="prediction">
                    <span class="arrow-up">▲</span>
                    <span class="percentage positive">+12.5%</span>
                </div>
                <div class="money-icon">💰</div>
            </div>
        </div>

        <div class="info-block">
            <div class="info-left">
                <div class="info-title">Общая прибыль</div>
                <div class="info-value">$18,245.00</div>
                <a href="#" class="info-link">просмотреть все заказы</a>
            </div>
            <div class="info-right">
                <div class="prediction">
                    <span class="arrow-up">▲</span>
                    <span class="percentage positive">+8.3%</span>
                </div>
                <div class="money-icon">💰</div>
            </div>
        </div>

        <div class="info-block">
            <div class="info-left">
                <div class="info-title">Общая прибыль</div>
                <div class="info-value">$32,189.00</div>
                <a href="#" class="info-link">просмотреть все заказы</a>
            </div>
            <div class="info-right">
                <div class="prediction">
                    <span class="arrow-down">▼</span>
                    <span class="percentage negative">-3.2%</span>
                </div>
                <div class="money-icon">💰</div>
            </div>
        </div>

        <div class="info-block">
            <div class="info-left">
                <div class="info-title">Общая прибыль</div>
                <div class="info-value">$15,672.00</div>
                <a href="#" class="info-link">просмотреть все заказы</a>
            </div>
            <div class="info-right">
                <div class="prediction">
                    <span class="arrow-up">▲</span>
                    <span class="percentage positive">+5.7%</span>
                </div>
                <div class="money-icon">💰</div>
            </div>
        </div>

        <!-- Второй слой - диаграммы -->
        <div class="market-overview">
            <div class="chart-header">
                <div class="chart-title">Обзор рынка</div>
                <div class="time-filter">
                    <span class="time-option active" data-period="day">День</span>
                    <span class="time-option" data-period="week">Неделя</span>
                    <span class="time-option" data-period="month">Месяц</span>
                    <span class="time-option" data-period="year">Год</span>
                </div>
            </div>

            <div class="crypto-filter">
                <label class="crypto-option">
                    <input type="checkbox" data-crypto="bts" checked> BTS
                </label>
                <label class="crypto-option">
                    <input type="checkbox" data-crypto="xrp" checked> XRP
                </label>
                <label class="crypto-option">
                    <input type="checkbox" data-crypto="eth" checked> ETH
                </label>
                <label class="crypto-option">
                    <input type="checkbox" data-crypto="zec" checked> ZEC
                </label>
                
                <div class="theme-switcher">
                    <span>Тема:</span>
                    <label class="switch">
                        <input type="checkbox" id="theme-switch">
                        <span class="slider"></span>
                    </label>
                    <span>Тёмная</span>
                </div>
            </div>

            <div class="chart-container" id="marketChart"></div>
        </div>

        <div class="pie-chart">
            <div class="chart-title">Распределение активов</div>
            <div class="pie-container" id="pieChart"></div>
        </div>
    </div>
</section>