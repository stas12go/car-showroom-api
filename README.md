## 1. Получить список всех автомобилей

```bash
curl -X GET "http://localhost:80/api/v1/cars" \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" | jq
```

**Пример ответа:**
```json
[
  {
    "id": 1,
    "brand": {
      "id": 1,
      "name": "Toyota"
    },
    "photo": "/images/toyota-camry.jpg",
    "price": 2500000
  },
  {
    "id": 2,
    "brand": {
      "id": 1,
      "name": "Toyota"
    },
    "photo": "/images/toyota-corolla.jpg",
    "price": 1800000
  }
]
```

## 2. Получить детальную информацию об автомобиле

```bash
curl -X GET "http://localhost:80/api/v1/cars/1" \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" | jq
```

**Пример ответа:**
```json
{
  "id": 1,
  "brand": {
    "id": 1,
    "name": "Toyota"
  },
  "model": {
    "id": 1,
    "name": "Camry"
  },
  "photo": "/images/toyota-camry.jpg",
  "price": 2500000
}
```

## 3. Расчет кредита - успешный запрос

```bash
curl -X GET "http://localhost:80/api/v1/credit/calculate?price=2500000&initialPayment=200000.56&loanTerm=64" \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" | jq
```

**Пример ответа:**
```json
{
  "programId": 1,
  "interestRate": 12.3,
  "monthlyPayment": 24276,
  "title": "First Program"
}
```

## 4. Расчет кредита - с ошибками валидации

```bash
curl -X GET "http://localhost:80/api/v1/credit/calculate?price=-100&initialPayment=abc&loanTerm=200" \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" | jq
```

**Пример ответа:**
```json
{
  "errors": {
    "price": ["Цена должна быть положительной"],
    "initialPayment": ["Первоначальный взнос должен быть числом"],
    "loanTerm": ["Срок кредита должен быть не более 120 месяцев"]
  }
}
```

## 5. Создание кредитной заявки - успешный запрос

```bash
curl -X POST "http://localhost:80/api/v1/request" \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "carId": 1,
    "programId": 1,
    "initialPayment": 200000,
    "loanTerm": 64
  }' | jq
```

**Пример ответа:**
```json
{
  "success": true
}
```

## 6. Создание кредитной заявки - с ошибками валидации

```bash
curl -X POST "http://localhost:80/api/v1/request" \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "carId": 999,
    "programId": 999,
    "initialPayment": -100,
    "loanTerm": 200
  }' | jq
```

**Пример ответа:**
```json
{
  "errors": {
    "carId": ["Автомобиль не найден"],
    "programId": ["Кредитная программа не найдена"],
    "initialPayment": ["Первоначальный взнос не может быть отрицательным"],
    "loanTerm": ["Срок кредита должен быть не более 120 месяцев"]
  }
}
```
