import './bootstrap';


window.addEventListener('DOMContentLoaded', function(){
    const showPasswordBtn = document.getElementById('show_password_btn');
    const inputPass = document.getElementById('password');
    const showPasswordConfirmBtn = document.getElementById('show_password_confirm_btn');
    const inputPassConfirm = document.getElementById('password_confirm');


    const getCityName = () =>{
        var prefecture_id = ('00' + $('#prefecture_id').val()).slice(-2);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            type:"POST",
            url: `/posts/create/ajax`,
            data: {"prefecture_id":prefecture_id },
        }).done(function(data) {
            var data = JSON.parse(data);
            $.each(data['data'], function (id) {
                $('#city').append($('<option>').text(data['data'][id]['name']).attr('value', data['data'][id]['name']));
            });
        }).fail(function(){
            console.log("失敗");
        });
    };

    //二度押し防止
    $(function () {
        $('form').submit(function () {
          $(this).find(':submit').prop('disabled', 'true');
        });
    });

    //passwordの表示、非表示の切り替え
    if(showPasswordBtn){
        showPasswordBtn.addEventListener('click', (e) => {
            e.preventDefault();

            if( inputPass.type == 'password') {
                inputPass.type = 'text';
                showPasswordBtn.classList.remove("fa-eye");
                showPasswordBtn.classList.add("fa-eye-slash");
            } else {
                inputPass.type = 'password';
                showPasswordBtn.classList.remove("fa-eye-slash");
                showPasswordBtn.classList.add("fa-eye");
            }
        });
    };
    //password_confirmの表示、非表示の切り替え
    if(showPasswordConfirmBtn){
        showPasswordConfirmBtn.addEventListener('click', (e) => {
            e.preventDefault();

            if( inputPassConfirm.type == 'password') {
                inputPassConfirm.type = 'text';
                showPasswordConfirmBtn.classList.remove("fa-eye");
                showPasswordConfirmBtn.classList.add("fa-eye-slash");
            } else {
                inputPassConfirm.type = 'password';
                showPasswordConfirmBtn.classList.remove("fa-eye-slash");
                showPasswordConfirmBtn.classList.add("fa-eye");
            }
        });
    }
        
    //読み込んだ際に市町村を取得する関数
    if($('#prefecture_id').val()){
        getCityName();
    }

    //都道府県を変更すると表示される市町村を変更させる処理
    $('#prefecture_id').change(function(){

        var prefecture_id = ('00' + $(this).val()).slice(-2);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            type:"POST",
            url: `/posts/create/ajax`,
            data: {"prefecture_id":prefecture_id },

        }).done(function(data) {
            $('#city option').remove();
            var data = JSON.parse(data);
            $.each(data['data'], function (id) {
                $('#city').append($('<option>').text(data['data'][id]['name']).attr('value', data['data'][id]['name']));
            });
        }).fail(function(){
            console.log("失敗");
        });
    });

    //投稿一覧で読み込んだ際に市町村を変更させる処理
    const searchgetCityName = () =>{
        var prefecture_id = ('00' + $('#prefecture_id_search').val()).slice(-2);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            type:"POST",
            url: `/posts/create/ajax`,
            data: {"prefecture_id":prefecture_id },
        }).done(function(data) {
            var data = JSON.parse(data);
            if($('#city').val()){
                $('#city').append($('<option>').text('市町村（選択なし)').attr('value', ''));
            }
            $.each(data['data'], function (id) {
                $('#city').append($('<option>').text(data['data'][id]['name']).attr('value', data['data'][id]['name']));
            });
        }).fail(function(){
            console.log("失敗");
        });
    };

    if($('#prefecture_id_search').val()){
        searchgetCityName();
    }

    //投稿一覧で都道府県を変更すると表示される市町村を変更させる処理
    $('#prefecture_id_search').change(function(){

        var prefecture_id = ('00' + $(this).val()).slice(-2);
        if (prefecture_id != '00'){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                type:"POST",
                url: `/posts/create/ajax`,
                data: {"prefecture_id":prefecture_id },

            }).done(function(data) {
                $('#city option').remove();
                var data = JSON.parse(data);
                $('#city').append($('<option>').text('市町村（選択なし)').attr('value', ''));
                $.each(data['data'], function (id) {
                    $('#city').append($('<option>').text(data['data'][id]['name']).attr('value', data['data'][id]['name']));
                });
            }).fail(function(){
                console.log("失敗");
            });
        } else {
            $('#city option').remove();
            $('#city').append($('<option>').text('市町村（選択なし)').attr('value', ''));
        }
    });

    //行きたいボタン
    $('.ikitai-btn').on('click', function() {
        const postId = $(this).data('value');
        const ikitaiBtn = $(this);
        var count = Number($(this).children('.ikitai-count'+ postId).text());
        //二度押し防止
        ikitaiBtn.prop('disabled',true);

        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            url: `/posts/ikitai/${postId}`,
            type: "POST",    
        }).done(function(data) {
            //disabled解除
            ikitaiBtn.prop('disabled',false);

            if (data == "いきたい登録"){
                //ラベルの変更
                $('.ikitai-label'+ postId).text('解除');
                //iconの変更
                $('.ikitai-icon'+ postId).removeClass("fa-regular");
                $('.ikitai-icon'+ postId).addClass("fa-solid");
                //ボタン背景の変更
                ikitaiBtn.removeClass("btn-outline-info");
                ikitaiBtn.addClass("btn-info");
                //カウント増加
                count++;
                $('.ikitai-count' + postId).text(count);

            }   else if (data == "いきたい削除"){
                //ラベルの変更
                $('.ikitai-label' + postId).text('行きたい');
                //iconの変更
                $('.ikitai-icon' + postId).removeClass("fa-solid");
                $('.ikitai-icon' + postId).addClass("fa-regular");
                //ボタン背景の変更
                ikitaiBtn.removeClass("btn-info");
                ikitaiBtn.addClass("btn-outline-info");
                //カウント減少
                count--;
                $('.ikitai-count' + postId).text(count);
            }   else {
            };
        }).fail(function () {
            console.log('失敗');
        });
    });

    //共感ボタン
    $('.empathy-btn').on('click', function() {
        const postId = $(this).data('value');
        const empathyBtn = $(this);
        var count = Number($(this).children('.empathy-count'+ postId).text());
        //二度押し防止
        empathyBtn.prop('disabled',true);

        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            url: `/posts/empathy/${postId}`,
            type: "POST",    
        }).done(function(data) {
            empathyBtn.prop('disabled',false);
            if (data == "共感登録"){
                //ラベルの変更
                $('.empathy-label' + postId).text('解除');
                //iconの変更
                $('.empathy-icon' + postId).removeClass("fa-regular");
                $('.empathy-icon' + postId).addClass("fa-solid");
                //ボタン背景の変更
                empathyBtn.removeClass("btn-outline-info");
                empathyBtn.addClass("btn-info");
                //カウント増加
                count++;
                $('.empathy-count' + postId).text(count);

            }   else if (data == "共感削除"){
                //ラベルの変更
                $('.empathy-label' + postId).text('共感');
                 //ボタン背景の変更
                empathyBtn.removeClass("btn-info");
                empathyBtn.addClass("btn-outline-info");
                //iconの変更
                $('.empathy-icon' + postId).removeClass("fa-solid");
                $('.empathy-icon' + postId).addClass("fa-regular");
                //カウント減少
                count--;
                $('.empathy-count' + postId).text(count);

            }   else {
            };
        }).fail(function () {
            console.log('失敗');
        });
    });

    $('#image').on('change', function(e) {
        //画像を読み込む
        const reader = new FileReader();
        if (this.files[0]) {
            //result属性にファイルのURLを格納
            reader.readAsDataURL(this.files[0]);
            //画像が読み込まれたときの動作
            reader.onload = function (e) {
                $('.img_preview').attr('src', e.target.result).css('width', '250px').css('height', '150px');
            }
        } else {
            $('.img_preview').attr('src', `/laravel-osusumeshi/public/img/noimage.png` ).css('width', '250px').css('height', '150px');
        }
    })
});
