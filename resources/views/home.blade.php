<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>CRUD</title>

    <style>
        .container {
            max-width: 1100px;
            padding: 0 30px;
            margin: auto
        }

        table {
            border-collapse: collapse;
            width: 100%
        }

        td {
            border: 1px solid #b5b5b5;
            padding: 3px 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Роуты</h1>
        <h3>Для всех пользователей</h3>
        <table>
            <thead>
                <tr>
                    <td>Метод</td>
                    <td>Адрес</td>
                    <td>Параметры</td>
                    <td>Описание</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>GET</td>
                    <td><a href="/">/</a></td>
                    <td></td>
                    <td>Главная страница</td>
                </tr>
                <tr>
                    <td>POST</td>
                    <td>/api/v1/register</td>
                    <td>
                        <ul>
                            <li>name - required</li>
                            <li>email - required</li>
                            <li>password - required</li>
                        </ul>
                    </td>
                    <td>Регистрация пользователя</td>
                </tr>
                <tr>
                    <td>POST</td>
                    <td>/api/v1/login</td>
                    <td>
                        <ul>
                            <li>email - required</li>
                            <li>password - required</li>
                        </ul>
                    </td>
                    <td>Авторизация</td>
                </tr>
                <tr>
                    <td>GET</td>
                    <td><a href="/api/v1/products" target="_blank">/api/v1/products</a></td>
                    <td></td>
                    <td>Список товаров</td>
                </tr>
                <tr>
                    <td>GET</td>
                    <td><a href="/api/v1/products/search" target="_blank">/api/v1/products/search</a></td>
                    <td>
                        <ul>
                            <li>name</li>
                            <li>price</li>
                            <li>stocked</li>
                        </ul>
                    </td>
                    <td>Поиск товара</td>
                </tr>
            </tbody>
        </table>


        <h3>Для авторизованных пользователей</h3>
        <table>
            <thead>
                <tr>
                    <td>Метод</td>
                    <td>Адрес</td>
                    <td>Параметры</td>
                    <td>Описание</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>POST</td>
                    <td>/cart/1</td>
                    <td>
                        <ul>
                            <li>quantity</li>
                        </ul>
                    </td>
                    <td>Добавит товар в корзину</td>
                </tr>
                <tr>
                    <td>DELETE</td>
                    <td>/cart/1</td>
                    <td></td>
                    <td>Удалит товар из корзины</td>
                </tr>
            </tbody>
        </table>

        <h3>Для администратора</h3>
        <table>
            <thead>
                <tr>
                    <td>Метод</td>
                    <td>Адрес</td>
                    <td>Параметры</td>
                    <td>Описание</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>POST</td>
                    <td>/api/v1/products/</td>
                    <td>
                        <ul>
                            <li>name - required</li>
                            <li>price</li>
                            <li>description</li>
                            <li>image</li>
                            <li>stocked</li>
                            <li>slug</li>
                        </ul>
                    </td>
                    <td>Добавление товара</td>
                </tr>
                <tr>
                    <td>PUT</td>
                    <td>/products/1</td>
                    <td>
                        <ul>
                            <li>name</li>
                            <li>price</li>
                            <li>description</li>
                            <li>image</li>
                            <li>stocked</li>
                            <li>slug</li>
                        </ul>
                    </td>
                    <td>Обновление товара</td>
                </tr>
                <tr>
                    <td>DELETE</td>
                    <td>/products/1</td>
                    <td></td>
                    <td>Удаление товара</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
