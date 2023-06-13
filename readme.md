### Installation

Webserver and frontend components

### Shopify Partner Setup
https://partners.shopify.com/organizations

### Code Setup

```bash
composer install
npm install
```

```bash
npm run dev
# or
npm run dev -- --reset
```

After authenticating to shopify partner, don't forget to add the following to your .env file:

```bash
[SHOPIFY]
SHOPIFY_API_KEY=<See App Setup>
SHOPIFY_API_SECRET=<See App Setup>
SHOPIFY_APP_SCOPES=write_orders,write_shipping
SHOPIFY_APP_HOST_NAME="GENERATED STORE URL"
```
