# Документация API

## Эндпоинты

### Аутентификация пользователя

```
POST /login
```

Параметры запроса:

| Параметр  | Тип     | Описание                  | Пример значения                  |
|-----------|---------|---------------------------|----------------------------------|
| username | string  | Имя пользователя | "admin"                           |
| password     | string | Пароль пользователя   | "admin"                      |

### Total profit

```
GET /totalProfit
```

Параметры запроса:

| Параметр  | Тип     | Описание                  | Пример значения                  |
|-----------|---------|---------------------------|----------------------------------|
| period | string  | Выбор периода | day, week, month                           |

Пример запроса:

```
GET /totalProfit?period=day
```

Ответ:


```json
{
    "period": "week",
    "total_profit": "3579.14",
    "growth_percent": "77.98"
}
```

### Кнопка View all orders

```
GET /orderList
```
Ответ:


```json
[
    {
        "order_id": 46,
        "user_name": null,
        "product_name": "Gaming Keyboard",
        "quantity": 1,
        "total_price": "75.50",
        "created_at": "2025-09-07 20:06:10"
    },
```

### Market overview

```
GET /currencies
```

Параметры запроса:

| Параметр  | Тип     | Описание                  | Пример значения                  |
|-----------|---------|---------------------------|----------------------------------|
| crypto_id | string  | Валюта | bts, xrp, eth, zec                           |
| sort_by     | string | Сортировка   | week, day, month                      |

Пример запроса:

```
GET /currencies?crypto_id=bts&sort_by=day
```

Ответ:


```json
[
    {
        "date": "07.09.2025 05:06",
        "price": "110662.58"
    },
    {
        "date": "07.09.2025 06:03",
        "price": "110565.44"
    }
]
```

### Best Selling Product

```
GET /bestSelling
```

Пример запроса:

```
GET /bestSelling?page=3
```

| Параметр  | Тип     | Описание                  | Пример значения                  |
|-----------|---------|---------------------------|----------------------------------|
| page | int  | запрашиваемая страница | 1, 2, ...                           |

Ответ:


```json
{
    "page": 3,
    "per_page": 5,
    "total_items": 11,
    "total_pages": 3,
    "items": [
        {
            "id": 5,
            "name": "Science Journal",
            "total_sold": 45,
            "price": "8.90",
            "stock": 60
        }
    ]
}
```


### Top Sellers

```
GET /topSellers
```

Пример запроса:

```
GET /topSellers?page=1
```

| Параметр  | Тип     | Описание                  | Пример значения                  |
|-----------|---------|---------------------------|----------------------------------|
| page | int  | запрашиваемая страница | 1, 2, ...                           |

Ответ:


```json
{
    "page": 1,
    "per_page": 5,
    "total_items": 5,
    "total_pages": 1,
    "items": [
        {
            "id": 4,
            "name": "GadgetKing",
            "rating": 5,
            "total_sales": "220000.10"
        },
```

### Store Visits By source

```
GET /storeVisits
```

Пример запроса:

```
GET /storeVisits?date=2025-09-08
```

| Параметр  | Тип     | Описание                  | Пример значения                  | По умолчанию                  |
|-----------|---------|---------------------------|----------------------------------|----------------------------------|
| sort_by | string  | сортировка | report, alphabet, visits_desc visits_asc                           | report
| date | string  | запрашиваемая дата |  2025-09-08                          | curdate

Ответ:


```json
[
    {
        "source": "Referral",
        "total_visits": "400",
        "percentage": "13.33"
    },
    {
        "source": "Direct",
        "total_visits": "600",
        "percentage": "20.00"
    },
    {
        "source": "Email",
        "total_visits": "800",
        "percentage": "26.67"
    },
    {
        "source": "Social",
        "total_visits": "1200",
        "percentage": "40.00"
    }
]
```

### Property Referrals

```
GET /referrals
```

Пример запроса:

```
GET /referrals?date=2025-09-08
```

| Параметр  | Тип     | Описание                  | Пример значения                  | По умолчанию                  |
|-----------|---------|---------------------------|----------------------------------|----------------------------------|
| date | string  | запрашиваемая дата |  2025-09-08                          | curdate

Ответ:


```json
[
    {
        "channel": "Social Media",
        "clicks": 1200,
        "percentage": "24.40"
    },
    {
        "channel": "Marketplaces",
        "clicks": 1088,
        "percentage": "22.12"
    },
    {
        "channel": "Websites",
        "clicks": 996,
        "percentage": "20.25"
    },
    {
        "channel": "Digital Ads",
        "clicks": 902,
        "percentage": "18.34"
    },
    {
        "channel": "Others",
        "clicks": 732,
        "percentage": "14.88"
    }
]
```

### Store Visits By source

```
GET /portfolio
```

Пример запроса:

```
GET /portfolio?sort_by=price&order=desc&page=2
```

| Параметр  | Тип     | Описание                  | Пример значения                  | По умолчанию                  |
|-----------|---------|---------------------------|----------------------------------|----------------------------------|
| sort_by | string  | сортировка | Name, price, change_24h, total_balance, TotalCoin                           | Name
| order | string  | Сортировка по возр/убыв |  asc, desc                          | asc
| page | string  | Запрашиваемая страница |  1,2,3                          | 1

Ответ:


```json
{
    "page": 2,
    "per_page": 5,
    "total_items": 25,
    "total_pages": 5,
    "items": [
        {
            "Name": "solana",
            "price": "235.22",
            "change_24h": "-0.03",
            "total_balance": "2903.95",
            "TotalCoin": "12.34567890"
        },
        {
            "Name": "uniswap",
            "price": "9.32",
            "change_24h": "1.79",
            "total_balance": "239.10",
            "TotalCoin": "25.65478932"
        },
        {
            "Name": "polkadot",
            "price": "4.24",
            "change_24h": "1.30",
            "total_balance": "234.99",
            "TotalCoin": "55.42136987"
        },
        {
            "Name": "cardano",
            "price": "0.87",
            "change_24h": "0.92",
            "total_balance": "434.82",
            "TotalCoin": "500.25478912"
        },
        {
            "Name": "dogecoin",
            "price": "0.27",
            "change_24h": "1.00",
            "total_balance": "3190.28",
            "TotalCoin": "12000.56789123"
        }
    ]
}
```
