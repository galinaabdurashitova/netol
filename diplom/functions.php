<?php
session_start();
date_default_timezone_set('Europe/Moscow');

class dbQueries
{
    protected $pdo;
    
    public function __construct()
    {
        $this->pdo = new PDO("mysql:host=;dbname=d", "root", "");
    }
    
    public function getAllCategories()
    {
        $catsSQL = 'SELECT * FROM categories';
        return $this->pdo->query($catsSQL);
    }
    
    public function getQuestionsForCat($i)
    {
        $questionsSQL = 'SELECT * FROM questions WHERE cat = ?';
        $questions = $this->pdo->prepare($questionsSQL);
        $questions->execute([$i]);
        return $questions->fetchAll();
    }
    
    public function answersCount($catID)
    {
        $questions = $this->getQuestionsForCat($catID);
        return count($questions);
    }
    
    public function nonansweredAnswersCount($catID)
    {
        $questionsSQL = 'SELECT * FROM questions WHERE cat = ? and status = 1';
        $questions = $this->pdo->prepare($questionsSQL);
        $questions->execute([$catID]);
        $na = $questions->fetchAll();
        return count($na);
    }
    
    public function getAllAdmins()
    {
        $adminsSQL = 'SELECT * FROM admins';
        $admins = $this->pdo->prepare($adminsSQL);
        $admins->execute([]);
        return $admins->fetchAll();
    }
    
    public function insertQuestion($name, $email, $cat, $text)
    {
        if (empty($text) or empty($name) or empty($email)) {
            return False;
        }
        $addNewQuestionSQL = 'INSERT INTO questions (name, date, email, cat, text, status) VALUES (?, ?, ?, ?, ?, ?)';
        $statement = $this->pdo->prepare($addNewQuestionSQL);
        $taskArr = array($name, date('d.m.Y H:i'), $email, $cat, $text, 1);
        $statement->execute($taskArr);
        return True;
    }
    
    public function newAdmin($login, $password)
    {
        if (!empty($login) and !empty($password)) {
            $addNewAdminSQL = 'INSERT INTO admins (name, password) VALUES (?, ?)';
            $statement = $this->pdo->prepare($addNewAdminSQL);
            $taskArr = array($login, $password);
            $statement->execute($taskArr);
        }
    }
    
    public function deleteAdmin($id)
    {
        $deleteAdminSQL = "DELETE FROM admins WHERE id = ?";
        $statement = $this->pdo->prepare($deleteAdminSQL);
        $statement->execute([$id]);
    }
    
    public function newCategory($name)
    {
        if (!empty($name)) {
            $addNewCatSQL = 'INSERT INTO categories (name) VALUES (?)';
            $statement = $this->pdo->prepare($addNewCatSQL);
            $taskArr = array($name);
            $statement->execute($taskArr);
        }
    }
    
    public function deleteCategory($id)
    {
        $deleteCatQuestionsSQL = "DELETE FROM questions WHERE cat = ?";
        $statement = $this->pdo->prepare($deleteCatQuestionsSQL);
        $statement->execute([$id]);
        $deleteCatSQL = "DELETE FROM categories WHERE id = ?";
        $statement = $this->pdo->prepare($deleteCatSQL);
        $statement->execute([$id]);
    }
    
    public function hideQuestion($id)
    {
        $hideQuestionsSQL = "UPDATE questions SET status = 3 WHERE id = ?";
        $statement = $this->pdo->prepare($hideQuestionsSQL);
        $statement->execute([$id]);
    }
    
    public function showQuestion($id)
    {
        $showQuestionsSQL = "UPDATE questions SET status = 2 WHERE id = ?";
        $statement = $this->pdo->prepare($showQuestionsSQL);
        $statement->execute([$id]);
    }
    
    public function answerQuestion($id, $answer, $status)
    {
        $answerQuestionsSQL = "UPDATE questions SET answer = ?, status = ? WHERE id = ?";
        $statement = $this->pdo->prepare($answerQuestionsSQL);
        $statement->execute([$answer, $status, $id]);
    }
    
    public function deleteQuestion($id)
    {
        $deleteQuestionsSQL = "DELETE FROM questions WHERE id = ?";
        $statement = $this->pdo->prepare($deleteQuestionsSQL);
        $statement->execute([$id]);
    }
    
    public function changeCategory($question, $category)
    {
        $changeCategorySQL = "UPDATE questions SET cat = ? WHERE id = ?";
        $statement = $this->pdo->prepare($changeCategorySQL);
        $statement->execute([$category, $question]);
    }
    
    public function changeQuestion($id)
    {
        $changeQuestionSQL = "SELECT * FROM questions WHERE id = ?";
        $statement = $this->pdo->prepare($changeQuestionSQL);
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
    
    public function confirmChangeQuestion($id, $name, $text, $answer, $cat)
    {
        $confirmChangeQuestionSQL = "UPDATE questions SET name = ?, text = ?, answer = ?, cat = ? WHERE id = ?";
        $statement = $this->pdo->prepare($confirmChangeQuestionSQL);
        $statement->execute([$name, $text, $answer, $cat, $id]);
    }
    
    public function changeAdminPassword($id, $password)
    {
        $changePasswordSQL = "UPDATE admins SET password = ? WHERE id = ?";
        $statement = $this->pdo->prepare($changePasswordSQL);
        $statement->execute([$password, $id]);
    }
    
    public function enterAdmin($login, $password)
    {
        if (empty($login) or empty($password)) {
            return 'Введены неполные данные';
        }
        $adminSQL = 'SELECT name, password FROM admins WHERE name = ?';
        $statement = $this->pdo->prepare($adminSQL);
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

function logout()
{
    session_destroy();
}