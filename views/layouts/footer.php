<script src="/template/js/jquery.js"></script>
<script src="/template/js/bootstrap.min.js"></script>
<script type="text/javascript">
    $(function () {
        $('#ajax_form').on('submit', function (e) {
            e.preventDefault();
            var $that = $(this),
                formData = new FormData($that.get(0)); // создаем новый экземпляр объекта и передаем ему нашу форму (*)
            $.ajax({
                url: $that.attr('action'),
                method: 'post',
                contentType: false, // важно - убираем форматирование данных по умолчанию
                processData: false, // важно - убираем преобразование строк по умолчанию
                data: formData,
                dataType: 'json',
            }).done(function (response) {
                if (response.status == 1) {
                    var jsonData = response.errors;
                    $that.find('.label-danger').text('');
                    for (var i = 0; i < jsonData.length; i++) {
                        var counter = jsonData[i];
                        $(counter.id).text(counter.message);
                    }
                } else {
                    //$('.qa-message-list').html(response.content);
                    $that.find('input[type="text"], textarea').val('');
                    $that.find(
                        'span[id="field-name"], ' +
                        'span[id="field-email"], ' +
                        'span[id="field-comment"], ' +
                        'span[id="upload-file-info"]'
                    ).text('');
                }
                console.log('success');
            }).fail(function () {
                console.log('fail');
            });
        });
    });

    function checkError(array, field) {
        for (var i = 0; i < array.length; i++) {
            if (array[i] === field) {
                return true;
            }
            return false;
        }
    }

    $(function () {
        $('#sort-name, #sort-email, #sort-data').on('click', function (e) {
            var $form = $(this);
            $.ajax({
                type: 'post',
                url: 'comment/index',
                data: {
                    sort_param: $form.attr('data-id')
                },
            }).done(function (response) {
                $('.qa-message-list').html(response);
                console.log('success');
            }).fail(function () {
                console.log('fail');
            });
            //отмена действия по умолчанию для кнопки submit
            e.preventDefault();
        });
    });
</script>
</body>
</html>
