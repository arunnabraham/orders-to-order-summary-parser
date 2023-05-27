# Orders to Order Summary Parser

The objective of the application is to parse jsonl format of orders and get its summary

# Sample Output

```json
{
  "orderData": [
    {
      "order_id": "88948419",
      "order_date": "2022-03-27",
      "total_order_value": 1205.52,
      "average_unit_price": 100.46,
      "unit_count": 12,
      "customer_state": "New South Wales"
    },
    ...
  ]
}
```

# Requirements

* PHP v8.2.*
* Symfony 6.2

# Tested Env

* Linux (Alpine Docker)

# Quick Start
* Make sure to add .env key `ORDER_INFO_PATH=/absolute/path/for/import/coding-challenge-1.jsonl`
* After git clone change directory to ``/app-root``
* run `symfony server:start` (requires symfony cli)
* In browser go to order path `/order-summary` for the output

# Tests

* Run `composer test`

# Additional info

### Libraries used

<a target="_blank" href="https://github.com/moneyphp/money">PHP Money</a>

<a target="_blank" href="https://github.com/sunaoka/ndjson">NDJSON Parser Library</a>


