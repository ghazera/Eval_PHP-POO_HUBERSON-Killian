# Rendu Evaluation SuperGame - HUBERSON Killian

Il s'agit du rendu de mon évaluation du 12/11/2026 pour le sujet PHP MVC POO

# Sécurités mises en place 

Pour éviter les injections sql on prepare nos requetes sql, on bind nos parametres avec des variables, j'utilsie aussi param_str & param_int dans nos liaisons de parametre à des variables, pour garantir l'intégrité des données afin d'ajouter une couche de sécurité avant l'exécution de notre reque^te

j'utilise aussi filter_var pour vérifier & valider que le score est un entier valide, même chose pour l'id de l'équipe via le parametre natif de filter_var : FILTER_VALIDATE_INT

On supprime aussi les espaces en début & fin de chaîne de caractères avec notre trim appelé depuis notre function sanitize dans notre utils.php

Et enfin j'utilise htmlspecialchars qui est aussi une fonction native de php pour protéger l'affichage HTML contre les injections XSS

https://www.alsacreations.com/article/lire/1989-Les-failles-XSS.html
ce site explique en quoi l'utilisation de htmlspecialchars() est plus adapté plutôt que de directement utiliser un echo

mauvaise pratique:
echo ($player['pseudo'],ENT_QUOTES,'UTF-8')

bonne pratique :
echo htmlspecialchars($player['pseudo'],ENT_QUOTES,'UTF-8')

ent_quote est une option de htmlspecialchars qui permet de convertir les deux types de guillements ( "" et '' ) pour les convertir en entités html, côté client rien ne change mais ça permet d'éviter que les guillemets soient interprétés comme des caratères typique de la syntaxe html.

et UTF-8 ( aussi une option de htmlspecialchars ) permet d'interpréter les caractères spéciaux et les afficher correctement, par exemple les accents é è à ù pour éviter d'afficher des pseudos "bugués"