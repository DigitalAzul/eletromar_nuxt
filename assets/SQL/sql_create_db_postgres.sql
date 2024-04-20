create database mectronic2teste;
use mectronic;

create table blog_posts (
id int auto_increment primary key,
titulo varchar(256),
titulo_en varchar(256),
titulo_es varchar(256),
criado_em date,
descricao text,
descricao_en text,
descricao_es text,
categoria_id int,
blog_autor_id int,
tags varchar(256)
);


create table categorias (
id int auto_increment primary key,
titulo varchar(256)
);

INSERT INTO categorias (titulo) VALUES ('Marketing');
INSERT INTO categorias (titulo) VALUES ('Negócios');
INSERT INTO categorias (titulo) VALUES ('Dicas');
INSERT INTO categorias (titulo) VALUES ('Designer');
INSERT INTO categorias (titulo) VALUES ('Linha Petra');
INSERT INTO categorias (titulo) VALUES ('Eletromar');
INSERT INTO categorias (titulo) VALUES ('Videos');

create table blog_imagens(
id int primary key auto_increment,
imagem_url varchar(256),
blog_id int,
tipo int
);
INSERT INTO blog_imagens (imagem_url,blog_id, banner) VALUES ('\\ksjdfklsjdflk\\',1, true);

create table blog_autor(
id int primary key auto_increment,
nome varchar(256),
bio text,
bio_en text,
bio_es text,
imagem varchar(256),
social_instagram varchar(256),
social_facebook varchar(256),
social_linkedin varchar(256)
);



create table comentarios(
id int auto_increment primary key,
blog_posts_id int,
nome varchar(256),
criado_em date,
comentario text,
email varchar(256),
localidade varchar (256),
imagem_url varchar(256),
ativado boolean
);

create table ufs(
id int primary key auto_increment,
estado varchar(256),
Sigla varchar (5)
);

create table representantes(
id int primary key auto_increment,
nome varchar(256),
estabelecimento varchar (256),
uf_id int,
contato text
);

INSERT INTO representantes (nome,estabelecimento, contato) VALUES ('aaa','HM PLANEJAMENTO E REPRESENTAÇÃO COMERCIAL LTDA','<p>Representante: Izabele Holanda</p><p>Rua MarechalRondon, 146</p><p>Casa Forte, Recife - PE</p><p>CEP:</p><p>Telefone:</p><p>Email:</p>');
INSERT INTO representantes (nome,estabelecimento, contato) VALUES ('aaa','HM PLANEJAMENTO E REPRESENTAÇÃO COMERCIAL LTDA','<p>Representante: Izabele Holanda</p><p>Rua MarechalRondon, 146</p><p>Casa Forte, Recife - PE</p><p>CEP:</p><p>Telefone:</p><p>Email:</p>');
INSERT INTO representantes (nome,estabelecimento, contato) VALUES ('aaa','HM PLANEJAMENTO E REPRESENTAÇÃO COMERCIAL LTDA','<p>Representante: Izabele Holanda</p><p>Rua MarechalRondon, 146</p><p>Casa Forte, Recife - PE</p><p>CEP:</p><p>Telefone:</p><p>Email:</p>');
INSERT INTO representantes (nome,estabelecimento, contato) VALUES ('aaa','HM PLANEJAMENTO E REPRESENTAÇÃO COMERCIAL LTDA','<p>Representante: Izabele Holanda</p><p>Rua MarechalRondon, 146</p><p>Casa Forte, Recife - PE</p><p>CEP:</p><p>Telefone:</p><p>Email:</p>');
INSERT INTO representantes (nome,estabelecimento, contato) VALUES ('aaa','HM PLANEJAMENTO E REPRESENTAÇÃO COMERCIAL LTDA','<p>Representante: Izabele Holanda</p><p>Rua MarechalRondon, 146</p><p>Casa Forte, Recife - PE</p><p>CEP:</p><p>Telefone:</p><p>Email:</p>');
INSERT INTO representantes (nome,estabelecimento, contato) VALUES ('aaa','HM PLANEJAMENTO E REPRESENTAÇÃO COMERCIAL LTDA','<p>Representante: Izabele Holanda</p><p>Rua MarechalRondon, 146</p><p>Casa Forte, Recife - PE</p><p>CEP:</p><p>Telefone:</p><p>Email:</p>');



create table solucao_linhas(
id int primary key auto_increment,
titulo varchar(256),
link varchar(256)
);

