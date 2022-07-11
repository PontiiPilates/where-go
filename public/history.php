<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Что нового</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>

<body>

    <?php
    $history = [
        // [
        //     'date' => '',
        //     'title' => '',
        //     'description' => ''
        //     'todo' => ''
        // ],
        [
            'date' => '2022-01-27',
            'title' => 'Организована система подписок',
            'description' => 'У зарегистрированного пользователя появилась возможность добавить в закладки другого пользователя. Такой пользователь будет отображаться на странице "Подписки". Таким образом у пользователя появляется возможность быстро посещать страницы понравившихся ему пользователей.',
            'todo' => 'Следующим шагом стоит организовать систему подписок, это означает получение уведомлений от созданий событий другими участниками.'
        ],
        [
            'date' => '2022-01-19',
            'title' => 'Добавлена пагинация',
            'description' => 'Теперь события выводятся партиями по Х штук для обеспечения наилучшей производительности. Для того, чтобы подгрузить события необходимо нажать кнопку "Еще"',
            'todo' => 'Следует усовершенствовавть вывод событий с помощью ajax. Очередная порция событий должна подгружаться при достижении пользователем последнего события в списке. А при скролле вверх должна появиться кнопка "наверх".'
        ],
        [
            'date' => '2022-01-13',
            'title' => 'Добавлены закладки',
            'description' => 'Тепер авторизованный пользователь может добавлять события в закладки и просматривать их из соответствующего пункта меню в личном кабинете.',
            'todo' => ''
        ],
    ];
    ?>


    <?php foreach ($history as $k => $v) : ?>
        <!-- <div class="card">
                <div class="card-header">
                    Рекомендуемые
                </div>
                <div class="card-body">
                    <h5 class="card-title">Особое обращение с заголовком</h5>
                    <p class="card-text">С вспомогательным текстом ниже в качестве естественного перехода к дополнительному контенту.</p>
                    <a href="#" class="btn btn-primary">Перейти куда-нибудь</a>
                </div>
            </div> -->

    <?php endforeach; ?>

</body>

</html>