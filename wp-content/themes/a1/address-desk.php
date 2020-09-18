<?php
/* Template Name: address-desk */
get_header();

?>
    <div class="address__form-wrapper">
        <!--<iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3A811e43364244823ad05b88ab5a68bccea0563d12872bbb2b14edf88640a228fb&amp;source=constructor" width="100%" height="288" frameborder="0"></iframe>-->
        <div id="map" style="width: 100%; height: 288px"></div>

        <form action="#" method="post" class="address__form">
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
    // Функция ymaps.ready() будет вызвана, когда
    // загрузятся все компоненты API, а также когда будет готово DOM-дерево.
    ymaps.ready(init);
    function init(){
        // Создание карты.
        var myMap = new ymaps.Map("map", {
            // Координаты центра карты.
            // Порядок по умолчанию: «широта, долгота».
            // Чтобы не определять координаты центра карты вручную,
            // воспользуйтесь инструментом Определение координат.
            center: [54.98386611, 73.36664216],
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



        $("input[name='street']").on('input',function(e){
            searchControl.search('Россия, Омск, ' + $(this).val() + ', ' + $("input[name='house']").val());
        });

        $("input[name='house']").on('input',function(e){
            searchControl.search('Россия, Омск, ' + $("input[name='street']").val() + ', ' + $(this).val());
        });

        $('input.ymaps-2-1-77-searchbox-input__input').attr('readonly');
    }
</script>

<?php get_footer() ?>
