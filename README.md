 <h1 align="center">Сервис по доставке пиццы PizzaDelivery</h1>
  <p> Этот проект реализован с помощью PHP 8.2 , фреймворка Laravel 10, PostgreSql и Nginx.
 <h2>Описание:</h2>
  <p> Это сервис, в котором можно зарегистрировать, аутентифицироваться, посмотреть категории товаров, посмотреть все товары, добавить товар в корзину до 20 напитков и 10 пицц, и сделать заказ.</p>

<h2>Функционал сервиса:</h2>
<ul>

Пользователям:
- Регистрация пользователя
- Аутентификация пользователя
- Просмотр всех товаров
- Добавление товара в корзину
- Просмотреть что добавлено в корзину
- Просмотр категории товаров
- Сделать заказ
- Посмотреть историю заказов

Администратору:
- Добавлять/изменять/удалять товары
- Просматривать список заказов и изменять их статус
- Добавлять категории товаров
- Добавлять и назначать роли пользователям
</ul>

<h2>API:</h2>
<ul>

## Аутентификация

- **POST /auth/sign-in**: Вход пользователя.
- **POST /auth/sign-up**: Регистрация пользователя.
- **POST /auth/sign-out**: Выход пользователя.
- **GET /auth/user-info**: Получение информации о пользователе.

## Гости 
### Продукты
- **GET /products**: Получить список товаров.
- **GET /products/{product}**: Получить товар по ID.
- **GET /products/category/{categoryId}**: Получить товары по категории.

### Корзина

- **POST /carts/{cart}/addItem**: Добавить товар в корзину.
- **GET /carts/{cart}/getCurrentItems**: Получить текущие товары в корзине.


## Пользователь

### Заказы

- **GET /orders**: Получить список заказов.
- **POST /orders**: Создать новый заказ.
- **GET /orders/{order}**: Получить заказ по ID.

###  Адреса (Ресурсные маршруты)

- **/addresses**: Управление адресами.

## Административные маршруты (Ресурсные маршруты)

- **/admin/products**: Управление товарами.
- **/admin/roles**: Управление ролями.
- **/admin/categories**: Управление категориями.
- **/admin/orders**: Управление заказами.
- **/admin/users**: Управление пользователями.



<h2>Чтобы запустить проект, выполните:</h2>

Поднять проект:

```make dev-up```
