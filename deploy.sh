#!/bin/bash

# Aller à la racine du projet
# cd /chemin/absolu/vers/votre/projet

# Effectuer un git pull pour récupérer les dernières modifications
git pull origin master

# Installer/mettre à jour les dépendances via composer
php composer.phar install --no-dev --optimize-autoloader

# Supprimer le répertoire des tests
rm -rf tests/

# Vous pouvez ajouter d'autres commandes spécifiques à Symfony, comme la mise à jour de la base de données, etc.
php bin/console doctrine:migrations:migrate --no-interaction

# Si vous utilisez un système de cache, n'oubliez pas de le vider
php bin/console cache:clear --env=prod

echo "Déploiement terminé avec succès!"
