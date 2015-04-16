var force = false;
var ZendR = {
    Loading: {
        open: function (options) {

            if ($('#zrLoading').html() == null) {
                var title = 'Cargando...';
                if (options.title != undefined) {
                    title = options.title;
                }
                $('body').append('<div id="zrLoading" title="' + title + '" align="center"><img src="' + site.baseUrl + '/zendr/css/images/loader.gif" alt="" \/><\/div>');
            }
            $('#zrLoading').dialog({
                modal: true,
                bgiframe: true,
                draggable: false,
                resizable: false,
                close: function(event, ui) {
                    if (!force) {
                        $(this).dialog('open');
                    }
                }
            });
        },
        close: function () {
            force = true
            $('#zrLoading').dialog('close');
        }
    }
}

ZendR.Url = function () {

}

ZendR.Url.serialize = function (urlParams, urlBase) {
    var uBase = new String(urlBase);
    var key = new String();


    var uParams = String.parseString(urlParams).split('&');
    for (var i = 0; i < uParams.length; i++) {
        var param = uParams[i].split('=');
        key = param[0];
        var value = escape(param[1]);

        var posicion = uBase.indexOf('/' + key + '/');
        if (posicion > 0) {
            var kParams = uBase.substr(posicion).split('/');
            uBase = uBase.replace(trim('/' + key + '/' + kParams[2]), trim('/' + key + '/' + value));
        } else {
            uBase += '/' + key + '/' + value;
        }
    }
    return uBase;
}

ZendR.Search = function () {

}

ZendR.Search.searchItem = function (idElement, url) {
    $.ajax({
        url: url,
        success: function(html) {
            $('#' + idElement + '-search').html(html);

            $('.aPopup').each(function() {
                $(this).attr("href", "javascript:ZendR.Search.searchItem('" + idElement + "', '" + this.href + "')");
            });

            $('.aPopupElement').each(function() {
                $(this).attr("href", "javascript:ZendR.Search.selectItem('" + idElement + "', '" + addslashes(this.id) + "')");
            });

            $('#Search .searchRight form').submit(function() {
                ZendR.Search.searchItem(idElement, ZendR.Url.serialize($(this).serialize(), url));
                return false;
            });

            $('#' + idElement + '-search').dialog('open');
        }
    })
}

ZendR.Search.selectItem = function (idElement, id) {
    var idNombre = id.split('#');
    $('#' + idElement).val(idNombre[0]);
    $('#' + idElement + '-select').html(stripslashes(idNombre[1]));
    $('#' + idElement + '-search').dialog('close');
    $('#' + idElement + '-search').html('');
}

Date.parseDate = function (sDate) {
	var aDate = sDate.split("/");
	if (aDate.length == 3) {
		var tDay	= aDate[0];
		var tMonth	= aDate[1];
		var tYear	= aDate[2];
		if (!isNaN(tDay) && !isNaN(tMonth) && !isNaN(tYear)) {
			return  new Date(tYear, tMonth - 1, tDay, 0, 0, 0);
		}
	}
	return  null;
}

Date.prototype.addDay = function (days) {
	var tDays = parseInt(days);
	this.setDate(this.getDate() + tDays);

	return this;
}

Date.prototype.subDay = function () {
	var tDays = parseInt(days);
	this.setDate(this.getDate() - tDays);

	return this;
}

Date.prototype.diffDays = function (vDate) {

	var  nroSecondsThis = this.getTime();
	var  nroSecondsDate = vDate.getTime();

	var seconds;
	if (nroSecondsDate < nroSecondsThis) {
		seconds = nroSecondsThis - nroSecondsDate;
	} else {
		seconds = nroSecondsDate - nroSecondsThis;
	}

	return Math.floor(seconds/(1000*60*60*24));
}

Date.prototype.forUI = function () {
	var bMonth = (this.getMonth() + 1);
	if (bMonth < 10) {
		bMonth = "0" + bMonth;
	}

	var bDay = this.getDate();
	if (bDay < 10) {
		bDay = "0" + bDay;
	}

	return bDay + "/" + bMonth  + "/" + this.getFullYear();
}

