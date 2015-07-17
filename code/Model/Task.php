<?php

class Model_Task
{
    private static $_taskSql = "SELECT t.id AS task_id, t.create_time AS task_create_time, t.subject AS task_subject, t.text AS task_text,
                       CONCAT(cu.lastname, ' ', cu.firstname) AS cuser,
                       CONCAT(u.lastname, ' ', u.firstname) AS user,
                       urg.id AS urg_id, urg.value AS urg,
                       comp.id AS comp_id, comp.value AS comp,
                       st.id AS status_id, st.value AS status
                FROM task AS t
                LEFT JOIN user AS cu ON cu.id=t.user_id
                LEFT JOIN user AS u ON u.id=t.user_id
                LEFT JOIN task_urg AS urg ON urg.id=t.task_urg_id
                LEFT JOIN task_comp AS comp ON comp.id=t.task_comp_id
                LEFT JOIN task_status AS st ON st.id=t.task_status_id";


    public static function add($data)
    {
        if (!isset($data['subject']) || !$data['subject'] ) {
            throw new Model_Task_Exception('Не указана тема задачи');
        }
        
        if (strlen($data['subject']) > 50) {
            throw new Model_Task_Exception('Максимальная длина темы 50 символов');
        }
        
        if (!isset($data['text']) || !$data['text'] ) {
            throw new Model_Task_Exception('Не указано задание задачи');
        }
        
        if (!Db::getOne('SELECT id FROM user WHERE id=?', array($data['user_id']))) {
            throw new Model_Task_Exception('Указан неизвестный пользователь');
        }
        
        if (!Db::getOne('SELECT id FROM task_urg WHERE id=?', array($data['task_urg_id']))) {
            throw new Model_Task_Exception('Некорректная срочность');
        }
        
        if (!Db::getOne('SELECT id FROM task_comp WHERE id=?', array($data['task_comp_id']))) {
            throw new Model_Task_Exception('Некорректная сложность');
        }
        
        // все нормально, можно записать в базу
        $data['create_time'] = date('Y-m-d H:i:s');
        $data['create_user_id'] = $_SESSION['user_id'];
        
        Db::insertArray('task', $data);
    }
    
    public static function getAll()
    {   
        return Db::getAll(self::$_taskSql . ' ORDER BY task_create_time DESC');
    }
    
    public static function getAllForUser($userId)
    {
        $sql = self::$_taskSql . ' WHERE u.id=? AND st.id < 3 ORDER BY task_create_time DESC';
        return Db::getAll($sql, array($userId));
    }
    
    public static function getCountForUser($userId)
    {
        return Db::getOne('SELECT count(id) FROM task WHERE user_id=? AND task_status_id<3', array($userId));
    }
    
    public static function getOne($id)
    {
        return Db::getRow(self::$_taskSql . ' WHERE t.id=?', array($id));
    }
    
    public static function setStatus($taskId, $statusId)
    {
        if (Db::getOne('SELECT id FROM task_status WHERE id=?', array($statusId))) {
            Db::updateWithArray('task', $taskId, array('task_status_id'=>$statusId));
        }
    }
    
    public static function getComments($taskId)
    {
        $sql = "SELECT CONCAT(u.lastname, ' ', u.firstname) AS user, c.create_time AS create_time, c.message AS message
                FROM task_comment AS c
                LEFT JOIN user AS u ON u.id=c.user_id
                WHERE task_id=?
                ORDER BY create_time
                ";
        
        return Db::getAll($sql, array($taskId));
    }
    
    public static function addComment($data)
    {
        if (!Db::getOne('SELECT id FROM task WHERE id=?', array($data['task_id']))) {
            throw new Model_Task_Exception('Указана неизвестная задача');
        }
        
        if (!Db::getOne('SELECT id FROM user WHERE id=?', array($data['user_id']))) {
            throw new Model_Task_Exception('Указан неизвестный пользователь');
        }
        
        $data['create_time'] = date('Y-m-d H:i:s');
        
        Db::insertArray('task_comment', $data);
    }
}
