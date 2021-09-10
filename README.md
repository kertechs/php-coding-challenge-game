Objectifs
=======

L'objectif de cet exercice est de coder un serveur d'un jeu. 
Le but du jeu est de trouver une cible sur une carte et de l'éliminer.

Règle du jeu
=======
Le jeu se déroule sur une carte carré de X cases de coté. *X est déterminer a votre discrétion*

La cible est placé aléatoirement en début de jeu sur une position (x,y).
Elle se déplace aléatoirement sur une case a coté d'elle a chaque fois que le joueur tire.

Le joueur est placé au milieu de la carte en début de partie.

Le joueur peut voir la cible si elle se situe a 2 cases de lui.

Le joueur ne peut pas sortir de la carte.

Le joueur peut se effectuer les actions suivantes :
* se déplacer en haut
* se déplacer en bas
* se déplacer gauche
* se déplacer droite
* tirer sur la cible

La cible doit être touché trois fois pour être éliminer

Si la partie est terminé le server renvoie une erreur HTTP 400 pour toutes les routes
Si la partie n'est pas commencé le serveur renvoie une erreur HTTP 404 pour toutes les routes

Route du serveurs
=======

**Start request** => Permet de démarrer la partie ou de la remettre à 0 si la partie est deja en cours
```
POST /start
```

**Move request** => Permet au joueur de se déplacer sur la carte
```
POST /move
{
  "action": "up|down|left|right"
}
```
**Response**
```
{
  "position": {
    "x" => 1,
    "y" => 7
  },
  "target": null | {
    "x" => 2,
    "y" => 8
  }
}
```

**Shoot request** => Permet au joueur de tirer
```
POST /shoot
{
  "x": 2,
  "y": 4
}
```
**Response**
```
{
  "result": "touch|miss|kill"
}
```

Bonus
=======

**Map request** => Permet de visualiser la carte
```
GET /map
```
**Response**

Représentation assci la carte à l'instant T :-)

Livrable attendu
=======

Un repo GIT avec le code et les tests associés

Les résultats sont importants mais il n'y a pas de solution unique, il existe différentes manières de réussir le test.
Le readme et le nom des commits sont tout aussi important.

N'oubliez pas que vous devrez expliquer et justifier vos choix lors d'un entretien.
