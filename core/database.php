<?php

class Database extends PDO
{
    // Tablodaki asıl anahtar (Primary key)
    private static $pk = 'id';
    private static $query;
    private static $pdo;

    /**
     * Başlatıcı
     * PDO veritabanı bağlantısı kurar
     * Karakter setini UTF-8 olarak belirler
     * Olası hatada çalışmayı durdurur
     */
    public function __construct()
    {
        $conn = "mysql:host=" . DB_HOST . "; port=" . DB_PORT . "; dbname=" . DB_NAME . ";";
        try {
            self::$pdo = new PDO($conn,DB_USERNAME,DB_PASSWORD);
            self::$pdo->exec("SET NAMES " . DB_CHARSET);
            self::$pdo->exec("SET CHARACTER SET " . DB_CHARSET);
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    /**
     * Tablo adına ve koşullara göre tek satır veri döndürür
     * @param string $table Tablo adı
     * @param string $conditions Şartlar (WHERE id=? gibi)
     * @param array $parameters Parametreler (array(1) gibi)
     * @return object Obje şeklinde döndürür ($post->title gibi)
     */
    public static function getOne($table, $conditions = null, $parameters = array())
    {
        self::$query = self::$pdo->prepare('SELECT * FROM ' . $table . ' ' . $conditions);
        self::$query->execute($parameters);
        return self::$query->fetch(PDO::FETCH_OBJ);
    }

    /**
     * Tablo adına ve koşullara göre tek satır veri döndürür
     * @param string $table Tablo adı
     * @param string $id Tablodaki anahtar kelime ID'si
     * @return object Obje şeklinde döndürür ($post->title gibi)
     */
    public static function getId($table, $id, $pk)
    {
        self::$query = self::$pdo->prepare('SELECT * FROM ' . $table . ' WHERE ' . $pk . '=?');
        self::$query->execute(array($id));
        return self::$query->fetch(PDO::FETCH_OBJ);
    }

    /**
     * Tablo adına ve koşullara göre tek veri döndürür
     * @param string $query SQL Sorgusu
     * @param array $parameters Parametreler
     * @return object Obje şeklinde döndürür ($post->title gibi)
     */
    public static function execOne($query, $parameters = array())
    {
        self::$query = self::$pdo->prepare($query);
        self::$query->execute($parameters);
        return self::$query->fetch(PDO::FETCH_OBJ);
    }

    /**
     * Tablo adına ve koşullara göre çoklu veri döndürür
     * @param string $table Tablo adı
     * @param string|null $conditions Şartlar (type=? gibi)
     * @param array $parameters Parametreler (array('post') gibi)
     * @return object Obje şeklinde döndürür ($post->title gibi)
     */
    public static function getAll(string $table, string $conditions = null, array $parameters = array())
    {
        self::$query = self::$pdo->prepare('SELECT * FROM ' . $table . ' ' . $conditions);
        self::$query->execute($parameters);
        return self::$query->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Tablo SQL sorgusuna göre çoklu veri döndürür
     * @param string $query SQL Sorgusu
     * @param array $parameters Parametreler
     * @return object Obje şeklinde döndürür ($post->title gibi)
     */
    public static function execAll($query, $parameters = array())
    {
        self::$query = self::$pdo->prepare($query);
        self::$query->execute($parameters);
        return self::$query->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Tabloya yeni veri eklemek için kullanılır
     * @param string $table Tablo adı
     * @param array $data Dizi şeklinde sütun adları
     * ve karşılarında veriler olmak üzere
     * @return int Son eklenen verinin ID'sini döndürür
     */
    public static function insert($table, $data)
    {
        $values = array();
        $columns = array();
        foreach ($data as $column => $value) {
            $values[] = $value;
            $columns[] = $column;
        }

        $columns = implode(',', $columns);
        $marks = trim(substr(str_repeat('?,', count($values)), 0, -1));

        self::$query = self::$pdo->prepare('INSERT INTO ' . $table . ' (' . $columns . ') VALUES (' . $marks . ')');
        if (self::$query->execute($values)) {
            return self::$pdo->lastInsertId();
        }
        return false;
    }

    /**
     * Tablodaki veriyi güncellemek için kullanılır
     * @param string $table Tablo adı
     * @param int $id Güncellenecek verinin ID'si
     * @param array $data Dizi şeklinde sütun adları
     * ve karşılarında veriler olmak üzere
     * @return int Güncellenen verinin ID'sini ya da false döndürür
     */
    public static function update($table, $id, $data, $conditions = null, $parameters = array())
    {
        if ($id) {
            $values = array();
            $columns = array();
            foreach ($data as $column => $value) {
                $values[] = $value;
                $columns[] = $column;
            }

            $columnsAndMarks = implode('=?,', $columns) . '=?';

            $count = self::count($table, 'WHERE ' . self::$pk . '=?', array($id));
            if ($count) {
                self::$query = self::$pdo->prepare('UPDATE ' . $table . ' SET ' . $columnsAndMarks . ' WHERE ' . self::$pk . '=' . $id);
                if (self::$query->execute($values)) {
                    return $id;
                }
                return false;
            }
            return false;
        } else {
            $values = array();
            $columns = array();
            foreach ($data as $column => $value) {
                $values[] = $value;
                $columns[] = $column;
            }

            $columnsAndMarks = implode('=?,', $columns) . '=?';

            $count = self::count($table, $conditions, $parameters);
            if ($count) {
                self::$query = self::$pdo->prepare('UPDATE ' . $table . ' SET ' . $columnsAndMarks . ' ' . $conditions);
                if (self::$query->execute(array_merge($values, $parameters))) {
                    return $id;
                }
                return false;
            }
            return false;
        }
    }

    /**
     * Tablodaki veriyi silmek/kaldırmak için kullanılır
     * @param string $table Tablo adı
     * @param int $id Silinecek verinin ID'si
     * @return int Silinen verinin ID'sini ya da false döndürür
     */
    public static function delete($table, $pk, $id, $conditions = null, $parameters = array())
    {
        if ($id) {
            $count = self::count($table, 'WHERE ' . $pk . '=?', array($id));
            if ($count) {
                self::$query = self::$pdo->prepare('DELETE FROM ' . $table . ' WHERE ' . $pk . '=' . $id);
                if (self::$query->execute()) {
                    return $id;
                }
                return false;
            }
            return false;
        } else {
            $count = self::count($table, $conditions, $parameters);
            if ($count) {
                self::$query = self::$pdo->prepare('DELETE FROM ' . $table . ' ' . $conditions);
                self::$query->execute($parameters);
                return true;
            }
            return false;
        }
    }

    /**
     * Tablo adına ve koşullara göre satır sayısını döndürür
     * @param string $table Tablo adı
     * @param string $conditions Şartlar (WHERE type=? gibi)
     * @param array $parameters Parametreler (array('post') gibi)
     * @return int Kaç satır veri olduğunu döndürür
     */
    public static function count($table, $conditions = null, $parameters = array())
    {
        self::$query = self::$pdo->prepare('SELECT * FROM ' . $table . ' ' . $conditions);
        self::$query->execute($parameters);
        return self::$query->rowCount();
    }

    /**
     * SQL sorgusuna göre satır sayısını döndürür
     * @param string $query SQL Sorgusu
     * @param array $parameters Parametreler
     * @return int Kaç satır veri olduğunu döndürür
     */
    public static function execCount($query, $parameters = array())
    {
        self::$query = self::$pdo->prepare($query);
        self::$query->execute($parameters);
        return self::$query->rowCount();
    }

    public function setPrimaryKey($pk)
    {
        self::$pk = $pk;
    }

    static function createWhere($columns, $table, $data)
    {
        $w = [];
        foreach ($data as $key => $value) {
            if ($data[$key] != "") $w[] = "$key = '" . $data[$key] . "'";
        }
        $q = implode(" AND ", $w);

        $sql = "SELECT $columns FROM $table WHERE " . $q . ";";

        return $sql;
    }
}
