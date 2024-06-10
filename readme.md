# Guide d'exécution en local

Ce fichier readme.md fournit des instructions pour exécuter l'application web en local et explique comment créer un administrateur pour le back-office de l'application.

## Prérequis

Avant de commencer, assurez-vous d'avoir les éléments suivants installés sur votre système :

1. **Serveur Web :** Vous aurez besoin d'un serveur web tel que Apache ou Nginx installé sur votre machine.

2. **PHP :** Le site web nécessite PHP 8.2 pour fonctionner correctement. Assurez-vous d'installer PHP 8.2 sur votre machine.

3. **Extension PHP :** Vérifiez que l'extension PDO est activée dans votre configuration PHP.

4. **Base de données :** Vous devez installer une base de données MySQL sur votre système. Créez une base de données avec le nom "mydatabase".

5. **Git :** Installez Git pour cloner le dépôt de l'application.

## Installation de l'Application

1. Clonez le dépôt du projet en utilisant Git :

   
   git clone https://github.com/kentar2022/eval.git
   cd eval


Configurer la base de données :



Création des Tables de Base de Données
Vous devez également créer les tables de la base de données. Voici les commandes SQL pour créer ces tables :


CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'worker') NOT NULL
);


CREATE TABLE cars (
    id INT AUTO_INCREMENT PRIMARY KEY,
    brand VARCHAR(100) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    mileage INT NOT NULL,
    color VARCHAR(50) NOT NULL,
    color_html VARCHAR(7) NOT NULL,
    release_date DATE NOT NULL,
    details TEXT
);

CREATE TABLE schedule (
    id INT AUTO_INCREMENT PRIMARY KEY,
    day VARCHAR(50) NOT NULL,
    time_intervals VARCHAR(255) NOT NULL
);

CREATE TABLE comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    text TEXT NOT NULL,
    nickname VARCHAR(255),
    rating INT NOT NULL
);

CREATE TABLE filtred_comment (
    id INT AUTO_INCREMENT PRIMARY KEY,
    text TEXT NOT NULL,
    nickname VARCHAR(255),
    rating INT NOT NULL
);

Créer un administrateur pour le back-office :



# INSERT INTO admin (login, password, salt) VALUES ('admin', 'password', 'salt');


Créez un fichier .env.local à la racine du projet et ajoutez la configuration d'accès à votre base de données :

DATABASE_URL=mysql://votre_identifiant_mysql:votre_mot_de_passe_mysql@localhost/mydatabase


