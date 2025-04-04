# 1. Clonar o projeto (caso ainda não tenha)
git clone <url-do-repo>

cd nome-do-projeto
bash
Copiar
Editar
# 2. Instalar as dependências PHP
composer install
bash
Copiar
Editar
# 3. Copiar o arquivo .env de exemplo
cp .env.example .env
bash
Copiar
Editar
# 4. Gerar a chave da aplicação
php artisan key:generate
bash
Copiar
Editar
# 5. Configurar o arquivo .env com suas variáveis (DB, APP_URL etc.)
# (abre no VSCode ou edita direto)
code .env
bash
Copiar
Editar
# 6. Rodar as migrations (e seeds, se tiver)
php artisan migrate
# ou, se quiser rodar as seeds junto
php artisan migrate --seed
bash
Copiar
Editar
# 7. Criar o link simbólico do storage (pra acessar arquivos públicos)
php artisan storage:link
bash
Copiar
Editar
# 8. (Opcional) Instalar dependências JS (se usar frontend tipo Vue/React)
npm install
npm run dev # ou npm run build
bash
Copiar
Editar
# 9. Subir o servidor local
php artisan serve