INSERT INTO solucao_linhas (titulo,link) VALUES ('LINHA RAPID','/RAPID');
INSERT INTO solucao_linhas (titulo,link) VALUES ('LINHA PRISMA','/PRISMA');
INSERT INTO solucao_linhas (titulo,link) VALUES ('LINHA PETRA','/PETRA');
INSERT INTO solucao_linhas (titulo,link) VALUES ('LINHA MEC-PLUS','/MEC-PLUS');
INSERT INTO solucao_linhas (titulo,link) VALUES ('LINHA VOLTS','/VOLTS' );
INSERT INTO solucao_linhas (titulo,link) VALUES ('LINHA MILLENIUN','/MILLENIUM');
INSERT INTO solucao_linhas (titulo,link) VALUES ('LINHA CLÁSSICA','/CLÁSSICA');
INSERT INTO solucao_linhas (titulo,link) VALUES ('LINHA SOBREPOR MILLENIUM','SOBREPOR_MILLENIUM');
INSERT INTO solucao_linhas (titulo,link) VALUES ('LINHA SOBREPOR PETRA','/SOBREPOR_PETRA');
INSERT INTO solucao_linhas (titulo,link) VALUES ('LINHA INFORMÁTICA','/INFORMÁTICA');
INSERT INTO solucao_linhas (titulo,link) VALUES ('LINHA EXTERNA','/EXTERNA');
INSERT INTO solucao_linhas (titulo,link) VALUES ('LINHA POTES','/POTES');
INSERT INTO solucao_linhas (titulo,link) VALUES ('LINHA FITAS','/FITAS');
INSERT INTO solucao_linhas (titulo,link) VALUES ('LINHA CAIXA DE PASSAGEM');
INSERT INTO solucao_linhas (titulo,link) VALUES ('LINHA DE EXTESÕES E CORDÕES PROLONGADORES');



create table solucoes(
id int primary key auto_increment,
linha_id int,
titulo varchar(256),
codigo varchar(256),
img_1 varchar(256),
img_2 varchar(256),
img_3 varchar(256),
video_destaque varchar(256),
descricao text,
descricao_en text,
descricao_es text,
destaque boolean
);

INSERT INTO solucoes (titulo,codigo,img_frente,img_atras) VALUES  ('LINHA RAPID','12345','/img/tomada.png','/img/linhaRapid.png');
INSERT INTO solucoes (titulo,codigo,img_frente,img_atras) VALUES  ('LINHA PRISMA','12345','/img/tomada.png','/img/linhaRapid.png');
INSERT INTO solucoes (titulo,codigo,img_frente,img_atras) VALUES  ('LINHA PETRA','12345','/img/tomada.png','/img/linhaRapid.png');
INSERT INTO solucoes (titulo,codigo,img_frente,img_atras) VALUES  ('LINHA MEC-PLUS','12345','/img/tomada.png','/img/linhaRapid.png');
INSERT INTO solucoes (titulo,codigo,img_frente,img_atras) VALUES  ('LINHA VOLTS','12345','/img/tomada.png','/img/linhaRapid.png');
INSERT INTO solucoes (titulo,codigo,img_frente,img_atras) VALUES  ('LINHA MILLENIUN','12345','/img/tomada.png','/img/linhaRapid.png');
INSERT INTO solucoes (titulo,codigo,img_frente,img_atras) VALUES ('LINHA CLÁSSICA','12345','/img/tomada.png','/img/linhaRapid.png');
INSERT INTO solucoes (titulo,codigo,img_frente,img_atras) VALUES  ('LINHA SOBREPOR MILLENIUM','12345','/img/tomada.png','/img/linhaRapid.png');
INSERT INTO solucoes (titulo,codigo,img_frente,img_atras) VALUES  ('LINHA SOBREPOR PETRA','12345','/img/tomada.png','/img/linhaRapid.png');
INSERT INTO solucoes (titulo,codigo,img_frente,img_atras) VALUES  ('LINHA INFORMÁTICA','12345','/img/tomada.png','/img/linhaRapid.png');
INSERT INTO solucoes (titulo,codigo,img_frente,img_atras) VALUES ('LINHA EXTERNA','12345','/img/tomada.png','/img/linhaRapid.png');
INSERT INTO solucoes (titulo,codigo,img_frente,img_atras) VALUES  ('LINHA POTES','12345','/img/tomada.png','/img/linhaRapid.png');
INSERT INTO solucoes (titulo,codigo,img_frente,img_atras) VALUES  ('LINHA FITAS','12345','/img/tomada.png','/img/linhaRapid.png');
INSERT INTO solucoes (titulo,codigo,img_frente,img_atras) VALUES ('LINHA CAIXA DE PASSAGEM','12345','/img/tomada.png','/img/linhaRapid.png');
INSERT INTO solucoes (titulo,codigo,img_frente,img_atras) VALUES ('LINHA DE EXTESÕES E CORDÕES PROLONGADORES','12345','/img/tomada.png','/img/linhaRapid.png');


create table catalogo(
id int primary key auto_increment,
titulo varchar(256),
pdf varchar(256),
imagem varchar(256)
);

create table newsletter(
id int primary key auto_increment,
nome varchar(256),
email varchar(256),
criado_em datetime
);

