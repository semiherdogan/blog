@extends('_layouts.master')

@push('meta')
    <meta property="og:title" content="About {{ $page->siteName }}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ $page->getUrl() }}"/>
    <meta property="og:description" content="A little bit about {{ $page->siteName }}" />
@endpush

@section('body')
    <h1>Hakkımda</h1>

<!--
    <img src="/assets/img/about.png"
        alt="About image"
        class="flex rounded-full h-64 w-64 bg-contain mx-auto md:float-right my-6 md:ml-10">
-->
    <p class="mb-6 text-gray-700">// TODO: </p>
<!--
    <p class="mb-6">This is where you can give a little more information about yourself or site. If you'd like to change the structure of this page, you can find the file at <code>source/about.blade.php</code></p>

    <p class="mb-6">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum officia dolorem accusantium veniam quae, possimus, temporibus explicabo magni voluptas. fugit natus deserunt atque veniam possimus earum harum itaque est!</p>
-->
    <div class="mt-7">
        <a href="https://twitter.com/h_semih_" title="Twitter @h_semih_">
            <img class="h-8 inline" src="/assets/img/twitter.svg" alt="Twitter logo" />
        </a>

        <a href="https://github.com/semiherdogan" title="Github @semiherdogan">
            <img class="h-8 inline" src="/assets/img/github.svg" alt="Github logo" />
        </a>
    </div>
@endsection
