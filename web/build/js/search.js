
function setEmails() {
    let $emails = $('#search-results input[name="emails"]:checked').map(function(){return $(this).val();}).get();

    sessionStorage.setItem('emails', JSON.stringify($emails));
    localStorage.setItem('emails', JSON.stringify($emails));
    $.ajax({
        type: "POST",
        url: window.location.href + "saveEmails",
        data: {
            emails: $emails
        },
        dataType: "json"
    });

    console.log(sessionStorage.getItem('emails'));
}


