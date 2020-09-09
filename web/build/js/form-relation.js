// setup an "add a tag" link
var $addDestinationLink = $('<button class="add_destination_link btn-primary btn btn-block btn-flat">Dodaj kolejną relację</button>');
var $newDestinationLink = $('<div class="form-row col-sm-12"></div>').append($addDestinationLink);
var $destinationMultiselectConfig = {
    nonSelectedText: 'Wybierz cele',
    nSelectedText: 'destynacje',
    allSelectedText: 'Wszystkie destynacje',
    buttonWidth: '100%',
    wrapElement: '<span class="multiselect-native-select col-sm-6" />',
    buttonClass: 'form-control text-nowrap',
    enableFiltering: true,
    filterBehavior: 'text',
    filterPlaceholder: 'Szukaj...',
    includeFilterClearBtn: false,
    maxHeight: 150,
    templates: {
        filter: '<li class="multiselect-item multiselect-filter"><input class="form-control multiselect-search" type="text" /></li>',

    }
};

var validationMessageFix = {
    "position": "absolute",
    "z-index": "-1",
    "opacity": "0",
    "height": "35px"
};

var $chosenGlobalConfig = {
    max_shown_results: 14,
    no_results_text: "Brak wyników: "
};
jQuery(document).ready(function () {
    // Get the ul that holds the collection of tags
    var $destinationAdd = $('div.relation-add');
    var $fromAdd = $('div.relation-add');
    var $destinationCollection = $('div.relations');
    var $fromCollection = $('div.relations');

    // add the "add a tag" anchor and li to the tags ul
    $destinationAdd.append($newDestinationLink);
    $fromAdd.append($newDestinationLink);

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $destinationCollection.data('index', $destinationCollection.find(':input.form-control').length);
    $fromCollection.data('index', $fromCollection.find(':input.form-control').length);

    $addDestinationLink.on('click', function (e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // add a new tag form (see code block below)
        addRelationForm($destinationCollection, $addDestinationLink);
    });

    $('.remove-tag').click(function (e) {
        e.preventDefault();

        $(this).closest('.form-row').remove();

        return false;
    });

    $('.new-relation').find($("[id$='_fromLocations']")).chosen($chosenGlobalConfig).show().css(validationMessageFix);
    $('.new-relation').find($("[id$='_destinations']")).chosen($chosenGlobalConfig).show().css(validationMessageFix).css({"right": 0});
});

function addRelationForm($collectionHolder, $newLinkLi) {
    // Get the data-prototype explained earlier
    var prototype = $collectionHolder.find('.relation-add').data('prototype');

    // get the new index
    var index = $collectionHolder.data('index');

    // Replace '$$name$$' in the prototype's HTML to
    // instead be a number based on how many items we have
    var newForm = prototype.replace(/__name__/g, index);

    // increase the index with one for the next item
    $collectionHolder.data('index', index + 1);

    // Display the form in the page in an li, before the "Add a tag" link li
    // var $newFormLi = $('<div class="form-row new-destination"></div>').append(newForm);

    // also add a remove button, just for this example
    // $newFormLi.append('<div class="col-sm-4"><button class="remove-tag btn-outline-danger btn btn-block btn-flat">Usuń</button></div>');

    var $addButton = $newLinkLi.parent().before(newForm);

    $addButton.prev('.new-relation').find($("[id$='_fromLocations']")).chosen($chosenGlobalConfig).show().css(validationMessageFix);
    $addButton.prev('.new-relation').find($("[id$='_destinations']")).chosen($chosenGlobalConfig).show().css(validationMessageFix).css({"right": 0});
    // handle the removal, just for this example
    $('.remove-tag').click(function (e) {
        e.preventDefault();

        $(this).closest('.form-row').remove();
        validateRelations();

        return false;
    });

    validateRelations();
}

function validateRelations() {
    var relationCount = $('.new-relation').length;
    if (relationCount === 0) {
        $('#appbundle_carriercustomer_secondtype_submit')
            .attr({
                'disabled': 'disabled',
                'pointer-events': 'none'
            });
        $('.add_destination_link').attr({
            'data-toggle': 'tooltip',
            'title': 'Proszę podać przynajmniej jedną relację.'
        }).tooltip({placement: 'bottom', trigger: 'manual'}).tooltip('show');
    } else {
        $('#appbundle_carriercustomer_secondtype_submit').unwrap('.disabled-tooltip').removeAttr('disabled');
        $('.add_destination_link').removeAttr('data-toggle title data-original-title').tooltip('hide').tooltip('dispose');
    }
}