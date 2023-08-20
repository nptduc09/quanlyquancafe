@extends('admin.share.master')
@section('noi_dung')
    <div class="container">
        <div class="row" id="app">
            <div class="col-3 mt-4">
                <div class="card border-primary border-bottom border-3 border-0" style="background: rgb(209, 205, 205)">
                    <div class="card-header text-center">
                        <b>Tạo Tài Khoản</b>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Họ Và Tên</label>
                            <input v-model="add.ho_va_ten" type="text" class="form-control" placeholder="Nhập vào họ và tên *">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input v-model="add.email" type="email" class="form-control" placeholder="Nhập vào email *">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Số Điện Thoại</label>
                            <input v-model="add.so_dien_thoai" type="tel" class="form-control" placeholder="Nhập vào số điện thoại *">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Ngày Sinh</label>
                            <input v-model="add.ngay_sinh" type="date" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Mật Khẩu</label>
                            <input v-model="add.password" type="password" class="form-control" placeholder="Nhập vào mật khẩu *">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Xác Nhận Mật Khẩu</label>
                            <input v-model="add.kt_mat_khau" type="password" class="form-control" placeholder="Nhập lại mật khẩu *">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Quyền Tài Khoản</label>
                            <select v-model="add.id_quyen" class="form-control">
                                <option value="0">vui lòng chọn quyền</option>
                                @foreach ($quyen as $key => $value)
                                    <option value="{{$value->id}}">{{$value->ten_quyen}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button v-on:click="taotaikhoan()" class="btn btn-primary" type="button" >Tạo Mới</button>
                    </div>
                </div>
            </div>
            <div class="col-9 mt-4">
                <div class="card border-primary border-bottom border-3 border-0" style="background: rgb(209, 205, 205)">
                    <div class="card-header text-center">
                        <b>Danh Sách Tài Khoản</b>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center align-middle">#</th>
                                        <th class="text-center align-middle">Họ Và Tên</th>
                                        <th class="text-center align-middle">Gmail</th>
                                        <th class="text-center align-middle">Số Điện Thoại</th>
                                        <th class="text-center align-middle">Ngày Sinh</th>
                                        <th class="text-center align-middle">Quyền Tài Khoản</th>
                                        <th class="text-center align-middle">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template v-for="(value , key) in data">
                                        <tr >
                                            <th class="text-center align-middle">@{{key + 1}}</th>
                                            <td class="align-middle">@{{ value.ho_va_ten}}</td>
                                            <td class="align-middle">@{{ value.email}}</td>
                                            <td class="text-center align-middle">@{{ value.so_dien_thoai}}</td>
                                            <td class="text-center align-middle">@{{ date_format(value.ngay_sinh)}}</td>
                                            <td class="text-center align-middle">@{{ value.ten_quyen}}</td>
                                            <td class="text-center align-middle text-nwrap">
                                                <button class="btn btn-success" v-on:click="mat_khau_moi = value" data-bs-toggle="modal"data-bs-target="#changePasswordModal">Đổi Mật Khẩu</button>
                                                <button class="btn btn-info" v-on:click="edit = Object.assign({}, value)" data-bs-toggle="modal" data-bs-target="#updateModal">Cập Nhật</button>
                                                <button class="btn btn-danger" v-on:click="del = value" data-bs-toggle="modal"data-bs-target="#deleteModal">Xoá</button>
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>

                             {{-- xóa --}}
                            <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Xoá Tài Khoản</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="alert alert-primary" role="alert">
                                                <p>Bạn có chắc chắn muốn xoá <b class="text-danger">@{{del.ho_va_ten}}</b> không?</p>
                                                <p><b>Lưu ý:</b> Thao tác này sẽ không thể hoàn tác</p>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                            <button type="button" class="btn btn-danger" v-on:click="xoataikhoan()">Xóa</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- cập nhập --}}
                            <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Cập Nhật Tài Khoản</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label">Họ Và Tên</label>
                                                <input v-model="edit.ho_va_ten" type="text" class="form-control" placeholder="Nhập vào họ và tên *">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Email</label>
                                                <input v-model="edit.email" type="email" class="form-control" placeholder="Nhập vào email *">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Số Điện Thoại</label>
                                                <input v-model="edit.so_dien_thoai" type="tel" class="form-control" placeholder="Nhập vào số điện thoại *">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Ngày Sinh</label>
                                                <input v-model="edit.ngay_sinh" type="date" class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Quyền Tài Khoản</label>
                                                <select v-model="edit.id_quyen" class="form-control">
                                                    @foreach ($quyen as $key => $value)
                                                        <option value="{{$value->id}}">{{$value->ten_quyen}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                            <button type="button" v-on:click="capnhap()" class="btn btn-primary" data-bs-dismiss="modal">Cập Nhật</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- đổi mật khẩu --}}
                            <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Đổi Mật Khẩu</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" v-model="mat_khau_moi.id">
                                        <div class="mb-3">
                                            <label class="form-label">Mật Khẩu</label>
                                            <input type="password" class="form-control" name="password" v-model="mat_khau_moi.mat_khau_moi" placeholder="Nhập vào mật khẩu mới *">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Xác Nhận Mật Khẩu</label>
                                            <input type="password" class="form-control" name="re_password" v-model="mat_khau_moi.re_password"  placeholder="Nhập lại mật khẩu mới *">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Đóng</button>
                                        <button type="button" class="btn btn-primary" v-on:click="changePassWord()">Cập Nhật</button>
                                    </div>
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
                    data  : [],
                    add   : { "id_quyen" : 0 },
                    del   : {},
                    edit  : {},
                    mat_khau_moi : {},
                },

                created() {
                    this.loadData();
                },

                methods: {

                    loadData() {
                        axios
                            .get('/admin/tai-khoan/data')
                            .then((res) => {
                                this.data = res.data.data;
                            });
                    },
                    date_format(now) {
                        return moment(now).format('DD/MM/yyyy');
                    },
                    //nhap
                    taotaikhoan(){
                        axios
                            .post('/admin/tai-khoan/nhap', this.add)
                            .then((res) => {
                                if(res.data.status) {
                                    toastr.success(res.data.message);
                                    this.loadData();
                                    this.add = {
                                        "id_quyen" : 1,
                                    };
                                    ('#add').removeAttr('disabled');
                                }
                            })

                            .catch((res) => {
                                $.each(res.response.data.errors, function(k, v) {
                                    toastr.error(v[0]);
                                });
                            });
                    },
                    //xoa
                    xoataikhoan() {
                        axios
                            .post('/admin/tai-khoan/xoa', this.del)
                            .then((res) => {
                                if (res.data.status) {
                                    toastr.success(res.data.message);
                                    this.loadData();
                                    $('#deleteModal').modal('hide');
                                } else {
                                    toastr.error(res.data.message);
                                }
                            })
                            .catch((res) => {
                                $.each(res.response.data.errors, function(k, v) {
                                    toastr.error(v[0]);
                                });
                            });
                    },
                    //cập nhập
                    capnhap() {
                        axios
                            .post('/admin/tai-khoan/capnhap', this.edit)
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
                    //đổi mật khẩu
                    changePassWord() {
                        axios
                            .post('/admin/tai-khoan/change-password', this.mat_khau_moi)
                            .then((res) => {
                                if(res.data.status) {
                                    toastr.success(res.data.message);
                                    this.loadData();
                                    $('#changePasswordModal').modal('hide');
                                }
                            })
                            .catch((res) => {
                                $.each(res.response.data.errors, function(k, v) {
                                    toastr.error(v[0]);
                                });
                            });
                    }
                }
            });
        });
    </script>
@endsection
