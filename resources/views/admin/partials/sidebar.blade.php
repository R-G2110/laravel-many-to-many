@php
    $menu_sidebar = config('menuSideBar.sidebar');
@endphp
<aside class="bg-dark">
    <nav class="w-100">
        <ul class="w-100">
            @foreach ($menu_sidebar as $item)
                <li class=" w-100 text-center my-2 {{ Route::currentRouteName() === $item['href'] ? 'active' : ''}}">
                    <a class="btn btn-custom w-100" href="{{ route($item['href']) }}">{{$item['text']}}</a>
                </li>
            @endforeach

        </ul>
    </nav>
</aside>
