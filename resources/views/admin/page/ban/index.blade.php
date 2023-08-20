@extends('admin.share.master')
@section('noi_dung')
    <div class="container">
        <div class="row" id="app">
            <div class="col-4 mt-3">
                <div class="card" style="background: rgb(209, 205, 205)">
                    <div class="card-header text-center">
                        <b>Thêm Mới Bàn</b>
                    </div>
                    <div class="card-body">
                        <label class="mt-3">Tên Bàn</label>
                        <input v-model="add_ban.ten_ban" v-on:blur="checkSlug()" v-on:keyup="createSlug()" class="form-control mt-1" type="text">
                        <label class="mt-3">Slug Bàn</label>
                        <input v-model="add_ban.slug_ban" class="form-control mt-1" type="text">
                        <label class="mt-3">Id Khu Vuc</label>
                        <select v-model="add_ban.id_khu_vuc" class="form-control">
                            <option value="0">vui lòng chọn id khu vực</option>
                            @foreach ( $khuvuc as $key => $value)
                                <option value="{{ $value->id }}">{{ $value->ten_khu }}</option>
                            @endforeach
                        </select>

                        <label class="form-label">Tình Trạng</label>
                        <select v-model="add_ban.tinh_trang" class="form-control" >
                            <option value="1">Mở Bàn</option>
                            <option value="0">Đóng Bàn</option>
                        </select>


                        <label type="hidden" hidden="form-label">Trạng Thái</label>
                        <select v-model="add_ban.trang_thai" hidden="form-control" >
                            <option value="0">chd</option>
                            <option value="1">dhd</option>
                        </select>

                    </div>
                    <div class="card-footer text-end">
                        <button id="add" v-on:click="addban()" type="submit" class="btn btn-primary">Thêm Mới </button>
                    </div>
                </div>
            </div>
            <div class="col-8 mt-3">
                <div class="card" style="background: rgb(209, 205, 205)">
                    <div class="card-header text-center">
                        <b>Danh Sách Bàn</b>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" style="max-height:550px">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Tên Bàn</th>
                                        <th class="text-center">Slug Bàn</th>
                                        <th class="text-center">Id Khu Vực</th>
                                        <th class="text-center">Tình Trạng</th>
                                        <th hidden="text-center">Trạng Thái</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template v-for="(value,key ) in data">
                                        <tr>
                                            <th class="text-center align-middle">@{{ key + 1 }}</th>
                                            <td class="align-middle">@{{ value.ten_ban }}</td>
                                            <td class="align-middle">@{{ value.slug_ban }}</td>
                                            <td class="align-middle">@{{ value.ten_khu }}</td>
                                            <td class="align-middle  text-center">
                                                <button v-on:click="changeStatus(value)" v-if="value.tinh_trang == 0" class="btn btn-warning">Có Bàn</button>
                                                <button v-on:click="changeStatus(value)" v-else class="btn btn-primary">Đóng Bàn</button>
                                            </td>

                                            <td hidden="align-middle  text-center">
                                                <button v-on:click="changeStatus2(value)" v-if="value.trang_thai == 0" class="btn btn-primary">dhd</button>
                                                <button v-on:click="changeStatus2(value)" v-else class="btn btn-warning">chd</button>
                                            </td>

                                            <td class="align-middle text-center">
                                                <button v-on:click="edit_ban = Object.assign({}, value)" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#editModal">Cập Nhập</button>
                                                <button v-on:click="del_ban = value" class="btn btn-danger ml-1" data-bs-toggle="modal" data-bs-target="#deleteModal">Xóa Bỏ</button>
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>

                            </table>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Xóa Danh Mục</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Bạn Có Chắc Muốn Xóa: <b class="text-danger text-uppercase"> @{{ del_ban.ten_ban }} </b> này không
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-danger" v-on:click="accpectDel()" data-bs-dismiss="modal">xóa</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Cập Nhật Danh Mục</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <label class="mt-3">Tên Bàn</label>
                                        <input v-model="edit_ban.ten_ban" v-on:keyup="createSlugedit()" class="form-control mt-1" type="text">
                                        <label class="mt-3">Slug Bàn</label>
                                        <input v-model="edit_ban.slug_ban" class="form-control mt-1" type="text">
                                        <label class="mt-3">Id Khu Vuc</label>
                                        <select v-model="edit_ban.id_khu_vuc" class="form-control">
                                            <option value="0">vui lòng chọn id khu vực</option>
                                            @foreach ( $khuvuc as $key => $value)
                                                <option value="{{ $value->id }}">{{ $value->ten_khu }}</option>
                                            @endforeach
                                        </select>
                                        <label class="form-label">Tình Trạng</label>
                                        <select v-model="edit_ban.tinh_trang" class="form-control">
                                            <option value="1">Có Bàn</option>
                                            <option value="0">Đóng Bàn</option>
                                        </select>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-danger" v-on:click="accpectEdit()" data-bs-dismiss="modal">cập nhập</button>
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
                    add_ban: {
                        "ten_ban": "",
                        "slug_ban": "",
                        "id_khu_vuc": 0,
                        "tinh_trang": 1 ,
                        "trang_thai": 0
                    },
                    del_ban : {},
                    edit_ban :{},

                },
                created() {
                    this.loadData();
                },
                methods: {

                    loadData() {
                        axios
                            .get('/admin/ban/data')
                            .then((res) => {
                                this.data = res.data.data;
                            });
                    },

                    //-------doi-trang-thai------
                    changeStatus(abcxyz) {
                        axios
                            .post('/admin/ban/doi-trang-thai', abcxyz)
                            .then((res) => {
                                if (res.data.status) {
                                    toastr.success(res.data.message, "Success");
                                    this.loadData();
                                } else if (res.data.status == 0) {
                                    toastr.error(res.data.message, "error");
                                }
                            });
                    },
                    //-------doi-trang-thai-2------
                    changeStatus2(abcxyz) {
                        axios
                            .post('/admin/ban/doi-trang-thai-2', abcxyz)
                            .then((res) => {
                                if (res.data.status) {
                                    toastr.success(res.data.message, "Success");
                                    this.loadData();
                                } else if (res.data.status == 0) {
                                    toastr.error(res.data.message, "error");
                                }
                            });
                    },

                    //--------vnd-----------
                    number_format(number) {
                        return new Intl.NumberFormat('vi-VI', {
                            style: 'currency',
                            currency: 'VND'
                        }).format(number);
                    },

                    //----check-slug----
                    createSlug() {
                        var slug = this.toSlug(this.add_ban.ten_ban);
                        this.add_ban.slug_ban = slug;
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

                    //-----------nhap----------------
                    addban() {
                        $("#add").prop('disabled', true);
                        axios
                            .post('/admin/ban/nhap', this.add_ban)
                            .then((res) => {
                                if (res.data.status == 1) {
                                    toastr.success(res.data.message, "Success");
                                    this.loadData();
                                    this.add_ban = {
                                        "ten_ban": "",
                                        "slug_ban": "",
                                        "id_khu_vuc": 0,
                                        "tinh_trang": 1,
                                        "trang_thai": 0,
                                    };
                                    $('#add').removeAttr('disabled');
                                } else if(res.data.status == 0) {
                                    toastr.error(res.data.message, "Error");
                                } else if(res.data.status == 2) {
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

                    //--------xóa------
                    accpectDel(){
                        axios
                            .post('/admin/ban/delete', this.del_ban)
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

                    //------update--------
                    accpectEdit(){
                        axios
                            .post('/admin/ban/update', this.edit_ban)
                            .then((res) => {
                                if (res.data.status) {
                                    toastr.success(res.data.message, "Success");
                                    this.loadData();
                                    $('#updateModal').modal('hide');8
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
                    createSlugedit(){
                        var slug = this.toSlug(this.edit_ban.ten_ban);
                        this.edit_ban.slug_ban = slug;
                    },

                    //--------checkSlug------
                    checkSlug(){
                        var payload = {
                            'slug_ban': this.add_ban.slug_ban
                        };
                        axios
                            .post('/admin/ban/check-slug', payload)
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

                    //

                },

            });

        });
    </script>
@endsection
