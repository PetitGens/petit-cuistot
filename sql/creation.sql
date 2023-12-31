DROP TABLE IF EXISTS CUI_ETIQUETTAGE_MOD;
DROP TABLE IF EXISTS CUI_COMPOSITION_MOD;
DROP TABLE IF EXISTS CUI_ETIQUETTAGE;
DROP TABLE IF EXISTS CUI_COMPOSITION;
DROP TABLE IF EXISTS CUI_RECETTE_MODIFIEE;
DROP TABLE IF EXISTS CUI_RECETTE;
DROP TABLE IF EXISTS CUI_INGREDIENT;
DROP TABLE IF EXISTS CUI_CATEGORIE;
DROP TABLE IF EXISTS CUI_UTILISATEUR;
DROP TABLE IF EXISTS CUI_TAG;

CREATE TABLE CUI_UTILISATEUR(
   UTIL_ID INT AUTO_INCREMENT,
   UTIL_PSEUDO VARCHAR(32)  NOT NULL,
   UTIL_MDP VARCHAR(60)  NOT NULL,
   UTIL_EMAIL VARCHAR(32)  NOT NULL,
   UTIL_NOM VARCHAR(32) ,
   UTIL_PRENOM VARCHAR(32) ,
   UTIL_DATE_INSCRIPTION DATETIME NOT NULL,
   UTIL_TYPE CHAR(1)  NOT NULL,
   UTIL_STATUT CHAR(1)  NOT NULL,
   PRIMARY KEY(UTIL_ID),
   UNIQUE(UTIL_PSEUDO),
   UNIQUE(UTIL_EMAIL)
);

CREATE TABLE CUI_TAG(
   TAG_ID INT AUTO_INCREMENT,
   TAG_INTITULE VARCHAR(32)  NOT NULL,
   TAG_DESCRIPTION VARCHAR(128) ,
   PRIMARY KEY(TAG_ID),
   UNIQUE(TAG_INTITULE)
);

CREATE TABLE CUI_INGREDIENT(
   ING_ID INT AUTO_INCREMENT,
   ING_INTITULE VARCHAR(32)  NOT NULL,
   ING_DESCRIPTION VARCHAR(128) ,
   PRIMARY KEY(ING_ID),
   UNIQUE(ING_INTITULE)
);

CREATE TABLE CUI_CATEGORIE(
   CAT_CODE CHAR(3) ,
   CAT_INTITULE VARCHAR(32)  NOT NULL,
   CAT_DESCRIPTION VARCHAR(128) ,
   PRIMARY KEY(CAT_CODE)
);

CREATE TABLE CUI_RECETTE(
   REC_ID INT AUTO_INCREMENT,
   REC_TITRE VARCHAR(64),
   REC_CONTENU TEXT,
   REC_RESUME VARCHAR(256) ,
   REC_IMAGE VARCHAR(128)  NOT NULL,
   REC_DATE_CREATION DATETIME NOT NULL,
   REC_DATE_MODIFICATION DATETIME,
   REC_STATUT CHAR(1)  NOT NULL,
   CAT_CODE CHAR(3)  NOT NULL,
   UTIL_ID INT NOT NULL,
   PRIMARY KEY(REC_ID),
   FOREIGN KEY(CAT_CODE) REFERENCES CUI_CATEGORIE(CAT_CODE),
   FOREIGN KEY(UTIL_ID) REFERENCES CUI_UTILISATEUR(UTIL_ID)
);

CREATE TABLE CUI_RECETTE_MODIFIEE(
   REC_ID INT,
   REC_MOD_TITRE VARCHAR(32) ,
   REC_MOD_CONTENU TEXT,
   REC_MOD_RESUME VARCHAR(128) ,
   REC_MOD_IMAGE VARCHAR(50) ,
   REC_MOD_DATE_MODIFICATION VARCHAR(50) ,
   CAT_CODE CHAR(3)  NOT NULL,
   PRIMARY KEY(REC_ID),
   FOREIGN KEY(REC_ID) REFERENCES CUI_RECETTE(REC_ID),
   FOREIGN KEY(CAT_CODE) REFERENCES CUI_CATEGORIE(CAT_CODE)
);

CREATE TABLE CUI_ETIQUETTAGE(
   REC_ID INT,
   TAG_ID INT,
   PRIMARY KEY(REC_ID, TAG_ID),
   FOREIGN KEY(REC_ID) REFERENCES CUI_RECETTE(REC_ID),
   FOREIGN KEY(TAG_ID) REFERENCES CUI_TAG(TAG_ID)
);

CREATE TABLE CUI_COMPOSITION(
   REC_ID INT,
   ING_ID INT,
   PRIMARY KEY(REC_ID, ING_ID),
   FOREIGN KEY(REC_ID) REFERENCES CUI_RECETTE(REC_ID),
   FOREIGN KEY(ING_ID) REFERENCES CUI_INGREDIENT(ING_ID)
);

CREATE TABLE CUI_COMPOSITION_MOD(
   ING_ID INT,
   REC_ID INT,
   PRIMARY KEY(ING_ID, REC_ID),
   FOREIGN KEY(ING_ID) REFERENCES CUI_INGREDIENT(ING_ID),
   FOREIGN KEY(REC_ID) REFERENCES CUI_RECETTE_MODIFIEE(REC_ID)
);

CREATE TABLE CUI_ETIQUETTAGE_MOD(
   TAG_ID INT,
   REC_ID INT,
   PRIMARY KEY(TAG_ID, REC_ID),
   FOREIGN KEY(TAG_ID) REFERENCES CUI_TAG(TAG_ID),
   FOREIGN KEY(REC_ID) REFERENCES CUI_RECETTE_MODIFIEE(REC_ID)
);