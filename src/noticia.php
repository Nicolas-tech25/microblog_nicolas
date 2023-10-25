<?php
namespace Microblog;
use PDO, Exception;

final class Noticia{
    private int $id;
    private string $data;
    private string $titulo;
    private string $texto;
    private string $resumo;
    private string $imagem;
    private string $destaque;
    private string $termo; // será usado na busca
    private PDO $conexao;

    /*  propriedades cujo tipo são associados a classes já existentes. Isso permitirá usar recursos destas classes á partir de Noticia. */
    public Usuario $usuario;
    public Categoria $categoria;


    /* Método construct */
    public function __construct(){
        /* Ao criar um objeto noticia, aproveitamos para instanciar objetos de Usuario e Categoria */
        $this->usuario = New Usuario;
        $this->categoria = New Categoria;
        $this->conexao = banco::conecta();
    }

    /* Método crud Iserir */
    public function inserir():void{
        $sql = "INSERT INTO noticias(titulo,texto,resumo,imagem,destaque,usuario_id,categoria_id) VALUES(:titulo, :texto, :resumo, :imagem, :destaque, :usuario_id, :categoria_id)";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":titulo", $this->titulo,PDO::PARAM_STR);
            $consulta->bindValue(":texto", $this->texto,PDO::PARAM_STR);
            $consulta->bindValue(":resumo", $this->resumo,PDO::PARAM_STR);
            $consulta->bindValue(":imagem", $this->imagem,PDO::PARAM_STR);
            $consulta->bindValue(":destaque", $this->destaque,PDO::PARAM_STR);
            
            /* Aqui primeiro chamamos os getters de ID do usuario e de categoria para só depois associar os valores aos parametros da consulta SQL.
            Isso é possivel graças a associação de classes */
            $consulta->bindValue(":usuario_id", $this->usuario->getId(),PDO::PARAM_INT);
            $consulta->bindValue(":categoria_id", $this->categoria->getId(),PDO::PARAM_INT);
            $consulta->execute();
        } catch (Exception $erro) {
            die("Erro ao inserir usuário: ".$erro->getMessage());
        }
        
    }

        /* Método ler */
        public function listar():array {

            if ( $this->usuario->getTipo() === "admin" ) {
                $sql = "SELECT noticias.id,noticias.titulo, noticias.data,usuarios.nome AS Autor, noticias.destaque  FROM noticias INNER JOIN usuarios ON noticias.usuario_id = usuarios.id  ORDER BY data DESC";
            } else {
                $sql = "SELECT id, titulo, data, destaque FROM noticias WHERE usuario_id = :usuario_id ORDER BY data DESC";
            }
    
            try {
                $consulta = $this->conexao->prepare($sql);

                if($this->usuario->getTipo() !== "admin"){
                $consulta->bindValue(":usuario_id", $this->usuario->getId(), PDO::PARAM_INT);
                }
                $consulta->execute();
                $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $erro) {
                die("Erro ao carregar noticias: ".$erro->getMessage());
            }
    
            return $resultado;
        }
    

    /* Método para upload de fotos */
    public function upload(array $arquivo):void{
        // Definindo os tipos válidos
        $tiposValidos = [
            "image/png", "image/jpeg", "image/gif", "image/svg+xml"
        ];

        // Verificando se o arquivo é compativel
        if (!in_array($arquivo["type"], $tiposValidos)) {
            // Alertamos o usuário e o fazemos voltar para o form.                  
            die("<script> alert('Formato invalido!😡🤬'); history.back(); </script>");
        }

        // Acessando apenas o nome/extensão do arquivo
        $nome = $arquivo["name"];

        // Acessando dados de acesso/armazenamento temporário
        $temporario = $arquivo["tmp_name"];

        // definindo o local/pasta de destio das imagens no site
        $pastaFinal = "../imagens/".$nome;

        // Movemos/enviamos da área temporária para a final/destino
        move_uploaded_file($temporario, $pastaFinal);
    }
   





    /* Getters e Setters */


    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

        return $this;
    }

    public function getData(): string
    {
        return $this->data;
    }

    public function setData(string $data): self
    {
        $this->data = filter_var($data, FILTER_SANITIZE_SPECIAL_CHARS);

        return $this;
    }


    public function getTitulo(): string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): self
    {
        $this->titulo = filter_var($titulo, FILTER_SANITIZE_SPECIAL_CHARS);

        return $this;
    }

    public function getTexto(): string
    {
        return $this->texto;
    }

    public function setTexto(string $texto): self
    {
        $this->texto = filter_var($texto, FILTER_SANITIZE_SPECIAL_CHARS);

        return $this;
    }

    public function getResumo(): string
    {
        return $this->resumo;
    }

    public function setResumo(string $resumo): self
    {
        $this->resumo = filter_var($resumo, FILTER_SANITIZE_SPECIAL_CHARS);

        return $this;
    }

    public function getImagem(): string
    {
        return $this->imagem;
    }

    public function setImagem(string $imagem): self
    {
        $this->imagem = filter_var($imagem, FILTER_SANITIZE_SPECIAL_CHARS);

        return $this;
    }

    public function getDestaque(): string
    {
        return $this->destaque;
    }

    public function setDestaque(string $destaque): self
    {
        $this->destaque = filter_var($destaque, FILTER_SANITIZE_SPECIAL_CHARS);

        return $this;
    }

    public function getTermo(): string
    {
        return $this->termo;
    }

    public function setTermo(string $termo): self
    {
        $this->termo = filter_var($termo, FILTER_SANITIZE_SPECIAL_CHARS);

        return $this;
    }
}