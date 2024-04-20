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


create table categorias (
id int PRIMARY KEY auto_increment,
titulo varchar(256),
titulo_en varchar(256),
titulo_es varchar(256)
);


create table blog_imagens(
id int PRIMARY KEY  auto_increment,
imagem_url varchar(256),
blog_id int,
tipo int
);


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



create table solucao_linhas(
id int PRIMARY KEY auto_increment,
titulo varchar(256),
link varchar(256),
descricao varchar(256),
descricao_en varchar(255),
descricao_es varchar(255),
ativo boolean,
ordem int
);





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
destaque boolean
);




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




create table galeria(
id iNT PRIMARY KEY auto_increment ,
img_url VARCHAR(256)
);




create table garantia(
id iNT PRIMARY KEY auto_increment,
texto TEXT,
texto_en TEXT,
texto_es TEXT,
arquivo VARCHAR(256)
);



create table qualidade(
id iNT PRIMARY KEY auto_increment,
texto TEXT,
texto_en TEXT,
texto_es TEXT,
arquivo VARCHAR(256)
);



create table ambiente(
id iNT PRIMARY KEY auto_increment,
texto TEXT,
texto_en TEXT,
texto_es TEXT,
arquivo VARCHAR(256)
);



create table faq(
id iNT PRIMARY KEY auto_increment,
texto TEXT,
texto_en TEXT,
texto_es TEXT,
arquivo VARCHAR(256)
);



create table psociais(
id iNT PRIMARY KEY auto_increment,
texto TEXT,
texto_en TEXT,
texto_es TEXT,
arquivo VARCHAR(256)
);



create table contato (
id INT PRIMARY KEY AUTO_INCREMENT,
nome VARCHAR(256),
email VARCHAR(256),
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
