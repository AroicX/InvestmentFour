<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">About Us</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ url('/admin/page-control-about') }}" method="POST" enctype="multipart/form-data">
              {{ csrf_field() }}
  
              <img class="img-responsive w-100" src="/images/{{$about->header_image}}" alt="header image">
  
              <div class="form-group">
                  <label for="image">Image</label>
                  <input id="image" class="form-control" type="file" name="image">
              </div>
  
              <div class="form-group h-30">
                  <label for="summary">Summary</label>
                  <textarea class="form-control" name="summary" cols="20" rows="5">
                      {{$about->summary}}
                  </textarea>
              </div>
  
              <div class="form-group h-30">
                  <label for="who_we_are">Who we are </label>
                  <textarea class="form-control" name="who_we_are" cols="20" rows="5">
                      {{$about->who_we_are}}
                  </textarea>
              </div>
  
              <div class="form-group h-30">
                  <label for="what_we_do">What we do </label>
                  <textarea class="form-control" name="what_we_do" cols="20" rows="5">
                      {{$about->who_we_are}}
                  </textarea>
              </div>
  
              <div class="form-group h-30">
                  <label for="our_essence">Our Essence </label>
                  <textarea class="form-control" name="our_essence" cols="20" rows="5">
                      {{$about->our_essence}}
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