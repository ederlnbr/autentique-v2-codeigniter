# autentique-v2-codeigniter
Projeto para integração com a ferramenta de geração de assinaturas digitais Autentique.
https://www.autentique.com.br/

### Carregando Biblioteca
```php
$this->load->library("MY_Autentique", array(), "lib_autentique");
```

## Manipulando Pastas

### Criado Pasta
```php
 $this->lib_autentique->folder()->create("Nome da Pasta");
```
### Ler Pasta
```php
$this->lib_autentique->folder()->get("UUID DA PASTA");	
```
### Listar Documentos da Pastas
```php
$this->lib_autentique->folder()->listDocuments("UUID DA PASTA");
```
### Mover Documento da Pasta
```php
$this->lib_autentique->folder()->move("UUID DA PASTA", "UUID DO DOCUMENTO");
```
### Apagar Pasta
```php
$this->lib_autentique->folder()->delete("UUID DA PASTA");
```

## Manipulando Documentos

### Criado Documento
```php
$this->lib_autentique->document()->create(
[
	"file" 	   => "uploads/file.pdf",
	"name" 	   => "NOME DO DOCUMENTO",
	"signers"  => 
	[
		[
			"email"  => "username@dominio.com",
			"action" => "SIGN"
		],
		[
			"name"  => "JOÃO DA SILVA",
			"action" => "SIGN"
		],
	]
]);	
```
### Listar Documentos
```php
$this->lib_autentique->document()->list();
```
### Ler Documento
```php
$this->lib_autentique->document()->get("UUID DO DOCUMENTO");
```
### Apagar Documento
```php
$this->lib_autentique->document()->delete("UUID DO DOCUMENTO");
```
### Assinar Documento
```php
$this->lib_autentique->document()->sign("UUID DO DOCUMENTO");
```

Gostaria de deixar os créditos ao vinicinbgs, me inspirei na biblioteca dele para criar esta voltada para o codeigniter. Abaixo o link do repostório dele;
https://github.com/vinicinbgs/autentique-v2
