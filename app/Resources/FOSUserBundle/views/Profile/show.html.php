{% extends "::base.html.twig" %}

{% block fos_user_content %}
{% include "FOSUserBundle:Profile:show_content.html.php" %}
{% endblock fos_user_content %}
