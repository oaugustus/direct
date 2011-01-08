<?php

/* index.html */
class __TwigTemplate_79188869572cbf20db2d9b8b60066d54 extends Twig_Template
{
    public function display(array $context, array $blocks = array())
    {
        $context = array_merge($this->env->getGlobals(), $context);

        // line 1
        echo "<html>
<head>
\t<title>";
        // line 3
        echo twig_escape_filter($this->env, (isset($context['name']) ? $context['name'] : null), "html");
        echo "</title>
</head>
<body>

<p>Directory access is forbidden.</p>

</body>
</html>";
    }

    public function getTemplateName()
    {
        return "index.html";
    }
}