Date.prototype.forDB = function () {
	var bMonth = (this.getMonth() + 1);
	if (bMonth < 10) {
		bMonth = "0" + bMonth;
	}

	var bDay = this.getDate();
	if (bDay < 10) {
		bDay = "0" + bDay;
	}

	return this.getFullYear() + "-"  + bMonth  + "-" + bDay;
}

Date.prototype.findEdad = function () {
	var hoy = new Date();
	var edad = hoy.getFullYear() - this.getFullYear();

	if (hoy.getMonth() > this.getMonth()) {
	   return edad;
	}
	if (hoy.getMonth() < this.getMonth()) {
	   return edad - 1;
	}
	if (hoy.getDate() >= this.getDate()) {
	   return edad;
	}

	return edad - 1;
}

String.parseString = function (val) {
    return new String(val);
}

String.prototype.trim = function () {
	return this.replace(/^(\s|\&nbsp;)*|(\s|\&nbsp;)*$/g,"");
}

String.prototype.isValidEmail = function () {
	if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this)) {
		return true;
	} else {
		return false;
	}
}

String.prototype.isValidMultiplesEmail = function () {
	var emails = this.trim().split(',');

	for (var i = 0; i < emails.length; i++) {
		var email = new String(emails[i]);
		if (!email.trim().isValidEmail()) {
			alert('Este correo no es valido: ' + email);
			return false;
		}
	}

	return true;
}

String.prototype.isValidEntero = function () {
    var valid = false;
    if (this != null && this != "" && !isNaN(this)) {
        valid = parseInt(this, 10) == this;
    }
    return valid;
}

var validarEmail = function (email) {
	if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) {
		return true;
	} else {
		return false;
	}
}

var trim = function (cadena) {
	return cadena.replace(/^(\s|\&nbsp;)*|(\s|\&nbsp;)*$/g,"");
}
/**
*
*  Base64 encode / decode
*  http://www.webtoolkit.info/
*
**/

var Base64 = {

	// private property
	_keyStr : "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",

	// public method for encoding
	encode : function (input) {
		var output = "";
		var chr1, chr2, chr3, enc1, enc2, enc3, enc4;
		var i = 0;

		input = Base64._utf8_encode(input);

		while (i < input.length) {

			chr1 = input.charCodeAt(i++);
			chr2 = input.charCodeAt(i++);
			chr3 = input.charCodeAt(i++);

			enc1 = chr1 >> 2;
			enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
			enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
			enc4 = chr3 & 63;

			if (isNaN(chr2)) {
				enc3 = enc4 = 64;
			} else if (isNaN(chr3)) {
				enc4 = 64;
			}

			output = output +
			this._keyStr.charAt(enc1) + this._keyStr.charAt(enc2) +
			this._keyStr.charAt(enc3) + this._keyStr.charAt(enc4);

		}

		return output;
	},

	// public method for decoding
	decode : function (input) {
		var output = "";
		var chr1, chr2, chr3;
		var enc1, enc2, enc3, enc4;
		var i = 0;

		input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");

		while (i < input.length) {

			enc1 = this._keyStr.indexOf(input.charAt(i++));
			enc2 = this._keyStr.indexOf(input.charAt(i++));
			enc3 = this._keyStr.indexOf(input.charAt(i++));
			enc4 = this._keyStr.indexOf(input.charAt(i++));

			chr1 = (enc1 << 2) | (enc2 >> 4);
			chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
			chr3 = ((enc3 & 3) << 6) | enc4;

			output = output + String.fromCharCode(chr1);

			if (enc3 != 64) {
				output = output + String.fromCharCode(chr2);
			}
			if (enc4 != 64) {
				output = output + String.fromCharCode(chr3);
			}

		}

		output = Base64._utf8_decode(output);

		return output;

	},

	// private method for UTF-8 encoding
	_utf8_encode : function (string) {
		string = string.replace(/\r\n/g,"\n");
		var utftext = "";

		for (var n = 0; n < string.length; n++) {

			var c = string.charCodeAt(n);

			if (c < 128) {
				utftext += String.fromCharCode(c);
			}
			else if((c > 127) && (c < 2048)) {
				utftext += String.fromCharCode((c >> 6) | 192);
				utftext += String.fromCharCode((c & 63) | 128);
			}
			else {
				utftext += String.fromCharCode((c >> 12) | 224);
				utftext += String.fromCharCode(((c >> 6) & 63) | 128);
				utftext += String.fromCharCode((c & 63) | 128);
			}

		}

		return utftext;
	},

	// private method for UTF-8 decoding
	_utf8_decode : function (utftext) {
		var string = "";
		var i = 0;
		var c = c1 = c2 = 0;

		while ( i < utftext.length ) {

			c = utftext.charCodeAt(i);

			if (c < 128) {
				string += String.fromCharCode(c);
				i++;
			}
			else if((c > 191) && (c < 224)) {
				c2 = utftext.charCodeAt(i+1);
				string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
				i += 2;
			}
			else {
				c2 = utftext.charCodeAt(i+1);
				c3 = utftext.charCodeAt(i+2);
				string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
				i += 3;
			}

		}

		return string;
	}

}


