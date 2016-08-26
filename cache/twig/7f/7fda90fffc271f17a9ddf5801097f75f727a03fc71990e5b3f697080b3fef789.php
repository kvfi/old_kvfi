<?php

/* base.twig */
class __TwigTemplate_cb71ba39f7cdbb21eae177686e30b653bab63b0078bba01eb4a58541ddb37b20 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'head' => array($this, 'block_head'),
            'aside_description' => array($this, 'block_aside_description'),
            'content' => array($this, 'block_content'),
            'pagination' => array($this, 'block_pagination'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html>

<head>
    ";
        // line 5
        $this->displayBlock('head', $context, $blocks);
        // line 21
        echo "</head>
<body class=\"";
        // line 22
        echo twig_escape_filter($this->env, (isset($context["css_class"]) ? $context["css_class"] : null), "html", null, true);
        echo "\">
<div class=\"notification-global\"><p>08.19.2016 &mdash; I'm improving the website's search functionality and, as a
        result, it was disabled to prevent search conflicts. You still can search this site on Google, just type
        \"site:scif.ml\" followed by keywords.</p></div>
<div class=\"bodyPage\">
    <!-- <div class=\"hdr\"></div> -->
    <div class=\"grid\">
        <div class=\"aside col-1-5\">
            <div class=\"container\">
                <a href=\"/\" class=\"logo\"></a>
                ";
        // line 32
        $this->displayBlock('aside_description', $context, $blocks);
        // line 34
        echo "                <ul class=\"menu\">
                    <li><a href=\"/Me\" title=\"About\">About</a></li>
                    <li><a href=\"/Archives\" title=\"Archives\">Archives</a></li>
                    <li><a href=\"/Topics\" title=\"Topics\">Topics</a></li>
                    <li><a href=\"/Hi\" title=\"Contact\">Contact</a></li>
                </ul>
                <br/>

                <p><em>“Even in the most heinous act of gruesomeness I will be bound to glimpse beauty.<br/>Because
                        beauty is everywhere.”</em></p>
                <footer>
                    <p><a href=\"https://creativecommons.org/publicdomain/zero/1.0/\"><img
                                    src=\"https://licensebuttons.net/p/zero/1.0/88x31.png\"/></a></p>
                </footer>
            </div>
        </div>
        <div class=\"col-3-5\">
            ";
        // line 51
        $this->displayBlock('content', $context, $blocks);
        // line 53
        echo "            ";
        $this->displayBlock('pagination', $context, $blocks);
        // line 55
        echo "        </div>
    </div>
</div>
</body>
</html>
";
    }

    // line 5
    public function block_head($context, array $blocks = array())
    {
        // line 6
        echo "        <meta charset=\"utf-8\"/>
        <title>";
        // line 7
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["headMeta"]) ? $context["headMeta"] : null), "title", array()), "html", null, true);
        echo " - ";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "blog", array()), "title", array()), "html", null, true);
        echo "</title>
        <link rel=\"shortcut icon\" href=\"/static/images/xd.gif\" type=\"image/x-icon\">
        <link rel=\"stylesheet\" href=\"/static/stylesheets/screen.css\" type=\"text/css\" media=\"screen\" charset=\"utf-8\">
        <script src=\"/static/js/ng.min.js\"></script>
        <script src=\"/static/js/showdown.min.js\"></script>
        <script src=\"/static/js/jquery.min.js\"></script>
        <script src=\"/static/js/d3.min.js\"></script>
        <script src=\"/static/js/script.js\"></script>
        <!-- <script type=\"text/x-mathjax-config\">MathJax.Hub.Config({tex2jax: {inlineMath: [['\$','\$'], ['\\\\(','\\\\)']]}});</script>
        <script type=\"text/javascript\" async src=\"/static/js/MathJax.js?config=TeX-MML-AM_CHTML\"></script>-->
        <!--[if lte IE 6]>
        <link rel=\"stylesheet\" href=\"/static/stylesheets/lib/ie.css\" type=\"text/css\" media=\"screen\" charset=\"utf-8\">
        <![endif]-->
    ";
    }

    // line 32
    public function block_aside_description($context, array $blocks = array())
    {
        // line 33
        echo "                ";
    }

    // line 51
    public function block_content($context, array $blocks = array())
    {
        // line 52
        echo "            ";
    }

    // line 53
    public function block_pagination($context, array $blocks = array())
    {
        // line 54
        echo "            ";
    }

    public function getTemplateName()
    {
        return "base.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  125 => 54,  122 => 53,  118 => 52,  115 => 51,  111 => 33,  108 => 32,  88 => 7,  85 => 6,  82 => 5,  73 => 55,  70 => 53,  68 => 51,  49 => 34,  47 => 32,  34 => 22,  31 => 21,  29 => 5,  23 => 1,);
    }
}
/* <!DOCTYPE html>*/
/* <html>*/
/* */
/* <head>*/
/*     {% block head %}*/
/*         <meta charset="utf-8"/>*/
/*         <title>{{ headMeta.title }} - {{ config.blog.title }}</title>*/
/*         <link rel="shortcut icon" href="/static/images/xd.gif" type="image/x-icon">*/
/*         <link rel="stylesheet" href="/static/stylesheets/screen.css" type="text/css" media="screen" charset="utf-8">*/
/*         <script src="/static/js/ng.min.js"></script>*/
/*         <script src="/static/js/showdown.min.js"></script>*/
/*         <script src="/static/js/jquery.min.js"></script>*/
/*         <script src="/static/js/d3.min.js"></script>*/
/*         <script src="/static/js/script.js"></script>*/
/*         <!-- <script type="text/x-mathjax-config">MathJax.Hub.Config({tex2jax: {inlineMath: [['$','$'], ['\\(','\\)']]}});</script>*/
/*         <script type="text/javascript" async src="/static/js/MathJax.js?config=TeX-MML-AM_CHTML"></script>-->*/
/*         <!--[if lte IE 6]>*/
/*         <link rel="stylesheet" href="/static/stylesheets/lib/ie.css" type="text/css" media="screen" charset="utf-8">*/
/*         <![endif]-->*/
/*     {% endblock %}*/
/* </head>*/
/* <body class="{{ css_class }}">*/
/* <div class="notification-global"><p>08.19.2016 &mdash; I'm improving the website's search functionality and, as a*/
/*         result, it was disabled to prevent search conflicts. You still can search this site on Google, just type*/
/*         "site:scif.ml" followed by keywords.</p></div>*/
/* <div class="bodyPage">*/
/*     <!-- <div class="hdr"></div> -->*/
/*     <div class="grid">*/
/*         <div class="aside col-1-5">*/
/*             <div class="container">*/
/*                 <a href="/" class="logo"></a>*/
/*                 {% block aside_description %}*/
/*                 {% endblock %}*/
/*                 <ul class="menu">*/
/*                     <li><a href="/Me" title="About">About</a></li>*/
/*                     <li><a href="/Archives" title="Archives">Archives</a></li>*/
/*                     <li><a href="/Topics" title="Topics">Topics</a></li>*/
/*                     <li><a href="/Hi" title="Contact">Contact</a></li>*/
/*                 </ul>*/
/*                 <br/>*/
/* */
/*                 <p><em>“Even in the most heinous act of gruesomeness I will be bound to glimpse beauty.<br/>Because*/
/*                         beauty is everywhere.”</em></p>*/
/*                 <footer>*/
/*                     <p><a href="https://creativecommons.org/publicdomain/zero/1.0/"><img*/
/*                                     src="https://licensebuttons.net/p/zero/1.0/88x31.png"/></a></p>*/
/*                 </footer>*/
/*             </div>*/
/*         </div>*/
/*         <div class="col-3-5">*/
/*             {% block content %}*/
/*             {% endblock %}*/
/*             {% block pagination %}*/
/*             {% endblock %}*/
/*         </div>*/
/*     </div>*/
/* </div>*/
/* </body>*/
/* </html>*/
/* */
