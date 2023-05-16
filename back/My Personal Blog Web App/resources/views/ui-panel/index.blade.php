 @extends('ui-panel.layouts.master')

 @section('title', 'Mr.Min Personal Blog')

 @section('content')

     <!-- Posts And Categories Section -->
     <section class="bg-white">
         <div class="container">
             <div class="row py-5">
                 <div class="col-md-8 order-md-5" id="blogs">
                     <div class="row">
                         @if ($posts->count() != 0)
                             @foreach ($posts as $post)
                                 <!-- Posts -->
                                 <div class="col-md-6 mt-5 mt-md-0 mb-md-4" id="posts">
                                     <img src="{{ asset('storage/post_images/' . $post->image) }}" alt="image"
                                         class="w-100 img-fluid">
                                     <p class="text-muted mt-3">
                                         {{ $post->category->name }} -{{ $post->created_at->diffForHumans() }}
                                     </p>
                                     <h5 class="text-uppercase">{{ $post->title }}</h5>
                                     <div class="text-muted">
                                         {{ substr($post->content, 0, 100) }}
                                     </div>
                                     <a href="{{ route('blogs.detail', $post->id) }}"
                                         class="text-decoration-none text-black fs-6 mb-5">Read More <i
                                             class="fa-solid fa-right-long ms-1"></i></a>
                                 </div>
                             @endforeach
                         @else
                             <h3>There is no posts to show here!</h3>
                         @endif
                         <div>{{ $posts->links() }}</div>
                     </div>
                 </div>
                 <div class="col-md-4 order-md-1">
                     <!-- Search -->
                     <form action="{{ route('main') }}" method="GET">
                         <div class="input-group bg-secondary-subtle p-4 rounded">

                             @csrf
                             <input type="text" class="form-control" placeholder="Search..." name="search">
                             <button class="btn btn-outline-secondary bg-white"><i
                                     class="fa-solid fa-magnifying-glass"></i></button>
                         </div>
                     </form>
                     <!-- Categories -->
                     <div class="mt-4 bg-secondary-subtle">
                         <h5 class="p-3">Categories</h5>
                         <ul class="list-group list-group-flush bg-secondary-subtle py-2">
                             <a href="{{ route('main') }}">
                                 <li class="list-group-item bg-secondary-subtle">All</li>
                             </a>
                             @foreach ($categories as $category)
                                 <a href="{{ route('blogs.filter', $category->id) }}">
                                     <li class="list-group-item bg-secondary-subtle">{{ $category->name }}</li>
                                 </a>
                             @endforeach
                         </ul>
                     </div>
                     <!-- Top Posts -->
                     <div class="mt-4 bg-secondary-subtle">
                         <h5 class="p-3">Top Posts</h5>
                         <div class="list-group">
                             @foreach ($topPosts as $topPost)
                                 <a href="{{ route('blogs.detail', $topPost->id) }} }}"
                                     class="list-group-item list-group-item-action bg-secondary-subtle">
                                     <div class="w-100">
                                         <h5 class="mb-1 text-uppercase">{{ $topPost->title }}</h5>
                                     </div>
                                     <p class="mb-1">{{ $topPost->category->name }} -
                                         {{ $topPost->created_at->format('d M, Y') }}</p>
                                 </a>
                             @endforeach
                         </div>
                     </div>
                     <!-- Instagram -->
                     <div class="mt-4">
                         <h5>Instagram</h5>
                         <div class="row">
                             @foreach ($images as $image)
                                 <div class="col-4 mt-2">
                                     <img src="{{ asset("storage/social_images/$image->name") }}" alt="image"
                                         class="w-100 img-fluid" style="height: 100px; object-fit: cover">
                                 </div>
                             @endforeach
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </section>

 @endsection
