<div class="bcrumbs">
    <div class="container">
        <ul>
            <li><a href="{{ url.getBaseUri()}}">Home</a></li>
            <li><a href="#">Comparação</a></li>
        </ul>
    </div>
</div>
<div class="container">
	{{ helper.comparacao.getHelper(['produtos':produtos]) }}
</div>

<br clear="all"/>