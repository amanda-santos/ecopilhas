<?php
include("include/header.php");

if (isset($_SESSION["login"])) { //SE EXISTIR AUTENTICAÇÃO

	if (!isset($_GET['id'])) { //se não tiver nenhum id passado pela url deve-se redirecionar o usuário para a página inicial
		echo "<script>window.location = 'index.php';</script>";
		exit;
	} else {
	//SE ATUALIZAR POST
	if (isset($_POST["atualizar"])) {
		$id = $_GET["id"];
		$titulo = addslashes($_POST["titulo"]);
		$legenda = addslashes($_POST["legenda"]);
		$imagem = $_POST["imgAntiga"]; 
		if (isset($_POST['header'])){
			$header = 1;
		}else{
			$header = 0;
		}
		$link = addslashes($_POST["link"]);

		if(!empty($_FILES['imagem']['name'])) { // se o input file não estiver vazio, ou seja, se a imagem também foi editada

			//recebe os valores enviados pelo formulário
			$file = $_FILES['imagem'];

			//permite debugar e ver o que foi enviado
			//var_dump($file);

			//conta quantas imagens foram enviadas
			$numFile = count(array_filter($file['name']));

			//define qual pasta a imagem será salva
			$folder = 'upload/img-galeria';;

			//define os tipos suportados de arquivos enviados
			$permite = array("image/tif", "image/jpeg","image/png");
			$maxSize = 1024 * 1024 * 5;

			//Mensagens
			$msg = array(); //cria um array vazio
			//cria um array e já atribui valores das mensagens a ele.
			$erro = array(
			1 =>"O arquivo é maior que o limite definido no max_filesize.",
			2 => "O aquivo ultrapassa o limite de tamanho permitido no MAX_FILE_SIZE.",
			3 => "O upload do arquivo foi feito parcialmente.",
			4 => "Não foi feito o upload do arquivo."
			);

			if ($numFile<=0) {

			} else {
			for ($i=0; $i < $numFile; $i++) {

				$name = $file["name"][$i]; //pega o nome
				$type = $file["type"][$i]; //pega o tipo
				$size = $file["size"][$i]; //pega o tamanho
				$error = $file["error"][$i]; //pega os erros
				$tmp = $file["tmp_name"][$i]; //pega o nome temporário do arquivo quando ele está sendo passado do cliente para o servidor
				$extensao = @end(explode(".", $name)); //pega extensão de cada arquivo

				//var_dump($extensao); //para debugar e ver se está pegando a extensão dos arquivos

				$imagem = rand().".$extensao"; //gera um novo nome único para os arquivos. Poderia também usar a função md5 do php 

				//abaixo estamos tratando as mensagens a serem exibidas para o usuário, em casos de erro ou sucesso no upload
				if ($error != 0) { //se não houver erro ao carregar a imagem
				$msg[] = "<b>$name: </b>".$erro[$error];

				} else if(!in_array($type, $permite)) {
				$msg[] = "<b>$name: </b>ERRO: Tipo de arquivo não suportado. Escolha arquivo do tipo .jpg e .png.";

				} else if ($size > $maxSize) {
				$msg[] = "<b>$name: </b>ERRO: Tamanho do arquivo é maior que o permitido.";

				} else {
				//move o arquivo para a pasta definida
				if (move_uploaded_file($tmp, $folder."/".$imagem)) {
					//trecho para gravar a imagem na pasta e para gravar os dados na pasta da imagem no banco de dados
				} else {
					$msg[] = "<b>$name: </b> Desculpe! Ocorreu um erro ao fazer upload da imagem.";
				}
				}
			}

			//var_dump($msg); //para debugar e ver o conteúdo da variável $msg
			foreach ($msg as $mensagem) {
				echo $mensagem."<br>";
			}
			
			} //fim else "algum arquivo foi enviado"

		} //fim empty

		$sql = 'UPDATE Imagem SET imagem = "' . $imagem . '", titulo = "' . $titulo . '", legenda = "' . $legenda . '", header = ' . $header . ', link = "' . $link . '" WHERE idImagem = ' . $id . ';';
				
		if ($con->query($sql) === TRUE) {
			echo "<script>alert('Atualização realizada com sucesso!');</script>";
			echo "<script>window.location = 'galeria.php';</script>";
		} else {
			echo "Erro: " . $sql . "<br>" . $con->error;
		}
		$con->close(); 

	} //fim se atualizar post

	include("include/footer.php");
	}

} else {
  echo "<script>window.location = 'index.php';</script>";
}
?>