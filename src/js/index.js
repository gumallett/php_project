var Validator = (function() {

    var messages = [];

    var change = function(name, newmsg) {
        var message = messages[name];
        var elem = message.helpElem;
        elem.innerHTML = newmsg;
    };

    return {
        error: function(elem, msg) {
            if(messages.hasOwnProperty(elem.name)) {
                change(elem.name, msg);
                setError(elem);
            }
            else {
                setError(elem);
                messages[elem.name] = {
                    helpElem: addHelpText(elem, msg),
                    message: msg
                };
            }
        },
        clear: function(elem) {
            if(messages.hasOwnProperty(elem.name)) {
                change(elem.name, '');
                elem.parentNode.className = elem.parentNode.className.replace(/(?:^|\s)has-error(?!\S)/g, '');
            }
        }
    }

})();


function validate(form) {
    var valid = true;

    for(var key in form) {
        if(form.hasOwnProperty(key)) {
            var elem = form[key];
            if(!elem.getAttribute) {
                continue;
            }

            Validator.clear(elem);
            var type = elem.getAttribute('type');
            var required = elem.required;

            if(type == 'date') {
                try {
                    var date = parseDate(elem.value);

                    if(!date) {
                        Validator.error(elem, 'Please enter a validate date, e.g: 12/12/2014');
                        valid = false;
                    }
                    else {
                        if(new Date() > date) {
                            Validator.error(elem, 'Please enter a future date');
                            valid = false;
                        }
                    }
                }
                catch(err) {
                    Validator.error(elem, 'Please enter a validate date, e.g: 12/12/2014');
                    valid = false;
                }
            }

            if(required && !elem.value) {
                Validator.error(elem, 'Field is required');
                valid = false;
            }
        }
    }
    return valid;
}

function addHelpText(node, msg) {
    var elem = document.createElement("span");
    elem.className = "help-block";
    elem.innerHTML = msg;
    node.parentNode.appendChild(elem);
    return elem;
}

function setError(formField) {
    if(formField.parentNode.className.indexOf('has-error') < 0) {
        formField.parentNode.className += ' has-error';
    }
}

function parseDate(dateString) {
    if(dateString) {
        var arr = dateString.split('/');
        if(arr.length != 3) {
            return false;
        }

        var months = arr[0];
        var days = arr[1];
        var year = arr[2];

        if(months < 1 || months > 12) {
            return false;
        }

        if(days < 1 || days > 31) {
            return false;
        }

        if(year < 1900 || year > 2100) {
            return false;
        }

        return new Date(dateString);
    }

    return false;
}



