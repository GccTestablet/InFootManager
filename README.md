# InFootManager
Project to learn Symfony.

### Description du projet
Réalisation d’un projet de gestion d’équipes Football indoor.

### Use case
Lorsqu’on arrive sur le site, on a la possibilité de s’authentifier ou de créer un compte.
Lors de la création d’un compte, on saisit son mail, mot de passe et confirmation du mot de passe, puis on retourne sur la page d’authentification.
Une fois authentifié, si l’utilisateur n’est pas lié à un joueur, on lui propose de créer sa fiche joueur en entrant son nom, prénom et sa catégorie.
Une fois sa fiche créée, il peut créer une équipe.

Afficher une liste de tous les joueurs avec
- Nom et prénom (Lien pour aller sur la fiche du joueur)
- Catégorie
- Equipes

Dans la fiche d’un joueur, on verra les informations le concernant ainsi que la liste des équipes dont il fait partie. On pourra modifier le joueur lui-meme

Afficher une liste des équipes avec
- Nom (Lien vers la fiche de l’équipe)
- Liste des joueurs

On aura aussi la possibilité de créer une nouvelle équipe.

Dans la fiche de l’équipe, on verra les informations la concernant ainsi que la liste des joueurs et la possibilité d’en ajouter de nouveaux. On pourra modifier aussi l’équipe elle-même.

### Règles
Un joueur peut être dans plusieurs équipes et une équipe à plusieurs joueurs

### Entités
##### User
- id (INT AI)
- email (VARCHAR 200, NOT NULL)
- password  (VARCHAR 100, NOT NULL)
- playerId (INT FK, NULLABLE)

##### Player
- id (INT AI)
- firstName (VARCHAR 100 NOT NULL)
- lastName (VARCHAR 100, NOT NULL)
- category (VARCHAR 20, EnumType: PlayerCategoryEnum)
- userId (INT FK, NOT NULL)
- teams (COLLECTION<Team>)

##### Team
- id (INT AI)
- name (VARCHAR 255)
- players (COLLECTION<Player>)
### Enum
##### PlayerCategoryEnum
- Débutant
- Poussin
- Benjamin
- 13 ans
- 15 ans
- 18 ans

### Bonus
Ajouter lastLogin (DATETIME NULLABLE) à l’utilisateur

Gérer une liste d’attente pour la demande à rejoindre une équipe.
!!! On ne dois pas perdre les données déjà en place
Ajouter une Entité UserTeam à la place de la liaison directe de Player et Team
- playerId (INT FK)
- teamId (IN FK)
- accepted (BOOL, DEFAULT FALSE)
Ajouter un bouton dans la fiche d’une Équipe pour demander à rejoindre

