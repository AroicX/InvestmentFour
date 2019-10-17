<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Response</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ url('/admin/ticket-control-responed') }}" method="POST" enctype="multipart/form-data">
              {{ csrf_field() }}
  
              <input type="hidden" id="get-response" name="id" value="">

              
              <div class="form-group h-30">
                  <label for="Message">Message</label>
                  <textarea class="form-control" name="message" cols="20" rows="5">
                      
                  </textarea>
              </div>
          
  
              <button type="submit" class="btn btn-primary">Upload</button>
  
  
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          {{-- <button type="button" class="btn btn-primary">Upload</button> --}}
        </div>
      </div>
    </div>
  </div>


