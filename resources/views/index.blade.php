@extends('../template/index_detail')
@section('content')


  <div class="main-content">
    <style >
        #form-cari-berkas{
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
        }
        .foto-preview{
          max-height: 50px;
        }
        .foto-popop{
          max-height: 550px;
        }
    </style>
    <script type="text/javascript">
      // jQuery(function ($) {

      function openDetail(id,e) {
        // e.preventDefault();
        $(e).closest('tbody').find('.no-'+id).toggleClass('open');
        $(e).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
      }
      // })

      function proses() {
        var deskripsi = $('#form-cari-berkas input[name=deskripsi]').val();


        table_data.clear().draw();
         table_data.ajax.url("{{url("/cari_berkas/proses")}}?deskripsi="+deskripsi).load();


      }

       function openFile(id){
         window.open("{{asset("file_data")}}/"+id,'_blank').focus();

       }
       function submitInput() {
         $('#form_tambah').submit()
       }
       function submitEdit() {
         $('#form_edit').submit()
       }
       function setHaputData(id,nama_barang) {
         $('#dialog-hapus input[name=id]').val(id);
         $('#dialog-hapus #text_nama').empty().append(nama_barang);
       }
       function getEditData(id) {

         $.ajax({
           url: '{{url("cari_berkas/detail")}}/'+id,
           type: 'GET',
         })
         .done(function(data) {
           var json = JSON.parse(data);
           console.log(json);
           // $('#form_edit input[name=foto_barang]').val(json.foto_barang);
           $('#form_edit #foto_edit').attr('src', '{{asset('file_data')}}/'+json.foto_barang);
           $('#form_edit input[name=nama_barang]').val(json.nama_barang);
           $('#form_edit input[name=harga_barang]').val(json.harga_barang);
           $('#form_edit input[name=harga_jual]').val(json.harga_jual);
           $('#form_edit input[name=stok]').val(json.stok);
           $('#form_edit input[name=id]').val(json.id);

         })
         .fail(function() {
           console.log("error");
         })
         .always(function() {
           console.log("complete");
         });
       }
       function hapusData() {

         var id = $('#dialog-hapus input[name=id]').val();
         $.ajax({
           url: '{{url("upload_berkas/hapus")}}/'+id,
           type: 'GET',
         })
         .done(function(data) {
           alert("Data berhasil Di Hapus !!")
           proses()
         })
         .fail(function() {
           console.log("error");
         })
         .always(function() {
           console.log("complete");
         });
       }
    </script>
    <div class="main-content-inner">

      					<div class="page-content">




                  @if (session('success'))
                    <div class="alert alert-success">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <strong>Success!</strong> {{session('success') }}
                    </div>
                    @endif
                    @if (session('error'))
                    <div class="alert alert-danger">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <strong>Error!</strong> {{session('error') }}
                    </div>
                    @endif
                    @if ($errors->any())
                      <div class="alert alert-danger">
                          <ul>
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                      </div>
                  @endif
                  {{-- @include('popup/pilih_entry') --}}
              
                  <div id="dialog-confirm-entry" class="hide">
                    <div class="col-sm-12">
                      <form id="form_tambah" class="form-horizontal" action="{{url('upload_berkas/proses')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="col-sm-3 control-label " for="tema">Foto Barang :</label>
                            <div class="col-sm-9">
                              <div class="col-sm-6 no-padding">
                                <input class="input-sm" type="file" id="id-input-file-2" name="foto_barang" accept=".jpg,.png"/>
                              </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label " for="tema">Nama Barang :</label>
                            <div class="col-sm-9">
                              <input class="input-xxlarge" type="text" id="tema" name="nama_barang" value="" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label " for="tema">Harga Barang :</label>
                            <div class="col-sm-9">
                              <input class="input-sm text-right" type="number" id="tema" name="harga_barang" value="" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label " for="tema">Harga Jual :</label>
                            <div class="col-sm-9">
                              <input class="input-sm text-right" type="number" id="tema" name="harga_jual" value="" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label " for="tema">Stok :</label>
                            <div class="col-sm-9">
                              <input class="input-sm text-right" type="number" id="tema" name="stok" value="" >
                            </div>
                        </div>


                      </form>

                  </div>

                      <div class="space-6"></div>


                  </div>
                  <div id="dialog-foto" class="hide">
                    <div class="col-sm-12" style="text-align:center">
                      <img id="popup-foto" class="foto-popop" src="{!! asset('file_data') !!}/" alt="Foto" />

                  </div>
                  <div id="dialog-hapus" class="hide">
                    <input type="hidden" name="id" value="">
                    <p>Apakan anda yakin ingin menghapus barang <br>"<span id="text_nama">hahahah</span>"</p>
                    {{-- <div class="col-sm-12" style="text-align:center"> --}}

                  </div>

                      <div class="space-6"></div>


                  </div>
                  <div id="dialog-confirm-edit" class="hide">
                    <div class="col-sm-12">
                      <form id="form_edit" class="form-horizontal" action="{{url('upload_berkas/edit')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="">
                        <div class="form-group">
                            <label class="col-sm-3 control-label " for="tema">Foto Barang :</label>
                            <div class="col-sm-9">
                              <div class="col-sm-6 no-padding">
                                <input class="input-sm" type="file" id="id-input-file-2" name="foto_barang" accept=".jpg,.png"/>
                                <small>#Jika ingin mengganti foto, silakan upload ulang</small>
                              </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-9 col-sm-push-3">
                              <img id="foto_edit" class="foto-preview" src="{!! asset('file_data') !!}/" alt="'+data+'" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label " for="tema">Nama Barang :</label>
                            <div class="col-sm-9">
                              <input class="input-xxlarge" type="text" id="tema" name="nama_barang" value="" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label " for="tema">Harga Barang :</label>
                            <div class="col-sm-9">
                              <input class="input-sm text-right" type="number" id="tema" name="harga_barang" value="" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label " for="tema">Harga Jual :</label>
                            <div class="col-sm-9">
                              <input class="input-sm text-right" type="number" id="tema" name="harga_jual" value="" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label " for="tema">Stok :</label>
                            <div class="col-sm-9">
                              <input class="input-sm text-right" type="number" id="tema" name="stok" value="" >
                            </div>
                        </div>


                      </form>

                  </div>

                      <div class="space-6"></div>


                  </div>
      						<div class="row">


                    <div class="cari_berkas">
                        {{-- <div class="col-xs-12" style="margin-top : 20px;border-top : 1px solid #000"> --}}
                          <div class="page-header" style="margin-top : 10px;background-color: #fff;">

                            <h1>
                              <center>
                                <b>Cari Barang</b>
                              </center>
                            </h1>
                          </div><!-- /.page-header -->
                        <form method="get" id="form-cari-berkas" >
                          <div class="input-group" style="margin-bottom:20px;" >
                              <input class="input-xxlarge" name="deskripsi" type="text" name="" placeholder="Nama Barang">

                          </div>



                          <div class="input-group" style="display:flex;margin-bottom :20px; padding-left:12px;">
                            <button type="button" class="btn btn-primary" onclick="proses()"><i class="fa fa-search"></i> Cari Barang</button>
                            <button type="button" class="btn btn-success" onclick="openPopup()"><i class="ace-icon glyphicon glyphicon-plus"></i> Tambah Barang</button>

                          </div>

                        </form>

                    </div>
                  </div>

                  <div class="" >


                    <div class="col-xs-12" style="margin-top : 20px;border-top : 1px solid #000">
                      <div class="page-header" style="margin-top : 10px;background-color: #fff;">

                        <h1>
                          <center>
                            <b>Hasil</b>
                          </center>
                        </h1>
                      </div><!-- /.page-header -->
                      <div class="col-xs-12">
                        <small>#note : Klik Data Untuk Melihat Barang</small>

                        <table class="table table-bordered table-hover table-sm" id="table_data">
                          <thead>
                            <tr  style="text-align:center">
                              <th>Foto Barang</th>
                              <th>Nama Barang</th>
                              <th>Harga Barang</th>
                              <th>Harga Jual</th>
                              <th>Stok</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>


                          </tbody>
                        </table>

                      </div>
                    </div>
                  </div>

      						</div><!-- /.row -->
      					</div><!-- /.page-content -->
      				</div>

              <script type="text/javascript">
              var table_data = $('#table_data')
                // .wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
                .DataTable({
                    "bProcessing": true,
                    "ajax": {
                        "url": "{{url('cari_berkas/proses')}}",
                        "dataSrc": ""
                    },
                    createdRow: function(row, data, dataIndex){
                      $(row).addClass('text-nowrap')
                      // $('td:eq(0)', row).empty().append(dataIndex+1)
                      $('td:eq(0)', row).attr('onClick','openFoto("'+data.foto_barang+'")')
                      $('td:eq(5)', row).empty().append('<button type="button" style="margin-right:10px;" class="btn btn-warning" onclick="openPopupEdit(\''+data.id+'\')"><i class="ace-icon fa fa-pencil-square-o"></i> Edit</button>')
                      $('td:eq(5)', row).append('<button type="button" class="btn btn-danger" onclick="openPopupHapus(\''+data.id+'\',\''+data.nama_barang+'\')"><i class="ace-icon glyphicon glyphicon-trash"></i> Hapus</button>')

                    },

                    columns: [
                        {data: "foto_barang",
                              render: function (data) {
                                return '<img class="foto-preview" src="{!! asset('file_data') !!}/'+data+'" alt="'+data+'" />';
                              }
                        },
                        {data: "nama_barang"},
                        {data: "harga_barang"},
                        {data: "harga_jual"},
                        {data: "stok"},
                        {data: "id"
                        }
                      ],

                    columnDefs: [
                      {
                         targets: 0,
                          className: 'center'
                      },  {
                            targets: 1,
                            className: 'text-left'
                      },  {
                            targets: 2,
                            className: 'text-right'
                      },  {
                            targets: 3,
                            className: 'text-right'

                      },  {
                            targets: 4,
                            className: 'text-right'

                      },  {
                        width:'100px',
                            targets: 5,
                            className: 'center'
                      }
                    ],

                    bAutoWidth: false,
                    // "bPaginate": false,
                    "bLengthChange": false,
                    // "bFilter": false,
                    "bInfo": false,
                    "sScrollY": "150px",
                    "bScrollCollapse": false,
                    // "ordering": false,

                });
                $(document).ready(function() {
                  $('#id-input-file-1 , #id-input-file-2').ace_file_input({
            					no_file:'No File ...',
            					btn_choose:'Choose',
            					btn_change:'Change',
            					droppable:false,
            					onchange:null,
            					thumbnail:false, //| true | large
            					whitelist:'pdf'
            					//blacklist:'exe|php'
            					//onchange:''
            					//
            				});
                });

        function openPopup() {
          $("#dialog-confirm-entry").removeClass('hide').dialog({
              resizable: false,
              width: '320',
              modal: true,
              title: "<div class='widget-header'><h4 class='smaller'><i class='ace-icon fa fa-exclamation-triangle red'></i> Tambah Barang</h4></div>",
              title_html: true,
              buttons: [
                  {
                      html: "<i class='ace-icon fa fa-save bigger-110'></i>&nbsp; Simpan",
                      "class": "btn btn-primary btn-minier",
                      click: function () {
                        submitInput();


                          $(this).dialog("close");
                      }
                  }
                  ,
                  {
                      html: "<i class='ace-icon fa fa-times bigger-110'></i>&nbsp; Batal",
                      "class": "btn btn-minier",
                      click: function () {
                          $(this).dialog("close");
                      }
                  }
              ]
          });


      };
        function openPopupEdit(id) {
          $("#dialog-confirm-edit").removeClass('hide').dialog({
              resizable: false,
              width: '320',
              modal: true,
              title: "<div class='widget-header'><h4 class='smaller'><i class='ace-icon fa fa-exclamation-triangle red'></i> Edit Barang</h4></div>",
              title_html: true,
              buttons: [
                  {
                      html: "<i class='ace-icon fa fa-save bigger-110'></i>&nbsp; Simpan",
                      "class": "btn btn-primary btn-minier",
                      click: function () {
                        submitEdit();


                          $(this).dialog("close");
                      }
                  }
                  ,
                  {
                      html: "<i class='ace-icon fa fa-times bigger-110'></i>&nbsp; Batal",
                      "class": "btn btn-minier",
                      click: function () {
                          $(this).dialog("close");
                      }
                  }
              ]
          });
          getEditData(id);



      };
        function openFoto(id) {
          $("#popup-foto").attr('src', '{!! asset('file_data') !!}/'+id);

          $("#dialog-foto").removeClass('hide').dialog({
              resizable: false,
              width: '320',
              modal: true,
              title: "<div class='widget-header'><h4 class='smaller'><i class='ace-icon fa fa-exclamation-triangle red'></i> Barang</h4></div>",
              title_html: true,
              buttons: [
                  {
                      html: "<i class='ace-icon fa fa-times bigger-110'></i>&nbsp; Tutup",
                      "class": "btn btn-minier",
                      click: function () {
                          $(this).dialog("close");
                      }
                  }
              ]
          });


      };
        function openPopupHapus(id,nama_barang) {
          setHaputData(id,nama_barang);

          $("#dialog-hapus").removeClass('hide').dialog({
              resizable: false,
              width: '320',
              modal: true,
              title: "<div class='widget-header'><h4 class='smaller'><i class='ace-icon fa fa-exclamation-triangle red'></i> Peringatan</h4></div>",
              title_html: true,
              buttons: [
                  {
                      html: "<i class='ace-icon glyphicon glyphicon-trash'></i>&nbsp; Hapus",
                      "class": "btn btn-danger btn-minier",
                      click: function () {
                        hapusData();


                          $(this).dialog("close");
                      }
                  }
                  ,
                  {
                      html: "<i class='ace-icon fa fa-times bigger-110'></i>&nbsp; Batal",
                      "class": "btn btn-minier",
                      click: function () {
                          $(this).dialog("close");
                      }
                  }
              ]
          });


      };
        </script>


@endsection
