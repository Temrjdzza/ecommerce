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

        <!-- Третий слой - таблицы -->
        <div class="table-container">
            <div class="table-header">
                <div class="table-title">Best selling Products</div>
                <div class="table-filter">
                    <span class="filter-label">Sort By</span>
                    <select class="filter-select" id="productFilter">
                        <option value="day">День</option>
                        <option value="week">Неделя</option>
                        <option value="month">Месяц</option>
                    </select>
                </div>
            </div>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Продукт</th>
                        <th>Дата</th>
                        <th>Цена</th>
                        <th>Заказы</th>
                        <th>На складе</th>
                        <th>Количество</th>
                    </tr>
                </thead>
                <tbody id="productsTableBody">
                    <!-- Данные будут заполнены через JavaScript -->
                </tbody>
            </table>
            <div class="pagination-container" id="productsPaginationContainer">
                <div class="pagination-info" id="productsPaginationInfo"></div>
                <div class="pagination" id="productsPagination"></div>
            </div>
        </div>

        <div class="table-container">
            <div class="table-header">
                <div class="table-title">Top Sellers</div>
                <div class="table-filter">
                    <select class="filter-select" id="sellersFilter">
                        <option value="report">Отчет</option>
                        <option value="performance">Производительность</option>
                        <option value="sales">Продажи</option>
                    </select>
                </div>
            </div>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Продавец</th>
                        <th>Товар</th>
                        <th>Тип</th>
                        <th>Заказы</th>
                        <th>Выручка</th>
                        <th>% за месяц</th>
                    </tr>
                </thead>
                <tbody id="sellersTableBody">
                    <!-- Данные будут заполнены через JavaScript -->
                </tbody>
            </table>
            <div class="pagination-container" id="sellersPaginationContainer">
                <div class="pagination-info" id="sellersPaginationInfo"></div>
                <div class="pagination" id="sellersPagination"></div>
            </div>
        </div>

        <!-- Четвертый слой - Store visits и My currencies -->
        <div class="chart-container-small">
            <div class="chart-title">Store visits by Source</div>
            <div id="storeVisitsChart"></div>
        </div>

        <div class="currencies-container">
            <div class="table-header">
                <div class="table-title">My currencies</div>
                <div class="table-filter">
                    <select class="filter-select" id="currenciesFilter">
                        <option value="report">Get Report</option>
                        <option value="performance">Performance</option>
                        <option value="sales">Sales</option>
                    </select>
                </div>
            </div>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Coin Name</th>
                        <th>Price</th>
                        <th>24H Change</th>
                        <th>Total Balance</th>
                        <th>Total coin</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="currenciesTableBody">
                    <!-- Данные будут заполнены через JavaScript -->
                </tbody>
            </table>
            <div class="pagination-container" id="currenciesPaginationContainer">
                <div class="pagination-info" id="currenciesPaginationInfo">Showing 5 of 15 Results</div>
                <div class="pagination" id="currenciesPagination"></div>
            </div>
        </div>

        <!-- Пятый слой - Property Referrals -->
        <div class="chart-container-small" style="grid-column: span 4;">
            <div class="chart-title">Property Referrals</div>
            <div class="property-referrals-container">
                <div class="referrals-list">
                    <div class="referral-item">
                        <span class="referral-name">Social Media</span>
                        <span class="referral-value">85.71%</span>
                    </div>
                    <div class="referral-item">
                        <span class="referral-name">Marketplaces</span>
                        <span class="referral-value">77.67%</span>
                    </div>
                    <div class="referral-item">
                        <span class="referral-name">Websites</span>
                        <span class="referral-value">71.16%</span>
                    </div>
                    <div class="referral-item">
                        <span class="referral-name">Digital Ads</span>
                        <span class="referral-value">64.44%</span>
                    </div>
                    <div class="referral-item">
                        <span class="referral-name">Others</span>
                        <span class="referral-value">52.22%</span>
                    </div>
                </div>
                <div class="referrals-chart">
                    <div id="propertyReferralsChart"></div>
                </div>
            </div>
        </div>
    </div>
</section>