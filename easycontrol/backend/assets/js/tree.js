let sidebarTree = '.sidebar .sidebar-tree';
let $sidebarTree = $(sidebarTree);
let treeListUl = '.sidebar .sidebar-tree ul.tree-list';
let $treeListUl = $(treeListUl);
let listItemLi = '.sidebar .sidebar-tree ul.tree-list > li.list-item';
let $listItemLi = $(listItemLi);
let action = '.sidebar .sidebar-tree ul.tree-list > li.list-item .-action';
let $action = $(action);
let toggle = '.sidebar .sidebar-tree ul.tree-list > li.list-item > .item-options > .icon-toggle.item-icon';
let $toggle = $(toggle);


// Routing
let pageAdd = "backend_page_add-json";
let categoryAdd = "backend_category_add-json";
let pageUpdateName = "backend_page_update-name-json";
let categoryUpdateName = "backend_category_update-name-json";
let pageDelete = "backend_page_delete-json";
let categoryDelete = "backend_category_delete-json";
let pageUpdateActive = "backend_page_update-active-json";
let categoryUpdateActive = "backend_category_update-active-json";
let pageUpdateSort = "backend_page_update-sort-json";
let categoryUpdateSort = "backend_category_update-sort-json";


function initActions() {
    $action.on('click', function () {
        let treeType = $(this).parents(sidebarTree).data('type');
        let listItemId = $(this).data('id');
        let action = $(this).data('action');
        let $listItemParent = $(this).parents(listItemLi + '[data-id="' + listItemId + '"]');
        window[action + 'Action'](treeType, listItemId, $listItemParent, $(this));
    });
}

function addAction(treeType, listItemId, $listItemParent, $this) {
    window.top.addActionCall(treeType, listItemId, $listItemParent, $this);
}

function addActionCall(treeType, listItemId, $listItemParent, $this) {
    swal({
        title: "Add New Item:",
        content: {element: "input"}
    })
        .then((value) => {
            if (value) {
                let newItemFormData = new FormData();
                newItemFormData.set('name', value);
                newItemFormData.set('parent', listItemId);
                let route = '';

                if (treeType == 'website') {
                    route = Routing.generate(pageAdd);
                } else if (treeType == 'shop') {
                    route = Routing.generate(categoryAdd);
                }

                axios.post(route, newItemFormData)
                    .then(function (response) {
                        if (response.status) {
                            location.reload()
                        }
                    });
            }
        });
}

function editAction(treeType, listItemId, $listItemParent, $this) {
    window.top.editActionCall(treeType, listItemId, $listItemParent, $this);
}

function editActionCall(treeType, listItemId, $listItemParent, $this) {
    swal({
        title: "Edit:",
        content: {
            element: "input",
            attributes: {
                value: $listItemParent.find('.item-title').html()
            }
        }
    }).then((value) => {
        if (value) {
            let newItemFormData = new FormData();
            newItemFormData.set('name', value);
            let route = '';

            if (treeType == 'website') {
                route = Routing.generate(pageUpdateName, {page: listItemId});
            } else if (treeType == 'shop') {
                route = Routing.generate(categoryUpdateName, {category: listItemId});
            }

            axios.post(route, newItemFormData)
                .then(function (response) {
                    if (response.status) {
                        $listItemParent.find('.item-title').html(value)
                    }
                });
        }
    });
}

function deleteAction(treeType, listItemId, $listItemParent, $this) {
    window.top.deleteActionCall(treeType, listItemId, $listItemParent, $this);
}

function deleteActionCall(treeType, listItemId, $listItemParent, $this) {
    swal({
        title: "Delete",
        text: "Do you want to delete this Item  ",
        icon: "warning",
        buttons: true,
        dangerMode: true
    }).then((willDelete) => {
        if (willDelete) {
            let route = '';
            if (treeType == 'website') {
                route = Routing.generate(pageDelete, {page: listItemId});
            } else if (treeType == 'shop') {
                route = Routing.generate(categoryDelete, {category: listItemId});
            }

            axios.delete(route)
                .then(function (response) {
                    if(response.status) {
                        $listItemParent.remove();
                    }
                });
        }
    });
}

function activeAction(treeType, listItemId, $listItemParent, $this) {
    window.top.activeActionCall(treeType, listItemId, $listItemParent, $this);
}

function activeActionCall(treeType, listItemId, $listItemParent, $this) {
    let route = '';
    if (treeType == 'website') {
        route = Routing.generate(pageUpdateActive, {page: listItemId});
    } else if (treeType == 'shop') {
        route = Routing.generate(categoryUpdateActive, {category: listItemId});
    }

    axios.get(route)
        .then(function (response) {
            if(response.status) {
                if($this.html() == 'visibility_off') {
                    $this.html('visibility');
                } else {
                    $this.html('visibility_off');
                }
            }
        });
}

function initSort() {
    $treeListUl.sortable({
        cursor: "move",
        forceHelperSize: true,
        forcePlaceholderSize: true,
        handle: ".icon-sort",
        opacity: 0.2,
        placeholder: "ui-sortable-placeholder",
        revert: true,
        tolerance: "pointer",
        stop: function( event, ui ) {
            sortTree(event, ui);
        }
    });
    $treeListUl.disableSelection();
}

function sortTree(event, ui) {
    let list = ui.item.parent();
    let newSortFormData = new FormData();
    let counter = 0;
    list.children('li').each(function (index, item) {
        newSortFormData.set('item['+counter+'][id]',$(item).data('id'));
        newSortFormData.set('item['+counter+'][sort]',index);
        counter++;
    });

    let treeType = list.parents(sidebarTree).data('type');
    let route = '';
    if (treeType == 'website') {
        route = Routing.generate(pageUpdateSort);
    } else if (treeType == 'shop') {
        route = Routing.generate(categoryUpdateSort);
    }

    axios.post(route, newSortFormData)
        .then(function (response) {
            if(response.status) {
                console.log(response.data);
            }
        });;
}

function initOnToggleClick() {
    $toggle.on('click', function () {
        let $itemContent = $(this).parents('.sidebar .sidebar-tree ul.tree-list > li.list-item > .item-options').next('.item-content.collapse');
        if($itemContent.hasClass('show')) {
            $(this).removeClass('show');
        } else {
            $(this).addClass('show');
        }
    });
}

$(document).ready(function () {
    initActions();
    initSort();
    initOnToggleClick();
});