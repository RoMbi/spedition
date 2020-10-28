jQuery(document).ready(function () {
    disable13($('.new-relation').find($("[id$='_fromLocations']")));
    disable13($('.new-relation').find($("[id$='_destinations']")));

    $('.add_destination_link').click(function () {
        disable13($(this).parent().prev('.new-relation').find($("[id$='_fromLocations']")));
        disable13($(this).parent().prev('.new-relation').find($("[id$='_destinations']")));
    });

    $('form[name="appbundle_carriercustomer_secondtype"]')
        .bind('submit', function () {
            $(this).find('option').prop('disabled', false);
        });
});

function disable13($select) {
    $select.find('option')
        .slice(0, 14)
        .each(function () {
            $(this).prop('disabled', true);
        })
        .trigger("chosen:updated");
}
