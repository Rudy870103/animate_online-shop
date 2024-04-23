<style>
    h1 {
        text-align: center;
        font-weight: 700;
        padding-top: 150px;
    }

    .box {
        border: 1px solid black;
        border-radius: 10px;
    }

    .mem {
        color: black;
    }

    .mem:hover {
        color: #052659;
    }

    @media (max-width:768px) {
        .login {
            width: 80%;
        }
    }
</style>
<h1>會員註冊<span style="display: block;font-size:16px;margin-top:10px">Join us</span></h1>
<div class="p-5 col-4 box mx-auto text-center">
    <div>帳號<input type="text" name="acc" id="acc"></div><br>
    
    <div>密碼<input type="password" name="pw" id="pw"></div><br>
    
    <div>確認密碼<input type="password" name="pw2" id="pw2"></div><br>
    
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
        }

        // 檢查使用者輸入是否完整
        if (user.acc != '' && user.pw != '' && user.pw2 != '') {
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