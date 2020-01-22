<li class="nav-item dropdown mega-dropdown"> <a class="nav-link dropdown-toggle text-muted  " href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> modal modal</a>
    <div class="dropdown-menu animated zoomIn form-data">
        <ul class="mega-dropdown-menu row">


            <li class="col-lg-3  m-b-30">
                <h4 class="m-b-20">CONTACT US</h4>
                <!-- Contact -->
                <form method="post" data-toogle="validator" class="form-horzontal" id="form" enctype="multipart/form-data">
                    {{csrf_field()}}
                    {{method_field ('POST')}} 
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="modal-title"></h4>
                    </div>
                    <div class="modal-body">
                      <input type="hidden" name="id" id="id">
                      <div class="form-group">
                        <label for="name" class="control-label">Nama</label>
                        <input type="text" class="form-control" name="name" id="name" required>
                        <span class="help-block with-errors"></span>
                      </div>
            
                      <div class="form-group">
                        <label for="email" class="control-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                        <span class="help-block with-errors"></span>            
                      </div>
      
                      <div class="form-group">
                          <label for="password" class="control-label">Password</label>
                          <input type="text" name="password" id="password" class="form-control" required>
                          <span class="help-block with-errors"></span>            
                      </div>
            
                       <div class="form-group">
                        <label for="foto" class="control-label">Foto</label>
                        <input type="file" name="photo" id="photo" class="form-control">
                        <span class="help-block with-errors"></span>            
                      </div>
            
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default btn-save" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                  </form>
            </li>
            
        </ul>
    </div>
</li>