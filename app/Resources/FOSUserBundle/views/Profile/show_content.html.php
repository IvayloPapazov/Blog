<div class="fos_user_user_show">
    <p>{{ 'profile.show.username'|trans }}: {{ user.username }}</p>
    <p>{{ 'profile.show.email'|trans }}: {{ user.email }}</p>
    <p><a href="{{ path('fos_user_profile_edit') }}">{{'profile.show.edit'|trans}}</a></p>
</div>
