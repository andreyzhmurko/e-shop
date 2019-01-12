<?php

/**
 * Класс Db
 * Компонент для работы с базой данных
 */
class Db
{

    /**
     * Устанавливает соединение с базой данных
     * @return \PDO (Объект класса PDO для работы с БД)
     */
    public static function getConnection()
    {
        // Получаем параметры подключения из файла
        $parametersPath = 'app/config/db_parameters.php';
        $parameters = include($parametersPath);

        // Устанавливаем соединение
        $db = new mysqli($parameters['host'], $parameters['user'], $parameters['password'], $parameters['dbname']);

        return $db;
    }

}
