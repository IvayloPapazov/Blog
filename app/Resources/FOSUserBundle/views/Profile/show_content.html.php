<div class="fos_user_user_show">
    <p>{{ 'profile.show.username'|trans({}, 'FOSUserBundle') }}: {{ user.username }}</p>
    <p>{{ 'profile.show.email'|trans({}, 'FOSUserBundle') }}: {{ user.email }}</p>
    <p><a href="{{ path('fos_user_profile_edit') }}">Edit</a></p>
</div>
