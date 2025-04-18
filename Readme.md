# Crypto Rates API

---

## 🚀 Getting Started

### 1. Clone the repository
```bash
git clone git@github.com:bylasnoches/technical_assignment.git
```

### 2. Start the containers (Docker)
```bash
cd project
make up
```

### 3. Set up environment variables
```bash
cp docker/.env.dist docker/.env
```
 Open the newly created .env file and add your CoinMarketCap API key:
```
nano docker/.env
```
Start containers one more time to update envs:
```bash
make up
```

### 4. Enter the PHP container and install dependencies
```bash
make exec
composer install
```

### 5. Run migrations and load database fixtures
```bash
./bin/console doctrine:migrations:migrate
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

#### 📊 With optional time range:

```bash
curl --location '0.0.0.0:8110/api/rates?baseCurrency=BTC&quoteCurrency=USD&from=2025-04-18%2012%3A22%3A11.000000&to=2025-04-18%2012%3A29%3A14.000000'
```

## 🧪 Developer Tools (Inside Container)

You can run the following quality assurance tools **inside the PHP container**:

| Command         | Description                       |
|----------------|-----------------------------------|
| `make phpcs`    | Run PHP CodeSniffer (PSR-12)      |
| `make phpunit`  | Run PHPUnit tests                 |


## ✅ TODO

List of optional improvements:

- Add cron job or background worker for hourly updates
- Add PHP Mess Detector (phpmd)
- Add Psalm for static analysis
- Acceptance tests
- Integration tests