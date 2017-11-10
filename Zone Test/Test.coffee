<td><a href="{{ path('review_show', { 'id': review.id }) }}">{{ review.id }}</a></td>

<td>{{ review.userRated }}</td>
                <td>{{ review.reviewAuthor }}</td>
<td>{% if review.publicationDate %}{{ review.publicationDate|date('Y-m-d H:i:s') }}
{% endif %}</td>
                <td>{{ review.note }}</td>
<td>
<ul>
<li>
<a href="{{ path('review_show', { 'id': review.id }) }}">show</a>
                        </li>
<li>
<a href="{{ path('review_edit', { 'id': review.id }) }}">edit</a>
                        </li>
</ul>
                </td>