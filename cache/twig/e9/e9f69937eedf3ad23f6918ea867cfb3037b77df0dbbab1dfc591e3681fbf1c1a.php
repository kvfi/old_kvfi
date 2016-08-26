<?php

/* page.twig */
class __TwigTemplate_31e07d168523d58bdacbe0497374f8d9af059dd09ad4ad5a2dd3452b510508e0 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("base.twig", "page.twig", 1);
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

    // line 2
    public function block_content($context, array $blocks = array())
    {
        // line 3
        echo "<div class=\"post\">
    <article id=\"article_";
        // line 4
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "page", array()), "id", array()), "html", null, true);
        echo "\" data-article-id=\"";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "page", array()), "id", array()), "html", null, true);
        echo "\">
        <div class=\"article-head\">
            <h1>";
        // line 6
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "page", array()), "title", array()), "html", null, true);
        echo "</h1> ";
        if ( !twig_test_empty($this->getAttribute($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "page", array()), "intro", array()))) {
            // line 7
            echo "            <h5>";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "page", array()), "intro", array()), "html", null, true);
            echo "</h5>";
        }
        // line 8
        echo "            <p>published: <span>";
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "page", array()), "created_on", array()), "M j"), "html", null, true);
        echo "<sup>";
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "page", array()), "created_on", array()), "S"), "html", null, true);
        echo "</sup> ";
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "page", array()), "created_on", array()), "Y"), "html", null, true);
        echo "</span>; last update: <span>";
        if (($this->getAttribute($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "article", array()), "last_update", array()) != "0000-00-00 00:00:00")) {
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "page", array()), "last_update", array()), "M j"), "html", null, true);
            echo "<sup>";
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "page", array()), "last_update", array()), "S"), "html", null, true);
            echo "</sup> ";
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "page", array()), "last_update", array()), "Y"), "html", null, true);
        } else {
            echo "never";
        }
        echo "</span>;
                progress: <span>";
        // line 9
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "page", array()), "progress", array()), "html", null, true);
        echo "</span>; epistemic state: <span>";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "page", array()), "epistemic", array()), "html", null, true);
        echo "</span>
        </div>
        <div class=\"article-body\">
            ";
        // line 12
        if ($this->getAttribute($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "page", array()), "toc", array())) {
            // line 13
            echo "            <div class=\"table-of-contents\"></div>";
        }
        echo " ";
        echo $this->getAttribute($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "page", array()), "content", array());
        echo "
        </div>
    </article>
</div>
";
    }

    public function getTemplateName()
    {
        return "page.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  79 => 13,  77 => 12,  69 => 9,  50 => 8,  45 => 7,  41 => 6,  34 => 4,  31 => 3,  28 => 2,  11 => 1,);
    }
}
/* {% extends "base.twig" %}*/
/* {% block content %}*/
/* <div class="post">*/
/*     <article id="article_{{ data.page.id }}" data-article-id="{{ data.page.id }}">*/
/*         <div class="article-head">*/
/*             <h1>{{ data.page.title }}</h1> {% if data.page.intro is not empty %}*/
/*             <h5>{{ data.page.intro }}</h5>{% endif %}*/
/*             <p>published: <span>{{ data.page.created_on|date('M j') }}<sup>{{ data.page.created_on|date('S') }}</sup> {{ data.page.created_on|date('Y') }}</span>; last update: <span>{% if data.article.last_update != '0000-00-00 00:00:00' %}{{ data.page.last_update|date('M j') }}<sup>{{ data.page.last_update|date('S') }}</sup> {{ data.page.last_update|date('Y') }}{% else %}never{% endif %}</span>;*/
/*                 progress: <span>{{ data.page.progress }}</span>; epistemic state: <span>{{ data.page.epistemic }}</span>*/
/*         </div>*/
/*         <div class="article-body">*/
/*             {% if data.page.toc %}*/
/*             <div class="table-of-contents"></div>{% endif %} {{ data.page.content | raw }}*/
/*         </div>*/
/*     </article>*/
/* </div>*/
/* {% endblock %}*/
/* */
