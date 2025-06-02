<h1>Olá {{ $owner->name }}</h1>

<a href="{{ url("/validate", $owner->remember_token) }}">Clique aqui para validar seu email</a>