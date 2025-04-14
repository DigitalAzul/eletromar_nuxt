representantescreate database teste;
use teste;



create table blog_posts (
id int PRIMARY KEY auto_increment,
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

select bg.*,
ba.id AS autor_id,
bgi.id AS bImagem_id,
ba.nome, ba.bio, ba.bio_en, ba.bio_es, ba.imagem, ba.social_instagram, ba.social_facebook,ba.social_linkedin,
bgi.imagem_url, bgi.blog_id, bgi.banner

from blog_posts AS bg
LEFT JOIN blog_imagens AS bgi ON bgi.blog_id = bg.id
LEFT JOIN blog_autor AS ba ON ba.id = bg.blog_autor_id;

SELECT * FROM blog_posts WHERE categoria = "marketing" LIMIT 0,10;

create table categorias (
id int PRIMARY KEY auto_increment,
titulo varchar(256),
titulo_en varchar(256),
titulo_es varchar(256)
);

ALTER TABLE categorias
ADD titulo_en varchar(255);
ALTER TABLE categorias
ADD titulo_es varchar(255);

INSERT INTO categorias (titulo) VALUES ('Marketing');
INSERT INTO categorias (titulo) VALUES ('Negócios');
INSERT INTO categorias (titulo) VALUES ('Dicas');
INSERT INTO categorias (titulo) VALUES ('Designer');
INSERT INTO categorias (titulo) VALUES ('Linha Petra');
INSERT INTO categorias (titulo) VALUES ('Eletromar');
INSERT INTO categorias (titulo) VALUES ('Videos');

create table blog_imagens(
id int PRIMARY KEY  auto_increment,
imagem_url varchar(256),
blog_id int,
tipo int
);
INSERT INTO blog_imagens (imagem_url,blog_id, banner) VALUES ('\\ksjdfklsjdflk\\',1, true);

create table blog_autor(
id int PRIMARY KEY auto_increment,
nome varchar(256),
bio text,
bio_en text,
bio_es text,
imagem varchar(256),
social_instagram varchar(256),
social_facebook varchar(256),
social_linkedin varchar(256)
);


ALTER TABLE comentarios
ADD blog_posts_id int;

create table comentarios(
id int PRIMARY KEY auto_increment,
blog_posts_id int,
nome varchar(256),
criado_em date,
comentario text,
email varchar(256),
localidade varchar (256),
imagem_url text,
resposta text,
ativado boolean
);

create table resposta_comentario(
id int PRIMARY KEY auto_increment,
comentarios_id int,
criado_em date,
texto varchar(256)
);


create table ufs(
id int PRIMARY KEY auto_increment,
estado varchar(256),
Sigla varchar (5)
);

create table representantes(
id int PRIMARY KEY auto_increment,
nome varchar(256),
estabelecimento varchar (256),
uf char(2),
contato text
);

INSERT INTO representantes (nome,estabelecimento, contato) VALUES ('aaa','HM PLANEJAMENTO E REPRESENTAÇÃO COMERCIAL LTDA','<p>Representante: Izabele Holanda</p><p>Rua MarechalRondon, 146</p><p>Casa Forte, Recife - PE</p><p>CEP:</p><p>Telefone:</p><p>Email:</p>');
INSERT INTO representantes (nome,estabelecimento, contato) VALUES ('aaa','HM PLANEJAMENTO E REPRESENTAÇÃO COMERCIAL LTDA','<p>Representante: Izabele Holanda</p><p>Rua MarechalRondon, 146</p><p>Casa Forte, Recife - PE</p><p>CEP:</p><p>Telefone:</p><p>Email:</p>');
INSERT INTO representantes (nome,estabelecimento, contato) VALUES ('aaa','HM PLANEJAMENTO E REPRESENTAÇÃO COMERCIAL LTDA','<p>Representante: Izabele Holanda</p><p>Rua MarechalRondon, 146</p><p>Casa Forte, Recife - PE</p><p>CEP:</p><p>Telefone:</p><p>Email:</p>');
INSERT INTO representantes (nome,estabelecimento, contato) VALUES ('aaa','HM PLANEJAMENTO E REPRESENTAÇÃO COMERCIAL LTDA','<p>Representante: Izabele Holanda</p><p>Rua MarechalRondon, 146</p><p>Casa Forte, Recife - PE</p><p>CEP:</p><p>Telefone:</p><p>Email:</p>');
INSERT INTO representantes (nome,estabelecimento, contato) VALUES ('aaa','HM PLANEJAMENTO E REPRESENTAÇÃO COMERCIAL LTDA','<p>Representante: Izabele Holanda</p><p>Rua MarechalRondon, 146</p><p>Casa Forte, Recife - PE</p><p>CEP:</p><p>Telefone:</p><p>Email:</p>');
INSERT INTO representantes (nome,estabelecimento, contato) VALUES ('aaa','HM PLANEJAMENTO E REPRESENTAÇÃO COMERCIAL LTDA','<p>Representante: Izabele Holanda</p><p>Rua MarechalRondon, 146</p><p>Casa Forte, Recife - PE</p><p>CEP:</p><p>Telefone:</p><p>Email:</p>');

select * from representantes;



create table solucao_linhas(
id int PRIMARY KEY auto_increment,
titulo varchar(256),
link varchar(256),
descricao varchar(256),
ordem int
);
ALTER TABLE solucao_linhas
ADD descricao text;

ALTER TABLE solucao_linhas
ADD descricao_en text;

ALTER TABLE solucao_linhas
ADD descricao_es text;

ALTER TABLE solucao_linhas
ADD ativo boolean;

ALTER TABLE solucao_linhas
ADD ordem int;




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
INSERT INTO solucao_linhas (titulo,link) VALUES ('LINHA CAIXA DE PASSAGEM','/CAIXA');
INSERT INTO solucao_linhas (titulo,link) VALUES ('LINHA DE EXTESÕES E CORDÕES PROLONGADORES', '/CORDOES');

select * from solucao_linhas;

create table solucoes(
id int PRIMARY KEY auto_increment,
linha_id int,
titulo varchar(256),
titulo_en varchar(256),
titulo_es varchar(256),
codigo varchar(256),
img_1 varchar(256),
img_2 varchar(256),
img_3 varchar(256),
video_destaque varchar(256),
descricao text,
descricao_en text,
descricao_es text,
destaque boolean,
dwg varchar(256)
);

ALTER TABLE solucoes
ADD dwg varchar(256);


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


select * from blog_posts;
select * from blog_imagens;

TRUNCATE `teste`.`blog_posts`;
TRUNCATE `teste`.`blog_imagens`;

create table catalogo(
id int PRIMARY KEY auto_increment,
titulo varchar(256),
pdf varchar(256),
imagem varchar(256)
);

create table newsletter(
id int PRIMARY KEY auto_increment,
nome varchar(256),
email varchar(256),
criado_em datetime
);

create table empresa_ano(
id iNT PRIMARY KEY auto_increment,
ano CHAR(4),
texto_ano TEXT,
texto_ano_en TEXT,
texto_ano_es TEXT,
imagem_ano VARCHAR(256)
);

/* Tabela empresa */
create table empresa(
id iNT PRIMARY KEY auto_increment,
historia TEXT,
historia_en TEXT,
historia_es TEXT,
img_url VARCHAR(256),
missao TEXT,
visao TEXT,
valores TEXT
);

/* Tabela galeria  */
create table galeria(
id iNT PRIMARY KEY auto_increment ,
img_url VARCHAR(256)
);

/* Tabela politica de garantia */
create table garantia(
id iNT PRIMARY KEY auto_increment,
texto TEXT,
texto_en TEXT,
texto_es TEXT,
arquivo VARCHAR(256)
);

/* Tabela politica de qualidade */
create table qualidade(
id iNT PRIMARY KEY auto_increment,
texto TEXT,
texto_en TEXT,
texto_es TEXT,
arquivo VARCHAR(256)
);

/* Tabela meio ambiente */
create table ambiente(
id iNT PRIMARY KEY auto_increment,
texto TEXT,
texto_en TEXT,
texto_es TEXT,
arquivo VARCHAR(256)
);

/* Tabela faq */
create table faq(
id iNT PRIMARY KEY auto_increment,
texto TEXT,
texto_en TEXT,
texto_es TEXT,
arquivo VARCHAR(256)
);

/* Tabela psociais */
create table psociais(
id iNT PRIMARY KEY auto_increment,
texto TEXT,
texto_en TEXT,
texto_es TEXT,
arquivo VARCHAR(256)
);


ALTER TABLE contato
ADD continente varchar(256);
ALTER TABLE contato
ADD pais varchar(256);

create table contato (
id INT PRIMARY KEY AUTO_INCREMENT,
nome VARCHAR(256),
email VARCHAR(256),
continente VARCHAR(256),
pais VARCHAR(256),
uf VARCHAR(256),
cidade VARCHAR(256),
empresa VARCHAR(256),
cnpj VARCHAR(20),
mensagem TEXT,
politica boolean
);

create table setores (
id INT PRIMARY KEY AUTO_INCREMENT,
label VARCHAR(256)
);

create table curriculo (
id INT PRIMARY KEY AUTO_INCREMENT,
nome VARCHAR(256),
email VARCHAR(256),
uf VARCHAR(256),
cidade VARCHAR(256),
setor VARCHAR(256),
pdf VARCHAR(256),
comentario TEXT,
politica boolean
);


## 23/10/2023
create table tags(
id int PRIMARY KEY  auto_increment,
titulo varchar(256),
titulo_en varchar(256),
titulo_es varchar(256)

);
create table tag_post(
id int PRIMARY KEY  auto_increment,
tag_id int,
post_id int
);


ALTER TABLE animacoes
ADD titulo_esquerdo varchar(256);

ALTER TABLE animacoes
ADD titulo_direito varchar(256);

ALTER TABLE animacoes
ADD translateEsq int;

ALTER TABLE animacoes
ADD translateDir int;

ALTER TABLE animacoes
ADD linha_id int;

## EM 07/12/2024
ALTER TABLE animacoes
ADD titulo_direito_en varchar(256);
ALTER TABLE animacoes
ADD titulo_direito_es varchar(256);

ALTER TABLE animacoes
ADD titulo_esquerdo_en varchar(256);
ALTER TABLE animacoes
ADD titulo_esquerdo_es varchar(256);



create table animacoes(
id int PRIMARY KEY auto_increment,
titulo_esquerdo varchar(256),
titulo_esquerdo_en varchar(256),
titulo_esquerdo_es varchar(256),
titulo_direito varchar(256),
titulo_direito_en varchar(256),
titulo_direito_es varchar(256),
ativo varchar(256),
pasta varchar(256),
ordem int,
titulo_esquerdo varchar(256),
titulo_direito varchar(256),
translateEsq int,
translateDir int,
linha_id int
);