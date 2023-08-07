<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Posts de {{ $user['name'] }}
        </h2>
    </x-slot>
@include('users.partials.head_users')
<link rel="stylesheet" href="{{ asset('css/posts.css') }}">
<div class="container" style="margin-top: 100px;padding-bottom:100px;">
    @foreach($posts as $post)
        <div class="projcard-container">
            <div class="projcard projcard-blue">
            <div class="projcard-innerbox">
                <div class="projcard-textbox">
                <div class="projcard-title">{{ $post['title'] }}</div>
                <div class="projcard-subtitle">Post id: {{ $post['id'] }} - Autor: {{ $user['name'] }}</div>
                <div class="projcard-bar"></div>
                <div class="projcard-description">{{ $post['body'] }}</div>
                </div>
            </div>
            </div>
        </div>
    @endforeach
</div>
</x-app-layout>
