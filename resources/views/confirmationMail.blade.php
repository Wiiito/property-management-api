<h1>Olá {{ $owner->name }}</h1>

<p>
    Seja muito bem vindo à nossa API!
</p>
<a href="{{ url("/validate", $owner->remember_token) }}">Clique aqui para validar seu email</a>