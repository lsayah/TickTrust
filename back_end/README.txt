# 🎟️ Plateforme de Gestion de Tickets – Projet Symfony

## 📖 Description
Ce projet est une plateforme de gestion de tickets dédiée au secteur financier. Il permet de suivre et résoudre efficacement les incidents IT et financiers.

 📂 Structure du projet
/database/dump.sql → Fichier SQL pour recréer la base de données
/src/ → Code source du projet
/templates/ → Fichiers HTML/Twig pour l'affichage
.env → Fichier de configuration

---

## 🚀 Installation du projet

### 1️ Prérequis 
Avant de commencer, assurez-vous d'avoir installé :  
- [WampServer](https://www.wampserver.com/) (ou XAMPP si vous êtes sur Mac/Linux)  
- [Composer](https://getcomposer.org/)  
- [PHP 8+](https://www.php.net/)  
- [Symfony CLI](https://symfony.com/download)  
- [Git](https://git-scm.com/)  

### 2️ Cloner le projet  
Ouvrez un terminal et exécutez :  
```bash
- git clone https://github.com/lsayah/TickTrust.git
- cd TickTrust
- cd back_end


### 3 Installer les dépendances
Dans le dossier du projet, exécutez :
- composer install

### 4️ Configurer la base de données
🔹 Option 1 : Importation directe du script SQL
- Ouvrir Wamp et lancer phpMyAdmin
- Créer une nouvelle base de données (nom_de_ta_bdd)
- Aller dans l'onglet Importer
- Sélectionner le fichier database/dump.sql
- Valider l'importation

🔹 Option 2 : Recréer la base via Symfony
Si vous préférez recréer la base de zéro avec Symfony, utilisez :
- php bin/console doctrine:database:create
- php bin/console doctrine:migrations:migrate


### 5️ Configurer les variables d'environnement

- cp .env.example .env



### 6 Lancer le serveur Symfony
Démarrez le serveur en local :
- symfony server:start




