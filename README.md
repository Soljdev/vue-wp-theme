# Vue.js 3 WordPress ThemeStarter Template with Vue.js and Tailwind CSS
Version 0.3

## Описание
Стартовый шаблон темы WordPress, интегрированный с Vue.js 3 и Tailwind CSS 3.4.12 для создания динамичных, адаптивных веб-приложений с технологией SPA. Шаблон предоставляет готовую инфраструктуру для разработки современных веб-приложений на базе WordPress.

## Особенности
* **Vue.js 3** - современная версия фреймворка для создания интерактивных интерфейсов
* **Tailwind CSS 3.4.12** - утилитарный CSS-фреймворк для создания кастомных дизайнов
* * https://v3.tailwindcss.com
* **REST API Data Localizer** - встроенная поддержка локализации данных
* * https://gitverse.ru/solj/rest-api-data-localizer (submodule)
* * https://github.com/bshiluk/rest-api-data-localizer
* **Webpack** - модульная система сборки
* **Модульная архитектура** - легко расширяемая структура проекта
* **Оптимизированная производительность** - автоматическая оптимизация бандлов

## Требования
* Node.js версии 16+
* NPM или Yarn
* WordPress min v6.2+

## Установка
1. Клонируйте репозиторий в корень сайта WordPress:
```bash
git clone https://gitverse.ru/solj/vue-wp-theme
```

2. В директории темы установите зависимости:
```bash
cd wp-content/themes/vue-wp-theme
npm install 
git submodule update --init --recursive # Установка субмодуля REST API Data Localizer
```

3. Активируйте тему в WordPress:
* Активируйте плагин REST API Data Localizer
* Активируйте тему в разделе "Внешний вид"

## Запуск разработки
### Настройка окружения
1. Настройте конфигурацию Webpack:
```js
// wp-content/themes/vue-wp-theme/webpack.dev.config.js
module.exports = {
  entry: path.resolve(__dirname, 'src/app.js'),
  mode: 'development',
  devServer: {
    hot: true,
    headers: { "Access-Control-Allow-Origin": "*" },
    port: 8085,
    https: false,
    disableHostCheck: true,
    publicPath: '',
    host: 'localhost',
  },
  output: {
    path: path.resolve(__dirname, 'dist'),
    publicPath: 'http://localhost:8085/',
    filename: 'vue-wordpress.js'
  },
  /* ... */
}
```

2. Настройте подключение скриптов:
```php
// wp-content/themes/vue-wp-theme/functions/functions_scripts.php

// Enable For Production - Disable for Development
// wp_enqueue_script('vue_wordpress.js', get_template_directory_uri() . '/dist/vue-wordpress.js', array(), $ver, true );
// Enable For Development - Remove for Production
wp_enqueue_script( 'vue_wordpress.js', 'http://localhost:8085/vue-wordpress.js', array(), $ver, true );
```

3. Запустите окружение

Запуск окружения Webpack
```bash
npm run dev
```
Запуск TailwindCSS
```bash
npx tailwindcss -i ./src/input.css -o ./src/output.css --watch 
```

### Для сборки production версии:
1. Настройте параметры сборки Webpack
```js
// wp-content/themes/vue-wp-theme/webpack.prod.config.js
module.exports = {
  entry: path.resolve(__dirname, 'src/app.js'),
  mode: 'production',
  output: {
    path: path.resolve(__dirname, 'dist'),
    publicPath: '/wp-content/themes/vue-wp-theme/dist/',
    filename: 'vue-wordpress.js'
  },
  /* ... */
}
```

2. Установите подключение скриптов 'Enable For Production'
```php
// wp-content/themes/vue-wp-theme/functions/functions_scripts.php

// Enable For Production - Disable for Development
wp_enqueue_script('vue_wordpress.js', get_template_directory_uri() . '/dist/vue-wordpress.js', array(), $ver, true );
// Enable For Development - Remove for Production
// wp_enqueue_script( 'vue_wordpress.js', 'http://localhost:8085/vue-wordpress.js', array(), $ver, true );
```

3. 
```bash
npm run build
```

## Структура проекта
```
vue-wp-theme/
├── dist/            # Статические файлы JS и CSS
├── functions/       # Файлы функций шаблона
├── template-parts/  # PHP Шаблоны темы
├── src/             # Исходный код Vue.js
│   ├── api/         # API 
│   ├── components/  # Vue.js компоненты
│   ├── app.js       # Главный компонент
│   ├── App.vue      # Главный компонент
│   └── input.css    # Входной файл CSS для TailwindCSS
├── postcss.config.js       # Конфигурация PostCSS
├── tailwind.config.js      # Конфигурация TailwindCSS
├── webpack.dev.config.js   # Конфигурация Webpack для разработки
├── webpack.prod.config.js  # Конфигурация Webpack для релиза
└── package.json     # Зависимости проекта
```

## Использование REST API Data Localizer
* **REST API Data Localizer** — встроенная система для работы с локализацией данных через REST API.
* * https://gitverse.ru/solj/rest-api-data-localizer (submodule)
* * https://github.com/bshiluk/rest-api-data-localizer

## Работа с кастомными типами записей и полями
Для управления типами записей и произвольными полями доступны следующие варианты:
* Нативная настройка через `functions.php`.
* Рекомендованный способ — использование плагина ACF (Advanced Custom Fields) для упрощения работы с контентом.
* * https://ru.wordpress.org/plugins/advanced-custom-fields/

## Настройка Tailwind CSS
Для кастомизации стилей и создания собственных утилит используйте конфигурационный файл: `tailwind.config.js`.

## Поддержка и вопросы
* Создавайте issue для сообщения об ошибках, вопросов и предложений
* Открыты к pull-реквестам

## Лицензия
Проект распространяется под лицензией MIT. Смотрите файл LICENSE для деталей.

## Зависимости
* **Vue.js 3** - https://vuejs.org
* **Tailwind CSS** - https://tailwindcss.com
* **REST API Data Localizer** - https://gitverse.ru/solj/rest-api-data-localizer
* **Webpack** - https://webpack.js.org
* **WordPress** - https://wordpress.org
