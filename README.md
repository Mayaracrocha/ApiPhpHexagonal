
# Repositorio utilizado para treinamentos sobre desenvolvimento de API

## Requisitos

- Docker
- Docker Compose

### Instalação para Desenvolvimento

- Instalar dependências do PHP usando Composer:

    `docker-compose run --rm php-fpm composer install`

- Criar e adicionar configuração no arquivo `.env`:

    `cp .env.local.dist .env`

- Executar servidor na url: http://localhost:8888

    `docker-compose up -d`

- Parar o servidor execute:

    `docker-compose stop`
    
### Comandos de Q&A

- Executar testes:

    `docker-compose run --rm php-fpm composer test`

- Executar testes, verificação do estilo de código e análise estática:

    `docker-compose run --rm php-fpm composer check`

- Corrigir estilo de código automaticamente com PHPCodeSniffer:

    `docker-compose run --rm php-fpm composer cs-fix`

- Gerar relatório de cobertura de testes no diretório `test/_reports`:

    `docker-compose run --rm php-fpm composer reports`