<?php
/* Template Name: address-desk */
get_header();

?>
<div class="address__form-wrapper">
    <!--<iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3A811e43364244823ad05b88ab5a68bccea0563d12872bbb2b14edf88640a228fb&amp;source=constructor" width="100%" height="288" frameborder="0"></iframe>-->
    <div id="map" style="width: 100%; height: 288px"></div>

    <form action="#" method="post" class="address__form">
        <span class="address__form-delivery-city">Доставка товаров осуществляется только по г.Омск</span>
        <div class="address__form-inner-wrapper">
            <input type="text" name="street" placeholder="Улица">
            <input type="text" name="house" placeholder="Дом">
            <input type="text" name="entrance" placeholder="Подъезд">
        </div>
        <div class="address__form-inner-wrapper" style="margin-bottom: 0">
            <input type="text" name="floor" placeholder="Этаж">
            <input type="text" name="apartment" placeholder="Квартира / офис">
            <button type="submit">Добавить адрес</button>
        </div>
    </form>
</div>

</div>

<script type="text/javascript">
    /*var latitude = 0;
    var longitude = 0;

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            console.log("Geolocation is not supported by this browser.");
        }
    }

    getLocation();

    function showPosition(position) {
        latitude = position.coords.latitude;
        longitude = position.coords.longitude;
        console.log(latitude + ' ' + longitude);
    }

    console.log(latitude + ' ' + longitude);*/


    var latitude = 0;
    var longitude = 0;
    var i = 0;
    if (window.navigator.geolocation) {
        // Geolocation available
        /* window.navigator.geolocation
             .getCurrentPosition(getPosition);*/

        navigator.geolocation.watchPosition(function (position) {
                // console.log("i'm tracking you!");
                latitude = position.coords.latitude;
                longitude = position.coords.longitude;
                // console.log(latitude + ' ' + longitude);
                if (i == 0) {
                    ymaps.ready(init);
                }
                i++;
            },
            function (error) {
                if (error.code == error.PERMISSION_DENIED) {
                    // console.log("you denied me :-(");
                    ymaps.ready(init);
                }
            });

        /*function getPosition(position) {
            latitude = position.coords.latitude;
            longitude = position.coords.longitude;
            console.log(latitude + ' ' + longitude);
            ymaps.ready(init);
        }*/
    } else {
        ymaps.ready(init);
    }


    // Функция ymaps.ready() будет вызвана, когда
    // загрузятся все компоненты API, а также когда будет готово DOM-дерево.
    // ymaps.ready(init);
    function init() {
        // Создание карты.

        if (latitude !== 0 || longitude !== 0) {
            $.ajax({
                url: 'https://geocode-maps.yandex.ru/1.x/?apikey=e215db02-6068-4965-8f36-3b1b1b18a6f1&geocode=' + longitude + ',' + latitude + '&kind=house&format=json',
                dataType: 'jsonp',
                success: function (dataWeGotViaJsonp) {
                    // console.log(dataWeGotViaJsonp);
                    // console.log(dataWeGotViaJsonp.response.GeoObjectCollection.featureMember[0].GeoObject.metaDataProperty.GeocoderMetaData.Address.Components[3].name);
                    if (dataWeGotViaJsonp.response.GeoObjectCollection.featureMember[0].GeoObject.metaDataProperty.GeocoderMetaData.Address.Components[3].name !== 'Омск') {
                        $('.address__form-delivery-city').css('display', 'block');
                    }
                }
            });
        } else {
            latitude = 54.98386611;
            longitude = 73.36664216;
        }


        // console.log(latitude + ' ' + longitude);
        var myMap = new ymaps.Map("map", {
            // Координаты центра карты.
            // Порядок по умолчанию: «широта, долгота».
            // Чтобы не определять координаты центра карты вручную,
            // воспользуйтесь инструментом Определение координат.
            // center: [54.98386611, 73.36664216],
            center: [latitude, longitude],
            // Уровень масштабирования. Допустимые значения:
            // от 0 (весь мир) до 19.
            zoom: 12,
            controls: []
        });

        var searchControl = new ymaps.control.SearchControl({
            options: {
                provider: 'yandex#search',
                // noPopup: true,
                noSuggestPanel: true,
            }
        });

        myMap.controls.add(searchControl);


        $("input[name='street']").on('input', function (e) {
            searchControl.search('Россия, Омск, ' + $(this).val() + ', ' + $("input[name='house']").val());
        });

        $("input[name='house']").on('input', function (e) {
            searchControl.search('Россия, Омск, ' + $("input[name='street']").val() + ', ' + $(this).val());
        });
    }

    setInterval(function(){
        $('input.ymaps-2-1-77-searchbox-input__input').attr('readonly', 'true');
        }, 1000);

    $('.address__form').on('submit', function (e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            'method': 'POST',
            'dataType': 'json',
            'url': '/wp-content/themes/a1/custom_files_dm/add_address.php',
            'data':  formData,
            success: function (data) {//success callback
                // console.log(data);
                $('.address__form button[type="submit"]').text('Адрес успешно добавлен');
                setTimeout(function(){  window.location.href = '/cabinet'; }, 1000);
            },
            error: function (data) {
                console.log(data);
            }
        });
    })
</script>

<?php get_footer() ?>
