<?php

/* 404.twig */
class __TwigTemplate_92d2bc131b3cf40891aaaa0e785a63f334c62d8c7ad3fb3be2daf265c41d3fc1 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("base.twig", "404.twig", 1);
        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "base.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_content($context, array $blocks = array())
    {
        // line 4
        echo "    <h1>Just between me and you.</h1>
    <h3>It looks like the page doesn't exist. Too bad, uh?<br/>You still can get back to the <a href=\"/\">homepage</a>,
        though. Best of luck.</h3>
";
    }

    public function getTemplateName()
    {
        return "404.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  31 => 4,  28 => 3,  11 => 1,);
    }
}
/* {% extends "base.twig" %}*/
/* */
/* {% block content %}*/
/*     <h1>Just between me and you.</h1>*/
/*     <h3>It looks like the page doesn't exist. Too bad, uh?<br/>You still can get back to the <a href="/">homepage</a>,*/
/*         though. Best of luck.</h3>*/
/* {% endblock %}*/
/* */
