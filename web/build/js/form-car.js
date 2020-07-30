// setup an "add a tag" link
var $addCarLink = $('<button class="add_car_link btn-primary btn btn-block btn-flat">Dodaj kolejny rodzaj pojazdu</button>');
var $newLinkLi = $('<div class="form-row col-sm-12"></div>').append($addCarLink);
var $equipmentMultiselectConfig = {
    nonSelectedText: 'Brak wyposażenia',
    nSelectedText: 'wyposażenie',
    allSelectedText: 'Pełne wyposażenie',
    buttonWidth: '100%',
    wrapElement: '<span class="multiselect-native-select col-sm-2" />',
    buttonClass: 'form-control text-nowrap',
};

jQuery(document).ready(function () {
    // Get the ul that holds the collection of tags
    var $collectionAdd = $('div.car-add');
    var $collectionHolder = $('div.cars');

    // add the "add a tag" anchor and li to the tags ul
    $collectionAdd.append($newLinkLi);

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionHolder.data('index', $collectionHolder.find(':input.form-control').length);

    $addCarLink.on('click', function (e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // add a new tag form (see code block below)
        addCarForm($collectionHolder, $addCarLink);
    });

    // handle the removal
    $('.remove-tag').click(function (e) {
        e.preventDefault();

        $(this).closest('.form-row').remove();

        return false;
    });
    $('.new-car').find($("[id$='_equipments']")).multiselect($equipmentMultiselectConfig);
    $('.new-car').find('[data-toggle="tooltip"]').tooltip();
});

function addCarForm($collectionHolder, $newLinkLi) {
    // Get the data-prototype explained earlier
    var prototype = $collectionHolder.find('.car-add').data('prototype');

    // get the new index
    var index = $collectionHolder.data('index');

    // Replace '$$name$$' in the prototype's HTML to
    // instead be a number based on how many items we have
    var newForm = prototype.replace(/__name__/g, index);

    // increase the index with one for the next item
    $collectionHolder.data('index', index + 1);

    // Display the form in the page in an li, before the "Add a tag" link li
    // var $newFormLi = $('<div class="form-row new-car"></div>').append(newForm);

    // also add a remove button, just for this example
    // $newFormLi.append('<div class="col-sm-1"><button class="remove-tag btn btn-block btn-outline-danger">Usuń</button></div>');

    var $addButton = $newLinkLi.parent().before(newForm);

    $addButton.prev('.new-car').find($("[id$='_equipments']")).multiselect($equipmentMultiselectConfig);
    $addButton.prev('.new-car').find('[data-toggle="tooltip"]').tooltip();
    // handle the removal, just for this example
    $('.remove-tag').click(function (e) {
        e.preventDefault();

        $(this).closest('.new-car').remove();

        return false;
    });
}