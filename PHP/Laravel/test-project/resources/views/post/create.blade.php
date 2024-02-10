<x-app-layout>
  <x-slot name="header"">
    <h2 class=" font-semibold text-xl text-gray-800 leading-tight">
    新規投稿画面
    </h2>
  </x-slot>
  <div class="max-w-7xl mx-auto px-6">
    @if (session('message'))
    <div class="text-red-600 font-bold">
      {{ session('message') }}
    </div>
    @endif

    <form action="{{route('post.store')}}" method="post">
      @csrf
      <div class="mt-8">
        <div class="w-full flex flex-col">
          <label for="title" class="font-semibold mt-4">件名</label> <!-- /.font-semibold mt-4 -->
          <x-input-error :messages="$errors->get('title')" class="w-auto py-2" />
          <input value=" {{old('title')}}" type=" text" name="title" class="w-auto py-2 border border-gray-300 rounded-md ">

        </div>
      </div>
      <div class=" w-full flex flex-col">
        <label for="body" class="font-semibold mt-4">本文</label>
        <x-input-error :messages="$errors->get('body')" class="mt-2" />
        <textarea name=" body" cols="30" rows="5" class="w-auto py-2 border border-gray-300 rounded-md" id="body">{{old('body')}}</textarea>
      </div>

      <x-primary-button class="mt-4 ">
        <h1>投稿する</h1>
      </x-primary-button>
    </form>
  </div>
</x-app-layout>