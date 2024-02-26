#!/bin/bash

#!/bin/bash

docker exec -i $(docker ps -qf "name=WorkSpace") /bin/bash <<'EOF'
# Resto do seu script
EOF

cd "$project_folder"

git config core.filemode false

echo "DONE"
env_file="$project_folder/.env"
echo "copying .env.example to .env"
cp "$project_folder/.env.example" "$env_file"

# modify the wowness-club .env file

# Define key-value pairs (new_variable => new_value)
declare -A env_updates=(
    ["APP_URL"]="http://wowness-local"
    ["DB_HOST"]="mysql"
    ["DB_DATABASE"]="wowness_club"
    ["DB_USERNAME"]="root"
    ["DB_PASSWORD"]="root"
)

# Check if the .env file exists
if [ -f "$env_file" ]; then
    # Iterate over key-value pairs and update .env file
    for key in "${!env_updates[@]}"; do
        value="${env_updates[$key]}"
        
        # Check if the variable already exists
        if grep -q "^$key=" "$env_file"; then
            # Variable exists, update its value
            sed -i "s/^$key=.*/$key=$value/" "$env_file"
        else
            # Variable doesn't exist, add it
            echo "Does not exist"
        fi
    done

    echo "Updated .env file with new values."
else
    echo ".env file not found at $env_file."
fi

cat "$env_file"

echo "Iniciando migrations..."
php artisan migrate

echo "Iniciando npm install"
npm install

echo "Iniciando build npm"
npm run build

echo "instanciando as tabelas do banco"
php artisan db:seed

echo "iniciando key generate"
php artisan key:generate

echo "Running storage link"
php artisan storage:link

echo "Iniciando permissões do diretório"
chmod -R 775 *

echo "Iniciando permissões de grupos"
chown -R www-data:www-data *
EOF

cd "$project_folder"

git config core.filemode false

echo "DONE"