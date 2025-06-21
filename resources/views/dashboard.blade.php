<h2>Welcome, {{ auth()->user()->name }}</h2>

<form method="POST" action="{{ url('/logout') }}">
    @csrf
    <button class="btn btn-danger">Logout</button>
</form>
