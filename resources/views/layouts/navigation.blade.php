<nav>
    <ul>
        <li><a href="{{ route('welcome') }}">Domů</a></li>
        <li><a href="{{ route('reservations.index') }}">Rezervace</a></li>
        <li><a href="{{ route('login') }}">Přihlášení</a></li>

        <!-- Pokud je uživatel přihlášen, zobrazí se odkaz na profil a odhlášení -->
        @auth
            <li><a href="{{ route('profile.edit') }}">Můj profil</a></li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">Odhlásit se</button>
                </form>
            </li>
        @else
            <!-- Pokud není uživatel přihlášen, zobrazí se odkaz na přihlášení -->
            <li><a href="{{ route('login') }}">Přihlásit se</a></li>
        @endauth
    </ul>
</nav>
