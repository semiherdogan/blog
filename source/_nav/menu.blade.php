<nav class="hidden lg:flex items-center justify-end text-lg">
    <a title="{{ $page->siteName }} Blog" href="/blog"
        class="ml-6 text-gray-700 hover:text-blue-600 {{ $page->isActive('/blog') ? 'active text-blue-600' : '' }}">
        Blog
    </a>

    <a title="{{ $page->siteName }} Hakkımda" href="/about"
        class="ml-6 text-gray-700 hover:text-blue-600 {{ $page->isActive('/about') ? 'active text-blue-600' : '' }}">
        Hakkımda
    </a>

    <!--
    <a title="{{ $page->siteName }} Snippets" href="/snippets"
       class="ml-6 text-gray-700 hover:text-blue-600 {{ $page->isActive('/snippets') ? 'active text-blue-600' : '' }}">
        Snippets
    </a>
    -->
</nav>
