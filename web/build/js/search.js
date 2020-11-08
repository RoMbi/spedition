let $carTypeMultiselectConfig = {
    nonSelectedText: 'Dowolny rodzaj',
    nSelectedText: 'rodzaj',
    allSelectedText: 'Wszystkie rodzaje',
    buttonWidth: '100%',
    wrapElement: '<span class="multiselect-native-select col-sm-2" />',
    buttonClass: 'form-control text-nowrap',
};

jQuery(document).ready(function () {
    $('#sendMailButton').one('click', function () {
        $('div.fr-element.fr-view').prepend(mailTemplate);
    });

    $('#appbundle_carriersearch_type').multiselect($carTypeMultiselectConfig);
});


function setEmails() {
    let $emails = $('#search-results input[name="emails"]:checked').map(function () {
        return $(this).val();
    }).get();

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

let mailTemplate = '<div style="margin:0;padding:0;background-color:#d8d8d8">' +
    '    <table bgcolor="#d8d8d8" cellpadding="0" cellspacing="0"' +
    '           style="table-layout:fixed;vertical-align:top;min-width:320px;border-spacing:0;border-collapse:collapse;background-color:#d8d8d8;width:100%"' +
    '           valign="top" width="100%">' +
    '        <tbody>' +
    '        <tr style="vertical-align:top" valign="top">' +
    '            <td style="word-break:break-word;vertical-align:top" valign="top">' +
    '                <div style="background-color:transparent">' +
    '                    <div style="min-width:320px;max-width:600px;word-wrap:break-word;word-break:break-word;Margin:0 auto;background-color:transparent">' +
    '                        <div style="border-collapse:collapse;display:table;width:100%;background-color:transparent">' +
    '                            <div style="min-width:320px;max-width:600px;display:table-cell;vertical-align:top;width:600px">' +
    '                                <div style="width:100%!important">' +
    '                                    <div style="border-top:0px solid transparent;border-left:0px solid transparent;border-bottom:0px solid transparent;border-right:0px solid transparent;padding-top:15px;padding-bottom:15px;padding-right:0px;padding-left:0px">' +
    '                                        <table border="0" cellpadding="0" cellspacing="0"' +
    '                                               style="table-layout:fixed;vertical-align:top;border-spacing:0;border-collapse:collapse;min-width:100%"' +
    '                                               valign="top" width="100%">' +
    '                                            <tbody>' +
    '                                            <tr style="vertical-align:top" valign="top">' +
    '                                                <td style="word-break:break-word;vertical-align:top;min-width:100%;padding-top:10px;padding-right:0px;padding-bottom:10px;padding-left:0px"' +
    '                                                    valign="top">' +
    '                                                    <table align="center" border="0" cellpadding="0" cellspacing="0"' +
    '                                                           height="0"' +
    '                                                           style="table-layout:fixed;vertical-align:top;border-spacing:0;border-collapse:collapse;border-top:0px solid transparent;height:0px;width:100%"' +
    '                                                           valign="top" width="100%">' +
    '                                                        <tbody>' +
    '                                                        <tr style="vertical-align:top" valign="top">' +
    '                                                            <td height="0"' +
    '                                                                style="word-break:break-word;vertical-align:top"' +
    '                                                                valign="top"><span></span></td>' +
    '                                                        </tr>' +
    '                                                        </tbody>' +
    '                                                    </table>' +
    '                                                </td>' +
    '                                            </tr>' +
    '                                            </tbody>' +
    '                                        </table>' +
    '                                    </div>' +
    '                                </div>' +
    '                            </div>' +
    '                        </div>' +
    '                    </div>' +
    '                </div>' +
    '                <div style="background-color:transparent">' +
    '                    <div style="min-width:320px;max-width:600px;word-wrap:break-word;word-break:break-word;Margin:0 auto;background-color:transparent">' +
    '                        <div style="border-collapse:collapse;display:table;width:100%;background-color:transparent">' +
    '                            <div style="display:table-cell;vertical-align:top;min-width:320px;max-width:400px;background-color:#ffffff;width:400px">' +
    '                                <div style="width:100%!important">' +
    '                                    <div style="border-top:5px solid #2b6aa1;border-left:0px solid transparent;border-bottom:0px solid transparent;border-right:0px solid transparent;padding-top:5px;padding-bottom:5px;padding-right:10px;padding-left:10px">' +
    '                                        <div align="left" style="padding-right:15px;padding-left:15px">' +
    '                                            <div style="font-size:1px;line-height:15px">&nbsp;</div>' +
    '                                            <a href="https://lforce.pl" style="outline:none" target="_blank"> <img' +
    '                                                    alt="LFORCE LOGO" border="0"' +
    '                                                    src="https://lforce.pl/wp-content/uploads/2015/11/logo_lforce1.png"' +
    '                                                    style="text-decoration:none;height:auto;border:0;width:100%;max-width:171px;display:block"' +
    '                                                    title="LFORCE LOGO" width="171"></a>' +
    '                                            <div style="font-size:1px;line-height:10px">&nbsp;</div>' +
    '                                        </div>' +
    '                                    </div>' +
    '                                </div>' +
    '                            </div>' +
    '                            <div style="display:table-cell;vertical-align:top;max-width:320px;min-width:200px;background-color:#ffffff;width:200px">' +
    '                                <div style="width:100%!important">' +
    '                                    <div style="border-top:5px solid #2b6aa1;border-left:0px solid transparent;border-bottom:0px solid transparent;border-right:0px solid transparent;padding-top:5px;padding-bottom:5px;padding-right:5px;padding-left:5px">' +
    '                                        <div style="color:#ffffff;font-family:\'Lato\',Tahoma,Verdana,Segoe,sans-serif;line-height:1.5;padding-top:23px;padding-right:23px;padding-bottom:23px;padding-left:23px">' +
    '                                            <div style="line-height:1.5;font-size:12px;color:#ffffff;font-family:\'Lato\',Tahoma,Verdana,Segoe,sans-serif">' +
    '                                                <p style="font-size:12px;line-height:1.5;word-break:break-word;text-align:right;margin:0">' +
    '                                                    <span style="font-size:12px"><a href="https://lforce.pl/"' +
    '                                                                                    rel="noopener"' +
    '                                                                                    style="text-decoration:underline;color:#2b6aa1"' +
    '                                                                                    title="https://lforce.pl/"' +
    '                                                                                    target="_blank">ODWIEDŹ NAS ONLINE</a></span>' +
    '                                                </p></div>' +
    '                                        </div>' +
    '                                    </div>' +
    '                                </div>' +
    '                            </div>' +
    '                        </div>' +
    '                    </div>' +
    '                </div>' +
    '                <div style="background-color:transparent">' +
    '                    <div style="min-width:320px;max-width:600px;word-wrap:break-word;word-break:break-word;Margin:0 auto;background-color:transparent">' +
    '                        <div style="border-collapse:collapse;display:table;width:100%;background-color:transparent">' +
    '                            <div style="min-width:320px;max-width:600px;display:table-cell;vertical-align:top;background-color:#ffffff;width:600px">' +
    '                                <div style="width:100%!important">' +
    '                                    <div style="border-top:0px solid transparent;border-left:0px solid transparent;border-bottom:0px solid transparent;border-right:0px solid transparent;padding-top:0px;padding-bottom:0px;padding-right:0px;padding-left:0px">' +
    '                                        <table border="0" cellpadding="0" cellspacing="0"' +
    '                                               style="table-layout:fixed;vertical-align:top;border-spacing:0;border-collapse:collapse;min-width:100%"' +
    '                                               valign="top" width="100%">' +
    '                                            <tbody>' +
    '                                            <tr style="vertical-align:top" valign="top">' +
    '                                                <td style="word-break:break-word;vertical-align:top;min-width:100%;padding-top:10px;padding-right:0px;padding-bottom:10px;padding-left:0px"' +
    '                                                    valign="top">' +
    '                                                    <table align="center" border="0" cellpadding="0" cellspacing="0"' +
    '                                                           style="table-layout:fixed;vertical-align:top;border-spacing:0;border-collapse:collapse;border-top:2px solid #2b6aa1;width:95%"' +
    '                                                           valign="top" width="95%">' +
    '                                                        <tbody>' +
    '                                                        <tr style="vertical-align:top" valign="top">' +
    '                                                            <td style="word-break:break-word;vertical-align:top"' +
    '                                                                valign="top"><span></span></td>' +
    '                                                        </tr>' +
    '                                                        </tbody>' +
    '                                                    </table>' +
    '                                                </td>' +
    '                                            </tr>' +
    '                                            </tbody>' +
    '                                        </table>' +
    '                                    </div>' +
    '                                </div>' +
    '                            </div>' +
    '                        </div>' +
    '                    </div>' +
    '                </div>' +
    '                <div style="background-color:transparent">' +
    '                    <div style="min-width:320px;max-width:600px;word-wrap:break-word;word-break:break-word;Margin:0 auto;background-color:transparent">' +
    '                        <div style="border-collapse:collapse;display:table;width:100%;background-color:transparent">' +
    '                            <div style="display:table-cell;vertical-align:top;max-width:320px;min-width:300px;background-color:#ffffff;width:300px">' +
    '                                <div style="width:100%!important">' +
    '                                    <div style="border-top:0px solid transparent;border-left:0px solid transparent;border-bottom:0px solid transparent;border-right:0px solid transparent;padding-top:5px;padding-bottom:5px;padding-right:5px;padding-left:5px">' +
    '                                        <div style="color:#3c3c3c;font-family:\'Lato\',Tahoma,Verdana,Segoe,sans-serif;line-height:1.8;padding-top:0px;padding-right:10px;padding-bottom:0px;padding-left:20px">' +
    '                                            <div style="line-height:1.8;font-size:12px;font-family:\'Lato\',Tahoma,Verdana,Segoe,sans-serif;color:#3c3c3c">' +
    '                                                <p style="line-height:1.8;word-break:break-word;font-family:Lato,Tahoma,Verdana,Segoe,sans-serif;margin:0">' +
    '                                                    <strong><span' +
    '                                                            style="font-size:22px;color:#2b6aa1"><span>DZIEŃ DOBRY</span></span></strong>' +
    '                                                </p></div>' +
    '                                        </div>' +
    '                                        <div style="color:#555555;font-family:\'Lato\',Tahoma,Verdana,Segoe,sans-serif;line-height:1.2;padding-top:0px;padding-right:10px;padding-bottom:10px;padding-left:20px">' +
    '                                            <div style="line-height:1.2;font-size:12px;color:#555555;font-family:\'Lato\',Tahoma,Verdana,Segoe,sans-serif">' +
    '                                                <p style="line-height:1.2;word-break:break-word;font-size:20px;margin:0">' +
    '                                                    <span style="font-size:20px;color:#2b6aa1">mamy dostępny ładunek!</span>' +
    '                                                </p></div>' +
    '                                        </div>' +
    '                                    </div>' +
    '                                </div>' +
    '                            </div>' +
    '                            <div style="display:table-cell;vertical-align:top;max-width:320px;min-width:300px;background-color:#ffffff;width:300px">' +
    '                                <div style="width:100%!important">' +
    '                                    <div style="border-top:0px solid transparent;border-left:0px solid transparent;border-bottom:0px solid transparent;border-right:0px solid transparent;padding-top:5px;padding-bottom:5px;padding-right:0px;padding-left:0px">' +
    '                                        <div>' +
    '                                            <table border="0" cellpadding="0" cellspacing="0"' +
    '                                                   style="table-layout:fixed;vertical-align:top;border-spacing:0;border-collapse:collapse;min-width:100%"' +
    '                                                   valign="top" width="100%">' +
    '                                                <tbody>' +
    '                                                <tr style="vertical-align:top" valign="top">' +
    '                                                    <td style="word-break:break-word;vertical-align:top;min-width:100%;padding-top:41px;padding-right:26px;padding-bottom:26px;padding-left:26px"' +
    '                                                        valign="top">' +
    '                                                        <table align="center" border="0" cellpadding="0" cellspacing="0"' +
    '                                                               height="0"' +
    '                                                               style="table-layout:fixed;vertical-align:top;border-spacing:0;border-collapse:collapse;border-top:0px solid transparent;height:0px;width:100%"' +
    '                                                               valign="top" width="100%">' +
    '                                                            <tbody>' +
    '                                                            <tr style="vertical-align:top" valign="top">' +
    '                                                                <td height="0"' +
    '                                                                    style="word-break:break-word;vertical-align:top"' +
    '                                                                    valign="top"><span></span></td>' +
    '                                                            </tr>' +
    '                                                            </tbody>' +
    '                                                        </table>' +
    '                                                    </td>' +
    '                                                </tr>' +
    '                                                </tbody>' +
    '                                            </table>' +
    '                                        </div>' +
    '                                    </div>' +
    '                                </div>' +
    '                            </div>' +
    '                        </div>' +
    '                    </div>' +
    '                </div>' +
    '                <div style="background-color:transparent">' +
    '                    <div style="min-width:320px;max-width:600px;word-wrap:break-word;word-break:break-word;Margin:0 auto;background-color:transparent">' +
    '                        <div style="border-collapse:collapse;display:table;width:100%;background-color:transparent">' +
    '                            <div style="display:table-cell;vertical-align:top;max-width:320px;min-width:200px;background-color:#ffffff;width:200px">' +
    '                                <div style="width:100%!important">' +
    '                                    <div style="border-top:0px solid transparent;border-left:0px solid transparent;border-bottom:0px solid transparent;border-right:0px solid transparent;padding-top:5px;padding-bottom:5px;padding-right:0px;padding-left:0px">' +
    '                                        <div style="color:#555555;font-family:\'Lato\',Tahoma,Verdana,Segoe,sans-serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:25px">' +
    '                                            <div style="line-height:1.2;font-size:12px;color:#555555;font-family:\'Lato\',Tahoma,Verdana,Segoe,sans-serif">' +
    '                                                <p style="font-size:14px;line-height:1.2;word-break:break-word;margin:0">' +
    '                                                    <strong><span' +
    '                                                            style="font-size:14px">miejsce załadunku:</span></strong>' +
    '                                                </p></div>' +
    '                                        </div>' +
    '                                        <div style="color:#555555;font-family:\'Lato\',Tahoma,Verdana,Segoe,sans-serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:25px">' +
    '                                            <div style="line-height:1.2;font-size:12px;color:#555555;font-family:\'Lato\',Tahoma,Verdana,Segoe,sans-serif">' +
    '                                                <p style="font-size:14px;line-height:1.2;word-break:break-word;margin:0">' +
    '                                                    <span style="font-size:14px">czas załadunku:</span></p></div>' +
    '                                        </div>' +
    '                                        <div style="color:#555555;font-family:\'Lato\',Tahoma,Verdana,Segoe,sans-serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:25px">' +
    '                                            <div style="line-height:1.2;font-size:12px;color:#555555;font-family:\'Lato\',Tahoma,Verdana,Segoe,sans-serif">' +
    '                                                <p style="font-size:14px;line-height:1.2;word-break:break-word;margin:0">' +
    '                                                    <strong>miejsce rozładunku:</strong></p></div>' +
    '                                        </div>' +
    '                                        <div style="color:#555555;font-family:\'Lato\',Tahoma,Verdana,Segoe,sans-serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:25px">' +
    '                                            <div style="line-height:1.2;font-size:12px;color:#555555;font-family:\'Lato\',Tahoma,Verdana,Segoe,sans-serif">' +
    '                                                <p style="font-size:14px;line-height:1.2;word-break:break-word;margin:0">' +
    '                                                    czas rozładunku:</p></div>' +
    '                                        </div>' +
    '                                        <div style="color:#555555;font-family:\'Lato\',Tahoma,Verdana,Segoe,sans-serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:25px">' +
    '                                            <div style="line-height:1.2;font-size:12px;color:#555555;font-family:\'Lato\',Tahoma,Verdana,Segoe,sans-serif">' +
    '                                                <p style="font-size:14px;line-height:1.2;word-break:break-word;margin:0">' +
    '                                                    towar:</p></div>' +
    '                                        </div>' +
    '                                        <div style="color:#555555;font-family:\'Lato\',Tahoma,Verdana,Segoe,sans-serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:25px">' +
    '                                            <div style="line-height:1.2;font-size:12px;color:#555555;font-family:\'Lato\',Tahoma,Verdana,Segoe,sans-serif">' +
    '                                                <p style="font-size:14px;line-height:1.2;word-break:break-word;margin:0">' +
    '                                                    rodzaj transportu:</p></div>' +
    '                                        </div>' +
    '                                        <div style="color:#555555;font-family:\'Lato\',Tahoma,Verdana,Segoe,sans-serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:25px">' +
    '                                            <div style="line-height:1.2;font-size:12px;color:#555555;font-family:\'Lato\',Tahoma,Verdana,Segoe,sans-serif">' +
    '                                                <p style="font-size:14px;line-height:1.2;word-break:break-word;margin:0">' +
    '                                                    cena:</p></div>' +
    '                                        </div>' +
    '                                    </div>' +
    '                                </div>' +
    '                            </div>' +
    '                            <div style="display:table-cell;vertical-align:top;min-width:320px;max-width:400px;background-color:#ffffff;width:400px">' +
    '                                <div style="width:100%!important">' +
    '                                    <div style="border-top:0px solid transparent;border-left:0px solid transparent;border-bottom:0px solid transparent;border-right:0px solid transparent;padding-top:5px;padding-bottom:5px;padding-right:0px;padding-left:0px">' +
    '                                        <div style="color:#555555;font-family:\'Lato\',Tahoma,Verdana,Segoe,sans-serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px">' +
    '                                            <div style="line-height:1.2;font-size:12px;color:#555555;font-family:\'Lato\',Tahoma,Verdana,Segoe,sans-serif">' +
    '                                                <p style="font-size:14px;line-height:1.2;word-break:break-word;margin:0">' +
    '                                                    XXX</p></div>' +
    '                                        </div>' +
    '                                        <div style="color:#555555;font-family:\'Lato\',Tahoma,Verdana,Segoe,sans-serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px">' +
    '                                            <div style="line-height:1.2;font-size:12px;color:#555555;font-family:\'Lato\',Tahoma,Verdana,Segoe,sans-serif">' +
    '                                                <p style="font-size:14px;line-height:1.2;word-break:break-word;margin:0">' +
    '                                                    XXX</p></div>' +
    '                                        </div>' +
    '                                        <div style="color:#555555;font-family:\'Lato\',Tahoma,Verdana,Segoe,sans-serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px">' +
    '                                            <div style="line-height:1.2;font-size:12px;color:#555555;font-family:\'Lato\',Tahoma,Verdana,Segoe,sans-serif">' +
    '                                                <p style="font-size:14px;line-height:1.2;word-break:break-word;margin:0">' +
    '                                                    XXX</p></div>' +
    '                                        </div>' +
    '                                        <div style="color:#555555;font-family:\'Lato\',Tahoma,Verdana,Segoe,sans-serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px">' +
    '                                            <div style="line-height:1.2;font-size:12px;color:#555555;font-family:\'Lato\',Tahoma,Verdana,Segoe,sans-serif">' +
    '                                                <p style="font-size:14px;line-height:1.2;word-break:break-word;margin:0">' +
    '                                                    XXX</p></div>' +
    '                                        </div>' +
    '                                        <div style="color:#555555;font-family:\'Lato\',Tahoma,Verdana,Segoe,sans-serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px">' +
    '                                            <div style="line-height:1.2;font-size:12px;color:#555555;font-family:\'Lato\',Tahoma,Verdana,Segoe,sans-serif">' +
    '                                                <p style="font-size:14px;line-height:1.2;word-break:break-word;margin:0">' +
    '                                                    XXX</p></div>' +
    '                                        </div>' +
    '                                        <div style="color:#555555;font-family:\'Lato\',Tahoma,Verdana,Segoe,sans-serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px">' +
    '                                            <div style="line-height:1.2;font-size:12px;color:#555555;font-family:\'Lato\',Tahoma,Verdana,Segoe,sans-serif">' +
    '                                                <p style="font-size:14px;line-height:1.2;word-break:break-word;margin:0">' +
    '                                                    XXX</p></div>' +
    '                                        </div>' +
    '                                        <div style="color:#555555;font-family:\'Lato\',Tahoma,Verdana,Segoe,sans-serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px">' +
    '                                            <div style="line-height:1.2;font-size:12px;color:#555555;font-family:\'Lato\',Tahoma,Verdana,Segoe,sans-serif">' +
    '                                                <p style="font-size:14px;line-height:1.2;word-break:break-word;margin:0">' +
    '                                                    XXX</p></div>' +
    '                                        </div>' +
    '                                    </div>' +
    '                                </div>' +
    '                            </div>' +
    '                        </div>' +
    '                    </div>' +
    '                </div>' +
    '                <div style="background-color:transparent">' +
    '                    <div style="min-width:320px;max-width:600px;word-wrap:break-word;word-break:break-word;Margin:0 auto;background-color:transparent">' +
    '                        <div style="border-collapse:collapse;display:table;width:100%;background-color:transparent">' +
    '                            <div style="min-width:320px;max-width:600px;display:table-cell;vertical-align:top;background-color:#ffffff;width:600px">' +
    '                                <div style="width:100%!important">' +
    '                                    <div style="border-top:0px solid transparent;border-left:0px solid transparent;border-bottom:0px solid transparent;border-right:0px solid transparent;padding-top:10px;padding-bottom:10px;padding-right:0px;padding-left:0px">' +
    '                                        <table border="0" cellpadding="0" cellspacing="0"' +
    '                                               style="table-layout:fixed;vertical-align:top;border-spacing:0;border-collapse:collapse;min-width:100%"' +
    '                                               valign="top" width="100%">' +
    '                                            <tbody>' +
    '                                            <tr style="vertical-align:top" valign="top">' +
    '                                                <td style="word-break:break-word;vertical-align:top;min-width:100%;padding-top:10px;padding-right:0px;padding-bottom:10px;padding-left:0px"' +
    '                                                    valign="top">' +
    '                                                    <table align="center" border="0" cellpadding="0" cellspacing="0"' +
    '                                                           style="table-layout:fixed;vertical-align:top;border-spacing:0;border-collapse:collapse;border-top:2px solid #2b6aa1;width:95%"' +
    '                                                           valign="top" width="95%">' +
    '                                                        <tbody>' +
    '                                                        <tr style="vertical-align:top" valign="top">' +
    '                                                            <td style="word-break:break-word;vertical-align:top"' +
    '                                                                valign="top"><span></span></td>' +
    '                                                        </tr>' +
    '                                                        </tbody>' +
    '                                                    </table>' +
    '                                                </td>' +
    '                                            </tr>' +
    '                                            </tbody>' +
    '                                        </table>' +
    '                                    </div>' +
    '                                </div>' +
    '                            </div>' +
    '                        </div>' +
    '                    </div>' +
    '                </div>' +
    '                <div style="background-color:transparent">' +
    '                    <div style="min-width:320px;max-width:600px;word-wrap:break-word;word-break:break-word;Margin:0 auto;background-color:transparent">' +
    '                        <div style="border-collapse:collapse;display:table;width:100%;background-color:transparent">' +
    '                            <div style="min-width:320px;max-width:600px;display:table-cell;vertical-align:top;background-color:#ffffff;width:600px">' +
    '                                <div style="width:100%!important">' +
    '                                    <div style="border-top:0px solid transparent;border-left:0px solid transparent;border-bottom:0px solid transparent;border-right:0px solid transparent;padding-top:5px;padding-bottom:5px;padding-right:5px;padding-left:5px">' +
    '                                        <div style="color:#555555;font-family:\'Lato\',Tahoma,Verdana,Segoe,sans-serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:20px">' +
    '                                            <div style="line-height:1.2;font-size:12px;color:#555555;font-family:\'Lato\',Tahoma,Verdana,Segoe,sans-serif">' +
    '                                                <p style="text-align:left;line-height:1.2;word-break:break-word;font-size:20px;margin:0">' +
    '                                                    <span style="font-size:20px;color:#2b6aa1">ZAPRASZAMY DO KONTAKTU!</span>' +
    '                                                </p></div>' +
    '                                        </div>' +
    '                                        <div style="color:#555555;font-family:\'Lato\',Tahoma,Verdana,Segoe,sans-serif;line-height:1.5;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:20px">' +
    '                                            <div style="line-height:1.5;font-size:12px;color:#555555;font-family:\'Lato\',Tahoma,Verdana,Segoe,sans-serif">' +
    '                                                <p style="line-height:1.5;word-break:break-word;font-size:14px;margin:0">' +
    '                                                    <span style="font-size:14px"><strong>Łukasz Ujek</strong>: <a' +
    '                                                            href="mailto:l.ujek@lforce.pl?subject=Kontakt%20w%20sprawie%20zlecenia"' +
    '                                                            rel="noopener"' +
    '                                                            style="text-decoration:underline;color:#2b6aa1"' +
    '                                                            title="l.ujek@lforce.pl"' +
    '                                                            target="_blank">l.ujek@lforce.pl</a>, telefon:&nbsp;<a' +
    '                                                            rel="noopener"' +
    '                                                            style="text-decoration:underline;color:#2b6aa1"' +
    '                                                            title="tel:504376792">504 376 792</a>, trans ID: 663234-2</span>' +
    '                                                </p>' +
    '                                                <p style="line-height:1.5;word-break:break-word;font-size:14px;margin:0">' +
    '                                                    <span style="font-size:14px"><strong>Łukasz Ziarniak</strong>: <a' +
    '                                                            href="mailto:l.ziarniak@lforce.pl?subject=Kontakt%20w%20sprawie%20zlecenia"' +
    '                                                            rel="noopener"' +
    '                                                            style="text-decoration:underline;color:#2b6aa1"' +
    '                                                            title="l.ziarniak@lforce.pl" target="_blank">l.ziarniak@lforce.pl</a>, telefon:&nbsp;<a' +
    '                                                            rel="noopener"' +
    '                                                            style="text-decoration:underline;color:#2b6aa1"' +
    '                                                            title="tel:534244668">534 244 668</a>, trans ID: 663234-1</span>' +
    '                                                </p>' +
    '                                                <p style="line-height:1.5;word-break:break-word;font-size:14px;margin:0">' +
    '                                                    <span style="font-size:14px"><strong>Ewa Kozera</strong>: <a' +
    '                                                            href="mailto:office@lforce.pl?subject=Kontakt%20w%20sprawie%20zlecenia"' +
    '                                                            rel="noopener"' +
    '                                                            style="text-decoration:underline;color:#2b6aa1"' +
    '                                                            title="office@lforce.pl"' +
    '                                                            target="_blank">office@lforce.pl</a>, telefon: <a' +
    '                                                            rel="noopener"' +
    '                                                            style="text-decoration:underline;color:#2b6aa1"' +
    '                                                            title="tel:603040469">603 040 469</a>, trans ID: 663234-8</span>' +
    '                                                </p></div>' +
    '                                        </div>' +
    '                                    </div>' +
    '                                </div>' +
    '                            </div>' +
    '                        </div>' +
    '                    </div>' +
    '                </div>' +
    '                <div style="background-color:transparent">' +
    '                    <div style="min-width:320px;max-width:600px;word-wrap:break-word;word-break:break-word;Margin:0 auto;background-color:transparent">' +
    '                        <div style="border-collapse:collapse;display:table;width:100%;background-color:transparent">' +
    '                            <div style="min-width:320px;max-width:600px;display:table-cell;vertical-align:top;background-color:#ffffff;width:600px">' +
    '                                <div style="width:100%!important">' +
    '                                    <div style="border-top:0px solid transparent;border-left:0px solid transparent;border-bottom:0px solid transparent;border-right:0px solid transparent;padding-top:10px;padding-bottom:10px;padding-right:0px;padding-left:0px">' +
    '                                        <table border="0" cellpadding="0" cellspacing="0"' +
    '                                               style="table-layout:fixed;vertical-align:top;border-spacing:0;border-collapse:collapse;min-width:100%"' +
    '                                               valign="top" width="100%">' +
    '                                            <tbody>' +
    '                                            <tr style="vertical-align:top" valign="top">' +
    '                                                <td style="word-break:break-word;vertical-align:top;min-width:100%;padding-top:10px;padding-right:0px;padding-bottom:10px;padding-left:0px"' +
    '                                                    valign="top">' +
    '                                                    <table align="center" border="0" cellpadding="0" cellspacing="0"' +
    '                                                           style="table-layout:fixed;vertical-align:top;border-spacing:0;border-collapse:collapse;border-top:2px solid #2b6aa1;width:95%"' +
    '                                                           valign="top" width="95%">' +
    '                                                        <tbody>' +
    '                                                        <tr style="vertical-align:top" valign="top">' +
    '                                                            <td style="word-break:break-word;vertical-align:top"' +
    '                                                                valign="top"><span></span></td>' +
    '                                                        </tr>' +
    '                                                        </tbody>' +
    '                                                    </table>' +
    '                                                </td>' +
    '                                            </tr>' +
    '                                            </tbody>' +
    '                                        </table>' +
    '                                    </div>' +
    '                                </div>' +
    '                            </div>' +
    '                        </div>' +
    '                    </div>' +
    '                </div>' +
    '                <div style="background-color:transparent">' +
    '                    <div style="min-width:320px;max-width:600px;word-wrap:break-word;word-break:break-word;Margin:0 auto;background-color:transparent">' +
    '                        <div style="border-collapse:collapse;display:table;width:100%;background-color:transparent">' +
    '                            <div style="min-width:320px;max-width:600px;display:table-cell;vertical-align:top;background-color:#ffffff;width:600px">' +
    '                                <div style="width:100%!important">' +
    '                                    <div style="border-top:0px solid transparent;border-left:0px solid transparent;border-bottom:0px solid transparent;border-right:0px solid transparent;padding-top:0px;padding-bottom:0px;padding-right:0px;padding-left:0px">' +
    '                                        <div style="color:#ffffff;font-family:\'Lato\',Tahoma,Verdana,Segoe,sans-serif;line-height:1.8;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px">' +
    '                                            <div style="line-height:1.8;font-size:12px;color:#ffffff;font-family:\'Lato\',Tahoma,Verdana,Segoe,sans-serif">' +
    '                                                <p style="text-align:center;line-height:1.8;word-break:break-word;font-size:14px;margin:0">' +
    '                                                    <span style="color:#2b6aa1;font-size:14px">Mamy <strong>TYLKO</strong> pozytywne oceny płatnika!</span>' +
    '                                                </p>' +
    '                                                <p style="text-align:center;line-height:1.8;word-break:break-word;font-size:14px;margin:0">' +
    '                                                    <span style="color:#2b6aa1;font-size:14px">Zawsze jest z nami kontakt!</span>' +
    '                                                </p>' +
    '                                                <p style="text-align:center;line-height:1.8;word-break:break-word;font-size:14px;margin:0">' +
    '                                                    <span style="color:#2b6aa1;font-size:14px">Napisz jakie relacje Cię interesują,&nbsp;a <u>tylko takie będziemy Ci zgłaszać.</u></span>' +
    '                                                </p></div>' +
    '                                        </div>' +
    '                                    </div>' +
    '                                </div>' +
    '                            </div>' +
    '                        </div>' +
    '                    </div>' +
    '                </div>' +
    '                <div style="background-color:transparent">' +
    '                    <div style="min-width:320px;max-width:600px;word-wrap:break-word;word-break:break-word;Margin:0 auto;background-color:transparent">' +
    '                        <div style="border-collapse:collapse;display:table;width:100%;background-color:transparent">' +
    '                            <div style="min-width:320px;max-width:600px;display:table-cell;vertical-align:top;background-color:#ffffff;width:600px">' +
    '                                <div style="width:100%!important">' +
    '                                    <div style="border-top:0px solid transparent;border-left:0px solid transparent;border-bottom:0px solid transparent;border-right:0px solid transparent;padding-top:10px;padding-bottom:10px;padding-right:0px;padding-left:0px">' +
    '                                        <table border="0" cellpadding="0" cellspacing="0"' +
    '                                               style="table-layout:fixed;vertical-align:top;border-spacing:0;border-collapse:collapse;min-width:100%"' +
    '                                               valign="top" width="100%">' +
    '                                            <tbody>' +
    '                                            <tr style="vertical-align:top" valign="top">' +
    '                                                <td style="word-break:break-word;vertical-align:top;min-width:100%;padding-top:10px;padding-right:0px;padding-bottom:10px;padding-left:0px"' +
    '                                                    valign="top">' +
    '                                                    <table align="center" border="0" cellpadding="0" cellspacing="0"' +
    '                                                           style="table-layout:fixed;vertical-align:top;border-spacing:0;border-collapse:collapse;border-top:2px solid #2b6aa1;width:95%"' +
    '                                                           valign="top" width="95%">' +
    '                                                        <tbody>' +
    '                                                        <tr style="vertical-align:top" valign="top">' +
    '                                                            <td style="word-break:break-word;vertical-align:top"' +
    '                                                                valign="top"><span></span></td>' +
    '                                                        </tr>' +
    '                                                        </tbody>' +
    '                                                    </table>' +
    '                                                </td>' +
    '                                            </tr>' +
    '                                            </tbody>' +
    '                                        </table>' +
    '                                    </div>' +
    '                                </div>' +
    '                            </div>' +
    '                        </div>' +
    '                    </div>' +
    '                </div>' +
    '                <div style="background-color:transparent">' +
    '                    <div style="min-width:320px;max-width:600px;word-wrap:break-word;word-break:break-word;Margin:0 auto;background-color:transparent">' +
    '                        <div style="border-collapse:collapse;display:table;width:100%;background-color:transparent;border-bottom: 5px solid #2b6aa1;">' +
    '                            <div style="display:table-cell;vertical-align:top;max-width:320px;min-width:300px;background-color:#ffffff;width:300px">' +
    '                                <div style="width:100%!important">' +
    '                                    <div style="border-top:0px solid transparent;border-left:0px solid transparent;border-bottom:0border-right:0px solid transparent;padding-top:5px;padding-bottom:10px;padding-right:0px;padding-left:0px">' +
    '                                        <div align="left" style="padding-right:15px;padding-left:15px">' +
    '                                            <div style="font-size:1px;line-height:10px">&nbsp;</div>' +
    '                                            <img alt="Alternate text" border="0"' +
    '                                                 src="https://lforce.pl/wp-content/uploads/2015/11/logo_lforce1.png"' +
    '                                                 style="text-decoration:none;height:auto;border:0;width:100%;max-width:171px;display:block"' +
    '                                                 title="Alternate text" width="171">' +
    '                                            <div style="font-size:1px;line-height:10px">&nbsp;</div>' +
    '                                        </div>' +
    '                                    </div>' +
    '                                </div>' +
    '                            </div>' +
    '                            <div style="display:table-cell;vertical-align:top;max-width:320px;min-width:300px;background-color:#ffffff;width:300px">' +
    '                                <div style="width:100%!important">' +
    '                                    <div style="border-top:0px solid transparent;border-left:0px solid transparent;border-bottom:0;border-right:0px solid transparent;padding-top:5px;padding-bottom:5px;padding-right:0px;padding-left:0px">' +
    '                                        <div style="color:#737373;font-family:\'Lato\',Tahoma,Verdana,Segoe,sans-serif;line-height:1.5;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px">' +
    '                                            <div style="line-height:1.5;font-size:12px;color:#737373;font-family:\'Lato\',Tahoma,Verdana,Segoe,sans-serif">' +
    '                                                <p style="line-height:1.5;word-break:break-word;margin:0"><strong><span' +
    '                                                        style="color:#2b6aa1">L.Force Sp. z o.o.</span></strong><br><span' +
    '                                                        style="color:#2b6aa1">ul. Gen. Ch. de Gaulle\'a 8/13, 43-100 Tychy, Poland,</span><br><span' +
    '                                                        style="color:#2b6aa1">NIP: 6462980510, REGON: 385027271</span>' +
    '                                                </p></div>' +
    '                                        </div>' +
    '                                    </div>' +
    '                                </div>' +
    '                            </div>' +
    '                        </div>' +
    '                    </div>' +
    '                </div>' +
    '                <div style="background-color:transparent">' +
    '                    <div style="min-width:320px;max-width:600px;word-wrap:break-word;word-break:break-word;Margin:0 auto;background-color:transparent">' +
    '                        <div style="border-collapse:collapse;display:table;width:100%;background-color:transparent">' +
    '                            <div style="min-width:320px;max-width:600px;display:table-cell;vertical-align:top;width:600px">' +
    '                                <div style="width:100%!important">' +
    '                                    <div style="border-top:0px solid transparent;border-left:0px solid transparent;border-bottom:0px solid transparent;border-right:0px solid transparent;padding-top:15px;padding-bottom:15px;padding-right:0px;padding-left:0px">' +
    '                                        <div style="color:#555555;font-family:\'Lato\',Tahoma,Verdana,Segoe,sans-serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px">' +
    '                                            <div style="line-height:1.2;font-size:12px;color:#555555;font-family:\'Lato\',Tahoma,Verdana,Segoe,sans-serif">' +
    '                                                <p style="text-align:center;line-height:1.2;word-break:break-word;margin:0">' +
    '                                                    <a href="https://www.lforce.pl" rel="noopener"' +
    '                                                       style="text-decoration:underline;color:#2b6aa1"' +
    '                                                       title="www.lforce.pl" target="_blank">www.lforce.pl</a></p></div>' +
    '                                        </div>' +
    '                                        <table border="0" cellpadding="0" cellspacing="0"' +
    '                                               style="table-layout:fixed;vertical-align:top;border-spacing:0;border-collapse:collapse;min-width:100%"' +
    '                                               valign="top" width="100%">' +
    '                                            <tbody>' +
    '                                            <tr style="vertical-align:top" valign="top">' +
    '                                                <td style="word-break:break-word;vertical-align:top;min-width:100%;padding-top:10px;padding-right:0px;padding-bottom:10px;padding-left:0px"' +
    '                                                    valign="top">' +
    '                                                    <table align="center" border="0" cellpadding="0" cellspacing="0"' +
    '                                                           height="0"' +
    '                                                           style="table-layout:fixed;vertical-align:top;border-spacing:0;border-collapse:collapse;border-top:0px solid transparent;height:0px;width:100%"' +
    '                                                           valign="top" width="100%">' +
    '                                                        <tbody>' +
    '                                                        <tr style="vertical-align:top" valign="top">' +
    '                                                            <td height="0"' +
    '                                                                style="word-break:break-word;vertical-align:top"' +
    '                                                                valign="top"><span></span></td>' +
    '                                                        </tr>' +
    '                                                        </tbody>' +
    '                                                    </table>' +
    '                                                </td>' +
    '                                            </tr>' +
    '                                            </tbody>' +
    '                                        </table>' +
    '                                    </div>' +
    '                                </div>' +
    '                            </div>' +
    '                        </div>' +
    '                    </div>' +
    '                </div>' +
    '            </td>' +
    '        </tr>' +
    '        </tbody>' +
    '    </table>' +
    '</div>';

