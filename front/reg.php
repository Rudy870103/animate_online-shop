<h1>會員註冊<span style="display: block;font-size:16px;margin-top:10px">Join us</span></h1>
<div class="p-5 col-4 box mx-auto text-center">
    <table style="width: 100%;">
        <tr>
            <td style="text-align: end;height:50px">帳號</td>
            <td><input type="text" name="acc" id="acc"></td>
        </tr>
        <tr>
            <td style="text-align: end;height:50px">密碼</td>
            <td><input type="password" name="pw" id="pw"></td>
        </tr>
        <tr>
            <td style="text-align: end;height:50px">確認密碼</td>
            <td><input type="password" name="pw" id="pw2"></td>
        </tr>
        <tr>
            <td style="text-align: end;height:50px">姓名</td>
            <td><input type="text" name="name" id="name"></td>
        </tr>
        <tr>
            <td style="text-align: end;height:50px">手機</td>
            <td><input type="text" name="tel" id="tel"></td>
        </tr>
        <tr>
            <td style="text-align: end;height:50px">地址</td>
            <td><input type="text" name="addr" id="addr"></td>
        </tr>
        <tr>
            <td style="text-align: end;height:50px">信箱</td>
            <td><input type="text" name="email" id="email"></td>
        </tr>
    </table>

    <div>
        <button class="login-btn" onclick="reg()">註冊</button>
        <button class="login-btn" onclick="clean()">重置</button>
    </div>
</div>

<script>
    function reg() {

        let user = {
            acc: $("#acc").val(),
            pw: $("#pw").val(),
            pw2: $("#pw2").val(),
            name: $("#name").val(),
            tel: $("#tel").val(),
            addr: $("#addr").val(),
            email: $("#email").val()
        }

        // 檢查使用者輸入是否完整
        if (user.acc != '' && user.pw != '' && user.pw2 != '' && user.name !='' && user.tel !='' && user.addr !='' && user.email != '') {
            // 檢查密碼和確認密碼是否相符
            if (user.pw == user.pw2) {
                // 發送 POST 請求檢查帳號是否重覆
                $.post("./api/chk_acc.php", {
                    acc: user.acc
                }, (res) => {
                    // 如果回傳的結果為 1，表示帳號重覆
                    if (parseInt(res) == 1) {
                        alert("帳號重覆")
                    } else {
                        // 發送 POST 請求進行註冊
                        $.post('./api/reg.php', user, (res) => {
                            alert('註冊完成，請重新登入')
                            location.href = '?do=login';
                        })
                    }
                })
            } else {
                alert("密碼錯誤")
            }
        } else {
            alert("不可空白")
        }
    }
</script>