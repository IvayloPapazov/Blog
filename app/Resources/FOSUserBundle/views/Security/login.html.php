{% extends "::base.html.twig" %}

{% block fos_user_content %}
{% if error %}
    <div>{{ error|trans({}, 'FOSUserBundle') }}</div>
{% endif %}


<form action="{{ path("fos_user_security_check") }}" method="post" class="form-horizontal" role="form">
    <div class="form-group">
        <input type="hidden" name="_csrf_token" value="{{ csrf_token }}" />

        <label for="username" class="col-sm-2 control-label">{{ 'security.login.username'|trans }}</label>
        <div class="col-sm-4">
            <input type="text" id="username" class="form-control" name="_username" value="{{ last_username }}" required="required" />
        </div>
    </div>
    <div class="form-group">
        <label for="password" class="col-sm-2 control-label">{{ 'security.login.password'|trans }}</label>
        <div class="col-sm-4">
            <input type="password" id="password" class="form-control" name="_password" required="required" />
            <h6>
                <a href="{{ path('fos_user_resetting_request') }}" >
                    {{'security.login.forgot'|trans}}
                </a>|
                <a href="{{ path('fos_user_registration_register') }}" >
                    {{'security.login.register'|trans}}
                </a>
            </h6>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <div class="checkbox">
                <input type="checkbox" id="remember_me" name="_remember_me" value="on" />
                <label for="remember_me">{{ 'security.login.remember_me'|trans }}</label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <input type="submit" id="_submit" class="btn btn-default" name="_submit" value="{{ 'security.login.submit'|trans({}, 'FOSUserBundle') }}" />
        </div>
    </div>
</form>

{% endblock fos_user_content %}
