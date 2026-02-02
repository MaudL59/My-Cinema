# W-WEB-102-LIL-1-1-my_cinema-11

instalation de XAMPP [apachefriends.org](https://gemini.google.com/app/0f042699ac5eb0f3?hl=fr#:~:text=T%C3%A9l%C3%A9chargement%20%3A-,apachefriends.org,-2.%20Le%20choix)

mettre le fichier telecharger sur le bureau

Donner les droits d'exécution dans le terminal du bureau

chmod +x xampp-linux-x64-8.2.12-0-installer.run

sudo ./xampp-linux-x64-8.2.12-0-installer.run

sur xampp aller sur manage servers et lancer Apache et MYsql si vous avez déja quelque chose sur un apache var/www/html vous devez reconfigurer le apache de XAMPP en changeant Listen 80 en Listen 8080 et le ServerName localhost en ServerName localhost:8080

sur un terminal taper:

sudo /opt/lampp/manager-linux-x64.run

pour lancer le serveur xamp
projet (Cinéma) : sera accessible sur http://localhost:8080/my-cinema/.
base de données : sera accessible sur http://localhost:8080/phpmyadmin/

http://localhost:8080/my-cinema/frontend/index.html

http://localhost:8080/phpmyadmin/index.php?route=/table/structure&db=my-cinema&table=Screenings
