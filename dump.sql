-- Adminer 4.8.1 PostgreSQL 16.0 (Debian 16.0-1.pgdg120+1) dump

DROP TABLE IF EXISTS "esgi_user";
DROP SEQUENCE IF EXISTS esgi_user_id_seq;
CREATE SEQUENCE esgi_user_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."esgi_user" (
    "id" integer DEFAULT nextval('esgi_user_id_seq') NOT NULL,
    "firstname" character varying(25) NOT NULL,
    "lastname" character varying(50) NOT NULL,
    "email" character varying(320) NOT NULL,
    "pwd" character varying(255) NOT NULL,
    "role" character varying(10) DEFAULT 'user' NOT NULL,
    "verification_token" character varying(255),
    "email_verified" boolean DEFAULT false,
    "date_inserted" timestamptz DEFAULT CURRENT_TIMESTAMP,
    "date_updated" timestamp,
    "isdeleted" boolean DEFAULT false,
    CONSTRAINT "esgi_user_pkey" PRIMARY KEY ("id")
) WITH (oids = false);


DROP TABLE IF EXISTS "esgi_pages";
DROP SEQUENCE IF EXISTS esgi_pages_id_seq;
CREATE SEQUENCE esgi_pages_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;


DROP TABLE IF EXISTS esgi_menu CASCADE;

CREATE TABLE esgi_pages (
    id SERIAL PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    meta_description TEXT,
    miniature VARCHAR(255),
    comments boolean DEFAULT false,
    content TEXT,
    created_at TIMESTAMP NOT NULL DEFAULT NOW(),
    updated_at TIMESTAMP NOT NULL DEFAULT NOW()
);



INSERT INTO esgi_pages (title, meta_description, miniature, content)
VALUES ('Titre de l''article', 'Description méta de l''article', 'nom_miniature.jpg', true, 'Contenu de l''article');