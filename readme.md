# File Upload
Este exemplo ilustra o upload de ficheiros usando PHP

## ficheiros
* file.html (form para fazer upload de ficheiro)
* up.php (script que trata o upload)

## funcionamento do lado do cliente (`form.html`)

O upload de ficheiros em PHP pode ser efetuado através de um formulário HTML.
Este formulário deve usar o método **POST** e deverá ainda incluir um atributo a definir o tipo de codificação : `enctype="multipart/form-data`.

O mesmo formulário poderá servir para enviar diversos ficheiros.

O(s) campo(s) do formulário para selecionar o(s) ficheiro(s) a enviar deverá(ão) ser do tipo **FILE** : `<input type="file"   name="fich1">`. A info do ficheiro chegará ao servidor identificada pelo nome da variável de formulário (neste caso : `fich1`).

Adicionalmente, poderá ser definido um campo para limitar o tamanho dos ficheiros a enviar. Este deverá ser um campo escondido (`type=hidden`) com o nome da variável a ser **MAX_FILE_SIZE** (`name=MAX_FILE_SIZE`) e o valor máximo em bytes a ser definido no atributo **value** (`value = '10000000'`)

O formulário poderá ainda servir para enviar quaisquer outras informções para o servidor.

```HTML
<form action="up.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="MAX_FILE_SIZE" value="10000000"/>
    <input type="file"   name="fich1"/>
    <input type="text" name="tag"/>
    <input type="submit" value="enviar">
    <input type="reset"  value="cancelar">
</form>
```

## funcionamento do lado do servidor (`up.php`)

Os ficheiros transferidos via PHP ficam armazendos temporariamente num pasta do servidor com um nome temporário.
Deverão depois ser movidos para a pasta de destino com o nome desejado.

A informação sobre os ficheiros que são carregados via PHP, pode ser obtida através da variável global `$_FILES[]`.

Concretizando para um ficheiro que foi enviado com o nome de variável **fich1**, podem ser acedidas diversas informções como:
* nome original : `$_FILES['fich1']['name']`
* caminho temporário : `$_FILES['fich1']['tmp_name']`
* tamanho : `$_FILES['fich1']['size']`
* tipo de ficheiro : `$_FILES['fich1']['type']`
* erro de upload : `$_FILES['fich1']['error']`

Para verificar se um determinado ficheiro - definido por um caminho - teve origem num upload deve ser usada a função `is_uploaded_file($caminho)`.

Para mover os ficheiros enviados deve ser usada a função `move_uploaded_file($nome_temporario, $caminho_destino)`.

No exemplo ilustrado o ficheiro é armazendao numa pasta **uploads** (tem que estar criada) é-lhe colocado o prefixo **up_** no nome.


``` PHP
if (is_uploaded_file($_FILES['fich1']['tmp_name'])) {
  $target_path = "./uploads/"."up_".$_FILES['fich1']['name'];
  move_uploaded_file($_FILES['fich1']['tmp_name'], $target_path);
}
```
