#Achei bom colocar um backup do BD para cada um ter ele localmente mas sempre atualizado

# Nome do banco de dados
DB_NAME="aluguelcarrobd"
# Nome do arquivo de backup
BACKUP_FILE="backup_$(date +%F).sql"

# Comando para fazer o backup
mysqldump -u root -p $DB_NAME > $BACKUP_FILE

echo "Backup do banco de dados concluído: $BACKUP_FILE"