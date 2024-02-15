-- Adminer 4.8.1 PostgreSQL 16.1 (Debian 16.1-1.pgdg120+1) dump

DROP TABLE IF EXISTS "esgi_comment";

CREATE TABLE "esgi_comment" (
                                "id" SERIAL PRIMARY KEY,
                                "id_page" integer NOT NULL,
                                "valid" boolean DEFAULT false,
                                "fullname" character varying(100) NOT NULL,
                                "commenttitle" character varying(100),
                                "comment" text,
                                "created_at" timestamp DEFAULT now() NOT NULL
);


DROP TABLE IF EXISTS "esgi_pages";

CREATE TABLE "esgi_pages" (
                              "id" SERIAL PRIMARY KEY,
                              "title" character varying(255) NOT NULL,
                              "meta_description" text,
                              "miniature" character varying(255),
                              "comments" boolean DEFAULT false,
                              "content" text,
                              "created_at" timestamp DEFAULT now() NOT NULL
);


DROP TABLE IF EXISTS "esgi_user";

CREATE TABLE "esgi_user" (
                             "id" SERIAL PRIMARY KEY,
                             "firstname" character varying(25) NOT NULL,
                             "lastname" character varying(50) NOT NULL,
                             "email" character varying(320) NOT NULL,
                             "pwd" character varying(255) NOT NULL,
                             "role" character varying(10) DEFAULT 'user' NOT NULL,
                             "verification_token" character varying(255),
                             "email_verified" boolean DEFAULT false,
                             "date_inserted" timestamptz DEFAULT CURRENT_TIMESTAMP,
                             "isdeleted" boolean DEFAULT false
);
