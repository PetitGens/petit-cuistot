-- Données de base

-- -----UTILISATEUR------- --

INSERT INTO CUI_UTILISATEUR(UTIL_PSEUDO, UTIL_MDP, UTIL_EMAIL, UTIL_NOM, UTIL_PRENOM, UTIL_DATE_INSCRIPTION, UTIL_TYPE, UTIL_STATUT)
VALUES
(
'Gouillaime',
'motdepasse',
'fakeemail@hehe.fr',
'Georges',
'Brassens',
STR_TO_DATE('2023-10-16 17:48:48', '%Y-%m-%d %H:%i:%s'),
'U',
'A'
);

-- -------TAG------------- --

INSERT INTO CUI_TAG(TAG_INTITULE, TAG_DESCRIPTION)
VALUES
(
'Boisson chaude',
'Un type de boisson qui réchauffe l''estomac et le cœur.'
);

-- -----INGREDIENT-------- --

INSERT INTO CUI_INGREDIENT(ING_INTITULE, ING_DESCRIPTION)
VALUES
(
'Lait de vache - demi écremé',
'Du lait trait d''une vache. Possède de nombreuses utilisations, allant de la pâtisserie au goûter, jusqu''au petit déjeuner.'
);

-- -----CATEGORIE--------- --

INSERT INTO CUI_CATEGORIE(CAT_CODE, CAT_INTITULE, CAT_DESCRIPTION)
VALUES
(
'GOU',
'Goûter',
'Un petit plaisir gourmand, généralement dégusté au milieu de l''après midi. Mais rien n''empêche d''en profiter un autre temps.'
);

-- -------RECETTE--------- --

insert into CUI_RECETTE (REC_TITRE, REC_RESUME, REC_CONTENU, CAT_CODE, REC_IMAGE, REC_DATE_CREATION, UTIL_ID, REC_STATUT)
values ('Recette simple de lait chaud',
'Voici ma recette de lait chaud. Très simple à réaliser, parfait pour accompagner un petit gouter.',
'1 - Verser du lait dans une petit tasse (de préfèrence demi-écrémé).
2 - Mettre le lait dans un four à micro-ondes, et mettre à chauffer pendant une minute en fonction de la puissance du micro-onde.
3 - Déguster le lait ou soufflant un peu si il est chaud. Accompagner de biscuits pour plus de plaisir.', 
'GOU', 'https://i.imgur.com/cJACVb1.jpg', NOW(), 1, 'V'
);

-- ------COMPOSITION----- --

insert into CUI_COMPOSITION (REC_ID, ING_ID) values (1, 1);

-- ------ETIQUETTAGE----- --

insert into CUI_ETIQUETTAGE(REC_ID, TAG_ID) values (1, 1);