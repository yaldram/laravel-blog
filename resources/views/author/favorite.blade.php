@extends('layouts.backend.app')

@section('title', 'Favorite Posts')

@push('css')
	<!-- JQuery DataTable Css -->
    <link href="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                           FAVORITE POSTS
                           <span class="badge bg-blue">
                               {{ $posts->count() }}
                           </span>
                        </h2>
                    </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                        <thead>
                            <tr>
                            	  <th>NO.</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th><i class="material-icons">favorite</i></th>
                                {{-- <th><i class="material-icons">comment</i></th> --}}
                                <th><i class="material-icons">visibility</i></th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                            	  <th>NO.</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th><i class="material-icons">favorite</i></th>
                                {{-- <th><i class="material-icons">comment</i></th> --}}
                                <th><i class="material-icons">visibility</i></th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                       @foreach($posts as $key => $post)
          						<tr>
          							<td>{{ $key + 1 }}</td>
          							<td>{{ str_limit($post->title, '10') }}</td>
          							<td>{{ $post->user->name }}</td>
                        <td>{{ $post->favorite_to_user->count() }}</td>
          							<td>{{ $post->view_count}}</td>
                        
							                 <td class="text-center">
                                
                                <a href="#" class="btn btn-success waves-effect">
                                    <i class="material-icons">visibility</i>
                                </a>

                                  <button type="button" class="btn btn-danger waves-effect" onclick="removePost({{ $post->id }})">
                                    <i class="material-icons">delete</i>
                                </button>
                                
                                <form method="post" action="{{ route('post.favorite', $post->id) }}" style="display: none;" id="remove-post">
                                    @csrf
                                </form>
                          
                  							</td>	
                  						</tr>
                                   @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
@endsection

@push('js')
	<script src="{{ asset('assets/backend/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>

    <script src="{{ asset('assets/backend/js/pages/tables/jquery-datatable.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.28.4/dist/sweetalert2.all.min.js"></script>
	
	<script type="text/javascript">
      function removePost(id) {
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
          confirmButtonText: 'Yes, Remove Post!',
          cancelButtonText: 'No, cancel!',
          reverseButtons: true
        }).then((result) => {
          if (result.value) {
           event.preventDefault();
           document.getElementById('remove-post').submit();
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
