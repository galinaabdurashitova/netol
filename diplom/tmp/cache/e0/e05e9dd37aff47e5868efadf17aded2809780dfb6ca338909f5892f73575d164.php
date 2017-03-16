<?php

/* index.phtml */
class __TwigTemplate_7adff205c8883bd2149d20e59c6a9ac37bed2e0445b33d64de39bfb841fb411c extends Twig_Template
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
\t<h1>Задать вопрос</h1>
</header>
<a href=\"admin.php\">Администрирование</a><br><br>
<a href=\"ask.php\">Задать вопрос</a>
<section class=\"cd-faq\">
\t<ul class=\"cd-faq-categories\">
\t    ";
        // line 22
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["categories"]) ? $context["categories"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["cat"]) {
            // line 23
            echo "            <li><a href=\"#";
            echo twig_escape_filter($this->env, $this->getAttribute($context["cat"], "id", array()), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["cat"], "name", array()), "html", null, true);
            echo "</a></li>
\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['cat'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 25
        echo "\t</ul>

\t<div class=\"cd-faq-items\">
\t    ";
        // line 28
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["categories"]) ? $context["categories"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["cat"]) {
            // line 29
            echo "            <ul id=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["cat"], "id", array()), "html", null, true);
            echo "\" class=\"cd-faq-group\">
                <li class=\"cd-faq-title\"><h2>";
            // line 30
            echo twig_escape_filter($this->env, $this->getAttribute($context["cat"], "name", array()), "html", null, true);
            echo "</h2></li>
\t            ";
            // line 31
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["cat"], "questions", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["question"]) {
                // line 32
                echo "                    ";
                if (($this->getAttribute($context["question"], "status", array()) == 2)) {
                    // line 33
                    echo "                        <li>
                            <a class=\"cd-faq-trigger\" href=\"#0\">";
                    // line 34
                    echo twig_escape_filter($this->env, $this->getAttribute($context["question"], "text", array()), "html", null, true);
                    echo "</a>
                            <div class=\"cd-faq-content\">
                                <p>Вопрос задан ";
                    // line 36
                    echo twig_escape_filter($this->env, $this->getAttribute($context["question"], "date", array()), "html", null, true);
                    echo "; Спросил(а) ";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["question"], "name", array()), "html", null, true);
                    echo " (";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["question"], "email", array()), "html", null, true);
                    echo ")</p>
                                <br>
                                <b>Ответ:</b>
                                <p>";
                    // line 39
                    echo twig_escape_filter($this->env, $this->getAttribute($context["question"], "answer", array()), "html", null, true);
                    echo "</p>
                            </div>
                        </li>
                    ";
                }
                // line 43
                echo "\t\t        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['question'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 44
            echo "            </ul>
\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['cat'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 46
        echo "\t</div>
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
        return "index.phtml";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  120 => 46,  113 => 44,  107 => 43,  100 => 39,  90 => 36,  85 => 34,  82 => 33,  79 => 32,  75 => 31,  71 => 30,  66 => 29,  62 => 28,  57 => 25,  46 => 23,  42 => 22,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "index.phtml", "C:\\OpenServer\\domains\\localhost\\diplom\\templates\\index.phtml");
    }
}
