@extends('admin.share.master')
@section('noi_dung')
<div class="row" id="app">
    <div class="col-5 mt-5">
        <div class="card-header text-center">
            <b>danh sách chức năng</b>
        </div>
        <div class="card-body">
            <div class="table-responsive" style="max-height:550px">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">id</th>
                        <th class="text-center">danh sách chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    <template v-for="(value,key ) in danhsachchucnang">
                        <tr>
                            <th class="text-center align-middle">@{{ key + 1 }}</th>
                            <td class="align-middle">@{{ value.danh_sach_chuc_nang }}</td>
                        </tr>
                    </template>
                </tbody>
            </table>
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
                    danhsachchucnang : [],
                },

                created() {
                    this.danhsachchucnang1();
                },

                methods: {

                    danhsachchucnang1(){
                        axios
                            .get('/admin/vi-du/data')
                            .then((res)=>{
                                this.danhsachchucnang = res.data.danhsachchucnang;
                            })
                    },
                }
            });
        });
    </script>
@endsection

