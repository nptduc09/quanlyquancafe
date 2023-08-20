
@extends('admin.share.master')
@section('noi_dung')
<style>
    .col-md-3 {
        margin-bottom: 15px;
    }

    .card-body-1 {
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .img-container {
        height: 100px;
        display: flex;
        align-items: center;

        justify-content: center;
        overflow: hidden;
        border-radius: 5px 5px 0 0;
    }

    .img-container img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain ;
    }

    .card-body-2 {
        padding: 15px;
        background-color: #f9f9f9;
        border-radius: 0 0 5px 5px;
    }

    .card-body-2 b {
        font-size: 13px;
        display: block;
        margin-bottom: 10px;
    }

    .card-text {
        font-size: 10px;
        margin-bottom: 15px;
    }

    .btn {
        text-transform: uppercase;
        font-size: 10px;
        font-weight: 700;
        padding: 7px 12px;
    }

    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
    }

    .btn-success:hover {
        background-color: #218838;
        border-color: #1e7e34;
    }

    .nav-tabs-container .nav-item .nav-link.active,
    .nav-tabs-container .nav-item .nav-link:focus,
    .nav-tabs-container .nav-item .nav-link:hover {
        background-color: #007bff; /* Đổi màu tùy ý */
        color: #6aff1a; /* Đổi màu chữ tùy ý */
    }
