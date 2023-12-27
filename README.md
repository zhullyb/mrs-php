```bash
docker run -d \
    -p 8080:80 \
    --name mrs-php \
    -v /path/to/uploads:/var/www/html/uploads \
    --restart unless-stopped \
    mrs-php
```