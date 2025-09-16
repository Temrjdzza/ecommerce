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