</style>

   <div class="container">
        <div class="row" id="app">
            <div class="nav-tabs-container">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/ban-hang">Tất Cả</a>
                    </li>

                    @foreach($khuvuc as $key => $value)
                    <li class="nav-item">
                        <button class="nav-link" v-on:click="getBankv({{ $value->id }})">{{ $value->ten_khu}}</button>
                    </li>
                    @endforeach

                </ul>
            </div>
            <template v-for="(value, key) in list_ban" v-if="value.tinh_trang == 1">
                <div class="col-md-2  mt-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <p v-if="value.trang_thai == 0" class="text-uppercase"><b>@{{ value.ten_khu }}  @{{ value.ten_ban }}</b></p>
                            <p v-else class="text-uppercase text-primary"><b>@{{ value.ten_khu}}  @{{  value.ten_ban }}</b></p>
                            <i data-bs-toggle="modal" data-bs-target="#chiTietModal"v-on:click="opentable(value.id); getidhoadon(value.id)" v-if="value.trang_thai == 0" class="fa-solid fa-square-xmark fa-5x"></i>
                            <i data-bs-toggle="modal" data-bs-target="#chiTietModal" v-else-if="value.trang_thai == 1" v-on:click="getidhoadon(value.id)" class="fa-solid fa-mug-saucer fa-5x text-primary"></i>

                        </div>

                    </div>
                </div>
            </template>

            <!-- Modal -->

            <div class="modal fade" id="chiTietModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" style="max-width: 100%">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">CHI TIẾT BÁN HÀNG @{{ add_menu.id_hoa_don_ban_hang }}</h1><br>
                            {{-- <h1 class="modal-title fs-5" id="exampleModalLabel">CHI TIẾT BÁN HÀNG @{{ add_menu.ten_ban }}</h1> --}}
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            {{-- phần 1 --}}

                            <div class="row" v-if="trang_thai == 0">
                                <div class="col-lg-6">
                                    <div class="card">
                                        <div class="table-responsive" style="max-height: 500px;">
                                            <div class="card-header" style="padding: 10px; background-color: #f2f2f2;">
                                                <div class="input-group" style="display: flex; align-items: center;">

                                                    <div class="align-middle text-center" v-on:click="sort()" style="cursor: pointer; margin-right: 10px;">
                                                        <i v-if="gialenxuong === 2" class="text-primary fas fa-arrow-up" style="font-size: 20px; color: #007bff;"></i>
                                                        <i v-else-if="gialenxuong === 1" class="text-danger fas fa-arrow-down" style="font-size: 20px; color: #dc3545;"></i>
                                                        <i v-else class="text-success fas fa-spinner fa-pulse" style="font-size: 20px; color: #28a745;"></i>
                                                    </div>

                                                    <input v-model="timkiem" v-on:keyup.enter="search()" type="text" class="form-control" style="flex: 1; margin-right: 10px;" placeholder="Nhập từ khóa...">
                                                    <button class="btn btn-primary btn-sm" v-on:click="search()" style="min-width: 80px;">Tìm kiếm</button>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <template v-for="(value, key) in list_menu" v-if="value.tinh_trang == 1 ">
                                                        <div class="col-md-3 mb-3">
                                                            <div class="card-body-1">
                                                                    <div class="img-container">
                                                                        <img v-bind:src="'/hinh-mon/' + value.hinh_anh" alt="..." class="card-img img-thumbnail">
                                                                    </div>
                                                                <div class="card-body-2">
                                                                    <b>@{{ value.ten_mon }}</b>
                                                                    <p class="card-text m-0">Giá: @{{ number_format(value.gia_ban) }}</p>
                                                                    <button v-on:click="chitietbanhang(value.id)" class="btn btn-success btn-sm mt-2">Thêm Món</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </template>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-lg-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title">Danh sách món đã chọn</h5>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">#</th>
                                                        <th class="text-center">Tên món</th>
                                                        <th class="text-center">Số lượng</th>
                                                        <th class="text-center">Đơn giá</th>
                                                        <th class="text-center">Chiết khấu</th>
                                                        <th class="text-center">Thành tiền</th>
                                                        <th class="text-center">Ghi chú</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="(value, key) in list_detail">
                                                        <td class="text-center align-middle">
                                                            <template v-if="value.is_in_bep">
                                                                @{{ key + 1 }}
                                                            </template>
                                                            <template v-else>
                                                                <i class="fa-solid fa-trash-can text-danger" v-on:click="xoa(value)"></i>
                                                            </template>
                                                        </td>
                                                        <td class="align-middle">@{{ value.ten_mon }}</td>
                                                        <td class="align-middle text-center" :class="{ 'd-none': value.is_in_bep }">
                                                            <input v-on:change="update(value)" v-model="value.so_luong_ban" type="number"
                                                                class="form-control text-center" step="0.1">
                                                        </td>
                                                        <td class="align-middle text-end">@{{ number_format(value.don_gia_ban) }}</td>
                                                        <td class="align-middle" style="width: 15%;">
                                                            <input v-on:change="updateChietKhau(value)" v-model="value.tien_chiet_khau"
                                                                type="number" class="form-control" min="0">
                                                        </td>
                                                        <td class="align-middle text-end">@{{ number_format(value.thanh_tien) }}</td>
                                                        <td class="align-middle" style="width: 25%">
                                                            <input v-on:change="update(value)" v-model="value.ghi_chu" type="text"
                                                                class="form-control">
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th colspan="4"></th>
                                                        <th class="text-center">Tổng tiền</th>
                                                        <td class="align-middle font-weight-bold">@{{ number_format(tong_tien) }}</td>
                                                        <th></th>
                                                    </tr>
                                                    <tr>
                                                        <th colspan="2" class="text-center">Giảm giá</th>
                                                        <td colspan="2">
                                                            <input v-on:change="giamgia()" v-model="giam_gia" type="text" class="form-control">
                                                        </td>
                                                        <th class="text-center">Thành tiền</th>
                                                        <th class="text-danger font-weight-bold">@{{ number_format(thanh_tien) }}</th>
                                                        <th></th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>




                            {{-- Trang chuyển bàn --}}
                            <div class="row" v-if="trang_thai == 1">
                                <div class="col-5">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="align-middle">Chọn bàn</th>
                                                    <th>
                                                        <select v-on:change="loadDanhSachMenuTheoHoaDonChuyenBan(id_ban_nhan)" v-model="id_ban_nhan" class="form-control">
                                                            <option value="0">Chọn bàn cần chuyển món</option>
                                                            <template v-for="(value, key) in list_ban" v-if="value.tinh_trang == 1 && value.trang_thai != 0">
                                                                <option v-if="value.id != add_menu.id_ban" v-bind:value="value.id">@{{ value.ten_ban }}</option>
                                                            </template>
                                                        </select>
                                                    </th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                <th class="text-center">#</th>
                                                <th class="text-center">Tên Món</th>
                                                <th class="text-center">Số Lượng</th>
                                                <th class="text-center">Ghi Chú</th>
                                            </tr>
                                        </thead>
                                            <tbody>
                                                <tr v-for="(value, key) in list_menu_2">
                                                    <th class="text-center">@{{ key + 1 }}</th>
                                                    <td>@{{ value.ten_mon }}</td>
                                                    <td class="text-center">@{{ value.so_luong_ban }}</td>
                                                    <td>@{{ value.ghi_chu }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-7">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">Tên Món</th>
                                                    <th class="text-center">Số Lượng</th>
                                                    <th class="text-center">Số Lượng Chuyển</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(value, key) in list_detail">
                                                    <th class="text-center align-middle">
                                                        @{{ key + 1 }}
                                                    </th>
                                                    <td class="align-middle">@{{ value.ten_mon }} - @{{ value.id }}</td>
                                                    <td class="align-middle text-center">
                                                        @{{ value.so_luong_ban }}
                                                    </td>
                                                    <td class="align-middle" style="width: 15%;">
                                                        <input v-model="value.so_luong_chuyen" type="number"    class="form-control" min="0">
                                                    </td>
                                                    <td class="text-center">
                                                        <button v-if="id_hd_nhan == 0" v-on:click="chuyenmenu(value)" hidden=""></button>
                                                        <button v-else v-on:click="chuyenmenu(value)" class="btn btn-primary">Chuyển</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button v-if="trang_thai == 0" v-on:click="trang_thai = 1" type="button" class="btn btn-danger">Chuyển Bàn</button>
                            <button v-if="trang_thai == 1" v-on:click="trang_thai = 0" type="button" class="btn btn-danger">Xong Chuyển Bàn</button>

                            <button v-on:click="inbep(add_menu.id_hoa_don_ban_hang)" type="button" class="btn btn-primary">In Bếp</button>

                            <a target="_blank" v-bind:href="'/admin/ban-hang/in-bill/' + add_menu.id_hoa_don_ban_hang" class="btn btn-warning">In Bill</a>
                            <button v-on:click="thanhtoan()" type="button" class="btn btn-success">Thanh Toán</button>

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
                    list_ban: [],
                    list_menu: [],
                    list_detail: [],
                    timkiem: '',
                    gialenxuong: 0,
                    add_menu: {
                        'id_hoa_don_ban_hang': 0 , 'id_ban' : 0,
                    },
                    trang_thai: 0,

                    list_menu_2: [],
                    id_ban_nhan: 0,

                    tong_tien       :   0,
                    giam_gia        :   0,
                    thanh_tien      :   0,

                    id_hd_nhan  :   0,


                },

                created() {

                    // setInterval(() => {
                    //     this.loadDanhsachban();
                    // }, 500);


                    this.loadDanhsachban();

                    this.loadmenu();


                },

                methods: {

                    loadDanhsachban() {
                        axios
                            .get('/admin/ban/data')
                            .then((res) => {
                                this.list_ban = res.data.data;
                            });
                    },

                    //----------open-------------
                    opentable(id_ban) {
                        var payload = {
                            'id_ban': id_ban,
                        }
                        axios
                            .post('/admin/ban-hang/tao-hoa-don', payload)
                            .then((res) => {
                                if (res.data.status) {
                                    toastr.success(res.data.message, "Success");
                                    this.loadDanhsachban();
                                    this.add_menu.id_hoa_don_ban_hang = res.data.id_hoa_don_ban_hang;
                                } else {
                                    toastr.error(res.data.message, "error");
                                    this.loadDanhsachban();
                                }
                            })
                            .catch((res) => {
                                $.each(res.response.data.errors, function(k, v) {
                                    toastr.error(v[0]);
                                })
                            });
                    },
                    //--------vnd-----------
                    number_format(number) {
                        return new Intl.NumberFormat('vi-VI', {
                            style: 'currency',
                            currency: 'VND'
                        }).format(number);
                    },

                    //loadmenu
                    loadmenu() {
                        axios
                            .get('/admin/menu/data')
                            .then((res) => {
                                this.list_menu = res.data.data;
                            });
                    },
                    // tìm kiếm
                    search() {
                        var payload = {
                            'timkiem': this.timkiem
                        }
                        axios
                            .post('/admin/menu/search', payload)
                            .then((res) => {
                                this.list_menu = res.data.data;
                            })
                            .catch((res) => {
                                $.each(res.response.data.errors, function(k, v) {
                                    toastr.error(v[0]);
                                });
                            });
                    },
                    //chỉnh thứ tự giá bán
                    sort() {
                        this.gialenxuong = this.gialenxuong + 1;
                        if (this.gialenxuong > 2) {
                            this.gialenxuong = 0;
                        }
                        //quy ước : 1 tăng dần theo giá ,2 giảm dần theo giá , 0 thăng dần theo id
                        if (this.gialenxuong == 1) {
                            this.list_menu = this.list_menu.sort(function(a, b) {
                                return a.gia_ban - b.gia_ban;
                            })
                        } else if (this.gialenxuong == 2) {
                            this.list_menu = this.list_menu.sort(function(a, b) {
                                return b.gia_ban - a.gia_ban;
                            })
                        } else {
                            this.list_menu = this.list_menu.sort(function(a, b) {
                                return a.id - b.id;
                            })
                        }
                    },

                    //
                    getidhoadon(id_ban) {
                        var payload = {
                            'id_ban': id_ban
                        };
                        axios
                            .post('/admin/ban-hang/find-id-by-idban', payload)
                            .then((res) => {
                                if (res.data.status) {
                                    this.add_menu.id_hoa_don_ban_hang = res.data.id_hoa_don;
                                    this.add_menu.id_ban              = id_ban;
                                    this.loadDanhsachmenutheohoadon(this.add_menu.id_hoa_don_ban_hang);
                                } else {
                                    toastr.error("Hệ Thống Đang Gặp Sự Cố !");
                                    this.loadDanhsachban();
                                    $('#chiTietModal'.madal('toggle'));
                                }
                            })
                            .catch((res) => {
                                $.each(res.response.data.errors, function(k, v) {
                                    toastr.error(v[0]);
                                });
                            });
                    },

                    // thêm món
                    chitietbanhang(id_menu) {
                        var payload = {
                            'id_menu': id_menu,
                            'id_hoa_don_ban_hang': this.add_menu.id_hoa_don_ban_hang,
                        };
                        axios
                            .post('/admin/ban-hang/them-menu', payload)
                            .then((res) => {
                                if (res.data.status) {
                                    toastr.success(res.data.message);
                                    this.loadDanhsachmenutheohoadon(this.add_menu.id_hoa_don_ban_hang);
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

                    loadDanhsachmenutheohoadon(id_hoa_don) {
                        var payload = {
                            'id_hoa_don_ban_hang'   :   id_hoa_don,
                        };

                            axios
                                .post('/admin/ban-hang/danh-sach-menu-theo-hoa-don', payload)
                                .then((res) => {
                                    if(res.data.status) {
                                        // toastr.success(res.data.message);
                                        this.list_detail    = res.data.data;
                                        this.tong_tien      = res.data.tong_tien;
                                        this.thanh_tien     = res.data.thanh_tien;
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

                    // số lượng tăng tiền tăng
                    update(v) {
                        axios
                            .post('/admin/ban-hang/update', v)
                            .then((res) => {
                                if (res.data.status) {
                                    toastr.success(res.data.message);
                                } else {
                                    toastr.error(res.data.message);
                                }
                                this.loadDanhsachmenutheohoadon(v.id_hoa_don_ban_hang);
                            })
                            .catch((res) => {
                                $.each(res.response.data.errors, function(k, v) {
                                    toastr.error(v[0]);
                                });
                            });
                    },
                    //in bếp
                    inbep(id_hoa_don_ban_hang) {
                        var payload = {
                            "id_hoa_don_ban_hang": id_hoa_don_ban_hang,
                        };
                        axios
                            .post('/admin/ban-hang/in-bep', payload)
                            .then((res) => {
                                if (res.data.status) {
                                    toastr.success(res.data.message);
                                    this.loadDanhsachmenutheohoadon(id_hoa_don_ban_hang);
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

                    //xóa
                    xoa(payload) {
                        axios
                            .post('/admin/ban-hang/xoa-chi-tiet', payload)
                            .then((res) => {
                                if(res.data.status) {
                                    toastr.success(res.data.message);
                                } else {
                                    toastr.error(res.data.message);
                                }
                                this.loadDanhsachmenutheohoadon(payload.id_hoa_don_ban_hang);
                            })
                            .catch((res) => {
                                $.each(res.response.data.errors, function(k, v) {
                                    toastr.error(v[0]);
                                });
                            });
                    },

                    //updateChietKhau
                    updateChietKhau(v) {
                        axios
                            .post('{{ Route("1") }}', v)
                            .then((res) => {
                                if(res.data.status) {
                                    toastr.success(res.data.message);
                                } else {
                                    toastr.error(res.data.message);
                                }
                                this.loadDanhsachmenutheohoadon(v.id_hoa_don_ban_hang);
                            })
                            .catch((res) => {
                                $.each(res.response.data.errors, function(k, v) {
                                    toastr.error(v[0]);
                                });
                            });
                    },
                    //phần chuyển bàn
                    loadDanhSachMenuTheoHoaDonChuyenBan(id_ban_nhan) {
                        var payload = {
                            'id_ban'   :   id_ban_nhan,
                        };

                        axios
                            .post('{{ Route("2") }}', payload)
                            .then((res) => {
                                if(res.data.status) {
                                    this.list_menu_2    = res.data.data;
                                    this.id_hd_nhan    = res.data.id_hd;
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

                    //chuyển món
                    chuyenmenu(v) {
                        v['id_hoa_don_nhan']    =   this.id_hd_nhan;
                        axios
                            .post('{{ Route("3") }}', v)
                            .then((res) => {
                                if(res.data.status) {
                                    this.loadDanhsachmenutheohoadon(this.add_menu.id_hoa_don_ban_hang);
                                    this.loadDanhSachMenuTheoHoaDonChuyenBan(this.id_ban_nhan);
                                    toastr.success(res.data.message);
                                } else {
                                    toastr.error(res.data.message);
                                }
                            });
                    },



                    //
                    thanhtoan() {
                        axios
                            .post('{{ Route("6") }}', this.add_menu)
                            .then((res) => {
                                if(res.data.status) {
                                    toastr.success(res.data.message);
                                    this.loadDanhsachban();
                                    $('#chiTietModal').modal('toggle');
                                    var link = '/admin/ban-hang/in-bill/' + this.add_menu.id_hoa_don_ban_hang;
                                    window.open(link,'_blank');
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

                    giamgia() {
                        var payload = {
                            'id'        :   this.add_menu.id_hoa_don_ban_hang,
                            'giam_gia'  :   this.giam_gia,
                        };
                        axios
                            .post('{{ Route("7") }}', payload)
                            .then((res) => {
                                if(res.data.status) {
                                    this.loadDanhsachmenutheohoadon(this.add_menu.id_hoa_don_ban_hang);
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


                    getBankv(id){
                        var payload = {'id' : id};
                        axios
                            .post('/admin/ban-hang/get-bankv', payload)
                            .then((res) => {
                                this.list_ban = res.data.data;
                            });
                    },

                },
            });
        });
    </script>
@endsection
