<?php

/* post.twig */
class __TwigTemplate_2a6aafe2a15b0fafd9d511e525fb1693c55df696efc3f8ecae42b4850c4ef274 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("base.twig", "post.twig", 1);
        $this->blocks = array(
            'aside_description' => array($this, 'block_aside_description'),
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
    public function block_aside_description($context, array $blocks = array())
    {
    }

    // line 6
    public function block_content($context, array $blocks = array())
    {
        // line 7
        echo "
<div class=\"post\">
  <article id=\"article_";
        // line 9
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "article", array()), "id", array()), "html", null, true);
        echo "\" data-article-id=\"";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "article", array()), "id", array()), "html", null, true);
        echo "\">
    <div class=\"article-head\">
        <h1>";
        // line 11
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "article", array()), "title", array()), "html", null, true);
        echo "</h1>
        ";
        // line 12
        if ( !twig_test_empty($this->getAttribute($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "article", array()), "intro", array()))) {
            echo "<h5>";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "article", array()), "intro", array()), "html", null, true);
            echo "</h5>";
        }
        // line 13
        echo "        <p>published: <span>";
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "article", array()), "created_on", array()), "M j"), "html", null, true);
        echo "<sup>";
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "article", array()), "created_on", array()), "S"), "html", null, true);
        echo "</sup> ";
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "article", array()), "created_on", array()), "Y"), "html", null, true);
        echo "</span>; in <a href=\"/Archives?category=";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "article", array()), "category", array()), "slug", array()), "html", null, true);
        echo "\"><span>";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "article", array()), "category", array()), "name", array()), "html", null, true);
        echo "</span></a>; last update: <span>";
        if (($this->getAttribute($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "article", array()), "last_update", array()) != "0000-00-00 00:00:00")) {
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "article", array()), "created_on", array()), "M j"), "html", null, true);
            echo "<sup>";
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "article", array()), "created_on", array()), "S"), "html", null, true);
            echo "</sup> ";
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "article", array()), "created_on", array()), "Y"), "html", null, true);
        } else {
            echo "never";
        }
        echo "</span>; progress: <span>";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "article", array()), "progress", array()), "html", null, true);
        echo "</span>; epistemic state: <span>";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "article", array()), "epistemic", array()), "html", null, true);
        echo "</span></p>
    </div>
      <!-- <div class=\"frd-image\"><img src=\"";
        // line 15
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["config"]) ? $context["config"] : null), "cdn_image", array()), "html", null, true);
        echo $this->getAttribute($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "article", array()), "image", array());
        echo "\" /></div> -->
      <div id=\"container\"></div>
      ";
        // line 17
        if (($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "article", array()), "category", array()), "slug", array()) == "correlations")) {
            // line 18
            echo "      <div class=\"subc\">
        <p>";
            // line 19
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "article", array()), "category", array()), "description", array()), "html", null, true);
            echo " More <a href=\"/Archives?category=";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "article", array()), "category", array()), "slug", array()), "html", null, true);
            echo "\">here</a>.</p>
        <p><strong>Correlating:</strong> ";
            // line 20
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "article", array()), "extras", array()), "correlation", array()), "question", array()), "html", null, true);
            echo " <strong>Result:</strong> ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "article", array()), "extras", array()), "correlation", array()), "result", array()), "html", null, true);
            echo "</p>
      </div>
      ";
        }
        // line 23
        echo "      <div class=\"article-body\">
          ";
        // line 24
        if ($this->getAttribute($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "article", array()), "toc", array())) {
            echo "<div class=\"table-of-contents\"></div>";
        }
        // line 25
        echo "          ";
        echo $this->getAttribute($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "article", array()), "content", array());
        echo "
      </div>
      <div class=\"comments\" id=\"comments\">
          ";
        // line 28
        if ($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "comments", array())) {
            // line 29
            echo "          <h5>Comments &mdash; ";
            if ( !twig_test_empty($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "article", array()), "extras", array()), "comment_counter_start", array()))) {
                echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "article", array()), "extras", array()), "comment_counter_start", array()) + $this->getAttribute((isset($context["data"]) ? $context["data"] : null), "comment_count", array())), "html", null, true);
            } else {
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["data"]) ? $context["data"] : null), "comment_count", array()), "html", null, true);
            }
            echo " so far.</h5>
          ";
            // line 30
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "comments", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["data_comment"]) {
                // line 31
                echo "          <div class=\"comment\" id=\"comment-";
                echo twig_escape_filter($this->env, $this->getAttribute($context["data_comment"], "id", array()), "html", null, true);
                echo "\" data-comment-id=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($context["data_comment"], "id", array()), "html", null, true);
                echo "\">
            ";
                // line 32
                echo $this->getAttribute($context["data_comment"], "content", array());
                echo "
            <div class=\"meta\">
              <p><a href=\"#comment-";
                // line 34
                echo twig_escape_filter($this->env, $this->getAttribute($context["data_comment"], "id", array()), "html", null, true);
                echo "\" title=\"Direct link to this comment\">by ";
                echo twig_escape_filter($this->env, $this->getAttribute($context["data_comment"], "author", array()), "html", null, true);
                echo " on ";
                echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($context["data_comment"], "date", array()), "m/j/Y"), "html", null, true);
                echo "</a></p>
            </div>
          </div>
          ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['data_comment'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 38
            echo "          ";
        } else {
            // line 39
            echo "          <h5>No comment.</h5>
          <div class=\"comment\">
            <p><a href=\"#\" onclick=\"javascript(return false)\">Be the first to comment.</a></p>
          </div>
          ";
        }
        // line 44
        echo "      </div>
  </article>
