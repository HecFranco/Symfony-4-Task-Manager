CREATE DATABASE IF NOT EXISTS curso_backfront;
USE curso_backfront;

CREATE TABLE users(
	id 			int(255) auto_increment not null,
	role		varchar(20),
	name		varchar(180),
	surname 	varchar(255),
	email		varchar(255),
	password 	varchar(255),
	created_at  datetime,
	CONSTRAINT pk_users PRIMARY KEY(id)
)ENGINE=InnoDb;

CREATE TABLE tasks(
	id 			int(255) auto_increment not null,
	user_id		int(255) not null,
	title		varchar(255),
	description	text,
	status		varchar(100),
	created_at  datetime,
	updated_at  datetime,
	CONSTRAINT pk_tasks PRIMARY KEY(id),
	CONSTRAINT fk_tasks_users FOREIGN KEY(user_id) REFERENCES users(id)
)ENGINE=InnoDb;
