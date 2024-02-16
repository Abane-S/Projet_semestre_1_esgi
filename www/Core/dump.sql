DROP TABLE IF EXISTS "esgi_comment";
DROP SEQUENCE IF EXISTS esgi_comment_id_seq;
CREATE SEQUENCE esgi_comment_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."esgi_comment" (
                                         "id" integer DEFAULT nextval('esgi_comment_id_seq') NOT NULL,
                                         "id_page" integer NOT NULL,
                                         "valid" boolean DEFAULT false,
                                         "fullname" character varying(100) NOT NULL,
                                         "commenttitle" character varying(100),
                                         "comment" text,
                                         "created_at" timestamp DEFAULT now() NOT NULL,
                                         CONSTRAINT "esgi_comment_pkey" PRIMARY KEY ("id")
) WITH (oids = false);


DROP TABLE IF EXISTS "esgi_menus";
DROP SEQUENCE IF EXISTS esgi_pages_id_seq;
CREATE SEQUENCE esgi_pages_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."esgi_menus" (
                                       "id" integer DEFAULT nextval('esgi_pages_id_seq') NOT NULL,
                                       "title" character varying(255) NOT NULL,
                                       "meta_description" text,
                                       "miniature" character varying(255),
                                       "content" text,
                                       "created_at" timestamp DEFAULT now() NOT NULL,
                                       "title_menu" character varying(255) NOT NULL,
                                       "icon_menu" character(255) NOT NULL,
                                       CONSTRAINT "esgi_menus_pkey" PRIMARY KEY ("id")
) WITH (oids = false);


DROP TABLE IF EXISTS "esgi_pages";
DROP SEQUENCE IF EXISTS esgi_pages_id_seq1;
CREATE SEQUENCE esgi_pages_id_seq1 INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."esgi_pages" (
                                       "id" integer DEFAULT nextval('esgi_pages_id_seq1') NOT NULL,
                                       "title" character varying(255) NOT NULL,
                                       "meta_description" text,
                                       "miniature" character varying(255),
                                       "comments" boolean DEFAULT false,
                                       "content" text,
                                       "created_at" timestamp DEFAULT now() NOT NULL,
                                       CONSTRAINT "esgi_pages_pkey" PRIMARY KEY ("id")
) WITH (oids = false);


DROP TABLE IF EXISTS "esgi_user";
DROP SEQUENCE IF EXISTS esgi_user_id_seq1;
CREATE SEQUENCE esgi_user_id_seq1 INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."esgi_user" (
                                      "id" integer DEFAULT nextval('esgi_user_id_seq1') NOT NULL,
                                      "firstname" character varying(25) NOT NULL,
                                      "lastname" character varying(50) NOT NULL,
                                      "email" character varying(320) NOT NULL,
                                      "pwd" character varying(255) NOT NULL,
                                      "role" character varying(10) DEFAULT 'user' NOT NULL,
                                      "verification_token" character varying(255),
                                      "email_verified" boolean DEFAULT false,
                                      "date_inserted" timestamptz DEFAULT CURRENT_TIMESTAMP,
                                      "isdeleted" boolean DEFAULT false,
                                      CONSTRAINT "esgi_user_pkey" PRIMARY KEY ("id")
) WITH (oids = false);