<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      一覧画面表示
    </h2>
  </x-slot>
  <div class="mx-auto px-6">
    @foreach ($posts as $post)
    <div class="mt-4 p-8 bg-white w-full rounded-2xl">
      <h1 class="p-4 text-lg font-semibold">
        件名：
        <a href="{{route('post.show',$post)}}" class=" text-blue-500">{{ $post->title }}
        </a>
      </h1>
      <hr class="w-full">
      <p class="mt-4 p-4">
        {{ $post->body }}
      </p>
      <div class="p-4 text-sm font-semibold">
        <p>
          {{$post->created_at}} /{{$post->user->name??'名無し'}}
        </p>
      </div>
    </div>
    @endforeach
  </div>
</x-app-layout>
<!-- /.mx-auto px-6 -->