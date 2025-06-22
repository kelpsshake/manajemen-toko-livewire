<nav class="flex justify-end gap-3">
    @auth
        <a
            href="{{ url('/dashboard') }}"
            class="rounded-md px-3 py-2 text-black transition hover:text-gray-700 dark:text-white dark:hover:text-white/80"
        >
            Dashboard
        </a>

        <form method="POST" action="{{ url('/logout') }}">
            @csrf
            <button
                type="submit"
                class="rounded-md px-3 py-2 text-black transition hover:text-gray-700 dark:text-white dark:hover:text-white/80"
            >
                Logout
            </button>
        </form>
    @else
        <a
            href="{{ route('login') }}"
            class="rounded-md px-3 py-2 text-black transition hover:text-gray-700 dark:text-white dark:hover:text-white/80"
        >
            Log in
        </a>

        @if (Route::has('register'))
            <a
                href="{{ route('register') }}"
                class="rounded-md px-3 py-2 text-black transition hover:text-gray-700 dark:text-white dark:hover:text-white/80"
            >
                Register
            </a>
        @endif
    @endauth
</nav>
