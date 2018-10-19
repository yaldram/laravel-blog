@extends('layouts.backend.app')

@section('title', 'Create Posts')

@push('css')
    
@endpush

@section('content')
     <a href="{{ route('admin.post.index') }}" class="btn btn-danger waves-effect">
        <i class="material-icons">done</i>
            Back
        </a>
        
        @if($post->is_approved == false)
            
            <button type="button" class="btn btn-success pull-right waves-effect" onclick="approvePost({{ $post->id }})">
                <i class="material-icons">done</i>
                <span>Approve</span>
            </button>
            
            <form method="post" action="{{ route('admin.post.approve', $post->id) }}" style="display: none;" id="approval-form">
                @csrf
                @method('PUT')
            </form>
        
        @else 
             
             <button type="button" class="btn btn-success pull-right waves-effect" disabled>
                <i class="material-icons">done</i>
                <span>Approved</span>
            </button>
       
        @endif
        
    <div class="row clearfix" style="margin-top: 15px;">
        <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                       {{ $post->title }}
                       <small>Posted By
                       <strong>
                           <a href="{{ $post->user->name }}">
                                
                           </a>
                       </strong> on {{ $post->created_at->toFormattedDateString() }}
                       </small>
                    </h2>
                </div>
                <div class="body">
                   {!! $post->body !!} 
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
            <!-- Category Tag -->
            <div class="card">
                <div class="header bg-cyan">
                    <h2>
                      CATEGORIES
                    </h2>
                </div>
                <div class="body">
                    @foreach($post->categories as $category)
                        <span class="label bg-cyan" style="margin: 0px 5px">
                            {{ $category->name }}
                        </span>
                    @endforeach
                </div>
            </div>
            
            <!-- Tags -->
            <div class="card">
                <div class="header bg-green">
                    <h2>
                      TAGS
                    </h2>
                </div>
                <div class="body">
                    @foreach($post->tags as $tag)
                        <span class="label bg-green" style="margin: 0px 5px">
                            {{ $tag->name }}
                        </span>
                    @endforeach
                </div>
            </div>

            <!-- Featured Image  -->
            <div class="card">
                <div class="header bg-amber">
                    <h2>
                      FEATURED IMAGE
                    </h2>
                </div>
                <div class="body">
                  <img class="img-responsive thumbnail" src="{{ asset('storage/post/'. $post->image) }}" alt="Featured Image">
                </div>
            </div>

        </div>
   </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.28.4/dist/sweetalert2.all.min.js"></script>
    
    <script type="text/javascript">
        function approvePost(id) {
            const swalWithBootstrapButtons = swal.mixin({
              confirmButtonClass: 'btn btn-success',
              cancelButtonClass: 'btn btn-danger',
              buttonsStyling: false,
            });

            swalWithBootstrapButtons({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              type: 'warning',
              showCancelButton: true,
              confirmButtonText: 'Yes, Approve It!',
              cancelButtonText: 'No, cancel!',
              reverseButtons: true
            }).then((result) => {
              if (result.value) {
               event.preventDefault();
               document.getElementById('approval-form').submit();
              } else if (
                // Read more about handling dismissals
                result.dismiss === swal.DismissReason.cancel
              ) {
                swalWithBootstrapButtons(
                  'Cancelled',
                  'The post remained Pending :)',
                  'info'
                )
              }
        })
    }
    </script>
@endpush
