@extends('admin.share.master')
@section('noi_dung')
    <div class="container">
        <div class="" id="app">
            <div class="card">
                <div class="card-header text-center">
                    <b>BẾP</b>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center align-middle">#</th>
                                    <th class="text-center align-middle">Tên Món Ăn</th>
                                    <th class="text-center align-middle">Số Lượng</th>
                                    <th class="text-center align-middle">Tên Bàn</th>
                                    <th class="text-center align-middle">Ghi Chú</th>
                                    <th class="text-center align-middle">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template v-for="(value, key) in data">
                                    <tr>
                                        <th class="text-center align-middle">@{{ key + 1 }}</th>
                                        <td class="align-middle">@{{value.ten_mon}}</td>
                                        <td class="text-center align-middle">@{{value.so_luong_ban}}</td>
                                        <td class="text-center align-middle">@{{value.ten_khu}} @{{value.ten_ban}}</td>
                                        <td class="align-middle">@{{value.ghi_chu}}</td>
                                        <td class="text-center align-middle">
                                            <button v-on:click="xong(value)" class="btn btn-primary">Xong</button>
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
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
            el      :       '#app',
            data    :       {
                data   :   [],
            },


            created() {

                setInterval(() => {
                    this.loadData();
                }, 2000);
            },
            methods :   {
                loadData() {
                    axios
                        .get('/admin/bep/data-bep')
                        .then((res) => {
                            this.data  =  res.data.data;
                        });
                },
                xong(value) {
                    axios
                        .post('/admin/bep/update-bep', value)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.message, "Success");
                                this.loadData();
                            } else if (res.data.status == 0) {
                                toastr.error(res.data.message, "Error");
                            }
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0]);
                            })
                        });
                },

            },
        });
    });
</script>
@endsection
