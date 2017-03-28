<?php
session_start();
date_default_timezone_set('Europe/Moscow');


class dbQueries
{
    protected $pdo;
    
    
    public function __construct()
    {
        $this->pdo = new PDO("mysql:host=;dbname=abdurashitova", "abdurashitova", "neto0800");
    }
}


class AdminQueries extends dbQueries
{
    protected $adminsSQL = 'SELECT * FROM admins';
    protected $adminSQL = 'SELECT name, password FROM admins WHERE name = ?';
    protected $changePasswordSQL = "UPDATE admins SET password = ? WHERE id = ?";
    protected $addNewAdminSQL = 'INSERT INTO admins (name, password) VALUES (?, ?)';
    protected $deleteAdminSQL = "DELETE FROM admins WHERE id = ?";
    
    
    public function getAllAdmins()
    {
        $admins = $this->pdo->prepare($this->adminsSQL);
        $admins->execute([]);
        return $admins->fetchAll();
    }
    
    
    public function changeAdminPassword($id, $password)
    {
        $statement = $this->pdo->prepare($this->changePasswordSQL);
        $statement->execute([$password, $id]);
    }
    
    
    public function newAdmin($login, $password)
    {
        $statement = $this->pdo->prepare($this->addNewAdminSQL);
        $taskArr = array($login, $password);
        $statement->execute($taskArr);
    }  
    
    
    public function deleteAdmin($id)
    {
        $statement = $this->pdo->prepare($this->deleteAdminSQL);
        $statement->execute([$id]);
    }
    
    
    public function enterAdmin($login, $password)
    {
        $statement = $this->pdo->prepare($this->adminSQL);
        $statement->execute([$login]);
        $adminData = $statement->fetch();
        if (empty($adminData)) {
            return 'Такого пользователя не существует';
        }
        if ($adminData['password'] != $password) {
            return 'Неверный пароль';
        }
        $_SESSION['name'] = $login;
        $_SESSION['isAdmin'] = True;
        $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];   
        return 1;
    }  
}


class QuestionsQueries extends dbQueries
{
    protected $questionsSQL = 'SELECT * FROM questions WHERE cat = ?';
    protected $questionsStatusSQL = 'SELECT * FROM questions WHERE cat = ? and status = ?';
    protected $changeQuestionSQL = "SELECT * FROM questions WHERE id = ?";
    protected $hideshowQuestionsSQL = "UPDATE questions SET status = ? WHERE id = ?";
    protected $changeCategorySQL = "UPDATE questions SET cat = ? WHERE id = ?";
    protected $confirmChangeQuestionSQL = "UPDATE questions SET name = ?, text = ?, answer = ?, cat = ? WHERE id = ?";
    protected $answerQuestionsSQL = "UPDATE questions SET answer = ?, status = ? WHERE id = ?";
    protected $addNewQuestionSQL = 'INSERT INTO questions (name, date, email, cat, text, status) VALUES (?, ?, ?, ?, ?, ?)';
    protected $deleteQuestionsSQL = "DELETE FROM questions WHERE id = ?";
    
    
    public function getQuestionsForCategory($i)
    {
        $questions = $this->pdo->prepare($this->questionsSQL);
        $questions->execute([$i]);
        return $questions->fetchAll();
    }
    
    
    public function newQuestion($name, $email, $category, $text)
    {
        $statement = $this->pdo->prepare($this->addNewQuestionSQL);
        $taskArr = array($name, date('d.m.Y H:i'), $email, $category, $text, 1);
        $statement->execute($taskArr);
        return True;
    }
    
    
    public function answersCount($categoryID)
    {
        $questions = $this->getQuestionsForCategory($categoryID);
        return count($questions);
    }
    
    
    public function nonansweredAnswersCount($categoryID)
    {
        $questions = $this->pdo->prepare($this->questionsStatusSQL);
        $questions->execute([$categoryID, '1']);
        $naQuestions = $questions->fetchAll();
        return count($naQuestions);
    }
    
    
    public function hideQuestion($id)
    {
        $statement = $this->pdo->prepare($this->hideshowQuestionsSQL);
        $statement->execute(['3', $id]);
    }
    
    
    public function showQuestion($id)
    {
        $statement = $this->pdo->prepare($this->hideshowQuestionsSQL);
        $statement->execute(['2', $id]);
    }
    
    
    public function answerQuestion($id, $answer, $status)
    {
        $statement = $this->pdo->prepare($this->answerQuestionsSQL);
        $statement->execute([$answer, $status, $id]);
    }
    
    
    public function deleteQuestion($id)
    {
        $statement = $this->pdo->prepare($this->deleteQuestionsSQL);
        $statement->execute([$id]);
    }
    
    
    public function changeCategory($question, $category)
    {
        $statement = $this->pdo->prepare($this->changeCategorySQL);
        $statement->execute([$category, $question]);
    }
    
    
    public function changeQuestion($id)
    {
        $statement = $this->pdo->prepare($this->changeQuestionSQL);
        $statement->execute([$id]);
        $questionData = $statement->fetch();
        return array(
            'true' => True,
            'id' => $questionData['id'],
            'name' => $questionData['name'],
            'text' => $questionData['text'],
            'cat' => $questionData['cat'],
            'answer' => $questionData['answer']
        );
    }
    
    
    public function confirmChangeQuestion($id, $name, $text, $answer, $category)
    {
        $statement = $this->pdo->prepare($this->confirmChangeQuestionSQL);
        $statement->execute([$name, $text, $answer, $category, $id]);
    }
}


class CategoriesQueries extends dbQueries
{
    protected $categoriesSQL = 'SELECT * FROM categories';
    protected $addNewCategorySQL = 'INSERT INTO categories (name) VALUES (?)';
    protected $deleteCategoryQuestionsSQL = "DELETE FROM questions WHERE cat = ?";
    protected $deleteCategorySQL = "DELETE FROM categories WHERE id = ?";
    
    
    public function getAllCategories()
    {
        return $this->pdo->query($this->categoriesSQL);
    }
    
    
    public function newCategory($name)
    {
        $statement = $this->pdo->prepare($this->addNewCategorySQL);
        $taskArr = array($name);
        $statement->execute($taskArr);
    }
    
    
    public function deleteCategory($id)
    {
        $statement = $this->pdo->prepare($this->deleteCategoryQuestionsSQL);
        $statement->execute([$id]);
        
        $statement = $this->pdo->prepare($this->deleteCategorySQL);
        $statement->execute([$id]);
    }
}


class Statuses
{
    public static $sent = 1;
    public static $notSent = 0;
    public static $notAllData = 2;
    public static $error = 'Что-то пошло не так!';
}

    
function logout()
{
    session_destroy();
}