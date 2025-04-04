# 1. Clonar o projeto (caso ainda não tenha)
```bash
git clone <url-do-repo>
```
```bash
"cd nome-do-projeto"```
```
# 2. Instalar as dependências PHP
```bash
composer install
```
# 3. Copiar o arquivo .env de exemplo
```bash
cp .env.example .env
```
# 4. Gerar a chave da aplicação
```bash
php artisan key:generate
```
# 5. Configurar o arquivo .env com suas variáveis (DB, APP_URL etc.)
# (abre no VSCode ou edita direto)

# 6. Rodar as migrations (e seeds, se tiver)
```bash
php artisan migrate
```
# ou, se quiser rodar as seeds junto
```bash
php artisan migrate --seed
```

# 7. Criar o link simbólico do storage (pra acessar arquivos públicos)
```bash
php artisan storage:link
```

# 8. Subir o servidor local
```bash
php artisan serve
```
