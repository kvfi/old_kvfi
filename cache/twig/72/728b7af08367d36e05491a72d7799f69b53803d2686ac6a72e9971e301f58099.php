<?php

/* index.html */
class __TwigTemplate_6f0fd83d5f30119a47406ccf613f67a21ecf97bfd42f9bdc3d96c0d76f001664 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("base.twig", "index.html", 1);
        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'content' => array($this, 'block_content'),
            'pagination' => array($this, 'block_pagination'),
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
    public function block_title($context, array $blocks = array())
    {
        echo "Index";
    }

    // line 5
    public function block_content($context, array $blocks = array())
    {
        // line 6
        echo "<div class=\"index-intro\">
  <p>Howdy young Internet traveler,<br />
  This is a <a href=\"/Me\">semi-personal knowledge</a> base I've been building for the last 12 years. I mostly write about obsessive stuff.</p>
  <p>Anyway, you're most welcome.</p>
</div>
<div class=\"home-articles\">
  <h5>recent posts</h5>
  <ul id=\"article_";
        // line 13
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["article"]) ? $context["article"] : null), "id", array()), "html", null, true);
        echo "\" data-article-id=\"";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["article"]) ? $context["article"] : null), "id", array()), "html", null, true);
        echo "\">
    ";
        // line 14
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "articles", array()), "core", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["article"]) {
            // line 15
            echo "    <li><a href=\"post/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["article"], "slug", array()), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["article"], "title", array()), "html", null, true);
            echo "</a> <span>(";
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($context["article"], "created_on", array()), "m.j.Y"), "html", null, true);
            echo ")</span></li>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['article'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 17
        echo "  </ul>
</div>
  ";
    }

    // line 20
    public function block_pagination($context, array $blocks = array())
    {
        // line 21
        echo "  ";
        if ((($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "article_count", array()) > 0) || ($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "article_count", array()) > $this->getAttribute((isset($context["data"]) ? $context["data"] : null), "article_per_page", array())))) {
            // line 22
            echo "  <div class=\"pagination\">
    <ul>
      <li><strong>Browse:</strong> </li>
      <li class=\"current\">1</li>
      ";
            // line 26
            if (($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "article_count", array()) > $this->getAttribute((isset($context["data"]) ? $context["data"] : null), "article_per_page", array()))) {
                // line 27
                echo "      ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(range(2, $this->getAttribute((isset($context["data"]) ? $context["data"] : null), "page_number", array())));
                foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                    // line 28
                    echo "      <li><a href=\"/Archives?page=";
                    echo twig_escape_filter($this->env, $context["i"], "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $context["i"], "html", null, true);
                    echo "</a></li>
      ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 30
                echo "      ";
            }
            // line 31
            echo "      ";
            if (($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "article_count", array()) > $this->getAttribute((isset($context["data"]) ? $context["data"] : null), "article_per_page", array()))) {
                // line 32
                echo "      <li><a href=\"/Archives?page=";
                echo 2;
                echo "\">Next &raquo;</a></li>
      ";
            }
            // line 34
            echo "    </ul>
  </div>
  ";
        }
        // line 37
        echo "  ";
    }

    public function getTemplateName()
    {
        return "index.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  124 => 37,  119 => 34,  113 => 32,  110 => 31,  107 => 30,  96 => 28,  91 => 27,  89 => 26,  83 => 22,  80 => 21,  77 => 20,  71 => 17,  58 => 15,  54 => 14,  48 => 13,  39 => 6,  36 => 5,  30 => 3,  11 => 1,);
    }
}
/* {% extends "base.twig" %}*/
/* */
/* {% block title %}Index{% endblock %}*/
/* */
/* {% block content %}*/
/* <div class="index-intro">*/
/*   <p>Howdy young Internet traveler,<br />*/
/*   This is a <a href="/Me">semi-personal knowledge</a> base I've been building for the last 12 years. I mostly write about obsessive stuff.</p>*/
/*   <p>Anyway, you're most welcome.</p>*/
/* </div>*/
/* <div class="home-articles">*/
/*   <h5>recent posts</h5>*/
/*   <ul id="article_{{ article.id }}" data-article-id="{{ article.id }}">*/
/*     {% for article in data.articles.core %}*/
/*     <li><a href="post/{{ article.slug }}">{{ article.title }}</a> <span>({{ article.created_on|date('m.j.Y') }})</span></li>*/
/*     {% endfor %}*/
/*   </ul>*/
/* </div>*/
/*   {% endblock %}*/
/*   {% block pagination %}*/
/*   {% if (data.article_count > 0) or (data.article_count > data.article_per_page) %}*/
/*   <div class="pagination">*/
/*     <ul>*/
/*       <li><strong>Browse:</strong> </li>*/
/*       <li class="current">1</li>*/
/*       {% if data.article_count > data.article_per_page %}*/
/*       {% for i in 2..data.page_number %}*/
/*       <li><a href="/Archives?page={{ i }}">{{ i }}</a></li>*/
/*       {% endfor %}*/
/*       {% endif %}*/
/*       {% if data.article_count > data.article_per_page %}*/
/*       <li><a href="/Archives?page={{ 2 }}">Next &raquo;</a></li>*/
/*       {% endif %}*/
/*     </ul>*/
/*   </div>*/
/*   {% endif %}*/
/*   {% endblock %}*/
/* */
