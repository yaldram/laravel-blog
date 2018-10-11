@extends('layouts.backend.app')

@section('title', 'Comments')

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
                           ALL COMMENTS
                           <span class="badge bg-blue">
                               {{ $comments->count() }}
                           </span>
                        </h2>
                    </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                        <thead>
                            <tr>
                            	  <th class="text-center">Comment Info.</th>
                                <th class="text-center">Post Info.</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                            	 <th class="text-center">Comment Info.</th>
                                <th class="text-center">Post Info.</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                       @foreach($comments as $key => $comment)
      						    <tr>
                        <td>
                        <div class="media">
                        <div class="media-left">
                          <a href="#">
                           <img class="media-object" src="{{ Storage::disk('public')->url('profile/'.$comment->user->image) }}" alt="Profile Image" width="64" height="64"> 
                          </a>
                        
                        </div>
                        
                        <div class="media-body">
                          <h4 class="media-heading">{{ $comment->user->name }} <small>{{ $comment->created_at->diffForHumans() }}</small></h4>
                          <p>{{ $comment->comment }}</p>
                          <a target="_blank" href="{{ route('post.details', $comment->post->slug.'#comments') }}"></a>
                        </div>
                    </div>
                        </td> 
                        
                        <td>
                          <div class="media">
                            <div class="media-right">
                              <a target="_blank" href="{{ route('post.details', $comment->post->slug) }}">
                               <img class="media-object" src="{{ Storage::disk('public')->url('post/'.$comment->post->image) }}" alt="post-image" width="64" height="64"> 
                              </a>
                            </div>

                            <div style="padding: 10px;" class="media-body">
                              <a target="_blank" href="{{ route('post.details', $comment->post->slug) }}">
                                <h4 class="media-heading">
                                  {{ str_limit($comment->post->title, '40') }}
                                </h4>
                              </a>
                              <p>by <strong>{{ $comment->post->user->name }}</strong></p>
                            </div>
                          </div>
                        </td>
                        <td>
                           <button type="button" class="btn btn-danger waves-effect" onclick="removeComment({{ $comment->id }})">
                                    <i class="material-icons">delete</i>
                                </button>
                                
                                <form method="post" action="{{ route('admin.comments.destroy', $comment->id) }}" style="display: none;" id="remove-comment-{{ $comment->id}}">
                                    @csrf
                                    @method('DELETE')
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
      function removeComment(id) {
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
          confirmButtonText: 'Yes, Remove Comment!',
          cancelButtonText: 'No, cancel!',
          reverseButtons: true
        }).then((result) => {
          if (result.value) {
           event.preventDefault();
           document.getElementById('remove-comment-'+id).submit();
          } else if (
            // Read more about handling dismissals
            result.dismiss === swal.DismissReason.cancel
          ) {
            swalWithBootstrapButtons(
              'Cancelled',
              'The Comment remained :)',
              'info'
            )
          }
    })
}
	</script>

@endpush
