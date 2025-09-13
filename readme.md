# Документация API

## Эндпоинты

### 1. Аутентификация пользователя

```
POST /login
```

Параметры запроса:

| Параметр  | Тип     | Описание                  | Пример значения                  |
|-----------|---------|---------------------------|----------------------------------|
| username | string  | Имя пользователя | "admin"                           |
| password     | string | Пароль пользователя   | "admin"                      |

### 2. Market overview

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

### 3. Best Selling Product

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

#### Кнопка View all orders

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


### 4. Best Selling Product

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