</div>
";
    }

    public function getTemplateName()
    {
        return "post.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  176 => 44,  169 => 39,  166 => 38,  152 => 34,  147 => 32,  140 => 31,  136 => 30,  127 => 29,  125 => 28,  118 => 25,  114 => 24,  111 => 23,  103 => 20,  97 => 19,  94 => 18,  92 => 17,  86 => 15,  58 => 13,  52 => 12,  48 => 11,  41 => 9,  37 => 7,  34 => 6,  29 => 3,  11 => 1,);
    }
}
/* {% extends "base.twig" %}*/
/* */
/* {% block aside_description %}*/
/* {% endblock %}*/
/* */
/* {% block content %}*/
/* */
/* <div class="post">*/
/*   <article id="article_{{ data.article.id }}" data-article-id="{{ data.article.id }}">*/
/*     <div class="article-head">*/
/*         <h1>{{ data.article.title }}</h1>*/
/*         {% if data.article.intro is not empty %}<h5>{{ data.article.intro }}</h5>{% endif %}*/
/*         <p>published: <span>{{ data.article.created_on|date('M j') }}<sup>{{ data.article.created_on|date('S') }}</sup> {{ data.article.created_on|date('Y') }}</span>; in <a href="/Archives?category={{ data.article.category.slug }}"><span>{{ data.article.category.name }}</span></a>; last update: <span>{% if data.article.last_update != '0000-00-00 00:00:00' %}{{ data.article.created_on|date('M j') }}<sup>{{ data.article.created_on|date('S') }}</sup> {{ data.article.created_on|date('Y') }}{% else %}never{% endif %}</span>; progress: <span>{{ data.article.progress }}</span>; epistemic state: <span>{{ data.article.epistemic }}</span></p>*/
/*     </div>*/
/*       <!-- <div class="frd-image"><img src="{{ config.cdn_image }}{{ data.article.image | raw}}" /></div> -->*/
/*       <div id="container"></div>*/
/*       {% if data.article.category.slug == 'correlations' %}*/
/*       <div class="subc">*/
/*         <p>{{ data.article.category.description }} More <a href="/Archives?category={{ data.article.category.slug }}">here</a>.</p>*/
/*         <p><strong>Correlating:</strong> {{ data.article.extras.correlation.question }} <strong>Result:</strong> {{ data.article.extras.correlation.result }}</p>*/
/*       </div>*/
/*       {% endif %}*/
/*       <div class="article-body">*/
/*           {% if data.article.toc %}<div class="table-of-contents"></div>{% endif %}*/
/*           {{ data.article.content | raw}}*/
/*       </div>*/
/*       <div class="comments" id="comments">*/
/*           {% if data.comments %}*/
/*           <h5>Comments &mdash; {% if data.article.extras.comment_counter_start is not empty %}{{ data.article.extras.comment_counter_start + data.comment_count }}{% else %}{{ data.comment_count }}{% endif %} so far.</h5>*/
/*           {% for data_comment in data.comments %}*/
/*           <div class="comment" id="comment-{{ data_comment.id }}" data-comment-id="{{ data_comment.id }}">*/
/*             {{ data_comment.content|raw }}*/
/*             <div class="meta">*/
/*               <p><a href="#comment-{{ data_comment.id }}" title="Direct link to this comment">by {{ data_comment.author }} on {{ data_comment.date|date('m/j/Y') }}</a></p>*/
/*             </div>*/
/*           </div>*/
/*           {% endfor %}*/
/*           {% else %}*/
/*           <h5>No comment.</h5>*/
/*           <div class="comment">*/
/*             <p><a href="#" onclick="javascript(return false)">Be the first to comment.</a></p>*/
/*           </div>*/
/*           {% endif %}*/
/*       </div>*/
/*   </article>*/
/* </div>*/
/* {% endblock %}*/
/* */
