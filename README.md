# EXSANA

Un site qui propose des formations dans le domaine médical et qui par la suite va vendre du matériel médical à des professionnels de santé.
Norme SEO
Standar PSR4
Clean code

## Pré-requis

- Docker et Docker Compose installés sur votre machine.
- Git pour cloner le dépôt.

## Installation

1. **Cloner le dépôt**:

   Clonez le dépôt sur votre machine locale en utilisant la commande suivante:

   ```bash
   git clone https://github.com/cLemperi/Exsana.git
   ```

2. **Démarrer les conteneurs Docker**:

    ```bash
    cd exana
    docker-compose up -d
    ```

3. **Installation des dépendances:**

    ```bash
    docker exec -it www_exsana composer install
    ```

4. **Installation des dépendances JavaScript**
    
    ```bash
    yarn install
    ```

5. **5. Compilation des assets avec Webpack Encore**
    
    ```bash
    yarn encore dev
    ```

6. **Exécution des migrations:**
    
    ```bash
    docker exec -it www_exsana php bin/console doctrine:migrations:migrate
    ```

7. **Générer les fixtures (données fictives):**

    ```bash
    docker exec -it www_exsana php bin/console doctrine:fixtures:load
    ```

8. **Accéder à l'application:**
    
    Ouvrez votre navigateur et naviguez vers:
    ```bash
    http://127.0.0.1:8000
    ```

9. Utilisation de PHPMYADMIN
    
    Vous pouvez accéder à PhpMyAdmin à l'adresse :
     ```bash
    http://127.0.0.1:8082
    ```

    Utilisez les identifiants suivants pour vous connecter :

    Utilisateur : myuser
    Mot de passe : mypassword   


**Enjoy!**

