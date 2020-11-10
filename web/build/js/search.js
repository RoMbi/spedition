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
        $('div.fr-element.fr-view').attr('name', 'form[message]')
        $('div.fr-element.fr-view').find('p').prepend(mailTemplate);
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

let mailTemplate = '<table bgcolor="#d8d8d8" cellpadding="0" cellspacing="0"\n' +
' style="table-layout:fixed;vertical-align:top;min-width:320px;border-spacing:0;border-collapse:collapse;background-color:#d8d8d8;width:100%"\n' +
' valign="top" width="100%">\n' +
'<tbody>\n' +
'<tr style="vertical-align:top" valign="top">\n' +
'<td style="word-break:break-word;vertical-align:top" valign="top">\n' +
'<div style="background-color:transparent">\n' +
'<div style="min-width:320px;max-width:600px;word-wrap:break-word;word-break:break-word;Margin:0 auto;background-color:transparent">\n' +
'<div style="border-collapse:collapse;display:table;width:100%;background-color:transparent">\n' +
'<div style="min-width:320px;max-width:600px;display:table-cell;vertical-align:top;width:600px">\n' +
'<div style="width:100%!important">\n' +
'<div style="border-top:0px solid transparent;border-left:0px solid transparent;border-bottom:0px solid transparent;border-right:0px solid transparent;padding-top:15px;padding-bottom:15px;padding-right:0px;padding-left:0px">\n' +
'<table border="0" cellpadding="0" cellspacing="0"\n' +
' style="table-layout:fixed;vertical-align:top;border-spacing:0;border-collapse:collapse;min-width:100%"\n' +
' valign="top" width="100%">\n' +
'<tbody>\n' +
'<tr style="vertical-align:top" valign="top">\n' +
'<td style="word-break:break-word;vertical-align:top;min-width:100%;padding-top:10px;padding-right:0px;padding-bottom:10px;padding-left:0px"\n' +
'valign="top">\n' +
'<table align="center" border="0" cellpadding="0" cellspacing="0"\n' +
' height="0"\n' +
' style="table-layout:fixed;vertical-align:top;border-spacing:0;border-collapse:collapse;border-top:0px solid transparent;height:0px;width:100%"\n' +
' valign="top" width="100%">\n' +
'<tbody>\n' +
'<tr style="vertical-align:top" valign="top">\n' +
'<td height="0"\n' +
'style="word-break:break-word;vertical-align:top"\n' +
'valign="top"><span></span></td>\n' +
'</tr>\n' +
'</tbody>\n' +
'</table>\n' +
'</td>\n' +
'</tr>\n' +
'</tbody>\n' +
'</table>\n' +
'</div>\n' +
'</div>\n' +
'</div>\n' +
'</div>\n' +
'</div>\n' +
'</div>\n' +
'<div style="background-color:transparent">\n' +
'<div style="min-width:320px;max-width:600px;word-wrap:break-word;word-break:break-word;Margin:0 auto;background-color:transparent">\n' +
'<div style="border-collapse:collapse;display:table;width:100%;background-color:transparent">\n' +
'<div style="display:table-cell;vertical-align:top;min-width:320px;max-width:400px;background-color:#ffffff;width:400px">\n' +
'<div style="width:100%!important">\n' +
'<div style="border-top:5px solid #2b6aa1;border-left:0px solid transparent;border-bottom:0px solid transparent;border-right:0px solid transparent;padding-top:5px;padding-bottom:5px;padding-right:10px;padding-left:10px">\n' +
'<div align="left" style="padding-right:15px;padding-left:15px">\n' +
'<div style="font-size:1px;line-height:15px">&nbsp;</div>\n' +
'<a href="https://lforce.pl" style="outline:none" target="_blank"> <img\n' +
'alt="LFORCE LOGO" border="0"\n' +
'src="https://lforce.pl/wp-content/uploads/2015/11/logo_lforce1.png"\n' +
'style="text-decoration:none;height:auto;border:0;width:100%;max-width:171px;display:block"\n' +
'title="LFORCE LOGO" width="171"></a>\n' +
'<div style="font-size:1px;line-height:10px">&nbsp;</div>\n' +
'</div>\n' +
'</div>\n' +
'</div>\n' +
'</div>\n' +
'<div style="display:table-cell;vertical-align:top;max-width:320px;min-width:200px;background-color:#ffffff;width:200px">\n' +
'<div style="width:100%!important">\n' +
'<div style="border-top:5px solid #2b6aa1;border-left:0px solid transparent;border-bottom:0px solid transparent;border-right:0px solid transparent;padding-top:5px;padding-bottom:5px;padding-right:5px;padding-left:5px">\n' +
'<div style="color:#ffffff;font-family:\'Lato\',Tahoma,Verdana,Segoe,sans-serif;line-height:1.5;padding-top:23px;padding-right:23px;padding-bottom:23px;padding-left:23px">\n' +
'<div style="line-height:1.5;font-size:12px;color:#ffffff;font-family:\'Lato\',Tahoma,Verdana,Segoe,sans-serif">\n' +
'<p style="font-size:12px;line-height:1.5;word-break:break-word;text-align:right;margin:0">\n' +
' <span style="font-size:12px"><a\n' +
' href="https://lforce.pl/"\n' +
' rel="noopener"\n' +
' style="text-decoration:underline;color:#2b6aa1"\n' +
' title="https://lforce.pl/"\n' +
' target="_blank">ODWIEDŹ NAS ONLINE</a></span>\n' +
'</p></div>\n' +
'</div>\n' +
'</div>\n' +
'</div>\n' +
'</div>\n' +
'</div>\n' +
'</div>\n' +
'</div>\n' +
'<div style="background-color:transparent">\n' +
'<div style="min-width:320px;max-width:600px;word-wrap:break-word;word-break:break-word;Margin:0 auto;background-color:transparent">\n' +
'<div style="border-collapse:collapse;display:table;width:100%;background-color:transparent">\n' +
'<div style="min-width:320px;max-width:600px;display:table-cell;vertical-align:top;background-color:#ffffff;width:600px">\n' +
'<div style="width:100%!important">\n' +
'<div style="border-top:0px solid transparent;border-left:0px solid transparent;border-bottom:0px solid transparent;border-right:0px solid transparent;padding-top:0px;padding-bottom:0px;padding-right:0px;padding-left:0px">\n' +
'<table border="0" cellpadding="0" cellspacing="0"\n' +
' style="table-layout:fixed;vertical-align:top;border-spacing:0;border-collapse:collapse;min-width:100%"\n' +
' valign="top" width="100%">\n' +
'<tbody>\n' +
'<tr style="vertical-align:top" valign="top">\n' +
'<td style="word-break:break-word;vertical-align:top;min-width:100%;padding-top:10px;padding-right:0px;padding-bottom:10px;padding-left:0px"\n' +
'valign="top">\n' +
'<table align="center" border="0" cellpadding="0" cellspacing="0"\n' +
' style="table-layout:fixed;vertical-align:top;border-spacing:0;border-collapse:collapse;border-top:2px solid #2b6aa1;width:95%"\n' +
' valign="top" width="95%">\n' +
'<tbody>\n' +
'<tr style="vertical-align:top" valign="top">\n' +
'<td style="word-break:break-word;vertical-align:top"\n' +
'valign="top"><span></span></td>\n' +
'</tr>\n' +
'</tbody>\n' +
'</table>\n' +
'</td>\n' +
'</tr>\n' +
'</tbody>\n' +
'</table>\n' +
'</div>\n' +
'</div>\n' +
'</div>\n' +
'</div>\n' +
'</div>\n' +
'</div>\n' +
'<div style="background-color:transparent">\n' +
'<div style="min-width:320px;max-width:600px;word-wrap:break-word;word-break:break-word;Margin:0 auto;background-color:transparent">\n' +
'<div style="border-collapse:collapse;display:table;width:100%;background-color:transparent">\n' +
'<div style="display:table-cell;vertical-align:top;max-width:320px;min-width:300px;background-color:#ffffff;width:300px">\n' +
'<div style="width:100%!important">\n' +
'<div style="border-top:0px solid transparent;border-left:0px solid transparent;border-bottom:0px solid transparent;border-right:0px solid transparent;padding-top:5px;padding-bottom:5px;padding-right:5px;padding-left:5px">\n' +
'<div style="color:#3c3c3c;font-family:\'Lato\',Tahoma,Verdana,Segoe,sans-serif;line-height:1.8;padding-top:0px;padding-right:10px;padding-bottom:0px;padding-left:20px">\n' +
'<div style="line-height:1.8;font-size:12px;font-family:\'Lato\',Tahoma,Verdana,Segoe,sans-serif;color:#3c3c3c">\n' +
'<p style="line-height:1.8;word-break:break-word;font-family:Lato,Tahoma,Verdana,Segoe,sans-serif;margin:0">\n' +
'<strong><span\n' +
'style="font-size:22px;color:#2b6aa1"><span>DZIEŃ DOBRY</span></span></strong>\n' +
'</p></div>\n' +
'</div>\n' +
'<div style="color:#555555;font-family:\'Lato\',Tahoma,Verdana,Segoe,sans-serif;line-height:1.2;padding-top:0px;padding-right:10px;padding-bottom:10px;padding-left:20px">\n' +
'<div style="line-height:1.2;font-size:12px;color:#555555;font-family:\'Lato\',Tahoma,Verdana,Segoe,sans-serif">\n' +
'<p style="line-height:1.2;word-break:break-word;font-size:20px;margin:0">\n' +
'<span style="font-size:20px;color:#2b6aa1">mamy dostępny ładunek!</span>\n' +
'</p></div>\n' +
'</div>\n' +
'</div>\n' +
'</div>\n' +
'</div>\n' +
'<div style="display:table-cell;vertical-align:top;max-width:320px;min-width:300px;background-color:#ffffff;width:300px">\n' +
'<div style="width:100%!important">\n' +
'<div style="border-top:0px solid transparent;border-left:0px solid transparent;border-bottom:0px solid transparent;border-right:0px solid transparent;padding-top:5px;padding-bottom:5px;padding-right:0px;padding-left:0px">\n' +
'<div>\n' +
'<table border="0" cellpadding="0" cellspacing="0"\n' +
' style="table-layout:fixed;vertical-align:top;border-spacing:0;border-collapse:collapse;min-width:100%"\n' +
' valign="top" width="100%">\n' +
'<tbody>\n' +
'<tr style="vertical-align:top" valign="top">\n' +
'<td style="word-break:break-word;vertical-align:top;min-width:100%;padding-top:41px;padding-right:26px;padding-bottom:26px;padding-left:26px"\n' +
'valign="top">\n' +
'<table align="center" border="0" cellpadding="0" cellspacing="0"\n' +
' height="0"\n' +
' style="table-layout:fixed;vertical-align:top;border-spacing:0;border-collapse:collapse;border-top:0px solid transparent;height:0px;width:100%"\n' +
' valign="top" width="100%">\n' +
'<tbody>\n' +
'<tr style="vertical-align:top" valign="top">\n' +
'<td height="0"\n' +
'style="word-break:break-word;vertical-align:top"\n' +
'valign="top"><span></span></td>\n' +
'</tr>\n' +
'</tbody>\n' +
'</table>\n' +
'</td>\n' +
'</tr>\n' +
'</tbody>\n' +
'</table>\n' +
'</div>\n' +
'</div>\n' +
'</div>\n' +
'</div>\n' +
'</div>\n' +
'<table style="width:600px;background-color: white;color:#555555;">\n' +
'<tr style="font-weight:bold;width:100%!important">\n' +
'<td style="font-weight:bold;line-height:1.2;word-break:break-word;margin:0;width: 200px;text-align: right;">\n' +
'miejsce załadunku:\n' +
'</td>\n' +
'<td style="color:#555555;font-family:\'Lato\',Tahoma,Verdana,Segoe,sans-serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px">\n' +
'x\n' +
'</td>\n' +
'</tr>\n' +
'<tr style="width:100%!important">\n' +
'<td style="line-height:1.2;word-break:break-word;margin:0;width: 200px;text-align: right;">\n' +
'czas załadunku:\n' +
'</td>\n' +
'<td style="color:#555555;font-family:\'Lato\',Tahoma,Verdana,Segoe,sans-serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px">\n' +
'x\n' +
'</td>\n' +
'</tr>\n' +
'<tr style="font-weight:bold;width:100%!important">\n' +
'<td style="font-weight:bold;line-height:1.2;word-break:break-word;margin:0;width: 200px;text-align: right;">\n' +
'miejsce rozładunku:\n' +
'</td>\n' +
'<td style="color:#555555;font-family:\'Lato\',Tahoma,Verdana,Segoe,sans-serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px">\n' +
'x\n' +
'</td>\n' +
'</tr>\n' +
'<tr style="width:100%!important">\n' +
'<td style="line-height:1.2;word-break:break-word;margin:0;width: 200px;text-align: right;">\n' +
'czas rozładunku:\n' +
'</td>\n' +
'<td style="color:#555555;font-family:\'Lato\',Tahoma,Verdana,Segoe,sans-serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px">\n' +
'x\n' +
'</td>\n' +
'</tr>\n' +
'<tr style="width:100%!important">\n' +
'<td style="line-height:1.2;word-break:break-word;margin:0;width: 200px;text-align: right;">\n' +
'towar:\n' +
'</td>\n' +
'<td style="color:#555555;font-family:\'Lato\',Tahoma,Verdana,Segoe,sans-serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px">\n' +
'x\n' +
'</td>\n' +
'</tr>\n' +
'<tr style="width:100%!important">\n' +
'<td style="line-height:1.2;word-break:break-word;margin:0;width: 200px;text-align: right;">\n' +
'rodzaj transportu:\n' +
'</td>\n' +
'<td style="color:#555555;font-family:\'Lato\',Tahoma,Verdana,Segoe,sans-serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px">\n' +
'x\n' +
'</td>\n' +
'</tr>\n' +
'<tr style="width:100%!important">\n' +
'<td style="line-height:1.2;word-break:break-word;margin:0;width: 200px;text-align: right;">\n' +
'cena:\n' +
'</td>\n' +
'<td style="color:#555555;font-family:\'Lato\',Tahoma,Verdana,Segoe,sans-serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px">\n' +
'x\n' +
'</td>\n' +
'</tr>\n' +
'</table>\n' +
'</div>\n' +
'</div>\n' +
'<div style="background-color:transparent">\n' +
'<div style="min-width:320px;max-width:600px;word-wrap:break-word;word-break:break-word;Margin:0 auto;background-color:transparent">\n' +
'<div style="border-collapse:collapse;display:table;width:100%;background-color:transparent">\n' +
'<div style="min-width:320px;max-width:600px;display:table-cell;vertical-align:top;background-color:#ffffff;width:600px">\n' +
'<div style="width:100%!important">\n' +
'<div style="border-top:0px solid transparent;border-left:0px solid transparent;border-bottom:0px solid transparent;border-right:0px solid transparent;padding-top:10px;padding-bottom:10px;padding-right:0px;padding-left:0px">\n' +
'<table border="0" cellpadding="0" cellspacing="0"\n' +
' style="table-layout:fixed;vertical-align:top;border-spacing:0;border-collapse:collapse;min-width:100%"\n' +
' valign="top" width="100%">\n' +
'<tbody>\n' +
'<tr style="vertical-align:top" valign="top">\n' +
'<td style="word-break:break-word;vertical-align:top;min-width:100%;padding-top:10px;padding-right:0px;padding-bottom:10px;padding-left:0px"\n' +
'valign="top">\n' +
'<table align="center" border="0" cellpadding="0" cellspacing="0"\n' +
' style="table-layout:fixed;vertical-align:top;border-spacing:0;border-collapse:collapse;border-top:2px solid #2b6aa1;width:95%"\n' +
' valign="top" width="95%">\n' +
'<tbody>\n' +
'<tr style="vertical-align:top" valign="top">\n' +
'<td style="word-break:break-word;vertical-align:top"\n' +
'valign="top"><span></span></td>\n' +
'</tr>\n' +
'</tbody>\n' +
'</table>\n' +
'</td>\n' +
'</tr>\n' +
'</tbody>\n' +
'</table>\n' +
'</div>\n' +
'</div>\n' +
'</div>\n' +
'</div>\n' +
'</div>\n' +
'</div>\n' +
'<div style="background-color:transparent">\n' +
'<div style="min-width:320px;max-width:600px;word-wrap:break-word;word-break:break-word;Margin:0 auto;background-color:transparent">\n' +
'<div style="border-collapse:collapse;display:table;width:100%;background-color:transparent">\n' +
'<div style="min-width:320px;max-width:600px;display:table-cell;vertical-align:top;background-color:#ffffff;width:600px">\n' +
'<div style="width:100%!important">\n' +
'<div style="border-top:0px solid transparent;border-left:0px solid transparent;border-bottom:0px solid transparent;border-right:0px solid transparent;padding-top:5px;padding-bottom:5px;padding-right:5px;padding-left:5px">\n' +
'<div style="color:#555555;font-family:\'Lato\',Tahoma,Verdana,Segoe,sans-serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:20px">\n' +
'<div style="line-height:1.2;font-size:12px;color:#555555;font-family:\'Lato\',Tahoma,Verdana,Segoe,sans-serif">\n' +
'<p style="text-align:left;line-height:1.2;word-break:break-word;font-size:20px;margin:0">\n' +
'<span style="font-size:20px;color:#2b6aa1">ZAPRASZAMY DO KONTAKTU!</span>\n' +
'</p></div>\n' +
'</div>\n' +
'<div style="color:#555555;font-family:\'Lato\',Tahoma,Verdana,Segoe,sans-serif;line-height:1.5;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:20px">\n' +
'<div style="line-height:1.5;font-size:12px;color:#555555;font-family:\'Lato\',Tahoma,Verdana,Segoe,sans-serif">\n' +
'<p style="line-height:1.5;word-break:break-word;font-size:14px;margin:0">\n' +
' <span style="font-size:14px"><strong>Łukasz Ujek</strong>: <a\n' +
' href="mailto:l.ujek@lforce.pl?subject=Kontakt%20w%20sprawie%20zlecenia"\n' +
' rel="noopener"\n' +
' style="text-decoration:underline;color:#2b6aa1"\n' +
' title="l.ujek@lforce.pl"\n' +
' target="_blank">l.ujek@lforce.pl</a>, telefon:&nbsp;<a\n' +
' rel="noopener"\n' +
' style="text-decoration:underline;color:#2b6aa1"\n' +
' title="tel:504376792">504 376 792</a>, trans ID: 663234-2</span>\n' +
'</p>\n' +
'<p style="line-height:1.5;word-break:break-word;font-size:14px;margin:0">\n' +
' <span style="font-size:14px"><strong>Łukasz Ziarniak</strong>: <a\n' +
' href="mailto:l.ziarniak@lforce.pl?subject=Kontakt%20w%20sprawie%20zlecenia"\n' +
' rel="noopener"\n' +
' style="text-decoration:underline;color:#2b6aa1"\n' +
' title="l.ziarniak@lforce.pl"\n' +
' target="_blank">l.ziarniak@lforce.pl</a>, telefon:&nbsp;<a\n' +
' rel="noopener"\n' +
' style="text-decoration:underline;color:#2b6aa1"\n' +
' title="tel:534244668">534 244 668</a>, trans ID: 663234-1</span>\n' +
'</p>\n' +
'<p style="line-height:1.5;word-break:break-word;font-size:14px;margin:0">\n' +
' <span style="font-size:14px"><strong>Ewa Kozera</strong>: <a\n' +
' href="mailto:office@lforce.pl?subject=Kontakt%20w%20sprawie%20zlecenia"\n' +
' rel="noopener"\n' +
' style="text-decoration:underline;color:#2b6aa1"\n' +
' title="office@lforce.pl"\n' +
' target="_blank">office@lforce.pl</a>, telefon: <a\n' +
' rel="noopener"\n' +
' style="text-decoration:underline;color:#2b6aa1"\n' +
' title="tel:603040469">603 040 469</a>, trans ID: 663234-8</span>\n' +
'</p></div>\n' +
'</div>\n' +
'</div>\n' +
'</div>\n' +
'</div>\n' +
'</div>\n' +
'</div>\n' +
'</div>\n' +
'<div style="background-color:transparent">\n' +
'<div style="min-width:320px;max-width:600px;word-wrap:break-word;word-break:break-word;Margin:0 auto;background-color:transparent">\n' +
'<div style="border-collapse:collapse;display:table;width:100%;background-color:transparent">\n' +
'<div style="min-width:320px;max-width:600px;display:table-cell;vertical-align:top;background-color:#ffffff;width:600px">\n' +
'<div style="width:100%!important">\n' +
'<div style="border-top:0px solid transparent;border-left:0px solid transparent;border-bottom:0px solid transparent;border-right:0px solid transparent;padding-top:10px;padding-bottom:10px;padding-right:0px;padding-left:0px">\n' +
'<table border="0" cellpadding="0" cellspacing="0"\n' +
' style="table-layout:fixed;vertical-align:top;border-spacing:0;border-collapse:collapse;min-width:100%"\n' +
' valign="top" width="100%">\n' +
'<tbody>\n' +
'<tr style="vertical-align:top" valign="top">\n' +
'<td style="word-break:break-word;vertical-align:top;min-width:100%;padding-top:10px;padding-right:0px;padding-bottom:10px;padding-left:0px"\n' +
'valign="top">\n' +
'<table align="center" border="0" cellpadding="0" cellspacing="0"\n' +
' style="table-layout:fixed;vertical-align:top;border-spacing:0;border-collapse:collapse;border-top:2px solid #2b6aa1;width:95%"\n' +
' valign="top" width="95%">\n' +
'<tbody>\n' +
'<tr style="vertical-align:top" valign="top">\n' +
'<td style="word-break:break-word;vertical-align:top"\n' +
'valign="top"><span></span></td>\n' +
'</tr>\n' +
'</tbody>\n' +
'</table>\n' +
'</td>\n' +
'</tr>\n' +
'</tbody>\n' +
'</table>\n' +
'</div>\n' +
'</div>\n' +
'</div>\n' +
'</div>\n' +
'</div>\n' +
'</div>\n' +
'<div style="background-color:transparent">\n' +
'<div style="min-width:320px;max-width:600px;word-wrap:break-word;word-break:break-word;Margin:0 auto;background-color:transparent">\n' +
'<div style="border-collapse:collapse;display:table;width:100%;background-color:transparent">\n' +
'<div style="min-width:320px;max-width:600px;display:table-cell;vertical-align:top;background-color:#ffffff;width:600px">\n' +
'<div style="width:100%!important">\n' +
'<div style="border-top:0px solid transparent;border-left:0px solid transparent;border-bottom:0px solid transparent;border-right:0px solid transparent;padding-top:0px;padding-bottom:0px;padding-right:0px;padding-left:0px">\n' +
'<div style="color:#ffffff;font-family:\'Lato\',Tahoma,Verdana,Segoe,sans-serif;line-height:1.8;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px">\n' +
'<div style="line-height:1.8;font-size:12px;color:#ffffff;font-family:\'Lato\',Tahoma,Verdana,Segoe,sans-serif">\n' +
'<p style="text-align:center;line-height:1.8;word-break:break-word;font-size:14px;margin:0">\n' +
'<span style="color:#2b6aa1;font-size:14px">Mamy <strong>TYLKO</strong> pozytywne oceny płatnika!</span>\n' +
'</p>\n' +
'<p style="text-align:center;line-height:1.8;word-break:break-word;font-size:14px;margin:0">\n' +
'<span style="color:#2b6aa1;font-size:14px">Zawsze jest z nami kontakt!</span>\n' +
'</p>\n' +
'<p style="text-align:center;line-height:1.8;word-break:break-word;font-size:14px;margin:0">\n' +
'<span style="color:#2b6aa1;font-size:14px">Napisz jakie relacje Cię interesują,&nbsp;a <u>tylko takie będziemy Ci zgłaszać.</u></span>\n' +
'</p></div>\n' +
'</div>\n' +
'</div>\n' +
'</div>\n' +
'</div>\n' +
'</div>\n' +
'</div>\n' +
'</div>\n' +
'<div style="background-color:transparent">\n' +
'<div style="min-width:320px;max-width:600px;word-wrap:break-word;word-break:break-word;Margin:0 auto;background-color:transparent">\n' +
'<div style="border-collapse:collapse;display:table;width:100%;background-color:transparent">\n' +
'<div style="min-width:320px;max-width:600px;display:table-cell;vertical-align:top;background-color:#ffffff;width:600px">\n' +
'<div style="width:100%!important">\n' +
'<div style="border-top:0px solid transparent;border-left:0px solid transparent;border-bottom:0px solid transparent;border-right:0px solid transparent;padding-top:10px;padding-bottom:10px;padding-right:0px;padding-left:0px">\n' +
'<table border="0" cellpadding="0" cellspacing="0"\n' +
' style="table-layout:fixed;vertical-align:top;border-spacing:0;border-collapse:collapse;min-width:100%"\n' +
' valign="top" width="100%">\n' +
'<tbody>\n' +
'<tr style="vertical-align:top" valign="top">\n' +
'<td style="word-break:break-word;vertical-align:top;min-width:100%;padding-top:10px;padding-right:0px;padding-bottom:10px;padding-left:0px"\n' +
'valign="top">\n' +
'<table align="center" border="0" cellpadding="0" cellspacing="0"\n' +
' style="table-layout:fixed;vertical-align:top;border-spacing:0;border-collapse:collapse;border-top:2px solid #2b6aa1;width:95%"\n' +
' valign="top" width="95%">\n' +
'<tbody>\n' +
'<tr style="vertical-align:top" valign="top">\n' +
'<td style="word-break:break-word;vertical-align:top"\n' +
'valign="top"><span></span></td>\n' +
'</tr>\n' +
'</tbody>\n' +
'</table>\n' +
'</td>\n' +
'</tr>\n' +
'</tbody>\n' +
'</table>\n' +
'</div>\n' +
'</div>\n' +
'</div>\n' +
'</div>\n' +
'</div>\n' +
'</div>\n' +
'<div style="background-color:transparent">\n' +
'<div style="min-width:320px;max-width:600px;word-wrap:break-word;word-break:break-word;Margin:0 auto;background-color:transparent">\n' +
'<div style="border-collapse:collapse;display:table;width:100%;background-color:transparent;border-bottom: 5px solid #2b6aa1;">\n' +
'<div style="display:table-cell;vertical-align:top;max-width:320px;min-width:300px;background-color:#ffffff;width:300px">\n' +
'<div style="width:100%!important">\n' +
'<div style="border-top:0px solid transparent;border-left:0px solid transparent;border-bottom:0border-right:0px solid transparent;padding-top:5px;padding-bottom:10px;padding-right:0px;padding-left:0px">\n' +
'<div align="left" style="padding-right:15px;padding-left:15px">\n' +
'<div style="font-size:1px;line-height:10px">&nbsp;</div>\n' +
'<img alt="Alternate text" border="0"\n' +
' src="https://lforce.pl/wp-content/uploads/2015/11/logo_lforce1.png"\n' +
' style="text-decoration:none;height:auto;border:0;width:100%;max-width:171px;display:block"\n' +
' title="Alternate text" width="171">\n' +
'<div style="font-size:1px;line-height:10px">&nbsp;</div>\n' +
'</div>\n' +
'</div>\n' +
'</div>\n' +
'</div>\n' +
'<div style="display:table-cell;vertical-align:top;max-width:320px;min-width:300px;background-color:#ffffff;width:300px">\n' +
'<div style="width:100%!important">\n' +
'<div style="border-top:0px solid transparent;border-left:0px solid transparent;border-bottom:0;border-right:0px solid transparent;padding-top:5px;padding-bottom:5px;padding-right:0px;padding-left:0px">\n' +
'<div style="color:#737373;font-family:\'Lato\',Tahoma,Verdana,Segoe,sans-serif;line-height:1.5;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px">\n' +
'<div style="line-height:1.5;font-size:12px;color:#737373;font-family:\'Lato\',Tahoma,Verdana,Segoe,sans-serif">\n' +
'<p style="line-height:1.5;word-break:break-word;margin:0"><strong><span\n' +
'style="color:#2b6aa1">L.Force Sp. z o.o.</span></strong><br><span\n' +
'style="color:#2b6aa1">ul. Gen. Ch. de Gaulle\'a 8/13, 43-100 Tychy, Poland,</span><br><span\n' +
'style="color:#2b6aa1">NIP: 6462980510, REGON: 385027271</span>\n' +
'</p></div>\n' +
'</div>\n' +
'</div>\n' +
'</div>\n' +
'</div>\n' +
'</div>\n' +
'</div>\n' +
'</div>\n' +
'<div style="background-color:transparent">\n' +
'<div style="min-width:320px;max-width:600px;word-wrap:break-word;word-break:break-word;Margin:0 auto;background-color:transparent">\n' +
'<div style="border-collapse:collapse;display:table;width:100%;background-color:transparent">\n' +
'<div style="min-width:320px;max-width:600px;display:table-cell;vertical-align:top;width:600px">\n' +
'<div style="width:100%!important">\n' +
'<div style="border-top:0px solid transparent;border-left:0px solid transparent;border-bottom:0px solid transparent;border-right:0px solid transparent;padding-top:15px;padding-bottom:15px;padding-right:0px;padding-left:0px">\n' +
'<div style="color:#555555;font-family:\'Lato\',Tahoma,Verdana,Segoe,sans-serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px">\n' +
'<div style="line-height:1.2;font-size:12px;color:#555555;font-family:\'Lato\',Tahoma,Verdana,Segoe,sans-serif">\n' +
'<p style="text-align:center;line-height:1.2;word-break:break-word;margin:0">\n' +
'<a href="https://www.lforce.pl" rel="noopener"\n' +
' style="text-decoration:underline;color:#2b6aa1"\n' +
' title="www.lforce.pl" target="_blank">www.lforce.pl</a></p></div>\n' +
'</div>\n' +
'<table border="0" cellpadding="0" cellspacing="0"\n' +
' style="table-layout:fixed;vertical-align:top;border-spacing:0;border-collapse:collapse;min-width:100%"\n' +
' valign="top" width="100%">\n' +
'<tbody>\n' +
'<tr style="vertical-align:top" valign="top">\n' +
'<td style="word-break:break-word;vertical-align:top;min-width:100%;padding-top:10px;padding-right:0px;padding-bottom:10px;padding-left:0px"\n' +
'valign="top">\n' +
'<table align="center" border="0" cellpadding="0" cellspacing="0"\n' +
' height="0"\n' +
' style="table-layout:fixed;vertical-align:top;border-spacing:0;border-collapse:collapse;border-top:0px solid transparent;height:0px;width:100%"\n' +
' valign="top" width="100%">\n' +
'<tbody>\n' +
'<tr style="vertical-align:top" valign="top">\n' +
'<td height="0"\n' +
'style="word-break:break-word;vertical-align:top"\n' +
'valign="top"><span></span></td>\n' +
'</tr>\n' +
'</tbody>\n' +
'</table>\n' +
'</td>\n' +
'</tr>\n' +
'</tbody>\n' +
'</table>\n' +
'</div>\n' +
'</div>\n' +
'</div>\n' +
'</div>\n' +
'</div>\n' +
'</div>\n' +
'</td>\n' +
'</tr>\n' +
'</tbody>\n' +
'</table>';

