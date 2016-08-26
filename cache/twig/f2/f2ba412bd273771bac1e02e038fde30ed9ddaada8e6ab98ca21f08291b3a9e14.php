<?php

/* home.twig */
class __TwigTemplate_94b5808b274d8dfac00a9249c85fe2ffddeaad835608e0a8c9a91226df953f58 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("base.twig", "home.twig", 1);
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
  <ul id=\"post_";
        // line 13
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["post"]) ? $context["post"] : null), "id", array()), "html", null, true);
        echo "\" data-post-id=\"";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["post"]) ? $context["post"] : null), "id", array()), "html", null, true);
        echo "\">
    ";
        // line 14
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "posts", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["post"]) {
            // line 15
            echo "    <li><a href=\"post/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["post"], "slug", array()), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["post"], "title", array()), "html", null, true);
            echo "</a> <span>";
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($context["post"], "created_on", array()), "m/j/Y"), "html", null, true);
            echo "</span></li>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['post'], $context['_parent'], $context['loop']);
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
        echo twig_escape_filter($this->env, (isset($context["pagination"]) ? $context["pagination"] : null), "html", null, true);
        echo "
  ";
    }

    public function getTemplateName()
    {
        return "home.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  80 => 21,  77 => 20,  71 => 17,  58 => 15,  54 => 14,  48 => 13,  39 => 6,  36 => 5,  30 => 3,  11 => 1,);
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
/*   <ul id="post_{{ post.id }}" data-post-id="{{ post.id }}">*/
/*     {% for post in data.posts %}*/
/*     <li><a href="post/{{ post.slug }}">{{ post.title }}</a> <span>{{ post.created_on|date('m/j/Y') }}</span></li>*/
/*     {% endfor %}*/
/*   </ul>*/
/* </div>*/
/*   {% endblock %}*/
/*   {% block pagination %}*/
/*   {{ pagination }}*/
/*   {% endblock %}*/
/* */
