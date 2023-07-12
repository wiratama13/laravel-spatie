@extends('layouts.master')

@push('css')
    <link href="../vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
<link href="../vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" />
@endpush
@section('content')
    <div class="main-content">
            <div class="title">
                Configrure Role
            </div>
            <div class="content-wrapper">
                <div class="row same-height">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Monthly Sales</h4>
                            </div>
                            <div class="card-body">
                                @if (request()->user()->can('create role'))
                                    <button type="button" class="btn btn-primary btn-sm btn-add">Tambah data</button>
                                @endif 
                              {{ $dataTable->table() }}
                            </div>
                        </div>
                    </div>
                   
                </div>
            </div>
   
            <!-- Modal -->
            <div class="modal fade" id="modalAction" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                {{-- @include('configure.action') --}}
            </div>
            </div>
    </div>
@endsection

@push('js')
   <script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../vendor/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
<script src="../vendor/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="../vendor/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
<script src="../assets/js/pages/datatables.min.js"></script>
<script src="../vendor/sweetalert2/sweetalert2.all.min.js"></script>
    {{ $dataTable->scripts() }}

<script>
    const modal = new bootstrap.Modal($('#modalAction'))

    $('.btn-add').on('click', function(){
         $.ajax({
            method: 'get',
            url :  `/configure/roles/create`,
            success : function(res) {
                $('#modalAction').find('.modal-dialog').html(res)
                modal.show()
                create()
            }
        })
    })

    function create() {
        $('#formAction').on('submit', function(e){
            e.preventDefault()
            const _form = this
            const formData = new FormData(_form)

            const url = this.getAttribute('action')

            $.ajax({
                method: 'POST',
                url,
                headers : {
                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                },

                data: formData,
                processData: false,
                contentType: false,

                success : function(res) {
                    window.LaravelDataTables["role-table"].ajax.reload()
                    modal.hide()
                },
                error: function(res) {
                    let errors = res.responseJSON?.errors
                    $(_form).find('.text-danger.text-small').remove()
                    if(errors) {
                        for(const [key,value] of Object.entries(errors))
                        $(`[name='${key}']`).parent().append(`<span class="text-danger text-small">${value}</span>`)
                    }
                    console.log(errors)
                }
        })
        })
       } 

     $('#role-table').on('click', '.action' , function(){
        let data = $(this).data()
        let jenis = data.jenis
        let role_id = $(this).data('id') 
        
        if(jenis == 'delete') {
            Swal.fire({
                title: 'Are you sure',
                icon: 'warning',
                text: "You won't be able to to revert this !",
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                confirmButtonColor: '#3085d6',
                cancelmButtonColor: '#d33'
            }).then((result) => {
                if(result.isConfirmed) {
                    $.ajax({
                        method: 'DELETE',
                        url :  `/configure/roles/${role_id}`,
                        headers : {
                             'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                        },
                        success : function(res) {
                            window.LaravelDataTables["role-table"].ajax.reload()
                            swal.fire(
                                'Deleted',
                                res.message,
                                res.status
                            )
                        }
                    })
                   
                }
            })
            return
        }

        $.ajax({
            method: 'get',
            url :  `/configure/roles/${role_id}/edit`,
            success : function(res) {
                $('#modalAction').find('.modal-dialog').html(res)
                modal.show()
                store()
            }
        })

       function store() {
        $('#formAction').on('submit', function(e){
            e.preventDefault()
            const _form = this
            const formData = new FormData(_form)

            $.ajax({
                method: 'POST',
                url :  `/configure/roles/${role_id}`,
                headers : {
                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                },

                data: formData,
                processData: false,
                contentType: false,

                success : function(res) {
                    window.LaravelDataTables["role-table"].ajax.reload()
                    modal.hide()
                },
                error: function(res) {
                    let errors = res.responseJSON?.errors
                    $(_form).find('.text-danger.text-small').remove()
                    if(errors) {
                        for(const [key,value] of Object.entries(errors))
                        $(`[name='${key}']`).parent().append(`<span class="text-danger text-small">${value}</span>`)
                    }
                    console.log(errors)
                }
        })
        })
       } 
     })
</script>
@endpush