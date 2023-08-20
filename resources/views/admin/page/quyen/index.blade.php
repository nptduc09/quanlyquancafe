@extends('admin.share.master')
@section('noi_dung')
    <div class="container">
        <div class="row" id="app">
            <div class="col-2 mt-3">
                <div class="card" style="background: rgb(209, 205, 205)">
                    <div class="card-header text-center">
                        <b>Thêm Quyền</b>
                    </div>
                    <div class="card-body">
                        <label class="mt-3">Tên Quyền</label>
                        <input v-model="add_quyen.ten_quyen" class="form-control mt-1" type="text">
                        <label class="mt-3">List Id Quyền</label>
                        <input v-model="add_quyen.list_id_quyen" class="form-control mt-1" type="text">
                    </div>
                    <div class="card-footer text-end">
                        <button id="add" v-on:click="addquyen()" type="submit" class="btn btn-primary">Thêm Mới</button>
                    </div>
                </div>
            </div>
            <div class="col-5 mt-3">
                <div class="card" style="background: rgb(209, 205, 205)">
                    <div class="card-header text-center">
                        <b>Danh Sách Quyền</b>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" style="max-height:550px">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Tên Quyền</th>
                                        <th class="text-center">List Id Quyền</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template v-for="(value,key ) in data">
                                        <tr>
                                            <th class="text-center align-middle">@{{ key + 1 }}</th>
                                            <td class="align-middle">@{{ value.ten_quyen }}</td>
                                            <td class="align-middle">@{{ value.list_id_quyen }}</td>

                                            <td class="align-middle text-center">
                                                <button v-on:click="update_quyen = Object.assign({}, value)"
                                                    class="btn btn-info ml-1" data-bs-toggle="modal" data-bs-target="#editModal">Cập Nhật</button>
                                                <button v-on:click="xoa_quyen = value" class="btn btn-danger ml-1" data-bs-toggle="modal" data-bs-target="#deleteModal">Xóa Bỏ</button>
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="deleteModal" tabindex="-1"
                            aria-labelledby="exampleModalLabel"aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" class="form-control" id="id_delete">
                                        <div class="alert alert-primary" role="alert">
                                            Bạn Có Chắc Muốn Xóa : <b class="text-danger text-uppercase"> @{{ xoa_quyen.ten_quyen }}
                                            </b> này không
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Thoát</button>
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"
                                            v-on:click="accpectDel()">xác nhận xóa</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Update Quyền</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <label class="mt-3">Tên Quyền</label>
                                        <input v-model="update_quyen.ten_quyen"class="form-control mt-1" type="text">
                                        <label class="mt-3">List Id Quyền</label>
                                        <input v-model="update_quyen.list_id_quyen" class="form-control mt-1" type="text">

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Thoát</button>
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"
                                            v-on:click="accpectEdit()">Lưu</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-5 mt-3">
                <div class="card" style="background: rgb(209, 205, 205)">

                    <div class="card-body" style="background-color: #f7f7f7;">
                        <div class="table-responsive" style="max-height: 550px;">
                            <table class="table table-bordered" style="border-collapse: collapse; width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="background-color: #2c3e50; color: white; text-align: center; padding: 10px;">List Id Quyền</th>
                                        <th class="text-center" style="background-color: #2c3e50; color: white; text-align: center; padding: 10px;">Danh Sách</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template v-for="(value,key ) in danhsachchucnang">
                                        <tr>
                                            <th class="text-center align-middle" style="padding: 10px;">@{{ key + 1 }}</th>
                                            <td class="align-middle" style="padding: 10px;">@{{ value.danh_sach_chuc_nang }}</td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {

            new Vue({
                el: '#app',
                data: {
                    data: [],
                    add_quyen: {
                        "ten_quyen": " ",
                        "list_id_quyen": " ",
                    },
                    xoa_quyen: {},
                    update_quyen: {},

                    danhsachchucnang : [],
                },
                created() {
                    this.loadData();

                    this.danhsachchucnang1();
                },
                methods: {

                    loadData() {
                        axios
                            .get('/admin/quyen/data')
                            .then((res) => {
                                this.data = res.data.data;
                            });
                    },

                    //---------nhập--------------
                    addquyen() {
                        axios
                            .post('/admin/quyen/nhap', this.add_quyen)
                            .then((res) => {
                                if (res.data.status == 1) {
                                    toastr.success(res.data.message, "Success");
                                    this.loadData();
                                    this.add_quyen = {
                                        "ten_quyen": " ",
                                        "list_id_quyen": " "
                                    };
                                } else if (res.data.status == 0) {
                                    toastr.error(res.data.message, "Error");
                                } else if (res.data.status == 2) {
                                    toastr.warning(res.data.message, "warning");
                                }
                            })
                            .catch((res) => {
                                $.each(res.response.data.errors , function(k,v){
                                    toastr.error(v[0]);
                                })

                            });
                    },

                    //--------delete-------
                    accpectDel() {
                        axios
                            .post('/admin/quyen/delete', this.xoa_quyen)
                            .then((res) => {
                                if (res.data.status == 1) {
                                    toastr.success(res.data.message, "Success");
                                    this.loadData();
                                } else if (res.data.status == 0) {
                                    toastr.error(res.data.message, "error");
                                } else if (res.data.status == 2) {
                                    toastr.warning(res.data.message, "warning");
                                }
                            });
                    },

                    //update
                    accpectEdit() {
                        axios
                            .post('/admin/quyen/update', this.update_quyen)
                            .then((res) => {
                                if (res.data.status) {
                                    toastr.success(res.data.message, "Success");
                                    this.loadData();
                                    $('#updateModal').modal('hide');
                                } else if (res.data.status == 0) {
                                    toastr.error(res.data.message, "error");
                                }
                            })
                            .catch((res) => {
                                $.each(res.response.data.errors , function(k,v){
                                    toastr.error(v[0]);
                                })
                                $('#add').removeAttr('disabled');
                            });
                    },

                    // danh sách chức năng
                    danhsachchucnang1(){
                        axios
                            .get('/admin/vi-du/data')
                            .then((res)=>{
                                this.danhsachchucnang = res.data.danhsachchucnang;
                            })
                    },


                },

            });

        });
    </script>
@endsection
