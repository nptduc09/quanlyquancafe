
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Đổi mật khẩu</title>
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toast-css/1.1.0/grid.min.css" integrity="sha512-YOGZZn5CgXgAQSCsxTRmV67MmYIxppGYDz3hJWDZW4A/sSOweWFcynv324Y2lJvY5H5PL2xQJu4/e3YoRsnPeg==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap');
        *{
            margin: 0;
            padding: 0;
            font-family: 'poppins',sans-serif;
        }
        section{
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            width: 100%;
            background-image: url('/assets/images/cafe4k.jpg');
            /* background: url('background6.jpg')no-repeat; */
            background-position: center;
            background-size: cover;
        }
        .form-box{
            position: relative;
            width: 400px;
            height: 450px;
            background: transparent;
            border: 2px solid rgba(255,255,255,0.5);
            border-radius: 20px;
            backdrop-filter: blur(15px);
            display: flex;
            justify-content: center;
            align-items: center;

        }
        h2{
            font-size: 2em;
            color: #fff;
            text-align: center;
        }

        .inputbox{
            position: relative;
            margin: 30px 0;
            width: 310px;
            border-bottom: 1px solid #fff;
        }
        .inputbox label{
            position: absolute;
            top: 50%;
            left: 5px;
            transform: translateY(-50%);
            color: #fff;
            font-size: 1em;
            pointer-events: none;
            transition: .5s;
        }
        input:focus ~ label,
        input:valid ~ label{
        top: -5px;
        }
        .inputbox input {
            width: 80%;
            height: 50px;
            background: transparent;
            border: none;
            outline: none;
            font-size: 1em;
            padding:0 35px 0 5px;
            color: #fff;
        }
        /* .inputbox ion-icon{
            position: absolute;
            right: 8px;
            color: #fff;
            font-size: 1.2em;
            top: 20px;
        } */
        .forget{
            margin: -15px 0 15px ;
            font-size: .9em;
            color: #fff;
            display: flex;
            justify-content: space-between;
        }

        .forget label input{
            margin-right: 3px;

        }
        .forget label a{
            color: #fff;
            text-decoration: none;
        }
        .forget label a:hover{
            text-decoration: underline;
        }
        button{
            width: 100%;
            height: 40px;
            border-radius: 40px;
            background: #fff;
            border: none;
            outline: none;
            cursor: pointer;
            font-size: 1em;
            font-weight: 600;
        }
        .register{
            font-size: .9em;
            color: #fff;
            text-align: center;
            margin: 25px 0 10px;
        }
        .register p a{
            text-decoration: none;
            color: #fff;
            font-weight: 600;
        }
        .register p a:hover{
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <section>
        <div class="form-box">
            <div class="form-value">
                <form action="/admin/update-password" method="post">
                    @csrf


                    <h2>Đổi MẬT KHẨU</h2>
                    <div hidden="inputbox">
                        <input name="hash_reset" type="text" class="form-control" required value={{ $hash_reset}}>
                        <label for="">hash_reset</label>
                    </div>
                    <div class="inputbox">
                        <input name="password" type="password" class="form-control" required>
                        <label for="">Nhập mật khẩu mới</label>
                    </div>
                    <div class="inputbox">

                        <input name="kt_mat_khau" type="password" class="form-control" required>
                        <label for="">Nhập lại mật khẩu</label>
                    </div>

                    <div class="forget" style="float: right">
                        <label for=""><a href="/login">Đăng Nhập</a></label>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="bx bxs-lock-open"></i>Đổi Mật Khẩu</button>

                </form>
            </div>
        </div>
    </section>


    {{-- <script>
        $(document).ready(function() {
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'mat_khau');
                    $('#show_hide_password i').addClass("bx-hide");
                    $('#show_hide_password i').removeClass("bx-show");
                } else if ($('#show_hide_password input').attr("type") == "mat_khau") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("bx-hide");
                    $('#show_hide_password i').addClass("bx-show");
                }
            });
        });
    </script> --}}

</body>
</html>


