# To call a select component

```javascript
success: function (res) {
const data = JSON.parse(res);
const select = {
label: "Módulos",
id: "modul",
};
const options = data.data.map((item) => {
return {
text: item.nombre,
value: item.id_modulo,
};
});
$.get(
"/src/views/partials/components/check_list.mustache",
function (template) {
const rendered_moduls = Mustache.render(template, {
select: select,
options: options,
});
modul_rendered.html(rendered_moduls);
modul = $("#modul");
},
);
},
```