/**
 * Permite dar formato a un numero
 * @param float a Numero al que se aplicara el formato
 * @param int b La presicion paar el redondeo
 * @param string c Caracter para los decimales
 * @param string d Caracter para los miles
 * @return string
 **/
var number_format = function(a, b, c, d) {
    var negativo = false;
    if (a < 0) {
        a = a * -1;
        negativo = true;
    }
    a = Math.round(a * Math.pow(10, b)) / Math.pow(10, b);
    e = a + "";
    f = e.split(".");
    if (!f[0]) f[0] = "0";
    if (!f[1]) f[1] = "";
    if (f[1].length < b) {
        g = f[1];
        for (i = f[1].length + 1; i <= b; i++) {
            g += "0";
        }
        f[1] = g;
    }
    if(d != "" && f[0].length > 3) {
        h = f[0];
        f[0] = "";
        for (j = 3; j < h.length; j += 3) {
            i = h.slice(h.length - j, h.length - j + 3);
            f[0] = d + i +  f[0] + "";
        }
        j = h.substr(0, (h.length % 3 == 0) ? 3 : (h.length % 3));
        f[0] = j + f[0];
    }
    c = (b <= 0) ? "": c;
    resultado = f[0] + c + f[1];
    if (negativo) {
        resultado = "-" + resultado;}
    return resultado;
}

var stripslashes = function (str) {
    // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   improved by: Ates Goral (http://magnetiq.com)
    // +      fixed by: Mick@el
    // +   improved by: marrtins    // +   bugfixed by: Onno Marsman
    // +   improved by: rezna
    // +   input by: Rick Waldron
    // +   reimplemented by: Brett Zamir (http://brett-zamir.me)
    // +   input by: Brant Messenger (http://www.brantmessenger.com/)    // +   bugfixed by: Brett Zamir (http://brett-zamir.me)
    // *     example 1: stripslashes('Kevin\'s code');
    // *     returns 1: "Kevin's code"
    // *     example 2: stripslashes('Kevin\\\'s code');
    // *     returns 2: "Kevin\'s code"
    return (str+'').replace(/\\(.?)/g, function (s, n1) {
        switch (n1) {
            case '\\':
                return '\\';
            case '0':return '\u0000';
            case '':
                return '';
            default:
                return n1;}
    });
}



var addslashes = function (str) {
    // Escapes single quote, double quotes and backslash characters in a string with backslashes
    //
    // version: 1004.2314
    // discuss at: http://phpjs.org/functions/addslashes    // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   improved by: Ates Goral (http://magnetiq.com)
    // +   improved by: marrtins
    // +   improved by: Nate
    // +   improved by: Onno Marsman    // +   input by: Denny Wardhana
    // +   improved by: Brett Zamir (http://brett-zamir.me)
    // +   improved by: Oskar Larsson Högfeldt (http://oskar-lh.name/)
    // *     example 1: addslashes("kevin's birthday");
    // *     returns 1: 'kevin\'s birthday'
    return (str+'').replace(/[\\"']/g, '\\$&').replace(/\u0000/g, '\\0');
}

