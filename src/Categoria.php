<?php
namespace Microblog;
use PDO, Exception;

class Categoria {
    private int $id;
    private string $nome;
    private PDO $conexao;

    public function __construct()
    {
        $this->conexao = Banco::conecta();        
    }

    /* Método ler */
    public function listar():array {
        $sql = "SELECT * FROM categorias
        ORDER BY nome";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->execute();
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $erro) {
            die("Erro ao carregar categorias: ".$erro->getMessage());
        }

        return $resultado;
    }

    /* Método ler um (SELECT categoria)*/
    public function listarUm():array {
        $sql = "SELECT * FROM categorias WHERE id = :id";
        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":id",$this->id,PDO::PARAM_INT);
            $consulta->execute();
            $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $erro) {
            die("Erro ao carregar dados da categoria: ".$erro->getMessage());
        }
        return $resultado;
    }

    /* Método Inserir */
    public function inserir():void {
        $sql = "INSERT INTO categorias(nome) VALUES (:nome)";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":nome", $this->nome,PDO::PARAM_STR);
            $consulta->execute();
        } catch (Exception $erro) {
            die("Erro ao inserir categoria: ".$erro->getMessage());
        }
    }

    /* Método atualizar */
    public function atualizar():void {
        $sql = "UPDATE categorias set nome = :nome WHERE id = :id ";
        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":id",$this->id,PDO::PARAM_INT);
            $consulta->bindValue(":nome",$this->nome,PDO::PARAM_STR);
            $consulta->execute();
            $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $erro) {
            die("Erro ao atualizar categoria: ".$erro->getMessage());
        }
    }

    
    /* Método excluir */
    public function excluir():void{
        $sql = "DELETE FROM categorias WHERE id = :id";
        try {
            $consulta = $this->conexao->prepare($sql);
        $consulta->bindValue(":id", $this->id, PDO::PARAM_INT);
        $consulta->execute();
        } catch (Exception $erro) {
            die("Erro ao excluir: ".$erro->getMessage());
        }
    }
    


    /* Getters e setters */
    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }
  
    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }
}