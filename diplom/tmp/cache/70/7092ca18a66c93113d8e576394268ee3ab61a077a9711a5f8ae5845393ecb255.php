<?php

/* admin-interface.phtml */
class __TwigTemplate_b3b025e7d4e659d4a2d36fda08024bbf0cce201d1455a66748daef60f777438e extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!doctype html>
<html lang=\"en\" class=\"no-js\">
<head>
\t<meta charset=\"UTF-8\">
\t<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">

\t<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>

\t<link rel=\"stylesheet\" href=\"css/reset.css\">
\t<link rel=\"stylesheet\" href=\"css/style.css\">
\t<script src=\"js/modernizr.js\"></script>
\t<title>FAQ</title>
</head>
<body>
<header>
    <h1>Привет, Админ!</h1>
</header>
<a href=\"logout.php\">Выйти</a><br><br>
<section class=\"cd-faq\">
\t
\t<div class=\"cd-faq-items\">
        ";
        // line 22
        if ($this->getAttribute((isset($context["changing"]) ? $context["changing"] : null), "true", array())) {
            // line 23
            echo "           <h2>Редактирование вопроса:</h2>
           <form method=\"POST\">
                <label for=\"name\">Имя:</label>
                <input name=\"name\" id=\"name\" value=\"";
            // line 26
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["changing"]) ? $context["changing"] : null), "name", array()), "html", null, true);
            echo "\"><br><br>
                <label for=\"cat\">Категория вопроса: </label>
                <select name=\"cat\">
                    ";
            // line 29
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["categories"]) ? $context["categories"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["cat"]) {
                // line 30
                echo "                        ";
                if (($this->getAttribute($context["cat"], "id", array()) == $this->getAttribute((isset($context["changing"]) ? $context["changing"] : null), "cat", array()))) {
                    // line 31
                    echo "                            <option value=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["cat"], "id", array()), "html", null, true);
                    echo "\" selected>";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["cat"], "name", array()), "html", null, true);
                    echo "</option>
                        ";
                } else {
                    // line 33
                    echo "                            <option value=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["cat"], "id", array()), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["cat"], "name", array()), "html", null, true);
                    echo "</option>
                        ";
                }
                // line 35
                echo "                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['cat'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 36
            echo "                </select><br><br>
                <label for=\"text\">Вопрос:</label><br>
                <textarea name=\"text\" id=\"text\" width=\"200\" cols=60 rows=8>
                    ";
            // line 39
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["changing"]) ? $context["changing"] : null), "text", array()), "html", null, true);
            echo "
                </textarea><br>
                <label for=\"answer\">Ответ:</label><br>
                <textarea name=\"answer\" id=\"answer\" width=\"200\" cols=60 rows=8>
                    ";
            // line 43
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["changing"]) ? $context["changing"] : null), "answer", array()), "html", null, true);
            echo "
                </textarea><br>
                <input type=\"hidden\" value=\"";
            // line 45
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["changing"]) ? $context["changing"] : null), "id", array()), "html", null, true);
            echo "\" name=\"questionID\">
                <input type=\"submit\" name=\"confirmChangeQuestion\" value =\"Подтвердить\">
           </form>
        ";
        }
        // line 49
        echo "        <ul id=\"users\" class=\"cd-faq-group\">            
            <li>
                <a class=\"cd-faq-trigger\" href=\"#0\">Администраторы</a>
                <div class=\"cd-faq-content\">
                  <b>Добавить нового:</b>
                   <form method=\"POST\">
                        <label for=\"login\">Логин: </label>
                        <input name=\"login\">
                        <label for=\"password\">Пароль: </label>
                        <input name=\"password\">
                        <input type=\"submit\" name=\"newAdmin\" value=\"Добавить\">
                   </form>
                   <br>
                    <table class=\"super-table\">
                       <tr>
                           <td>Имя</td>
                           <td>Пароль</td>
                           <td>Х</td>
                       </tr>
                        ";
        // line 68
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["admins"]) ? $context["admins"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["admin"]) {
            // line 69
            echo "                            <tr>
                                <td>";
            // line 70
            echo twig_escape_filter($this->env, $this->getAttribute($context["admin"], "name", array()), "html", null, true);
            echo "</td>
                                <td>";
            // line 71
            echo twig_escape_filter($this->env, $this->getAttribute($context["admin"], "password", array()), "html", null, true);
            echo "</td>
                                <td>
                                    <form method=\"POST\">
                                        <input type=\"hidden\" value=\"";
            // line 74
            echo twig_escape_filter($this->env, $this->getAttribute($context["admin"], "id", array()), "html", null, true);
            echo "\" name=\"adminID\">
                                        <input type=\"submit\" name=\"deleteAdmin\" value=\"Удалить\">
                                    </form>
                                </td>
                            </tr>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['admin'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 80
        echo "                    </table>
                    <br>
                    <form method=\"POST\">
                        <label for=\"name\">Поменять пароль для: </label>
                        <select name=\"adminID\">
                            ";
        // line 85
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["admins"]) ? $context["admins"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["admin"]) {
            // line 86
            echo "                                <option value=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["admin"], "id", array()), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["admin"], "name", array()), "html", null, true);
            echo "</option>
                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['admin'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 88
        echo "                        </select>
                        <label for=\"newPassword\">Новый пароль: </label>
                        <input name=\"newPassword\">
                        <input type=\"submit\" name=\"changePassword\" value=\"Подтвердить\">
                    </form>
                </div>
            </li>
            
            <li>
                <a class=\"cd-faq-trigger\" href=\"#0\">Темы</a>
                <div class=\"cd-faq-content\">
                   <b>Добавить новую тему:</b>
                   <form method=\"POST\">
                        <input name=\"newCatName\">
                        <input type=\"submit\" name=\"newCat\" value=\"Добавить\">
                   </form><br>
                    <table class=\"super-table\">
                       <tr>
                           <td>Название</td>
                           <td>Кол-во вопросов</td>
                           <td>Неотвеченных</td>
                           <td>Удалить тему и все вопросы</td>
                       </tr>
                        ";
        // line 111
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["categories"]) ? $context["categories"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["cat"]) {
            // line 112
            echo "                            <tr>
                                <td>";
            // line 113
            echo twig_escape_filter($this->env, $this->getAttribute($context["cat"], "name", array()), "html", null, true);
            echo "</td>
                                <td>";
            // line 114
            echo twig_escape_filter($this->env, $this->getAttribute($context["cat"], "allQuestions", array()), "html", null, true);
            echo "</td>
                                <td>";
            // line 115
            echo twig_escape_filter($this->env, $this->getAttribute($context["cat"], "na", array()), "html", null, true);
            echo "</td>
                                <td>
                                    <form method=\"POST\">
                                        <input type=\"hidden\" value=\"";
            // line 118
            echo twig_escape_filter($this->env, $this->getAttribute($context["cat"], "id", array()), "html", null, true);
            echo "\" name=\"adminID\">
                                        <input type=\"submit\" name=\"deleteCat\" value=\"Удалить\">
                                    </form>
                                </td>
                            </tr>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['cat'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 124
        echo "                    </table>
                </div>
            </li>
            
            <li>
                <a class=\"cd-faq-trigger\" href=\"#0\">Все вопросы</a>
                <div class=\"cd-faq-content\">
                    <ul class=\"cd-faq-group\">
                        ";
        // line 132
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["categories"]) ? $context["categories"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["cat"]) {
            // line 133
            echo "                            <li class=\"cd-faq-title\"><h2>";
            echo twig_escape_filter($this->env, $this->getAttribute($context["cat"], "name", array()), "html", null, true);
            echo "</h2></li>
                            <table class=\"super-table\">
                                <tr>
                                    <td>Вопрос</td>
                                    <td>Имя</td>
                                    <td>Почта</td>
                                    <td>Дата</td>
                                    <td>Статус</td>
                                    <td>Ответ</td>
                                    <td>Действия</td>
                                </tr>
                                ";
            // line 144
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["cat"], "questions", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["question"]) {
                // line 145
                echo "                                    <tr>
                                        <td>";
                // line 146
                echo twig_escape_filter($this->env, $this->getAttribute($context["question"], "text", array()), "html", null, true);
                echo "</td>
                                        <td>";
                // line 147
                echo twig_escape_filter($this->env, $this->getAttribute($context["question"], "name", array()), "html", null, true);
                echo "</td>
                                        <td>";
                // line 148
                echo twig_escape_filter($this->env, $this->getAttribute($context["question"], "email", array()), "html", null, true);
                echo "</td>
                                        <td>";
                // line 149
                echo twig_escape_filter($this->env, $this->getAttribute($context["question"], "date", array()), "html", null, true);
                echo "</td>
                                        <td>
                                            ";
                // line 151
                if (($this->getAttribute($context["question"], "status", array()) == 1)) {
                    // line 152
                    echo "                                                Ожидает ответа
                                            ";
                } elseif (($this->getAttribute(                // line 153
$context["question"], "status", array()) == 2)) {
                    // line 154
                    echo "                                                Ответ получен
                                            ";
                } elseif (($this->getAttribute(                // line 155
$context["question"], "status", array()) == 3)) {
                    // line 156
                    echo "                                                Скрыт
                                            ";
                }
                // line 158
                echo "                                        </td>
                                        <td>";
                // line 159
                echo twig_escape_filter($this->env, $this->getAttribute($context["question"], "answer", array()), "html", null, true);
                echo "</td>
                                        <td>
                                            <form method=\"POST\">
                                                <input type=\"hidden\" value=\"";
                // line 162
                echo twig_escape_filter($this->env, $this->getAttribute($context["question"], "id", array()), "html", null, true);
                echo "\" name=\"questionID\">
                                                ";
                // line 163
                if (($this->getAttribute($context["question"], "status", array()) == 2)) {
                    // line 164
                    echo "                                                    <input type=\"submit\" name=\"hideQuestion\" value=\"Скрыть\">
                                                ";
                } elseif (($this->getAttribute(                // line 165
$context["question"], "status", array()) == 3)) {
                    // line 166
                    echo "                                                    <input type=\"submit\" name=\"showQuestion\" value=\"Показывать\">
                                                ";
                }
                // line 168
                echo "                                                <input type=\"submit\" name=\"changeQuestion\" value=\"Редактировать\">
                                                <input type=\"submit\" name=\"deleteQuestion\" value=\"Удалить\">
                                            </form>
                                        </td>
                                    </tr>
                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['question'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 174
            echo "                            </table><br>
                            <form method=\"POST\">
                                <label for=\"questionID\">Поменять категорию для: </label>
                                <select name=\"questionID\">
                                    ";
            // line 178
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["cat"], "questions", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["question"]) {
                // line 179
                echo "                                        <option value=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($context["question"], "id", array()), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $this->getAttribute($context["question"], "text", array()), "html", null, true);
                echo "</option>
                                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['question'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 181
            echo "                                </select>
                                <label for=\"newPassword\">Новая категория: </label>
                                <select name=\"catID\">
                                    ";
            // line 184
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["categories"]) ? $context["categories"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["category"]) {
                // line 185
                echo "                                        ";
                if (($this->getAttribute($context["category"], "id", array()) != $this->getAttribute($context["cat"], "id", array()))) {
                    // line 186
                    echo "                                            <option value=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["category"], "id", array()), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["category"], "name", array()), "html", null, true);
                    echo "</option>
                                        ";
                }
                // line 188
                echo "                                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['category'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 189
            echo "                                </select>
                                <input type=\"submit\" name=\"changeCategory\" value=\"Подтвердить\">
                            </form><br>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['cat'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 193
        echo "                    </ul>
                </div>
            </li>
            
            <li>
                <a class=\"cd-faq-trigger\" href=\"#0\">Вопросы без ответов</a>
                <div class=\"cd-faq-content\">
                    <ul class=\"cd-faq-group\">
                        ";
        // line 201
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["categories"]) ? $context["categories"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["cat"]) {
            // line 202
            echo "                            <li class=\"cd-faq-title\"><h2>";
            echo twig_escape_filter($this->env, $this->getAttribute($context["cat"], "name", array()), "html", null, true);
            echo "</h2></li>
                            <table class=\"super-table\">
                                <tr>
                                    <td>Вопрос</td>
                                    <td>Имя</td>
                                    <td>Почта</td>
                                    <td>Дата</td>
                                    <td>Ответ</td>
                                    <td>Действия</td>
                                </tr>
                                ";
            // line 212
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["cat"], "questions", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["question"]) {
                // line 213
                echo "                                   ";
                if (($this->getAttribute($context["question"], "status", array()) == 1)) {
                    // line 214
                    echo "                                        <tr>
                                            <td>";
                    // line 215
                    echo twig_escape_filter($this->env, $this->getAttribute($context["question"], "text", array()), "html", null, true);
                    echo "</td>
                                            <td>";
                    // line 216
                    echo twig_escape_filter($this->env, $this->getAttribute($context["question"], "name", array()), "html", null, true);
                    echo "</td>
                                            <td>";
                    // line 217
                    echo twig_escape_filter($this->env, $this->getAttribute($context["question"], "email", array()), "html", null, true);
                    echo "</td>
                                            <td>";
                    // line 218
                    echo twig_escape_filter($this->env, $this->getAttribute($context["question"], "date", array()), "html", null, true);
                    echo "</td>
                                            <td>
                                                <form method=\"POST\">
                                                    <input type=\"hidden\" value=\"";
                    // line 221
                    echo twig_escape_filter($this->env, $this->getAttribute($context["question"], "id", array()), "html", null, true);
                    echo "\" name=\"questionID\">
                                                    <textarea name=\"answer\"></textarea>
                                                    <select name=\"status\">
                                                        <option value=2>Видимый</option>
                                                        <option value=3>Невидимый</option>
                                                    </select>
                                                    <input type=\"submit\" name=\"answerQuestion\" value=\"Ответить\">
                                                </form>
                                            </td>
                                            <td>
                                                <form method=\"POST\">
                                                    <input type=\"hidden\" value=\"";
                    // line 232
                    echo twig_escape_filter($this->env, $this->getAttribute($context["question"], "id", array()), "html", null, true);
                    echo "\" name=\"questionID\">
                                                    <input type=\"submit\" name=\"changeQuestion\" value=\"Редактировать\">
                                                    <input type=\"submit\" name=\"deleteQuestion\" value=\"Удалить\">
                                                </form>
                                            </td>
                                        </tr>
                                    ";
                }
                // line 239
                echo "                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['question'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 240
            echo "                            </table><br>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['cat'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 242
        echo "                    </ul>
                </div>
            </li>
        </ul>
        
\t</div>
\t<a href=\"#0\" class=\"cd-close-panel\">Close</a>
</section>
<script src=\"js/jquery-2.1.1.js\"></script>
<script src=\"js/jquery.mobile.custom.min.js\"></script>
<script src=\"js/main.js\"></script>
</body>
</html>";
    }

    public function getTemplateName()
    {
        return "admin-interface.phtml";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  491 => 242,  484 => 240,  478 => 239,  468 => 232,  454 => 221,  448 => 218,  444 => 217,  440 => 216,  436 => 215,  433 => 214,  430 => 213,  426 => 212,  412 => 202,  408 => 201,  398 => 193,  389 => 189,  383 => 188,  375 => 186,  372 => 185,  368 => 184,  363 => 181,  352 => 179,  348 => 178,  342 => 174,  331 => 168,  327 => 166,  325 => 165,  322 => 164,  320 => 163,  316 => 162,  310 => 159,  307 => 158,  303 => 156,  301 => 155,  298 => 154,  296 => 153,  293 => 152,  291 => 151,  286 => 149,  282 => 148,  278 => 147,  274 => 146,  271 => 145,  267 => 144,  252 => 133,  248 => 132,  238 => 124,  226 => 118,  220 => 115,  216 => 114,  212 => 113,  209 => 112,  205 => 111,  180 => 88,  169 => 86,  165 => 85,  158 => 80,  146 => 74,  140 => 71,  136 => 70,  133 => 69,  129 => 68,  108 => 49,  101 => 45,  96 => 43,  89 => 39,  84 => 36,  78 => 35,  70 => 33,  62 => 31,  59 => 30,  55 => 29,  49 => 26,  44 => 23,  42 => 22,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "admin-interface.phtml", "C:\\OpenServer\\domains\\localhost\\diplom\\templates\\admin-interface.phtml");
    }
}
