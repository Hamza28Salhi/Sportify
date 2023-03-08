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

/* front.html.twig */
class __TwigTemplate_a2755bec7874bcf5eb519ff9f1ece80a5d0a4f5310b29ed9837667056e733e8b extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'css' => [$this, 'block_css'],
            'body' => [$this, 'block_body'],
            'js' => [$this, 'block_js'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "front.html.twig"));

        // line 1
        echo "<!DOCTYPE html>
<html lang=\"en\">

<head>
  ";
        // line 5
        $this->displayBlock('title', $context, $blocks);
        // line 6
        echo "

  ";
        // line 8
        $this->displayBlock('css', $context, $blocks);
        // line 30
        echo "

</head>

<body>
  ";
        // line 35
        $this->displayBlock('body', $context, $blocks);
        // line 576
        echo "</body>

</html>";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 5
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        echo " <title> Soccer &mdash; Website by Colorlib </title>";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 8
    public function block_css($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "css"));

        // line 9
        echo "
  <link href=\"";
        // line 10
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap"), "html", null, true);
        echo "\" rel=\"stylesheet\">

  <link rel=\"stylesheet\" href=\"";
        // line 12
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("fonts/icomoon/style.css"), "html", null, true);
        echo "\">

  <link rel=\"stylesheet\" href=\"";
        // line 14
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("css/bootstrap/bootstrap.css"), "html", null, true);
        echo "\">
  <link rel=\"stylesheet\" href=\"";
        // line 15
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("css/jquery-ui.css"), "html", null, true);
        echo "\">
  <link rel=\"stylesheet\" href=\"";
        // line 16
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("css/owl.carousel.min.css"), "html", null, true);
        echo "\">
  <link rel=\"stylesheet\" href=\"";
        // line 17
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("css/owl.theme.default.min.css"), "html", null, true);
        echo "\">
  <link rel=\"stylesheet\" href=\"";
        // line 18
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("css/owl.theme.default.min.css"), "html", null, true);
        echo "\">

  <link rel=\"stylesheet\" href=\"";
        // line 20
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("css/jquery.fancybox.min.css"), "html", null, true);
        echo "\">

  <link rel=\"stylesheet\" href=\"";
        // line 22
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("css/bootstrap-datepicker.css"), "html", null, true);
        echo "\">

  <link rel=\"stylesheet\" href=\"";
        // line 24
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("fonts/flaticon/font/flaticon.css"), "html", null, true);
        echo "\">

  <link rel=\"stylesheet\" href=\"";
        // line 26
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("css/aos.css"), "html", null, true);
        echo "\">

  <link rel=\"stylesheet\" href=\"";
        // line 28
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("css/style.css"), "html", null, true);
        echo "\">
  ";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 35
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 36
        echo "
  <div class=\"site-wrap\">

    <div class=\"site-mobile-menu site-navbar-target\">
      <div class=\"site-mobile-menu-header\">
        <div class=\"site-mobile-menu-close\">
          <span class=\"icon-close2 js-menu-toggle\"></span>
        </div>
      </div>
      <div class=\"site-mobile-menu-body\"></div>
    </div>


    <header class=\"site-navbar py-4\" role=\"banner\">

      <div class=\"container\">
        <div class=\"d-flex align-items-center\">
          <div class=\"site-logo\">
            <a href=\"index.html\">
              <img src=\"";
        // line 55
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("images/logo.png"), "html", null, true);
        echo "\" alt=\"Logo\">
            </a>
          </div>
          <div class=\"ml-auto\">
            <nav class=\"site-navigation position-relative text-right\" role=\"navigation\">
              <ul class=\"site-menu main-menu js-clone-nav mr-auto d-none d-lg-block\">
                <li class=\"active\"><a href=\"index.html\" class=\"nav-link\">Home</a></li>
                <li><a href=\"matches.html\" class=\"nav-link\">Matches</a></li>
                <li><a href=\"evenements.html\" class=\"nav-link\">Evenements</a></li>
                <li><a href=\"blog.html\" class=\"nav-link\">Blog</a></li>
                <li><a href=\"abonnements.html\" class=\"nav-link\">Abonnements</a></li>
                <li><a href=\"boutique.html\" class=\"nav-link\">Boutique</a></li>
                <li><a href=\"contact.html\" class=\"nav-link\">Contact</a></li>
              </ul>
            </nav>

            <a href=\"#\" class=\"d-inline-block d-lg-none site-menu-toggle js-menu-toggle text-black float-right text-white\"><span
                class=\"icon-menu h3 text-white\"></span></a>
          </div>
        </div>
      </div>

    </header>

    <div class=\"col-xl-12 hero overlay\"> <img src=\"";
        // line 79
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("images/bg_3.jpg"), "html", null, true);
        echo "\">  </img>
      <div class=\"container\">
        <div class=\"row align-items-center\">
          <div class=\"col-lg-5 ml-auto\">
            <h1 class=\"text-white\">Encourager votre club préféré</h1>
            
            <div id=\"date-countdown\"></div>
            <p>
              <a href=\"#\" class=\"btn btn-primary py-3 px-4 mr-3\">Book Ticket</a>
              <a href=\"#\" class=\"more light\">Learn More</a>
            </p>  
          </div>
        </div>
      </div>
    </div>

    
    
    <div class=\"container\">
      

      <div class=\"row\">
        <div class=\"col-lg-12\">
          
          <div class=\"d-flex team-vs\">
            <span class=\"score\">4-1</span>
            <div class=\"team-1 w-50\">
              <div class=\"team-details w-100 text-center\">
                
                <h3>LA LEGA <span>(win)</span></h3>
                <ul class=\"list-unstyled\">
                  <li>Anja Landry (7)</li>
                  <li>Eadie Salinas (12)</li>
                  <li>Ashton Allen (10)</li>
                  <li>Baxter Metcalfe (5)</li>
                </ul>
              </div>
            </div>
            <div class=\"team-2 w-50\">
              <div class=\"team-details w-100 text-center\">
                <img src=\"";
        // line 119
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("images/logo_2.png"), "html", null, true);
        echo "\" alt=\"Image\" class=\"img-fluid\">
                <h3>JUVENDU <span>(loss)</span></h3>
                <ul class=\"list-unstyled\">
                  <li>Macauly Green (3)</li>
                  <li>Arham Stark (8)</li>
                  <li>Stephan Murillo (9)</li>
                  <li>Ned Ritter (5)</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  

    <div class=\"latest-news\">
      <div class=\"container\">
        <div class=\"row\">
          <div class=\"col-12 title-section\">
            <h2 class=\"heading\">derniers évènements</h2>
          </div>
        </div>
        <div class=\"row no-gutters\">
          <div class=\"col-md-4\">
            <div class=\"post-entry\">
              <a href=\"#\">
                <img src=\"";
        // line 146
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("images/img_1.jpg"), "html", null, true);
        echo "\" alt=\"Image\" class=\"img-fluid\">
              </a>
              <div class=\"caption\">
                <div class=\"caption-inner\">
                  <h3 class=\"mb-3\">Dakar en Arabie Saoudite</h3>
                  <div class=\"author d-flex align-items-center\">
                    <div class=\"img mb-2 mr-3\">
                      <img src=\"";
        // line 153
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("images/person_1.jpg"), "html", null, true);
        echo "\" alt=\"\">
                    </div>
                    <div class=\"text\">
                      <h4>Partenaire ... </h4>
                      <span>May 19, 2023 &bullet; Sports</span>
                    </div>
                  </div>
                </div>
              </div> 
            </div>
          </div>
          <div class=\"col-md-4\">
            <div class=\"post-entry\">
              <a href=\"#\">
                <img src=\"";
        // line 167
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("images/img_3.jpg"), "html", null, true);
        echo "\" alt=\"Image\" class=\"img-fluid\">
              </a>
              <div class=\"caption\">
                <div class=\"caption-inner\">
                  <h3 class=\"mb-3\">Masters à Augusta</h3>
                  <div class=\"author d-flex align-items-center\">
                    <div class=\"img mb-2 mr-3\">
                      <img src=\"";
        // line 174
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("images/person_1.jpg"), "html", null, true);
        echo "\" alt=\"\">
                    </div>
                    <div class=\"text\">
                      <h4>Partenaire ...</h4>
                      <span>May 20, 2023 &bullet; Sports</span>
                    </div>
                  </div>
                </div>
              </div> 
            </div>
          </div>
          <div class=\"col-md-4\">
            <div class=\"post-entry\">
              <a href=\"#\">
                <img src=\"";
        // line 188
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("images/img_2.jpg"), "html", null, true);
        echo "\" alt=\"Image\" class=\"img-fluid\">
              </a>
              <div class=\"caption\">
                <div class=\"caption-inner\">
                  <h3 class=\"mb-3\">Euro féminin en Angleterre</h3>
                  <div class=\"author d-flex align-items-center\">
                    <div class=\"img mb-2 mr-3\">
                      <img src=\"";
        // line 195
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("images/person_1.jpg"), "html", null, true);
        echo "\" alt=\"\">
                    </div>
                    <div class=\"text\">
                      <h4>Partenaire ...</h4>
                      <span>May 21, 2023 &bullet; Sports</span>
                    </div>
                  </div>
                </div>
              </div> 
            </div>
          </div>
        </div>

      </div>
    </div>
    
    <div class=\"site-section bg-dark\">
      <div class=\"container\">
        <div class=\"row\">
          <div class=\"col-lg-6\">
            <div class=\"widget-next-match\">
              <div class=\"widget-title\">
                <h3>Next Match</h3>
              </div>
              <div class=\"widget-body mb-3\">
                <div class=\"widget-vs\">
                  <div class=\"d-flex align-items-center justify-content-around justify-content-between w-100\">
                    <div class=\"team-1 text-center\">
                      <img src=\"";
        // line 223
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("images/logo_1.png"), "html", null, true);
        echo "\" alt=\"Image\">
                      <h3>Football League</h3>
                    </div>
                    <div>
                      <span class=\"vs\"><span>VS</span></span>
                    </div>
                    <div class=\"team-2 text-center\">
                      <img src=\"";
        // line 230
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("images/logo_2.png"), "html", null, true);
        echo "\" alt=\"Image\">
                      <h3>Soccer</h3>
                    </div>
                  </div>
                </div>
              </div>

              <div class=\"text-center widget-vs-contents mb-4\">
                <h4>World Cup League</h4>
                <p class=\"mb-5\">
                  <span class=\"d-block\">December 20th, 2020</span>
                  <span class=\"d-block\">9:30 AM GMT+0</span>
                  <strong class=\"text-primary\">New Euro Arena</strong>
                </p>

                <div id=\"date-countdown2\" class=\"pb-1\"></div>
              </div>
            </div>
          </div>
          <div class=\"col-lg-6\">
            
            <div class=\"widget-next-match\">
              <table class=\"table custom-table\">
                <thead>
                  <tr>
                    <th>P</th>
                    <th>Team</th>
                    <th>W</th>
                    <th>D</th>
                    <th>L</th>
                    <th>PTS</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td><strong class=\"text-white\">Football League</strong></td>
                    <td>22</td>
                    <td>3</td>
                    <td>2</td>
                    <td>140</td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td><strong class=\"text-white\">Soccer</strong></td>
                    <td>22</td>
                    <td>3</td>
                    <td>2</td>
                    <td>140</td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td><strong class=\"text-white\">Juvendo</strong></td>
                    <td>22</td>
                    <td>3</td>
                    <td>2</td>
                    <td>140</td>
                  </tr>
                  <tr>
                    <td>4</td>
                    <td><strong class=\"text-white\">French Football League</strong></td>
                    <td>22</td>
                    <td>3</td>
                    <td>2</td>
                    <td>140</td>
                  </tr>
                  <tr>
                    <td>5</td>
                    <td><strong class=\"text-white\">Legia Abante</strong></td>
                    <td>22</td>
                    <td>3</td>
                    <td>2</td>
                    <td>140</td>
                  </tr>
                  <tr>
                    <td>6</td>
                    <td><strong class=\"text-white\">Gliwice League</strong></td>
                    <td>22</td>
                    <td>3</td>
                    <td>2</td>
                    <td>140</td>
                  </tr>
                  <tr>
                    <td>7</td>
                    <td><strong class=\"text-white\">Cornika</strong></td>
                    <td>22</td>
                    <td>3</td>
                    <td>2</td>
                    <td>140</td>
                  </tr>
                  <tr>
                    <td>8</td>
                    <td><strong class=\"text-white\">Gravity Smash</strong></td>
                    <td>22</td>
                    <td>3</td>
                    <td>2</td>
                    <td>140</td>
                  </tr>
                </tbody>
              </table>
            </div>

          </div>
        </div>
      </div>
    </div> <!-- .site-section -->

    <div class=\"site-section\">
      <div class=\"container\">
        <div class=\"row\">
          <div class=\"col-6 title-section\">
            <h2 class=\"heading\">Videos</h2>
          </div>
          <div class=\"col-6 text-right\">
            <div class=\"custom-nav\">
            <a href=\"#\" class=\"js-custom-prev-v2\"><span class=\"icon-keyboard_arrow_left\"></span></a>
            <span></span>
            <a href=\"#\" class=\"js-custom-next-v2\"><span class=\"icon-keyboard_arrow_right\"></span></a>
            </div>
          </div>
        </div>


        <div class=\"owl-4-slider owl-carousel\">
          <div class=\"item\">
            <div class=\"video-media\">
              <img src=\"";
        // line 356
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("images/img_1.jpg"), "html", null, true);
        echo "\" alt=\"Image\" class=\"img-fluid\">
              <a href=\"https://vimeo.com/139714818\" class=\"d-flex play-button align-items-center\" data-fancybox>
                <span class=\"icon mr-3\">
                  <span class=\"icon-play\"></span>
                </span>
                <div class=\"caption\">
                  <h3 class=\"m-0\">Dogba set for Juvendu return?</h3>
                </div>
              </a>
            </div>
          </div>
          <div class=\"item\">
            <div class=\"video-media\">
              <img src=\"";
        // line 369
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("images/img_2.jpg"), "html", null, true);
        echo "\" alt=\"Image\" class=\"img-fluid\">
              <a href=\"https://vimeo.com/139714818\" class=\"d-flex play-button align-items-center\" data-fancybox>
                <span class=\"icon mr-3\">
                  <span class=\"icon-play\"></span>
                </span>
                <div class=\"caption\">
                  <h3 class=\"m-0\">Kai Nets Double To Secure Comfortable Away Win</h3>
                </div>
              </a>
            </div>
          </div>
          <div class=\"item\">
            <div class=\"video-media\">
              <img src=\"";
        // line 382
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("images/img_3.jpg"), "html", null, true);
        echo "\" alt=\"Image\" class=\"img-fluid\">
              <a href=\"https://vimeo.com/139714818\" class=\"d-flex play-button align-items-center\" data-fancybox>
                <span class=\"icon mr-3\">
                  <span class=\"icon-play\"></span>
                </span>
                <div class=\"caption\">
                  <h3 class=\"m-0\">Romolu to stay at Real Nadrid?</h3>
                </div>
              </a>
            </div>
          </div>

          <div class=\"item\">
            <div class=\"video-media\">
              <img src=\"";
        // line 396
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("images/img_1.jpg"), "html", null, true);
        echo "\" alt=\"Image\" class=\"img-fluid\">
              <a href=\"https://vimeo.com/139714818\" class=\"d-flex play-button align-items-center\" data-fancybox>
                <span class=\"icon mr-3\">
                  <span class=\"icon-play\"></span>
                </span>
                <div class=\"caption\">
                  <h3 class=\"m-0\">Dogba set for Juvendu return?</h3>
                </div>
              </a>
            </div>
          </div>
          <div class=\"item\">
            <div class=\"video-media\">
              <img src=\"";
        // line 409
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("images/img_2.jpg"), "html", null, true);
        echo "\" alt=\"Image\" class=\"img-fluid\">
              <a href=\"https://vimeo.com/139714818\" class=\"d-flex play-button align-items-center\" data-fancybox>
                <span class=\"icon mr-3\">
                  <span class=\"icon-play\"></span>
                </span>
                <div class=\"caption\">
                  <h3 class=\"m-0\">Kai Nets Double To Secure Comfortable Away Win</h3>
                </div>
              </a>
            </div>
          </div>
          <div class=\"item\">
            <div class=\"video-media\">
              <img src=\"";
        // line 422
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("images/img_3.jpg"), "html", null, true);
        echo "\" alt=\"Image\" class=\"img-fluid\">
              <a href=\"https://vimeo.com/139714818\" class=\"d-flex play-button align-items-center\" data-fancybox>
                <span class=\"icon mr-3\">
                  <span class=\"icon-play\"></span>
                </span>
                <div class=\"caption\">
                  <h3 class=\"m-0\">Romolu to stay at Real Nadrid?</h3>
                </div>
              </a>
            </div>
          </div>

        </div>

      </div>
    </div>

    <div class=\"container site-section\">
      <div class=\"row\">
        <div class=\"col-6 title-section\">
          <h2 class=\"heading\">Our Blog</h2>
        </div>
      </div>
      <div class=\"row\">
        <div class=\"col-lg-6\">
          <div class=\"custom-media d-flex\">
            <div class=\"img mr-4\">
              <img src=\"";
        // line 449
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("images/img_1.jpg"), "html", null, true);
        echo "\" alt=\"Image\" class=\"img-fluid\">
            </div>
            <div class=\"text\">
              <span class=\"meta\">May 20, 2023</span>
              <h3 class=\"mb-4\"><a href=\"#\">FC Barcelone - Xavi : \"Le Real Madrid peut encore gagner le championnat\"</a></h3>
              <p>Opposé au Séville FC dimanche soir, le Barça n'a pas fait de cadeau en s'imposant 3-0...</p>
              <p><a href=\"#\">Read more</a></p>
            </div>
          </div>
        </div>
        <div class=\"col-lg-6\">
          <div class=\"custom-media d-flex\">
            <div class=\"img mr-4\">
              <img src=\"";
        // line 462
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("images/img_3.jpg"), "html", null, true);
        echo "\" alt=\"Image\" class=\"img-fluid\">
            </div>
            <div class=\"text\">
              <span class=\"meta\">May 20, 2023</span>
              <h3 class=\"mb-4\"><a href=\"#\">Où et quand voir le Clasico comptant pour la finale de la Supercoupe d'Espagne</a></h3>
              <p>Consultez les chaînes et les horaires pour voir le match entre le Real Madrid et le Barça dimanche soir</p>
              <p><a href=\"#\">Read more</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>



    <footer class=\"footer-section\">
      <div class=\"container\">
        <div class=\"row\">
          <div class=\"col-lg-3\">
            <div class=\"widget mb-3\">
              <h3>News</h3>
              <ul class=\"list-unstyled links\">
                <li><a href=\"#\">All</a></li>
                <li><a href=\"#\">Club News</a></li>
                <li><a href=\"#\">Media Center</a></li>
                <li><a href=\"#\">Video</a></li>
                <li><a href=\"#\">RSS</a></li>
              </ul>
            </div>
          </div>
          <div class=\"col-lg-3\">
            <div class=\"widget mb-3\">
              <h3>Tickets</h3>
              <ul class=\"list-unstyled links\">
                <li><a href=\"#\">Online Ticket</a></li>
                <li><a href=\"#\">Payment and Prices</a></li>
                <li><a href=\"#\">Contact &amp; Booking</a></li>
                <li><a href=\"#\">Tickets</a></li>
                <li><a href=\"#\">Coupon</a></li>
              </ul>
            </div>
          </div>
          <div class=\"col-lg-3\">
            <div class=\"widget mb-3\">
              <h3>Matches</h3>
              <ul class=\"list-unstyled links\">
                <li><a href=\"#\">Standings</a></li>
                <li><a href=\"#\">World Cup</a></li>
                <li><a href=\"#\">La Lega</a></li>
                <li><a href=\"#\">Hyper Cup</a></li>
                <li><a href=\"#\">World League</a></li>
              </ul>
            </div>
          </div>

          <div class=\"col-lg-3\">
            <div class=\"widget mb-3\">
              <h3>Social</h3>
              <ul class=\"list-unstyled links\">
                <li><a href=\"#\">Twitter</a></li>
                <li><a href=\"#\">Facebook</a></li>
                <li><a href=\"#\">Instagram</a></li>
                <li><a href=\"#\">Youtube</a></li>
              </ul>
            </div>
          </div>

        </div>

        <div class=\"row text-center\">
          <div class=\"col-md-12\">
            <div class=\" pt-5\">
              <p>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                Copyright &copy;
                <script>
                  document.write(new Date().getFullYear());
                </script> All rights reserved | This template is made with <i class=\"icon-heart\"
                  aria-hidden=\"true\"></i> by <a href=\"https://colorlib.com\" target=\"_blank\">Colorlib</a>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
              </p>
            </div>
          </div>

        </div>
      </div>
    </footer>



  </div>
  <!-- .site-wrap -->

  ";
        // line 555
        $this->displayBlock('js', $context, $blocks);
        // line 574
        echo "
  ";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 555
    public function block_js($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "js"));

        // line 556
        echo "  <script src=\"";
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("js/jquery-3.3.1.min.js"), "html", null, true);
        echo "\"></script>
  <script src=\"";
        // line 557
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("js/jquery-migrate-3.0.1.min.js"), "html", null, true);
        echo "\"></script>
  <script src=\"";
        // line 558
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("js/jquery-ui.js"), "html", null, true);
        echo "\"></script>
  <script src=\"";
        // line 559
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("js/popper.min.js"), "html", null, true);
        echo "\"></script>
  <script src=\"";
        // line 560
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("js/bootstrap.min.js"), "html", null, true);
        echo "\"></script>
  <script src=\"";
        // line 561
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("js/owl.carousel.min.js"), "html", null, true);
        echo "\"></script>
  <script src=\"";
        // line 562
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("js/jquery.stellar.min.js"), "html", null, true);
        echo "\"></script>
  <script src=\"";
        // line 563
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("js/jquery.countdown.min.js"), "html", null, true);
        echo "\"></script>
  <script src=\"";
        // line 564
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("js/bootstrap-datepicker.min.js"), "html", null, true);
        echo "\"></script>
  <script src=\"";
        // line 565
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("js/jquery.easing.1.3.js"), "html", null, true);
        echo "\"></script>
  <script src=\"";
        // line 566
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("js/aos.js"), "html", null, true);
        echo "\"></script>
  <script src=\"";
        // line 567
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("js/jquery.fancybox.min.js"), "html", null, true);
        echo "\"></script>
  <script src=\"";
        // line 568
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("js/jquery.sticky.js"), "html", null, true);
        echo "\"></script>
  <script src=\"";
        // line 569
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("js/jquery.mb.YTPlayer.min.js"), "html", null, true);
        echo "\"></script>


  <script src=\"";
        // line 572
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("js/main.js"), "html", null, true);
        echo "\"></script>
  ";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    public function getTemplateName()
    {
        return "front.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  820 => 572,  814 => 569,  810 => 568,  806 => 567,  802 => 566,  798 => 565,  794 => 564,  790 => 563,  786 => 562,  782 => 561,  778 => 560,  774 => 559,  770 => 558,  766 => 557,  761 => 556,  754 => 555,  746 => 574,  744 => 555,  648 => 462,  632 => 449,  602 => 422,  586 => 409,  570 => 396,  553 => 382,  537 => 369,  521 => 356,  392 => 230,  382 => 223,  351 => 195,  341 => 188,  324 => 174,  314 => 167,  297 => 153,  287 => 146,  257 => 119,  214 => 79,  187 => 55,  166 => 36,  159 => 35,  150 => 28,  145 => 26,  140 => 24,  135 => 22,  130 => 20,  125 => 18,  121 => 17,  117 => 16,  113 => 15,  109 => 14,  104 => 12,  99 => 10,  96 => 9,  89 => 8,  76 => 5,  67 => 576,  65 => 35,  58 => 30,  56 => 8,  52 => 6,  50 => 5,  44 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<!DOCTYPE html>
<html lang=\"en\">

<head>
  {% block title %} <title> Soccer &mdash; Website by Colorlib </title>{% endblock %}


  {% block css %}

  <link href=\"{{asset('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap')}}\" rel=\"stylesheet\">

  <link rel=\"stylesheet\" href=\"{{asset('fonts/icomoon/style.css')}}\">

  <link rel=\"stylesheet\" href=\"{{asset('css/bootstrap/bootstrap.css')}}\">
  <link rel=\"stylesheet\" href=\"{{asset('css/jquery-ui.css')}}\">
  <link rel=\"stylesheet\" href=\"{{asset('css/owl.carousel.min.css')}}\">
  <link rel=\"stylesheet\" href=\"{{asset('css/owl.theme.default.min.css')}}\">
  <link rel=\"stylesheet\" href=\"{{asset('css/owl.theme.default.min.css')}}\">

  <link rel=\"stylesheet\" href=\"{{asset('css/jquery.fancybox.min.css')}}\">

  <link rel=\"stylesheet\" href=\"{{asset('css/bootstrap-datepicker.css')}}\">

  <link rel=\"stylesheet\" href=\"{{asset('fonts/flaticon/font/flaticon.css')}}\">

  <link rel=\"stylesheet\" href=\"{{asset('css/aos.css')}}\">

  <link rel=\"stylesheet\" href=\"{{asset('css/style.css')}}\">
  {% endblock %}


</head>

<body>
  {% block body %}

  <div class=\"site-wrap\">

    <div class=\"site-mobile-menu site-navbar-target\">
      <div class=\"site-mobile-menu-header\">
        <div class=\"site-mobile-menu-close\">
          <span class=\"icon-close2 js-menu-toggle\"></span>
        </div>
      </div>
      <div class=\"site-mobile-menu-body\"></div>
    </div>


    <header class=\"site-navbar py-4\" role=\"banner\">

      <div class=\"container\">
        <div class=\"d-flex align-items-center\">
          <div class=\"site-logo\">
            <a href=\"index.html\">
              <img src=\"{{asset('images/logo.png')}}\" alt=\"Logo\">
            </a>
          </div>
          <div class=\"ml-auto\">
            <nav class=\"site-navigation position-relative text-right\" role=\"navigation\">
              <ul class=\"site-menu main-menu js-clone-nav mr-auto d-none d-lg-block\">
                <li class=\"active\"><a href=\"index.html\" class=\"nav-link\">Home</a></li>
                <li><a href=\"matches.html\" class=\"nav-link\">Matches</a></li>
                <li><a href=\"evenements.html\" class=\"nav-link\">Evenements</a></li>
                <li><a href=\"blog.html\" class=\"nav-link\">Blog</a></li>
                <li><a href=\"abonnements.html\" class=\"nav-link\">Abonnements</a></li>
                <li><a href=\"boutique.html\" class=\"nav-link\">Boutique</a></li>
                <li><a href=\"contact.html\" class=\"nav-link\">Contact</a></li>
              </ul>
            </nav>

            <a href=\"#\" class=\"d-inline-block d-lg-none site-menu-toggle js-menu-toggle text-black float-right text-white\"><span
                class=\"icon-menu h3 text-white\"></span></a>
          </div>
        </div>
      </div>

    </header>

    <div class=\"col-xl-12 hero overlay\"> <img src=\"{{asset ('images/bg_3.jpg')}}\">  </img>
      <div class=\"container\">
        <div class=\"row align-items-center\">
          <div class=\"col-lg-5 ml-auto\">
            <h1 class=\"text-white\">Encourager votre club préféré</h1>
            
            <div id=\"date-countdown\"></div>
            <p>
              <a href=\"#\" class=\"btn btn-primary py-3 px-4 mr-3\">Book Ticket</a>
              <a href=\"#\" class=\"more light\">Learn More</a>
            </p>  
          </div>
        </div>
      </div>
    </div>

    
    
    <div class=\"container\">
      

      <div class=\"row\">
        <div class=\"col-lg-12\">
          
          <div class=\"d-flex team-vs\">
            <span class=\"score\">4-1</span>
            <div class=\"team-1 w-50\">
              <div class=\"team-details w-100 text-center\">
                
                <h3>LA LEGA <span>(win)</span></h3>
                <ul class=\"list-unstyled\">
                  <li>Anja Landry (7)</li>
                  <li>Eadie Salinas (12)</li>
                  <li>Ashton Allen (10)</li>
                  <li>Baxter Metcalfe (5)</li>
                </ul>
              </div>
            </div>
            <div class=\"team-2 w-50\">
              <div class=\"team-details w-100 text-center\">
                <img src=\"{{asset('images/logo_2.png')}}\" alt=\"Image\" class=\"img-fluid\">
                <h3>JUVENDU <span>(loss)</span></h3>
                <ul class=\"list-unstyled\">
                  <li>Macauly Green (3)</li>
                  <li>Arham Stark (8)</li>
                  <li>Stephan Murillo (9)</li>
                  <li>Ned Ritter (5)</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  

    <div class=\"latest-news\">
      <div class=\"container\">
        <div class=\"row\">
          <div class=\"col-12 title-section\">
            <h2 class=\"heading\">derniers évènements</h2>
          </div>
        </div>
        <div class=\"row no-gutters\">
          <div class=\"col-md-4\">
            <div class=\"post-entry\">
              <a href=\"#\">
                <img src=\"{{asset('images/img_1.jpg')}}\" alt=\"Image\" class=\"img-fluid\">
              </a>
              <div class=\"caption\">
                <div class=\"caption-inner\">
                  <h3 class=\"mb-3\">Dakar en Arabie Saoudite</h3>
                  <div class=\"author d-flex align-items-center\">
                    <div class=\"img mb-2 mr-3\">
                      <img src=\"{{asset('images/person_1.jpg')}}\" alt=\"\">
                    </div>
                    <div class=\"text\">
                      <h4>Partenaire ... </h4>
                      <span>May 19, 2023 &bullet; Sports</span>
                    </div>
                  </div>
                </div>
              </div> 
            </div>
          </div>
          <div class=\"col-md-4\">
            <div class=\"post-entry\">
              <a href=\"#\">
                <img src=\"{{asset('images/img_3.jpg')}}\" alt=\"Image\" class=\"img-fluid\">
              </a>
              <div class=\"caption\">
                <div class=\"caption-inner\">
                  <h3 class=\"mb-3\">Masters à Augusta</h3>
                  <div class=\"author d-flex align-items-center\">
                    <div class=\"img mb-2 mr-3\">
                      <img src=\"{{asset('images/person_1.jpg')}}\" alt=\"\">
                    </div>
                    <div class=\"text\">
                      <h4>Partenaire ...</h4>
                      <span>May 20, 2023 &bullet; Sports</span>
                    </div>
                  </div>
                </div>
              </div> 
            </div>
          </div>
          <div class=\"col-md-4\">
            <div class=\"post-entry\">
              <a href=\"#\">
                <img src=\"{{asset('images/img_2.jpg')}}\" alt=\"Image\" class=\"img-fluid\">
              </a>
              <div class=\"caption\">
                <div class=\"caption-inner\">
                  <h3 class=\"mb-3\">Euro féminin en Angleterre</h3>
                  <div class=\"author d-flex align-items-center\">
                    <div class=\"img mb-2 mr-3\">
                      <img src=\"{{asset('images/person_1.jpg')}}\" alt=\"\">
                    </div>
                    <div class=\"text\">
                      <h4>Partenaire ...</h4>
                      <span>May 21, 2023 &bullet; Sports</span>
                    </div>
                  </div>
                </div>
              </div> 
            </div>
          </div>
        </div>

      </div>
    </div>
    
    <div class=\"site-section bg-dark\">
      <div class=\"container\">
        <div class=\"row\">
          <div class=\"col-lg-6\">
            <div class=\"widget-next-match\">
              <div class=\"widget-title\">
                <h3>Next Match</h3>
              </div>
              <div class=\"widget-body mb-3\">
                <div class=\"widget-vs\">
                  <div class=\"d-flex align-items-center justify-content-around justify-content-between w-100\">
                    <div class=\"team-1 text-center\">
                      <img src=\"{{asset('images/logo_1.png')}}\" alt=\"Image\">
                      <h3>Football League</h3>
                    </div>
                    <div>
                      <span class=\"vs\"><span>VS</span></span>
                    </div>
                    <div class=\"team-2 text-center\">
                      <img src=\"{{asset('images/logo_2.png')}}\" alt=\"Image\">
                      <h3>Soccer</h3>
                    </div>
                  </div>
                </div>
              </div>

              <div class=\"text-center widget-vs-contents mb-4\">
                <h4>World Cup League</h4>
                <p class=\"mb-5\">
                  <span class=\"d-block\">December 20th, 2020</span>
                  <span class=\"d-block\">9:30 AM GMT+0</span>
                  <strong class=\"text-primary\">New Euro Arena</strong>
                </p>

                <div id=\"date-countdown2\" class=\"pb-1\"></div>
              </div>
            </div>
          </div>
          <div class=\"col-lg-6\">
            
            <div class=\"widget-next-match\">
              <table class=\"table custom-table\">
                <thead>
                  <tr>
                    <th>P</th>
                    <th>Team</th>
                    <th>W</th>
                    <th>D</th>
                    <th>L</th>
                    <th>PTS</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td><strong class=\"text-white\">Football League</strong></td>
                    <td>22</td>
                    <td>3</td>
                    <td>2</td>
                    <td>140</td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td><strong class=\"text-white\">Soccer</strong></td>
                    <td>22</td>
                    <td>3</td>
                    <td>2</td>
                    <td>140</td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td><strong class=\"text-white\">Juvendo</strong></td>
                    <td>22</td>
                    <td>3</td>
                    <td>2</td>
                    <td>140</td>
                  </tr>
                  <tr>
                    <td>4</td>
                    <td><strong class=\"text-white\">French Football League</strong></td>
                    <td>22</td>
                    <td>3</td>
                    <td>2</td>
                    <td>140</td>
                  </tr>
                  <tr>
                    <td>5</td>
                    <td><strong class=\"text-white\">Legia Abante</strong></td>
                    <td>22</td>
                    <td>3</td>
                    <td>2</td>
                    <td>140</td>
                  </tr>
                  <tr>
                    <td>6</td>
                    <td><strong class=\"text-white\">Gliwice League</strong></td>
                    <td>22</td>
                    <td>3</td>
                    <td>2</td>
                    <td>140</td>
                  </tr>
                  <tr>
                    <td>7</td>
                    <td><strong class=\"text-white\">Cornika</strong></td>
                    <td>22</td>
                    <td>3</td>
                    <td>2</td>
                    <td>140</td>
                  </tr>
                  <tr>
                    <td>8</td>
                    <td><strong class=\"text-white\">Gravity Smash</strong></td>
                    <td>22</td>
                    <td>3</td>
                    <td>2</td>
                    <td>140</td>
                  </tr>
                </tbody>
              </table>
            </div>

          </div>
        </div>
      </div>
    </div> <!-- .site-section -->

    <div class=\"site-section\">
      <div class=\"container\">
        <div class=\"row\">
          <div class=\"col-6 title-section\">
            <h2 class=\"heading\">Videos</h2>
          </div>
          <div class=\"col-6 text-right\">
            <div class=\"custom-nav\">
            <a href=\"#\" class=\"js-custom-prev-v2\"><span class=\"icon-keyboard_arrow_left\"></span></a>
            <span></span>
            <a href=\"#\" class=\"js-custom-next-v2\"><span class=\"icon-keyboard_arrow_right\"></span></a>
            </div>
          </div>
        </div>


        <div class=\"owl-4-slider owl-carousel\">
          <div class=\"item\">
            <div class=\"video-media\">
              <img src=\"{{asset('images/img_1.jpg')}}\" alt=\"Image\" class=\"img-fluid\">
              <a href=\"https://vimeo.com/139714818\" class=\"d-flex play-button align-items-center\" data-fancybox>
                <span class=\"icon mr-3\">
                  <span class=\"icon-play\"></span>
                </span>
                <div class=\"caption\">
                  <h3 class=\"m-0\">Dogba set for Juvendu return?</h3>
                </div>
              </a>
            </div>
          </div>
          <div class=\"item\">
            <div class=\"video-media\">
              <img src=\"{{asset('images/img_2.jpg')}}\" alt=\"Image\" class=\"img-fluid\">
              <a href=\"https://vimeo.com/139714818\" class=\"d-flex play-button align-items-center\" data-fancybox>
                <span class=\"icon mr-3\">
                  <span class=\"icon-play\"></span>
                </span>
                <div class=\"caption\">
                  <h3 class=\"m-0\">Kai Nets Double To Secure Comfortable Away Win</h3>
                </div>
              </a>
            </div>
          </div>
          <div class=\"item\">
            <div class=\"video-media\">
              <img src=\"{{asset('images/img_3.jpg')}}\" alt=\"Image\" class=\"img-fluid\">
              <a href=\"https://vimeo.com/139714818\" class=\"d-flex play-button align-items-center\" data-fancybox>
                <span class=\"icon mr-3\">
                  <span class=\"icon-play\"></span>
                </span>
                <div class=\"caption\">
                  <h3 class=\"m-0\">Romolu to stay at Real Nadrid?</h3>
                </div>
              </a>
            </div>
          </div>

          <div class=\"item\">
            <div class=\"video-media\">
              <img src=\"{{asset('images/img_1.jpg')}}\" alt=\"Image\" class=\"img-fluid\">
              <a href=\"https://vimeo.com/139714818\" class=\"d-flex play-button align-items-center\" data-fancybox>
                <span class=\"icon mr-3\">
                  <span class=\"icon-play\"></span>
                </span>
                <div class=\"caption\">
                  <h3 class=\"m-0\">Dogba set for Juvendu return?</h3>
                </div>
              </a>
            </div>
          </div>
          <div class=\"item\">
            <div class=\"video-media\">
              <img src=\"{{asset('images/img_2.jpg')}}\" alt=\"Image\" class=\"img-fluid\">
              <a href=\"https://vimeo.com/139714818\" class=\"d-flex play-button align-items-center\" data-fancybox>
                <span class=\"icon mr-3\">
                  <span class=\"icon-play\"></span>
                </span>
                <div class=\"caption\">
                  <h3 class=\"m-0\">Kai Nets Double To Secure Comfortable Away Win</h3>
                </div>
              </a>
            </div>
          </div>
          <div class=\"item\">
            <div class=\"video-media\">
              <img src=\"{{asset('images/img_3.jpg')}}\" alt=\"Image\" class=\"img-fluid\">
              <a href=\"https://vimeo.com/139714818\" class=\"d-flex play-button align-items-center\" data-fancybox>
                <span class=\"icon mr-3\">
                  <span class=\"icon-play\"></span>
                </span>
                <div class=\"caption\">
                  <h3 class=\"m-0\">Romolu to stay at Real Nadrid?</h3>
                </div>
              </a>
            </div>
          </div>

        </div>

      </div>
    </div>

    <div class=\"container site-section\">
      <div class=\"row\">
        <div class=\"col-6 title-section\">
          <h2 class=\"heading\">Our Blog</h2>
        </div>
      </div>
      <div class=\"row\">
        <div class=\"col-lg-6\">
          <div class=\"custom-media d-flex\">
            <div class=\"img mr-4\">
              <img src=\"{{asset('images/img_1.jpg')}}\" alt=\"Image\" class=\"img-fluid\">
            </div>
            <div class=\"text\">
              <span class=\"meta\">May 20, 2023</span>
              <h3 class=\"mb-4\"><a href=\"#\">FC Barcelone - Xavi : \"Le Real Madrid peut encore gagner le championnat\"</a></h3>
              <p>Opposé au Séville FC dimanche soir, le Barça n'a pas fait de cadeau en s'imposant 3-0...</p>
              <p><a href=\"#\">Read more</a></p>
            </div>
          </div>
        </div>
        <div class=\"col-lg-6\">
          <div class=\"custom-media d-flex\">
            <div class=\"img mr-4\">
              <img src=\"{{asset('images/img_3.jpg')}}\" alt=\"Image\" class=\"img-fluid\">
            </div>
            <div class=\"text\">
              <span class=\"meta\">May 20, 2023</span>
              <h3 class=\"mb-4\"><a href=\"#\">Où et quand voir le Clasico comptant pour la finale de la Supercoupe d'Espagne</a></h3>
              <p>Consultez les chaînes et les horaires pour voir le match entre le Real Madrid et le Barça dimanche soir</p>
              <p><a href=\"#\">Read more</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>



    <footer class=\"footer-section\">
      <div class=\"container\">
        <div class=\"row\">
          <div class=\"col-lg-3\">
            <div class=\"widget mb-3\">
              <h3>News</h3>
              <ul class=\"list-unstyled links\">
                <li><a href=\"#\">All</a></li>
                <li><a href=\"#\">Club News</a></li>
                <li><a href=\"#\">Media Center</a></li>
                <li><a href=\"#\">Video</a></li>
                <li><a href=\"#\">RSS</a></li>
              </ul>
            </div>
          </div>
          <div class=\"col-lg-3\">
            <div class=\"widget mb-3\">
              <h3>Tickets</h3>
              <ul class=\"list-unstyled links\">
                <li><a href=\"#\">Online Ticket</a></li>
                <li><a href=\"#\">Payment and Prices</a></li>
                <li><a href=\"#\">Contact &amp; Booking</a></li>
                <li><a href=\"#\">Tickets</a></li>
                <li><a href=\"#\">Coupon</a></li>
              </ul>
            </div>
          </div>
          <div class=\"col-lg-3\">
            <div class=\"widget mb-3\">
              <h3>Matches</h3>
              <ul class=\"list-unstyled links\">
                <li><a href=\"#\">Standings</a></li>
                <li><a href=\"#\">World Cup</a></li>
                <li><a href=\"#\">La Lega</a></li>
                <li><a href=\"#\">Hyper Cup</a></li>
                <li><a href=\"#\">World League</a></li>
              </ul>
            </div>
          </div>

          <div class=\"col-lg-3\">
            <div class=\"widget mb-3\">
              <h3>Social</h3>
              <ul class=\"list-unstyled links\">
                <li><a href=\"#\">Twitter</a></li>
                <li><a href=\"#\">Facebook</a></li>
                <li><a href=\"#\">Instagram</a></li>
                <li><a href=\"#\">Youtube</a></li>
              </ul>
            </div>
          </div>

        </div>

        <div class=\"row text-center\">
          <div class=\"col-md-12\">
            <div class=\" pt-5\">
              <p>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                Copyright &copy;
                <script>
                  document.write(new Date().getFullYear());
                </script> All rights reserved | This template is made with <i class=\"icon-heart\"
                  aria-hidden=\"true\"></i> by <a href=\"https://colorlib.com\" target=\"_blank\">Colorlib</a>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
              </p>
            </div>
          </div>

        </div>
      </div>
    </footer>



  </div>
  <!-- .site-wrap -->

  {% block js %}
  <script src=\"{{asset('js/jquery-3.3.1.min.js')}}\"></script>
  <script src=\"{{asset('js/jquery-migrate-3.0.1.min.js')}}\"></script>
  <script src=\"{{asset('js/jquery-ui.js')}}\"></script>
  <script src=\"{{asset('js/popper.min.js')}}\"></script>
  <script src=\"{{asset('js/bootstrap.min.js')}}\"></script>
  <script src=\"{{asset('js/owl.carousel.min.js')}}\"></script>
  <script src=\"{{asset('js/jquery.stellar.min.js')}}\"></script>
  <script src=\"{{asset('js/jquery.countdown.min.js')}}\"></script>
  <script src=\"{{asset('js/bootstrap-datepicker.min.js')}}\"></script>
  <script src=\"{{asset('js/jquery.easing.1.3.js')}}\"></script>
  <script src=\"{{asset('js/aos.js')}}\"></script>
  <script src=\"{{asset('js/jquery.fancybox.min.js')}}\"></script>
  <script src=\"{{asset('js/jquery.sticky.js')}}\"></script>
  <script src=\"{{asset('js/jquery.mb.YTPlayer.min.js')}}\"></script>


  <script src=\"{{asset('js/main.js')}}\"></script>
  {% endblock %}

  {% endblock %}
</body>

</html>", "front.html.twig", "C:\\xampp\\htdocs\\sportifyy\\templates\\front.html.twig");
    }
}
