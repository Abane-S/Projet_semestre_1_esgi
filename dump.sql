-- Adminer 4.8.1 PostgreSQL 16.0 (Debian 16.0-1.pgdg120+1) dump

DROP TABLE IF EXISTS "esgi_users";
DROP SEQUENCE IF EXISTS esgi_user_id_seq;
CREATE SEQUENCE esgi_user_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."esgi_users" (
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


DROP TABLE IF EXISTS esgi_pages CASCADE;

CREATE TABLE esgi_pages (
    id SERIAL PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    meta_description TEXT,
    titre VARCHAR(255) NOT NULL,
    banniere VARCHAR(255),
    articleid smallint NOT NULL,
    comments boolean DEFAULT false,
    content TEXT,
    created_at TIMESTAMP NOT NULL DEFAULT NOW(),
    updated_at TIMESTAMP NOT NULL DEFAULT NOW()
);


DROP TABLE IF EXISTS "esgi_articles";
DROP SEQUENCE IF EXISTS esgi_articles_id_seq;
CREATE SEQUENCE esgi_articles_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;


DROP TABLE IF EXISTS esgi_articles CASCADE;

CREATE TABLE esgi_articles (
    id SERIAL PRIMARY KEY,
    id_user smallint NOT NULL,
    titre VARCHAR(255) NOT NULL,
    description varchar(50) NOT NULL,
    miniature varchar(100) NOT NULL,
    comments boolean DEFAULT false,
    content TEXT,
    created_at TIMESTAMP NOT NULL DEFAULT NOW(),
    updated_at TIMESTAMP NOT NULL DEFAULT NOW()
);



DROP TABLE IF EXISTS "esgi_comments";
DROP SEQUENCE IF EXISTS esgi_comments_id_seq;
CREATE SEQUENCE esgi_comments_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;


DROP TABLE IF EXISTS esgi_comments CASCADE;

CREATE TABLE esgi_comments (
    id SERIAL PRIMARY KEY,
    id_page VARCHAR(255) NOT NULL,
    valid boolean DEFAULT false,
    fullname varchar(100) NOT NULL,
    commenttitle varchar(100),
    comment TEXT,
    created_at TIMESTAMP NOT NULL DEFAULT NOW(),
    updated_at TIMESTAMP NOT NULL DEFAULT NOW()
);



