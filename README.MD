### service containers:
```bash
docker compose -f compose.services.yml -p pcalerts-services up -d
```

### php and caddy containers:
```bash
docker compose up -d --build
```

```bash
docker exec -it pcalerts-php sh -c "php bin/console lexik:jwt:generate-keypair --skip-if-exists"
```


Crons:
1. Advertisers table - done
2. Offers table - done
3. User table - done
4. Offer->Advertiser - to do
5. User->Advertiser - done
6. Caps Table - to do
