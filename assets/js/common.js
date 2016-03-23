var DefaultCookieName = "DefaultMessage";
var dateFormatToPassToServerSide = "YYYY/MM/DD";
var dateTimeFormatToPassToServerSide = "YYYY/MM/DD HH:mm";
var serverError = "Oops! Something went wrong on server, suspected error would be ";



function AngularAjaxCall($angularHttpObejct, url, postData, httpMethod, callDataType, contentType) {
if (contentType == undefined)
    contentType = "application/x-www-form-urlencoded;charset=UTF-8";

if (callDataType == undefined)
    callDataType = "json";

return $angularHttpObejct({
    method: httpMethod,
    responseType: callDataType,
    url: url,
    data: postData,
    crossDomain: true,
    headers: {'Content-Type': contentType},
    error: function(xhr) {
        //debugger;
        if (!userAborted(xhr)) {
            if (xhr.status == 403) {
                var isJson = false;
                try {
                    var response = $.parseJSON(xhr.responseText);
                    isJson = true;
                }
                catch (e) { }

                if (isJson && response != null && response.Type == "NotAuthorized" && response.Link != undefined)
                    window.location = baseUrl +response.Link;
                else
                    window.location = window.baseUrl;
            }
            else {
                var alertText = "";
                switch (xhr.status){
                    case 404:
                        alertText =  serverError +  "'Method " + xhr.statusText + "'";
                        break;

                    case 200:
                        break;

                    default :
                        alertText =  serverError + "'" + xhr.statusText + "'";
                        break;
                }
                alert(alertText);
                OnError(alertText, "", "", "");

            }
        }
    }
});
}

function UpdateDateJS(data, format) {
    if(data == undefined || data == null )
        return data;
    if (format == undefined) {
        format = dateFormatToPassToServerSide;
    }
    return  moment(data).format(format);
}

function UpdateDateTimeJS(data, format) {
    if(data == undefined || data == null )
        return data;
    if (format == undefined) {
        format = dateTimeFormatToPassToServerSide;
    }
    return moment(data).format(format);
}


function userAborted(xhr) {
    return !xhr.getAllResponseHeaders();
}

function OnError(message, file, line, error) {

    var apiUrl = baseUrl+'/javascripterror';
    if(line == undefined || line ==  ""){
        line = "";
    }
    if(file == undefined || file ==  ""){
        file = "";
    }
    if(error == undefined || error ==  ""){
        error = "";
    }
    else{
        error = error.stack;
    }
    //suppress browser error messages
    var suppressErrors = true;
    $.ajax({
        url: apiUrl,
        type: 'POST',
        data: {
            errorMsg: message,
            errorLine: line,
            queryString: file,
            url: document.location.pathname,
            referrer: document.referrer,
            stack: error,
            userAgent: navigator.userAgent
        }
    });

    return suppressErrors;
}



function ShowAlertMessage(message, type, header) {
    var classname;
    if (!header) {
        header = '';
    }

    switch (type) {
        case 'alert':
            classname = 'warning';
            break;
        case 'info':
            classname = 'info';
            break;
        case 'error':
            classname = 'error';
            break;
        default:
            classname = 'warning';
            type = 'alert';
            break;
    }

    BootstrapDialog.show({
        title: header,
        message: message,
        buttons: [{
            label: 'Close',
            cssClass: 'btn btn-danger',
            action: function(dialogItself){
                dialogItself.close();
            }
        }]
    });
}


function SetMessageForPageLoad(data, cookieName,days) {
    if (cookieName == undefined) {
        cookieName = DefaultCookieName;
    }
    if (days)
        $.cookie(cookieName, JSON.stringify(data), { expires: days, path: '/' });
    else
        $.cookie(cookieName, JSON.stringify(data), { path: '/' });
}

$(document).ready(function () {
    $('.page-content input:first').focus();
    ShowPageLoadMessage();
});


function ShowPageLoadMessage(cookieName) {
    if (cookieName == undefined) {
        cookieName = DefaultCookieName;
    }
    if ($.cookie(cookieName) != null && $.cookie(cookieName) != "null") {
        ShowSuccessMessage($.cookie(cookieName),'success','Success');
        $.cookie(cookieName, null, { path: '/' });
    }
}


function ShowSuccessMessage(message, type){
    $.msgGrowl({
        type : type ? type : "Success",
        text : message,
        position: 'top-center',
        lifetime: 5000
    });
}

function ShowConfirm(message, callback, successButtonText, cancelButtonText) {
    var success = "Yes";
    var cancel = "No";
    if (successButtonText != null)
        success = successButtonText;
    if (cancelButtonText != null)
        cancel = cancelButtonText;

    new BootstrapDialog({

        title: window.ConfirmDialogTitle,
        message: window.Confirmdialogmessage + message,
        closable: true,
        data: {
            'callback': callback
        },

        buttons: [{
            label: success,
            cssClass: 'btn btn-danger',
            action: function (dialogItself) {
                dialogItself.close();
                typeof dialogItself.getData('callback') === 'function' && dialogItself.getData('callback')(false);
            }
        },
            {
                label: cancel,
                cssClass: 'btn btn-grey',
                action: function (dialogItself) {
                    dialogItself.close();
                }
            }]

    }).open();
}

function CopyProperties(theSource,theTarget) {
    for (var propertyName in theTarget)
        //theTarget[propertyName] && (theTarget[propertyName] = theSource[propertyName]);
        theTarget[propertyName] = theSource[propertyName];
}