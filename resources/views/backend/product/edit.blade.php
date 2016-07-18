@extends('backend.base.template')
@section('content')

<section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Edit Product</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form class="form" role="form" method="POST" action="{{ url('admin/product/update/'.$product->product_id) }}" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                   <div class="box-body">
                    <div class="form-group">
                      <label>Name</label>
                      <input value="{{ $product->name }}" name="name" type="text" class="form-control" placeholder="Name">
                    </div>
                    <div class="form-group">
                      <label>Brand</label>
                      <select name="brand" class="form-control">
                          @foreach($brands as $brand)
                            <option <?php if($brand->id == $product->brand_id) echo 'selected'; ?> value="{{ $brand->id }}">{{ $brand->name }}</option>
                          @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Category</label>
                      <select name="category" class="form-control">
                          @foreach($categories as $category)
                            <option <?php if($category->id == $product->product_category_id) echo 'selected'; ?> value="{{ $category->id }}">{{ $category->name }}</option>
                          @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Price</label>
                      <input value="{{ $product->price }}" name="price" type="text" class="form-control" placeholder="Price">
                    </div>
                    <div class="form-group">
                      <label>Featured</label>
                      <input <?php if($product->is_featured == 1) echo 'checked'; ?>  name="is_featured" type="checkbox" class="checkbox">
                    </div>

                    <div class="box-footer">
                      <ul class="mailbox-attachments clearfix">
                        <li>
                          <span class="mailbox-attachment-icon has-img"><img src="{{ URL::to('images/products/'.$product->image) }}" alt="Attachment"/></span>
                          <div class="mailbox-attachment-info">
                            <a href="#" class="mailbox-attachment-name"><i class="fa fa-camera"></i> {{ $product->name }}</a>
                           
                          </div>
                        </li>
                      </ul>
                    </div><!-- /.box-footer -->
                    
                    
                    <div class="form-group">
                      <div class="btn btn-default btn-file">
                        <i class="fa fa-paperclip"></i> Image
                        <input name="file" type="file"/>
                      </div> 
                      <p class="help-block">Max. 32MB</p>
                    </div>
                    
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right">Submit</button>
                  </div>
                </form>
              </div><!-- /.box -->


            </div><!--/.col (left) -->

          </div>   <!-- /.row -->
        </section><!-- /.content -->

    <!-- jQuery 2.1.4 -->
    <script src="{{ URL::to('plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="{{ URL::to('bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="{{ URL::to('dist/js/app.min.js') }}" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ URL::to('dist/js/demo.js') }}" type="text/javascript"></script>

    @endsection