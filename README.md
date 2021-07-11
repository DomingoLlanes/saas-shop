# SaaS SHOP

Shop SaaS using DDD, PHP and Symfony

### System configuration

**Init docker**

```shell
make build
make start
```

**Testing**

```shell
make test
```

**Generate JWT keys**

```shell
cd etc/jwt/keys
ssh-keygen -t rsa -b 4096 -m PEM -f private.key
openssl rsa -in private.key -pubout -outform PEM -out public.key.pub
```
