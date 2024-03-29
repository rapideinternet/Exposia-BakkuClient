<nav>
    {{-- Here goes the menu --}}
    <ul>
        <li>
            {{-- Example of the active class with $slug variable --}}
            <a href="" class="{{ $slug === 'home' ? 'active' : '' }}">
                Home
            </a>
        </li>
    </ul>
</nav>
