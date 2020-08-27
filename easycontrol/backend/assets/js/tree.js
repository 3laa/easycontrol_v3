//https://symfony.com/doc/master/bundles/FOSJsRoutingBundle/usage.html
let $sidebarTree = $('.sidebar-tree');
let sidebarTree = '.sidebar-tree';
let $accordionItem = $('.sidebar-tree .accordion-tree .accordion-item');
let accordionItem = '.sidebar-tree .accordion-tree .accordion-item';
let $accordionItemEvent = $('.sidebar-tree .accordion-tree .accordion-item .-event');

function initItemContextMenu() {
    $accordionItemEvent.on('click', function (event){
        let treeType = $(this).parents(sidebarTree).data('type');
        let accordionItemId = $(this).parents(accordionItem).data('id');
        let eventType = $(this).data('event');
        let eventFunction = eventType + 'Item';
        window[eventFunction](treeType, accordionItemId);
    });
}

function addItem(treeType, accordionItemId) {
    console.log('start addItem function');
    console.log(treeType, accordionItemId);
}

function deleteItem(treeType, accordionItemId) {
    console.log('start deleteItem function');
    console.log(treeType, accordionItemId);
}

function activeItem(treeType, accordionItemId) {
    console.log('start activeItem function');
    console.log(treeType, accordionItemId);
    if(treeType == 'website') {
        axios.get(Routing.generate("backend_page_update-active", {page: accordionItemId}));
    }

}

$(document).ready(function () {
    initItemContextMenu();
});

if (document.readyState === 'complete') {

} else {
    $(window).on('load', function () {

    });
}

$(window).resize(function () {

});

$(window).scroll(function () {

});