var $chosenGlobalConfig = {
    max_shown_results: 14,
    no_results_text: "Wciśnij ENTER aby dodać:"
};

jQuery(document).ready(function () {
    let select = $('#appbundle_carrier_tags');
    select.chosen($chosenGlobalConfig);
    select.trigger("chosen:updated");
    let chosen = $(select).parent().find('.chosen-container');
    // Bind the keyup event to the search box input
    chosen.find('input').keyup(function(e)
    {
        // if we hit Enter and the results list is empty (no matches) add the option
        if (e.which === 13 && chosen.find('li.no-results').length > 0)
        {
            let option = $("<option>").val(this.value).text(this.value);

            // add the new option
            select.prepend(option);
            // automatically select it
            select.find(option).prop('selected', true);
            // trigger the update
            select.trigger("chosen:updated");

            let url = window.location.href.substring( 0, window.location.href.indexOf( "carrier/" ) );
            $.ajax({
                type: "POST",
                url: url + "carrier/addTag",
                data: {
                    tag: option.val()
                },
                dataType: "json",
                success: function (response) {
                    option.val(response.tagId)
                }
            });
        }
    });
});
