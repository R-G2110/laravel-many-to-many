<header class="bg-dark">
    <nav class="navbar navbar-dark">
        <div class="container-fluid">
          <a target="blank" href=" {{ route('home') }}" class="navbar-brand">Vai al sito</a>
          <form action="{{ route('logout') }}" method="POST" class="d-flex" role="search">
            @csrf

            <button class="btn btn-outline-hella" type="submit"><i class="fa-solid fa-arrow-right-from-bracket"></i></button>
          </form>
        </div>
      </nav>
</header>
