# Exemplo local — IOT Hub

O repositório inclui um painel web em Laravel para administrar **ambientes** e **sensores**, com dados demonstrativos para experimentar a interface.

## Requisitos

- PHP 8.2+ com extensões SQLite, Mbstring, XML e cURL
- Composer

## Executar localmente

Na raiz do projeto:

```bash
composer install
cp .env.example .env
php artisan key:generate
mkdir -p database && touch database/database.sqlite
```

No `.env`, confirme a conexão SQLite:

```dotenv
DB_CONNECTION=sqlite
DB_DATABASE=/caminho/absoluto/para/Projeto-IOT/database/database.sqlite
```

Depois rode as migrations, carregue os dados de exemplo e inicie o servidor:

```bash
php artisan migrate:fresh --seed
php artisan serve
```

Acesse `http://127.0.0.1:8000`. O banco usa SQLite e fica em `database/database.sqlite`; `migrate:fresh --seed` recria esse banco e repõe os exemplos.

## O que experimentar

- `/dashboard`: resumo e atalhos.
- `/ambientes`: listar, cadastrar, editar e excluir ambientes.
- `/sensores`: listar, cadastrar, editar e excluir sensores associados a ambientes.

O seeder inclui Sala de estar, Cozinha e Varanda, com sensores de temperatura, umidade e luminosidade.

## Regras importantes

- Um ambiente com sensores associados não pode ser excluído; exclua ou mova os sensores primeiro.
- Ao excluir um sensor, os registros históricos vinculados também são apagados. A tela pede confirmação antes dessa operação.
- O código do sensor é único; tipo, ambiente e descrição são validados.

## Testes

```bash
php artisan test
```
