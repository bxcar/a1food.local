<style>
    .ymaps-2-1-78-map-copyrights-promo,
    .ymaps-2-1-78-copyright,
    .ymaps-2-1-78-islets_card__toponym-buttons,
    .ymaps-2-1-78-islets_card__buttons,
    .ymaps-2-1-78-islets_card__separator,
    .ymaps-2-1-78-islets_card__row-links,
    .ymaps-2-1-78-controls__control_toolbar{
        display: none !important;
    }

    .ymaps-2-1-78-balloon__content > ymaps:first-child {
        height: auto !important;
    }
</style>
<script>
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
                if (dataWeGotViaJsonp.response.GeoObjectCollection.featureMember[0].GeoObject.metaDataProperty.GeocoderMetaData.Address.Components[3].name !== 'Омск') {
                    $('.address__form-delivery-city').css('display', 'block');
                } else {
                    $('input[name="street"]').attr('value', dataWeGotViaJsonp.response.GeoObjectCollection.featureMember[0].GeoObject.metaDataProperty.GeocoderMetaData.Address.Components[4].name);
                    $('input[name="house"]').attr('value', dataWeGotViaJsonp.response.GeoObjectCollection.featureMember[0].GeoObject.metaDataProperty.GeocoderMetaData.Address.Components[5].name);
                    searchControl.search('Россия, Омск, ' + $("input[name='street']").val() + ', ' + $("input[name='house']").val());
                }
            }
        });
    } else {
        latitude = 54.98386611;
        longitude = 73.36664216;
    }

    // https://ru.stackoverflow.com/questions/453173/%D0%9A%D0%B0%D0%BA-%D0%B7%D0%B0%D0%BF%D1%80%D0%B5%D1%82%D0%B8%D1%82%D1%8C-%D0%BC%D0%B0%D1%81%D1%88%D1%82%D0%B0%D0%B1%D0%B8%D1%80%D0%BE%D0%B2%D0%B0%D0%BD%D0%B8%D0%B5-%D0%AF%D0%BD%D0%B4%D0%B5%D0%BA%D1%81-%D0%9A%D0%B0%D1%80%D1%82%D1%8B-%D0%BF%D1%80%D0%B8-%D1%81%D0%BA%D1%80%D0%BE%D0%BB%D0%BB%D0%B5-%D1%82%D0%BE%D0%BB%D1%8C%D0%BA%D0%BE-%D0%BD%D0%B0-%D0%BC%D0%BE%D0%B1%D0%B8%D0%BB%D1%8C%D0%BD%D1%8B%D1%85-%D1%83%D1%81%D1%82%D1%80%D0%BE

    // console.log(latitude + ' ' + longitude);
    var myMap = new ymaps.Map("map", {
        // Координаты центра карты.
        // Порядок по умолчанию: «широта, долгота».
        // Чтобы не определять координаты центра карты вручную,
        // воспользуйтесь инструментом Определение координат.
        // center: [54.98386611, 73.36664216],
        center: [latitude, longitude],
        behaviors: [],
        // Уровень масштабирования. Допустимые значения:
        // от 0 (весь мир) до 19.
        zoom: 12,
        controls: []
    });


    //https://www.cyberforum.ru/javascript-api/thread2486960.html
    // myMap.controls.remove('searchControl');

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
    $('input.ymaps-2-1-78-searchbox-input__input').attr('readonly', 'true');
    // $('.ymaps-2-1-78-search.ymaps-2-1-78-search_layout_normal.ymaps-2-1-78-searchbox__normal-layout').css('display', 'none');
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
            var url_string = window.location.href;
            var url = new URL(url_string);
            var checkout = url.searchParams.get("checkout");
            if(checkout) {
                <?php if(get_the_ID() == 377) { ?> //mobile page id is 377
                setTimeout(function(){  window.location.href = '/checkout-mobile'; }, 1000);
                <?php } else { ?> //show desktop page
                setTimeout(function(){  window.location.href = '/checkout'; }, 1000);
                <?php } ?>
            } else {
                <?php if(get_the_ID() == 377) { ?> //mobile page id is 377
                setTimeout(function(){  window.location.href = '/cabinet-mobile'; }, 1000);
                <?php } else { ?> //show desktop page
                setTimeout(function(){  window.location.href = '/cabinet'; }, 1000);
                <?php } ?>
            }

        },
        error: function (data) {
            console.log(data);
        }
    });
});
</script>
