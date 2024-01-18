-- CREATE TABLE IF NOT EXISTS esgi_user (
--     id SERIAL PRIMARY KEY,
--     firstname VARCHAR(25) NOT NULL,
--     lastname VARCHAR(50) NOT NULL,
--     email VARCHAR(320) NOT NULL,
--     pwd VARCHAR(255) NOT NULL,
--     status SMALLINT NOT NULL DEFAULT 0,
--     isDeleted BOOLEAN DEFAULT FALSE,
--     insertedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
--     updatedAt TIMESTAMP NULL DEFAULT NULL
-- );


-- CREATE TABLE IF NOT EXISTS "esgi_users" (
--     "id" serial  NOT NULL,
--     "firstname" character varying(255) NOT NULL,
--     "lastname" character varying(255) NOT NULL,
--     "email" character varying(255) NOT NULL,
--     "password" character varying(255) NOT NULL,
--     "role_id" integer DEFAULT '6' NOT NULL,
--     "verification_token" character varying(255),
--     "email_verified" boolean DEFAULT false,
--     "date_inserted" timestamp DEFAULT CURRENT_TIMESTAMP,
--     "date_updated" timestamp,
--     CONSTRAINT "esgi_users_email_key" UNIQUE ("email"),
--     CONSTRAINT "esgi_users_pkey" PRIMARY KEY ("id")
-- ) WITH (oids = false);


CREATE TABLE IF NOT EXISTS esgi_user (
    "id" SERIAL PRIMARY KEY,
    "firstname" VARCHAR(25) NOT NULL,
    "lastname" VARCHAR(50) NOT NULL,
    "email" VARCHAR(320) NOT NULL,
    "pwd" VARCHAR(255) NOT NULL,
    "status" SMALLINT NOT NULL DEFAULT 0,
    "verification_token" VARCHAR(255),
    "email_verified" boolean DEFAULT false,
    "date_inserted" TIMESTAMP WITH TIME ZONE DEFAULT CURRENT_TIMESTAMP,
    "date_updated" timestamp,
    "isDeleted" BOOLEAN DEFAULT FALSE
);