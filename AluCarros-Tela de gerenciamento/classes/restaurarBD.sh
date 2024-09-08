
# Nome do banco de dados
DB_NAME="nome_do_banco"
# Nome do arquivo de backup
BACKUP_FILE="backup.sql"

# Comando para restaurar o banco de dados
mysql -u root -p $DB_NAME < $BACKUP_FILE

echo "Banco de dados restaurado a partir de $BACKUP_FILE"