set FECHA= %date%
set FECHA=%FECHA:/=%
set FECHA=%FECHA: =%
set FECHA=%FECHA::=%
set FECHA=%FECHA:,=%
set BD=c:/xampp/htdocs/Darsalud/log/backup_darsalud_%FECHA%.sql
cd c:/xampp/mysql/bin
mysqldump --user=root --host=localhost db_darsalud > %BD%



