### service containers:
```bash
docker compose -f docker-compose.services.yml -p pcalerts-services up -d
```

### php and caddy containers:
```bash
docker compose up -d --build
```

```bash
docker exec -it pcalerts-php sh -c "php bin/console lexik:jwt:generate-keypair --skip-if-exists"
```
