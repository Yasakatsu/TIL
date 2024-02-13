<x-app-layout>
  <x-slot name="header"">
    <h2 class=" font-semibold text-xl text-gray-800 leading-tight">
    記事詳細
    </h2>
  </x-slot>
  <div class="max-w-7xl mx-auto px-6">
    <div class="bg-white w-full rounded-2xl">
      <div class=" mt-4 p-4">
        <h1 class="text-lg font-semibold">
          {{$post->title}}
        </h1>
        <hr class="w-full">
        {{--whitespace-pre-line:データ保存時の行の折り返し、連続するspaceが１つになる--}}
        <p class=" mt-4 whitespace-pre-line">
          {{$post->body}}
        </p>
        <div class="text-sm font-semibold flex flex-row-reverse">
          <p>
            {{$post->created_at}}
          </p>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>