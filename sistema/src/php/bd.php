<?php

class bd {
    private static $host = "db";
    private static $dbname = "abhostel"; 
    private static $usuario = "root";
    private static $senha = "root";

    private static $conexao = null;

    private static function conectar() {
        try {
            if (self::$conexao === null) {
                self::$conexao = new PDO(
                    "mysql:host=" . self::$host . ";dbname=" . self::$dbname,
                    self::$usuario,
                    self::$senha
                );

                self::$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }

            return self::$conexao;

        } catch (PDOException $erro) {
            die("Erro ao conectar com o banco de dados: " . $erro->getMessage());
        }
    }

    public static function getConexao() {
        return self::conectar();
    }
}