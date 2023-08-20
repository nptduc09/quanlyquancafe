@extends('admin.share.master')
@section('noi_dung')
<div class="container">
    <div class="row" id="app">
        <div class="col-4 mt-3">
            <div class="card" style="background: rgb(209, 205, 205)">
                <div class="card-header text-center">
                    <b>Thêm Mới Khu Vực</b>
                </div>
                <div class="card-body">
                    <label class="mt-3">Tên Khu</label>
                    <input v-model="add_khu_vuc.ten_khu" v-on:keyup="createSlug()" v-on:blur="checkSlug()"class="form-control mt-1" type="text">
                    <label class="mt-3">Slug Khu</label>
                    <input v-model="add_khu_vuc.slug_khu" class="form-control mt-1" type="text">
                    <label class="mt-3">Tình Trạng</label>
                    <select v-model="add_khu_vuc.tinh_trang" class="form-control mt-1">
                        <option value="1">Mở Khu</option>
                        <option value="0">Đóng Khu</option>
                    </select>
                </div>
                <div class="card-footer text-end">
                    <button id="add" v-on:click="addkhuvuc()" type="submit" class="btn btn-primary">Thêm Mới
                    </button>
                </div>
            </div>
        </div>
        <div class="col-8 mt-3">
            <div class="card" style="background: rgb(209, 205, 205)">
                <div class="card-header text-center">
                    <b>Danh Sách Khu Vực</b>
                </div>
                <div class="card-body">
                    <div class="table-responsive" style="max-height:550px">
                        <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Tên Khu</th>
                                <th class="text-center">Slug Khu</th>
                                <th class="text-center">Tình Trạng</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-for="(value,key ) in data">
                                <tr>
                                    <th class="text-center align-middle">@{{ key + 1 }}</th>
                                    <td class="align-middle">@{{ value.ten_khu }}</td>
                                    <td class="align-middle">@{{ value.slug_khu }}</td>
                                    <td class="align-middle text-center">
                                        <button v-on:click="doitrangthai(value)" v-if="value.tinh_trang == 0" class="btn btn-warning">Mở Khu</button>
                                        <button v-on:click="doitrangthai(value)" v-else class="btn btn-primary">Đóng Khu</button>
                                    </td>
                                    <td class="align-middle text-center">

                                        <button v-on:click="capnhap_khu_vuc = Object.assign({}, value)" data-bs-toggle="modal" data-bs-target="#capnhapModal" class="btn btn-info ml-1" >Cập Nhật</button>
                                        <button v-on:click="del_khu_vuc = value" class="btn btn-danger ml-1"
                                            data-bs-toggle="modal" data-bs-target="#deleteModal">Xóa Bỏ</button>
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
                                        Bạn Có Chắc Muốn Xóa : <b class="text-danger text-uppercase"> @{{ del_khu_vuc.ten_khu }}
                                        </b> này không
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Thoát</button>
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"
                                        v-on:click="xoa()">xác nhận xóa</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="capnhapModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Món Ăn</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <label class="mt-3">Tên Khu</label>
                                    <input v-model="capnhap_khu_vuc.ten_khu" v-on:keyup="createSlugedit()"
                                        class="form-control mt-1" type="text">
                                    <label class="mt-3">Slug Khu</label>
                                    <input v-model="capnhap_khu_vuc.slug_khu" class="form-control mt-1" type="text">
                                    <label class="mt-3">Tình Trạng</label>
                                    <select v-model="capnhap_khu_vuc.tinh_trang" class="form-control mt-1">
                                        <option value="1">Hiển Thị</option>
                                        <option value="0">Tạm Tắt</option>
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Thoát</button>

                                    <button type="button" class="btn btn-danger"
                                    v-on:click="accpectEdit()" >Lưu</button>
                                </div>
                            </div>
                        </div>
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
                    add_khu_vuc: { "ten_khu": " ", "slug_khu": " ", "tinh_trang": 1 },
                    del_khu_vuc: {},
                    capnhap_khu_vuc: { "ten_khu": " ", "slug_khu": " ", "tinh_trang": 1 },
                },

                created() {
                    this.loadData();
                },

                methods: {

                    loadData() {
                        axios
                            .get('/admin/khu-vuc/data')
                            .then((res) => {
                                this.data = res.data.data;
                            });
                    },

                    //----đổi trạng thái-----------
                    doitrangthai(abcxyz) {
                        console.log(abcxyz);
                        axios
                            .post('/admin/khu-vuc/doi-trang-thai', abcxyz)
                            .then((res) => {
                                if (res.data.status) {
                                    toastr.success(res.data.message, "Success");
                                    this.loadData();
                                } else if (res.data.status == 0) {
                                    toastr.error(res.data.message, "error");
                                }
                            });
                    },

                    //---------nhập--------------
                    addkhuvuc() {
                        $("#add").prop('disabled', true);
                        axios
                            .post('/admin/khu-vuc/nhap', this.add_khu_vuc)
                            .then((res) => {
                                if (res.data.status == 1) {
                                    toastr.success(res.data.message, "Success");
                                    this.loadData();
                                    this.add_khu_vuc = {
                                        "ten_khu": " ",
                                        "slug_khu": " ",
                                        "tinh_trang": 1
                                    };
                                    $('#add').removeAttr('disabled');
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
                                $('#add').removeAttr('disabled');
                            });
                    },

                    //----checkslug-----------
                    createSlug() {
                        var slug = this.toSlug(this.add_khu_vuc.ten_khu);
                        this.add_khu_vuc.slug_khu = slug;
                    },
                    toSlug(str) {
                        str = str.toLowerCase();
                        str = str
                            .normalize('NFD')
                            .replace(/[\u0300-\u036f]/g, '');
                        str = str.replace(/[đĐ]/g, 'd');
                        str = str.replace(/([^0-9a-z-\s])/g, '');
                        str = str.replace(/(\s+)/g, '-');
                        str = str.replace(/-+/g, '-');
                        str = str.replace(/^-+|-+$/g, '');
                        return str;
                    },

                    //----xoa-----------
                    xoa() {
                        axios
                            .post('/admin/khu-vuc/xoa', this.del_khu_vuc)
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

                    //------cập nhập -----
                    accpectEdit() {
                        axios
                        .post('/admin/khu-vuc/cap-nhap', this.capnhap_khu_vuc)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.message, "Success");
                                this.loadData();
                                $('#capnhapModal').modal('hide');
                            } else if (res.data.status == 0) {
                                toastr.error(res.data.message, "Error");
                            }
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0]);
                            })
                            $("#add").removeAttr("disabled");
                        });
                    },

                    createSlugedit() {
                        var slug = this.toSlug(this.capnhap_khu_vuc.ten_khu);
                        this.capnhap_khu_vuc.slug_khu = slug;
                    },

                    //------checkSlug-----------
                    checkSlug() {
                        var payload = {
                            'slug_khu': this.add_khu_vuc.slug_khu
                        };
                        axios
                            .post('/admin/khu-vuc/check-slug', payload)
                            .then((res) => {
                                if (res.data.status == 1) {
                                    toastr.success(res.data.message, "Success");
                                    $("#add").removeAttr("disabled");
                                } else if (res.data.status == 0) {
                                    toastr.error(res.data.message, "Error");
                                    $("#add").prop("disabled", true);
                                } else if (res.data.status == 2) {
                                    toastr.warning(res.data.message, "warning");
                                }
                            });
                    },
                    
                }
            });
        });
    </script>
@endsection
