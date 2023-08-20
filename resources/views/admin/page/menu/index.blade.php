
@extends('admin.share.master')
@section('noi_dung')
    <div class="container">
        <div class="row" id="app">
            <div class="col-3 mt-3">
                <div class="card border-primary border-bottom border-3 border-0" style="background: rgb(209, 205, 205)">
                    <div class="card-header text-center">
                        <b>Thêm Mới Món</b>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Tên Món</label>
                            <input v-model="add_menu.ten_mon" v-on:blur="checkSlug()" v-on:keyup="createSlug()" type="text" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Slug Món</label>
                            <input v-model="add_menu.slug_mon" type="text" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Giá Bán</label>
                            <input v-model="add_menu.gia_ban" type="text" class="form-control">
                        </div>


                        {{-- <div class="mb-3">
                            <label class="form-label">hinh_anh</label>
                            <input type="file" class="form-control" ref="file" v-on:change="uploadfile()" accept="image/*" multiple/>
                        </div> --}}
                        <div class="mb-3">
                            <label class="form-label">hinh_anh</label>
                            <input type="file" class="form-control" ref="file" v-on:change="uploadfile()" accept="image/png , image/jpg , image/jpeg">
                        </div>



                        <div class="mb-3">
                            <label class="form-label">Id danh mục</label>
                            <select v-model="add_menu.id_danh_muc" class="form-control mt-1">
                                <option value="0">vui lòng chọn id danh mục</option>
                                @foreach ($danhmuc as $key => $value)
                                    <option value="{{ $value->id }}">{{ $value->ten_danh_muc }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tình Trạng</label>
                            <select v-model="add_menu.tinh_trang" class="form-control">
                                <option value="1">Có Món</option>
                                <option value="0">Hết Món</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button id="add" v-on:click="addmenu()" class="btn btn-primary">Thêm Mới</button>
                    </div>
                </div>
            </div>
            <div class="col-9 mt-3">
                <div class="card border-primary border-bottom border-3 border-0" style="background: rgb(209, 205, 205)">
                    <div class="card-header text-center">
                        <b>Danh Sách Món</b>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" style="max-height:550px">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Tên Món</th>
                                        <th class="text-center">slug Món</th>
                                        <th class="text-center">Giá bán</th>

                                        <th class="text-center">hinh_anh</th>


                                        <th class="text-center">Tên Danh Mục</th>
                                        <th class="text-center">Tình Trạng</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template v-for="(value,key ) in data">
                                        <tr>
                                            <th class="text-center align-middle">@{{ key + 1 }}</th>
                                            <td class="align-middle">@{{ value.ten_mon }}</td>
                                            <td class="align-middle">@{{ value.slug_mon }}</td>
                                            <td class="align-middle">@{{ number_format(value.gia_ban) }}</td>

                                            <td class="text-center">
                                                <img v-bind:src=" '/hinh-mon/' + value.hinh_anh" alt="" style="max-width: 100%; max-height: 50px; display: block; margin: 0 auto;">
                                            </td>

                                            <td class="align-middle">@{{ value.ten_danh_muc }}</td>
                                            <td class="align-middle">
                                                <button v-on:click="changeStatus(value)" v-if="value.tinh_trang == 0" class="btn btn-warning">Có Món</button>
                                                <button v-on:click="changeStatus(value)" v-else class="btn btn-primary">Hết Món</button>
                                            </td>
                                            <td class="align-middle text-center">
                                                <button v-on:click="edit_menu = Object.assign({}, value); edit_file = value.hinh_anh" class="btn btn-info ml-1" data-bs-toggle="modal" data-bs-target="#editModal">Cập Nhật</button>
                                                <button v-on:click="del_menu = value" class="btn btn-danger ml-1" data-bs-toggle="modal" data-bs-target="#deleteModal">Xóa Bỏ</button>
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
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Xóa Món</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Bạn Có Chắc Muốn Xóa : <b class="text-danger text-uppercase"> @{{ del_menu.ten_mon }} </b> này không
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
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Món</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Tên Món</label>
                                            <input v-model="edit_menu.ten_mon" v-on:keyup="createSlugedit()" type="text" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Slug Món</label>
                                            <input v-model="edit_menu.slug_mon" type="text" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Giá Bán</label>
                                            <input v-model="edit_menu.gia_ban" type="text" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Id danh mục</label>
                                            <select v-model="edit_menu.id_danh_muc" class="form-control mt-1">
                                                <option value="0">vui lòng chọn id danh mục</option>
                                                @foreach ($danhmuc as $key => $value)
                                                    <option value="{{ $value->id }}">{{ $value->ten_danh_muc }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Tình Trạng</label>
                                            <select v-model="edit_menu.tinh_trang" class="form-control">
                                                <option value="1">Có Món</option>
                                                <option value="0">Hết Món</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Hình ảnh</label>
                                            <input type="file" class="form-control" ref="editFile" v-on:change="uploadEditFile()" accept="image/png , image/jpg , image/jpeg">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-danger" v-on:click="accpectEdit()">edit</button>
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
                    add_menu    : { "ten_mon" : "" , "slug_mon" : "" , "id_danh_muc" : 0 , "gia_ban" : "" , "tinh_trang" : 1},
                    del_menu    : {},
                    edit_menu   : {},
                    file        : '',
                    edit_file   : '',
                },

                created() {
                    this.loadData();
                },

                methods: {

                    loadData() {
                        axios
                            .get('/admin/menu/data')
                            .then((res) => {
                                this.data = res.data.data;
                            });
                    },

                    //---------doi-trang-thai------------
                    changeStatus(abcxyz) {
                        console.log(abcxyz);
                        axios
                            .post('/admin/menu/doi-trang-thai', abcxyz)
                            .then((res) => {
                                if (res.data.status) {
                                    toastr.success(res.data.message, "Success");
                                    this.loadData();
                                } else if (res.data.status == 0) {
                                    toastr.error(res.data.message, "error");
                                }
                            });
                    },

                    //-----------nhap----------------
                    addmenu() {

                        $("#add").prop('disabled', true);

                        var formData = new FormData();

                        formData.append('ten_mon',this.add_menu.ten_mon);
                        formData.append('slug_mon',this.add_menu.slug_mon);
                        formData.append('gia_ban',this.add_menu.gia_ban);
                        formData.append('hinh_anh',this.file);
                        formData.append('id_danh_muc',this.add_menu.id_danh_muc);
                        formData.append('tinh_trang',this.add_menu.tinh_trang);


                        axios

                            .post('/admin/menu/nhap', formData, {
                                headers:{
                                    'Content-Type' : 'nultipart/form-data'
                                }
                            })

                            .then((res) => {
                                if (res.data.status == 1) {
                                    toastr.success(res.data.message, "Success");
                                    this.loadData();
                                    this.add_menu = {
                                        "ten_mon": "",
                                        "slug_mon": "",
                                        "id_danh_muc": 0,
                                        "gia_ban": "",
                                        "tinh_trang": 1,
                                    };
                                    $('#add').removeAttr('disabled');
                                } else if (res.data.status == 0) {
                                    toastr.error(res.data.message, "error");
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

                    //hình ảnh
                    uploadfile(){
                        this.file = this.$refs.file.files[0];
                        console.log(this.file);
                    },
                    //----------- vnd ------------
                    number_format(number) {
                        return new Intl.NumberFormat('vi-VI', {
                            style: 'currency',
                            currency: 'VND'
                        }).format(number);
                    },

                    //-------------check-slug-------------
                    createSlug() {
                        var slug = this.toSlug(this.add_menu.ten_mon);
                        this.add_menu.slug_mon = slug;
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

                    //--------xóa------
                    accpectDel(){
                        axios
                            .post('/admin/menu/xoa', this.del_menu)
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








                    //----------edit----------
                    accpectEdit() {
                        // Tạo một formData mới
                        var formData = new FormData();

                        // Đẩy dữ liệu của edit_menu vào formData
                        formData.append('id', this.edit_menu.id);
                        formData.append('ten_mon', this.edit_menu.ten_mon);
                        formData.append('slug_mon', this.edit_menu.slug_mon);
                        formData.append('gia_ban', this.edit_menu.gia_ban);
                        formData.append('hinh_anh', this.edit_file); // Đẩy hình ảnh mới vào formData
                        formData.append('id_danh_muc', this.edit_menu.id_danh_muc);
                        formData.append('tinh_trang', this.edit_menu.tinh_trang);

                        // Gửi yêu cầu cập nhật thông tin món với hình ảnh mới
                        axios.post('/admin/menu/cap-nhap', formData, {
                            headers: {
                                'Content-Type': 'multipart/form-data'
                            }
                        }).then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.message, "Success");
                                this.loadData();
                                $('#editModal').modal('hide');
                            } else if (res.data.status == 0) {
                                toastr.error(res.data.message, "error");
                            }
                        }).catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0]);
                            });
                        });
                    },
                    uploadEditFile(){
                        this.edit_file = this.$refs.editFile.files[0];
                        // console.log(this.$refs.editFile.files[0]);
                    },














                    // accpectEdit(){
                    //     axios
                    //         .post('/admin/menu/cap-nhap', this.edit_menu)
                    //         .then((res) => {
                    //             if (res.data.status) {
                    //                 toastr.success(res.data.message, "Success");
                    //                 this.loadData();
                    //                 $('#editModal').modal('hide');
                    //             } else if (res.data.status == 0) {
                    //                 toastr.error(res.data.message, "error");
                    //             }
                    //         })
                    //         .catch((res) => {
                    //             $.each(res.response.data.errors , function(k,v){
                    //                 toastr.error(v[0]);
                    //             })
                    //             $('#add').removeAttr('disabled');
                    //         });
                    // },
                    createSlugedit(){
                        var slug = this.toSlug(this.edit_menu.ten_mon);
                        this.edit_menu.slug_mon = slug;
                    },

                    //-------checkSlug-----------
                    checkSlug(){
                        var payload = {
                            'slug_mon': this.add_menu.slug_mon
                        };
                        axios
                            .post('/admin/menu/check-slug', payload)
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


                },

            });
        });
    </script>
@endsection
