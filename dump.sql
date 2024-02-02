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

CREATE TABLE "public"."esgi_pages" (
    "id" integer DEFAULT nextval('esgi_pages_id_seq') NOT NULL,
    "title" character varying(255) NOT NULL,
    "content" text,
    "user_id" integer NOT NULL,
    "date_created" timestamp DEFAULT CURRENT_TIMESTAMP,
    "date_modified" timestamp,
    "url_page" text,
    "controller_page" character varying(255) NOT NULL,
    "action_page" character varying(255) NOT NULL,
    "used_template" character varying(255),
    CONSTRAINT "esgi_pages_pkey" PRIMARY KEY ("id")
) WITH (oids = false);



INSERT INTO "esgi_pages" ("id", "title", "content", "user_id", "date_created", "date_modified", "url_page", "controller_page", "action_page", "used_template") VALUES
(2,	'dashboard',	'{"type":"body","children":[{"type":"img","attributes":{"src":"ImagePage\\/Uploads\\/ded\\/ded+logo fla.png"}},"dedLa FLA a permis de jouer contre de nombreuse equipe lors d\''un tournoi"]}',	126,	'2023-06-28 09:35:28.62323',	NULL,	'/dashboard',	'Main',	'dashboard',	NULL),
(3,	'contact',	'{"type":"body","children":[{"type":"img","attributes":{"src":"ImagePage\\/Uploads\\/ded\\/ded+logo fla.png"}},"dedLa FLA a permis de jouer contre de nombreuse equipe lors d\''un tournoi"]}',	126,	'2023-06-28 09:36:18.308916',	NULL,	'/contact',	'Main',	'contact',	NULL),
(4,	'login',	'{"type":"body","children":[{"type":"img","attributes":{"src":"ImagePage\\/Uploads\\/ded\\/ded+logo fla.png"}},"dedLa FLA a permis de jouer contre de nombreuse equipe lors d\''un tournoi"]}',	126,	'2023-06-28 09:36:52.399549',	NULL,	'/login',	'Security',	'login',	NULL),
(5,	'logout',	'{"type":"body","children":[{"type":"img","attributes":{"src":"ImagePage\\/Uploads\\/ded\\/ded+logo fla.png"}},"dedLa FLA a permis de jouer contre de nombreuse equipe lors d\''un tournoi"]}',	126,	'2023-06-28 09:37:34.418299',	NULL,	'/logout',	'Security',	'logout',	NULL),
(7,	'disconnect',	'{"type":"body","children":[{"type":"img","attributes":{"src":"ImagePage\\/Uploads\\/ded\\/ded+logo fla.png"}},"dedLa FLA a permis de jouer contre de nombreuse equipe lors d\''un tournoi"]}',	126,	'2023-06-28 09:39:12.302641',	NULL,	'/disconnect',	'Security',	'disconnect',	NULL),
(8,	'verify',	'{"type":"body","children":[{"type":"img","attributes":{"src":"ImagePage\\/Uploads\\/ded\\/ded+logo fla.png"}},"dedLa FLA a permis de jouer contre de nombreuse equipe lors d\''un tournoi"]}',	126,	'2023-06-28 09:39:30.914361',	NULL,	'/verify',	'Security',	'verify',	NULL),
(96,	'install',	'{"type":"body","children":[{"type":"img","attributes":{"src":"ImagePage\\/Uploads\\/ded\\/ded+logo fla.png"}},"dedLa FLA a permis de jouer contre de nombreuse equipe lors d\''un tournoi"]}',	126,	'2023-09-16 06:17:15.241603',	NULL,	'/install',	'Admin',	'install',	NULL),
(12,	'delete_user',	'{"type":"body","children":[{"type":"img","attributes":{"src":"ImagePage\\/Uploads\\/ded\\/ded+logo fla.png"}},"dedLa FLA a permis de jouer contre de nombreuse equipe lors d\''un tournoi"]}',	127,	'2023-06-28 12:45:14.6325',	NULL,	'/admin/delete_user',	'Admin',	'deleteUser',	NULL),
(11,	'edit_user',	'{"type":"body","children":[{"type":"img","attributes":{"src":"ImagePage\\/Uploads\\/ded\\/ded+logo fla.png"}},"dedLa FLA a permis de jouer contre de nombreuse equipe lors d\''un tournoi"]}',	127,	'2023-06-28 12:44:33.291857',	NULL,	'/admin/edit_user',	'Admin',	'editUser',	NULL),
(100,	'ded',	'{"type":"body","children":[{"type":"img","attributes":{"src":"ImagePage\\/Uploads\\/ded\\/ded+logo fla.png"}},"dedLa FLA a permis de jouer contre de nombreuse equipe lors d\''un tournoi"]}',	126,	'2023-09-18 14:42:54',	NULL,	'/ded',	'Page',	'index',	'Article'),
(13,	'add_template_page',	'{"type":"body","children":[{"type":"img","attributes":{"src":"ImagePage\\/Uploads\\/ded\\/ded+logo fla.png"}},"dedLa FLA a permis de jouer contre de nombreuse equipe lors d\''un tournoi"]}',	126,	'2023-06-28 14:24:41.937919',	NULL,	'/add_template_page',	'Security',	'addTemplatePage',	NULL),
(14,	'Index',	'{"type":"body","children":[{"type":"img","attributes":{"src":"ImagePage\\/Uploads\\/ded\\/ded+logo fla.png"}},"dedLa FLA a permis de jouer contre de nombreuse equipe lors d\''un tournoi"]}',	126,	'2023-06-29 06:56:39.827372',	NULL,	'/',	'Main',	'index',	NULL),
(6,	'register',	'{"type":"body","children":[{"type":"img","attributes":{"src":"ImagePage\\/Uploads\\/ded\\/ded+logo fla.png"}},"dedLa FLA a permis de jouer contre de nombreuse equipe lors d\''un tournoi"]}',	126,	'2023-06-28 09:38:51.893301',	NULL,	'/register',	'Security',	'register',	NULL),
(15,	'components',	'{"type":"body","children":[{"type":"img","attributes":{"src":"ImagePage\\/Uploads\\/ded\\/ded+logo fla.png"}},"dedLa FLA a permis de jouer contre de nombreuse equipe lors d\''un tournoi"]}',	127,	'2023-06-30 09:45:46.514237',	NULL,	'/components',	'Main',	'components',	NULL),
(9,	'Choice Template Page',	'{"type":"body","children":[{"type":"img","attributes":{"src":"ImagePage\\/Uploads\\/ded\\/ded+logo fla.png"}},"dedLa FLA a permis de jouer contre de nombreuse equipe lors d\''un tournoi"]}',	126,	'2023-06-28 12:39:00.307211',	NULL,	'/choice_template_page',	'Security',	'choiceTemplatePage',	NULL),
(16,	'Create Page',	'{"type":"body","children":[{"type":"img","attributes":{"src":"ImagePage\\/Uploads\\/ded\\/ded+logo fla.png"}},"dedLa FLA a permis de jouer contre de nombreuse equipe lors d\''un tournoi"]}',	126,	'2023-06-30 14:10:21.927364',	NULL,	'/create_page',	'Security',	'createPage',	NULL),
(72,	'page',	'{"type":"body","children":[{"type":"img","attributes":{"src":"ImagePage\\/Uploads\\/ded\\/ded+logo fla.png"}},"dedLa FLA a permis de jouer contre de nombreuse equipe lors d\''un tournoi"]}',	126,	'2023-07-21 01:26:14.765273',	NULL,	'/page',	'Security',	'page',	NULL),
(76,	'delete_page',	'{"type":"body","children":[{"type":"img","attributes":{"src":"ImagePage\\/Uploads\\/ded\\/ded+logo fla.png"}},"dedLa FLA a permis de jouer contre de nombreuse equipe lors d\''un tournoi"]}',	127,	'2023-06-28 12:45:14.6325',	NULL,	'/admin/delete_page',	'Admin',	'deletePage',	NULL);



DROP TABLE IF EXISTS esgi_menu CASCADE;

CREATE TABLE esgi_menu (
    id SERIAL PRIMARY KEY,
    parent_id INT NULL DEFAULT NULL,
    title VARCHAR(100) NOT NULL,
    page_id INT NOT NULL,
    visible SMALLINT NOT NULL DEFAULT 1,
    position INT NOT NULL DEFAULT 0,
    created_at TIMESTAMP NOT NULL DEFAULT NOW(),
    updated_at TIMESTAMP NOT NULL DEFAULT NOW(),

    is_footer SMALLINT NOT NULL DEFAULT 0,
    is_header SMALLINT NOT NULL DEFAULT 0,

    FOREIGN KEY (page_id) REFERENCES esgi_page(id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_esgi_menu_parent_id FOREIGN KEY (parent_id) REFERENCES esgi_menu(id) ON DELETE CASCADE
);



CREATE TABLE esgi_pages (
    id SERIAL PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    meta_description TEXT,
    miniature VARCHAR(255),
    comments boolean DEFAULT false,
    content TEXT
);



INSERT INTO esgi_pages (title, meta_description, miniature, content)
VALUES ('Titre de l''article', 'Description méta de l''article', 'nom_miniature.jpg', true, 'Contenu de l''article');