
### 1. Installation de l'environnement via interface WEB

- **Description** : Un processus d'installation guidé accessible via une interface web. Cela permet à l'utilisateur (dans votre cas, le professeur ou un développeur) de configurer et d'installer le framework facilement en suivant des étapes simples sur une page web.
- **Fonctionnement** : L'utilisateur peut spécifier des paramètres tels que les détails de la base de données, les configurations initiales, et d'autres préférences. Le système exécutera ensuite automatiquement les scripts nécessaires pour mettre en place l'environnement.

### 2. Système complet d'authentification

- **Description** : Un système permettant aux utilisateurs de s'inscrire, se connecter, se déconnecter et réinitialiser leur mot de passe.
- **Fonctionnalités clés** :
    - **Inscription (Register)** : Permet aux nouveaux utilisateurs de créer un compte.
    - **Connexion (Login)** : Authentifie les utilisateurs et leur donne accès à leur compte.
    - **Déconnexion (Logout)** : Permet aux utilisateurs de se déconnecter en toute sécurité.
    - **Réinitialisation du mot de passe (Reset Password)** : Offre une option pour réinitialiser le mot de passe en cas d'oubli.

### 3. Gestion des comptes utilisateurs

- **Description** : Permet aux utilisateurs de gérer leur compte, y compris la mise à jour de leurs informations personnelles et la suppression de leur compte.
- **Fonctionnalités clés** :
    - **Modification** : Les utilisateurs peuvent modifier leurs informations telles que le nom, l'e-mail, etc.
    - **Suppression** : Implémentation du hard delete (suppression définitive) et du soft delete (désactivation du compte).

### 4. Menu dynamique

- **Description** : Un système pour créer et gérer un menu de navigation dynamique pour le site.
- **Fonctionnement** : Les administrateurs peuvent ajouter, modifier et organiser les éléments du menu, permettant une personnalisation flexible de la navigation sur le site.

### 5. Routing basé sur fichier YAML

- **Description** : Un système de routage qui utilise un fichier YAML pour définir les routes et les lier aux actions des contrôleurs.
- **Fonctionnement** : Les développeurs peuvent déclarer les routes dans un fichier YAML, ce qui simplifie la gestion des routes et rend le code plus lisible.

### 6. Panel d'administration avec datavisualisation

- **Description** : Un tableau de bord pour les administrateurs offrant des outils de gestion et de visualisation de données.
- **Fonctionnalités clés** :
    - **Dashboard** : Un aperçu visuel des statistiques et des métriques importantes.
    - **Outils de gestion** : Interfaces pour gérer différents aspects du site (utilisateurs, contenu, etc.).

### 7. Configuration du templating

- **Description** : Permet aux administrateurs de personnaliser l'apparence du site en modifiant les modèles (templates).
- **Fonctionnement** : Interface pour changer les modèles de page, les styles et d'autres éléments de l'interface utilisateur.

### 8. CRUD pour commentaires et utilisateurs, avec modération

- **Description** : Fonctionnalités pour créer, lire, mettre à jour et supprimer (CRUD) des commentaires et des utilisateurs, ainsi que pour modérer les commentaires.
- **Fonctionnalités clés** :
    - **Gestion des utilisateurs et des commentaires** : Ajouter, visualiser, modifier et supprimer des utilisateurs et des commentaires.
    - **Modération des commentaires** : Examiner et approuver ou supprimer les commentaires.

### 9. Optimisation SEO

- **Description** : Implémentation de bonnes pratiques SEO pour améliorer la visibilité et le classement du site dans les moteurs de recherche.
- **Fonctionnement** : Utilisation de balises méta, structuration de l'URL, optimisation du contenu, etc.

### 10. Gestion des pages et SiteMap XML

- **Description** :
    - **Gestion des pages** : Fonctionnalités CRUD pour les pages du site.
    - **SiteMap XML** : Génération d'un plan du site au format XML pour aider les moteurs de recherche à indexer le site plus efficacement.
- **Fonctionnement** :
    - **Pages** : Ajouter, éditer, visualiser et supprimer des pages.
    - **SiteMap** : Générer automatiquement un fichier sitemap.xml.

### 11. ORM Lite intégré

- **Description** : Un ORM (Object-Relational Mapping) léger intégré pour faciliter les interactions avec la base de données en utilisant des objets au lieu de SQL brut.
- **Fonctionnement** : Permet un accès simplifié et plus sécurisé à la base de données, rendant le code plus lisible et facile à maintenir.


### 1. ORM Lite (Object-Relational Mapping Léger)

- **Qu'est-ce que c'est ?**
    - Un ORM est un outil qui permet de convertir les données entre des systèmes incompatibles, typiquement entre des objets de langage de programmation (comme PHP) et une base de données relationnelle. "Lite" signifie qu'il s'agit d'une version allégée de l'ORM, qui offre des fonctionnalités de base d'ORM sans la complexité ou le surpoids des ORMs plus complets.
- **Fonctionnement**
    - L'ORM Lite permet de manipuler les données de la base de données en utilisant des objets PHP, au lieu d'écrire des requêtes SQL brutes. Par exemple, au lieu d'écrire une requête SQL pour insérer des données, vous créez un objet PHP et utilisez des méthodes de l'ORM pour sauvegarder cet objet dans la base de données.