<?php
// ============== подключение к базе данных ================
class Database
{
    //Обеспечить единственный существующий экземпляр данного класса
    private static $instance = null;

    //Экземпляр подключения к базе данных
    private $connection = null;

    //Запретить создание новых экземпляров снаружи класса
    protected function __construct()
    {
        $this->connection = new \PDO(
            'mysql:host=localhost;dbname=gameShop',
            'root',
            'anek',
            [
                //В случае проблемы выбросить исключение
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,

                //По умолчанию использовать имена столбцов
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,

                //Не использовать эмуляцию подготовленных выражений средствами PDO,
                //будет использоваться подготовка запроса на уровне базы данных
                PDO::ATTR_EMULATE_PREPARES => false
            ]);
    }

    //Запретить клонирование
    protected function __clone(){}

    //Запретить десериализацию
    public function __wakeup()
    {
        throw new \http\Exception\BadMethodCallException('Unable to deserialize database connection');
    }

    //Создать экземпляр класса, который хранит подключение к БД
    public static function getInstance():Database
    {
        if (self::$instance === null)
        {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    //Экземпляр подключения к базе данных
    public static function connection():\PDO
    {
        return static::getInstance()->connection;
    }

    //Подготовленное выражение
    public static function prepare($statement):\PDOStatement
    {
        return static::connection()->prepare($statement);
    }

    //ID последней добавленной записи
    public static function lastInsertID():int
    {
        return intval(static::connection()->lastInsertID());
    }
}
