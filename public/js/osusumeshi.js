window.addEventListener('DOMContentLoaded', function(){
    const showPasswordBtn = document.getElementById('show_password_btn');
    const inputPass = document.getElementById('password');
    const showPasswordConfirmBtn = document.getElementById('show_password_confirm_btn')
    const inputPassConfirm = document.getElementById('password_confirm');

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
                showPasswordBtn.classList.remove("fa-slash");
                showPasswordBtn.classList.add("fa-eye");
            }
        });
    }
    //password_confirmの表示、非表示の切り替え
    if(showPasswordConfirmBtn){
        showPasswordConfirmBtn.addEventListener('change', (e) => {
            e.preventDefault();

            if( inputPassConfirm.type == 'password') {
                inputPassConfirm.type = 'text';
                showPasswordConfirmBtn.classList.remove("fa-eye");
                showPasswordConfirmBtn.classList.add("fa-eye-slash");
            } else {
                inputPassConfirm.type = 'password';
                showPasswordConfirmBtn.classList.remove("fa-slash");
                showPasswordConfirmBtn.classList.add("fa-eye");
            }
        });
    }

    //都道府県を変更すると表示される市町村を変更させる処理
    $('#prefecture_id').change(function(){
        console.log('aa');
        var prefecture_id = ('00' + $(this).val()).slice(-2);

        console.log(prefecture_id);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:"POST",
            url: "{{ route('getcity.ajax') }}",
            data: {"prefecture_id":prefecture_id },
            dataType: "json"
            
        }).done(function(data) {
            $('#city option').remove();
            $.each(data['data'], function (id) {
                $('#city').append($('<option>').text(data['data'][id]['name']).attr('value', data['data'][id]['name']));
            });
        }).fail(function(){
            console.log("失敗");
        });
    });
});