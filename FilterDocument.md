# Filter Example to productos section

This is a document about how to implement a filter to product's Kinub
using some filters.

## Routes

In this example there are the following routes to test what has been implemented so far.

This a example view with the searchbar and the selects

| Route                    | Description                                                                                                                                                                                   |
| ------------------------ | --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| `/filtro/productos/test` | This a example view with the searchbar and the selects                                                                                                                                        |
| `/filtro/productos`      | This is an endpoint for the product filter api that receives via a JSON the product name, the category id and the id of the category tags and returns the product name                        |
| `/filtro/productos/tags` | This is an endpoint for the product filter api that receives via a JSON the product name, the category id and the id of the category tags and returns the tags ssociated with the category id |

## Plugins

- [Pager](https://github.com/nhn/tui.pagination)
- [Searchbar autocomplete](https://tarekraafat.github.io/autoComplete.js/#/)
- [Selects](https://choices-js.github.io/Choices/)
