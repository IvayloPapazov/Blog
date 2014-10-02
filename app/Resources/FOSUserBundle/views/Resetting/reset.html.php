{% extends "::base.html.twig" %}

{% block fos_user_content %}
{% include "FOSUserBundle:Resetting:reset_content.html.php" %}
{% endblock fos_user_content %}
