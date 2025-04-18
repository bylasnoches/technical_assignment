# Crypto Rates API

---

## 🚀 Getting Started

### 1. Clone the repository
```bash
git clone git@github.com:bylasnoches/technical_assignment.git
```

### 2. Set up environment variables
```bash
cp docker/.env.dist docker/.env
```
 Open the newly created .env file and add your CoinMarketCap API key:
```
nano docker/.env
```

### 3. Start the containers (Docker)
```bash
cd project
make up
```

### 4. Enter the PHP container and install dependencies
```bash
make exec
composer install
```

### 5. Load database fixtures
```bash
./bin/console doctrine:fixtures:load
```

### 6. Fetch and store crypto rates from CoinMarketCap and exit the container
```bash
./bin/console app:update-crypto-rates
exit
```

----------

## 📥 API Usage

The `/api/rates` endpoint allows you to retrieve historical crypto rates for a given currency pair, optionally filtered by time range.

| Parameter         | Type      | Required | Format                      | Description                                                               |
|-------------------|-----------|----------|------------------------------|---------------------------------------------------------------------------|
| `baseCurrency`    | `string`  | ✅ Yes   | Example: `BTC`              | The base cryptocurrency symbol to query (e.g., BTC, ETH).                |
| `quoteCurrency`   | `string`  | ✅ Yes   | Example: `USD`              | The quote currency symbol (e.g., USD, EUR).                          |
| `from`            | `string`  | ❌ No    | `Y-m-d H:i:s.u`             | Optional start time for filtering the rates.                             |
| `to`              | `string`  | ❌ No    | `Y-m-d H:i:s.u`             | Optional end time for filtering the rates.                               |

> 🕒 **Datetime format example:** `2025-04-18 12:22:11.123456`

---

### 🧪 Example Requests

#### Minimum valid request:

```bash
curl --location 'http://0.0.0.0:8110/api/rates?baseCurrency=BTC&quoteCurrency=USD'
```

