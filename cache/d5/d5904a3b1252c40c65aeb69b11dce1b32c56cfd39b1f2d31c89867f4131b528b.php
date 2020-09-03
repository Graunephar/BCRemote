<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* profile.html */
class __TwigTemplate_4232f8855279ce59cf2838e72fd7fd9a60127f142fec83276374ee77bf321ca1 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "base.html";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("base.html", "profile.html", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 4
        echo "<h1>User List</h1>
<ul>
    <li><a href=\"";
        // line 6
        echo twig_escape_filter($this->env, $this->env->getRuntime('Slim\Views\TwigRuntimeExtension')->urlFor("profile", ["name" => "josh"]), "html", null, true);
        echo "\" ";
        if ($this->env->getRuntime('Slim\Views\TwigRuntimeExtension')->isCurrentUrl("profile", ["name" => "josh"])) {
            echo "class=\"active\"";
        }
        echo ">Josh</a></li>
    <li><a href=\"";
        // line 7
        echo twig_escape_filter($this->env, $this->env->getRuntime('Slim\Views\TwigRuntimeExtension')->urlFor("profile", ["name" => "andrew"]), "html", null, true);
        echo "\">Andrew</a></li>
</ul>
";
    }

    public function getTemplateName()
    {
        return "profile.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  62 => 7,  54 => 6,  50 => 4,  46 => 3,  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "profile.html", "/home/daniel/Git/BitCraverControllerApp/templates/profile.html");
    }
}
