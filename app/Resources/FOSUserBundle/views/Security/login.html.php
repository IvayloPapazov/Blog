{% extends "::base.html.twig" %}

{% block fos_user_content %}
{% if error %}
    <div>{{ error|trans({}, 'FOSUserBundle') }}</div>
{% endif %}

<form action="{{ path("fos_user_security_check") }}" method="post">
    <input type="hidden" name="_csrf_token" value="{{ csrf_token }}" />

    <label for="username">{{ 'security.login.username'|trans({}, 'FOSUserBundle') }}</label>
    <input type="text" id="username" name="_username" value="{{ last_username }}" required="required" />

    <label for="password">{{ 'security.login.password'|trans({}, 'FOSUserBundle') }}</label>
    <input type="password" id="password" name="_password" required="required" />

    <input type="checkbox" id="remember_me" name="_remember_me" value="on" />
    <label for="remember_me">{{ 'security.login.remember_me'|trans({}, 'FOSUserBundle') }}</label>

    <input type="submit" id="_submit" name="_submit" value="{{ 'security.login.submit'|trans({}, 'FOSUserBundle') }}" />
</form>
<div>
			<a href="{{ path('fos_user_registration_register') }}" >
                 {{'user.form.login.link.new'|trans}}
                </a>
            /
                <a href="{{ path('fos_user_resetting_request') }}" >
                 {{'user.form.login.link.forgot'|trans}}
                </a>
            </div>
{% endblock fos_user_content %}
