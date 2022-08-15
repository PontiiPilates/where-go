/**

 * * "Поделиться"

 * * При клике появляется, а затем исчезает всплывающая подсказка

 * * Также, при клике происходит копирование ссылки в буфер обмена

 * 

 * * Для того, чтобы присвоить элементу данную функцию:

 * * Присвоить элементу класс: share-link

 * * Поместить в него аттрибут: data-main-uri

 * * А также элемент должен быть снабжен фуцнкционалом Poppers

 */

function fork(selector) {



    // Получение элемента: принято решение делать это по классу, поскольку элемент используется на странице больше одного раза

    element = $('.' + selector);



    // Действие производится с элементом, по которрому произошел клик

    element.bind('click', function () {



        // Получение доступа к выбранному элементу

        var thisElement = $(this)[0];

        // Получение доступа к выбранному объекту

        var thisObject = $(this);



        // Получение ссылки

        link = thisObject.attr('data-main-uri');



        // Получение высплывающей подсказки Poppers

        var tooltip = bootstrap.Tooltip.getInstance(thisElement)



        // Реакция на событие при появлении всплывающей подсказки

        thisElement.addEventListener('shown.bs.tooltip', function () {



            // Копирование в буфер обмена

            var temp = $("<input>");

            thisObject.append(temp);

            temp.val(link).select();

            document.execCommand("copy");

            temp.remove();



            // Задержка перед исчезновением всплывающей подсказки

            setTimeout(function () {

                // Реализация скрытия всплывающей подсказки

                thisObject.tooltip('hide');

            }, 1000);



        })



    })



}



// Реализация функции "Поделиться"

fork('share-link');