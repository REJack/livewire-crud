# Livewire CRUD ToDo

- table view
    - [x] Main Table View (index)
    - [x] Table Row
- Form Builder
    - [ ] Support for all default Table Column Types
    - [ ] Grid Support
- add view
    - [ ] page
    - [ ] modal
- show view
    - [ ] page
    - [ ] modal
- create/edit views
    - [ ] page
    - [ ] modal
- [ ] delete modal

## Extras

- [ ] form builder
    - [ ] ability to replace form builder with own blade template
- [ ] clickable rows
- [ ] bulk action
- [x] filters
    - working example from livewire tables docs
        - https://rappasoft.com/docs/laravel-livewire-tables/v1/filters/creating-filters
- [ ] export

## Docs Stuff prep

Add these two line in your app.blade.php to enable notifications and/or dialogs

```html

<x-notifications z-index="z-60"/>
<x-dialog z-index="z-50" align="center"/>
```

For Tailwind JIT you need to add these lines to your content section.

```js
content: [
    './vendor/rejack/livewire-crud/resources/views/**/*.blade.php',
    ...,
    './app/Services/*.php',
    './app/Services/**/*.php'
],
```
