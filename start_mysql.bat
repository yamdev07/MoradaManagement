@echo off
echo Démarrage de MySQL...
cd /d C:\xampp\mysql\bin
start /b mysqld.exe --defaults-file=..\my.ini --standalone --console
echo MySQL en cours de démarrage...
timeout /t 5 >nul
echo Vérification du démarrage...
netstat -an | findstr :3306
if %errorlevel% equ 0 (
    echo ✅ MySQL démarré avec succès sur le port 3306
) else (
    echo ❌ MySQL n'a pas pu démarrer correctement
)
pause
